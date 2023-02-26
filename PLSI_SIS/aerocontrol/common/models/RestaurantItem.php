<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "restaurant_item".
 *
 * @property int $id
 * @property string $item
 * @property string $image
 * @property int $state
 * @property int $restaurant_id
 *
 * @property Restaurant $restaurant
 */
class RestaurantItem extends \yii\db\ActiveRecord
{

    const STATE_ACTIVE = 1;
    const STATE_INACTIVE = 0;

    public $imageFile;

    // Nome do ficheiro de placeholder caso o item dos perdidos e achados não tenha imagem
    public $imagePlaceholder = 'logo-placeholder.svg';
    // Nome do ficheiro do placeholder caso o item dos perdidos e achados tenha imagem, mas seja possível carregar
    public $imagePlaceholderOnError = 'logo-placeholder-on-error.svg';

    /**
     * Retorna o path onde se faz os uploads relacionados a este modelo
     * 
     * @return string path
     */
    public function getUploadPath()
    {
        $parentPath = $this->restaurant->getUploadPath();
        $path = $parentPath . '/menu';

        return $path;
    }

    /**
     * Retorna o url onde se faz os uploads relacionados a este modelo
     * 
     * @return string url
     */
    public function getUploadUrl()
    {
        $parentPath = $this->restaurant->getUploadUrl();
        $path = $parentPath . '/menu';

        return $path;
    }

    /**
     * Retorna o url do path da imagem,
     * caso seja null na BD então retorna [[$this->imagePlaceholder]]
     *
     * @return string Url do path da imagem
     */
    public function getImagePathUrl()
    {
        $pathUrl = '';

        // Se não existir imagem na DB então dá o URL do [[$this->placeholder]]
        if (is_null($this->image))
            $pathUrl = '@web/images/' . $this->imagePlaceholder;
        // Se existir imagem na DB, mas não existir no servidor então dá o URL do [[$this->placeholder-on-error]]
        else if (!file_exists($this->getUploadPath() . '/' . $this->image))
            $pathUrl = '@web/images/' . $this->imagePlaceholderOnError;
        // Se existir imagem na DB e no server então dá o URL da imagem
        else
            $pathUrl = $this->getUploadUrl() . '/' . $this->image;

        return $pathUrl;
    }


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%restaurant_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['image', 'item'], 'trim'],
            [['item', 'state'], 'required', 'message' => "{attribute} não pode ser vazio."],

            ['image', 'default', 'value' => null],
            ['image', 'string', 'max' => 50, 'tooLong' => 'O {attribute} não pode exceder os 50 caracteres.'],

            ['state', 'boolean'],
            ['state', 'default', 'value' => 1],

            ['item', 'string', 'max' => 100, 'tooLong' => 'O {attribute} não pode exceder os 100 caracteres.'],

            ['restaurant_id', 'integer'],
            ['restaurant_id', 'exist', 'skipOnError' => true, 'targetClass' => Restaurant::class, 'targetAttribute' => ['restaurant_id' => 'id']],

            ['imageFile', 'image', 'notImage' => '{file} não é uma imagem.'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'item' => 'Item',
            'image' => 'Imagem',
            'state' => 'Estado',
            'restaurant_id' => 'ID do Restaurante',
        ];
    }

    /**
     * Antes de validar dá a instancia do UploadedFila a [[$this->imageFile]]
     */
    public function beforeValidate()
    {
        $this->imageFile = UploadedFile::getInstance($this, 'imageFile');

        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Se estivermos num update
        if (!$insert) {
            // Se existir uma nova imagem então dá delete da antiga, é dá upload da nova
            if (!is_null($this->imageFile)) {
                $this->deleteImage();
                if (!$this->upload())
                    return false;
            }
        } else {
            // Se o [[$this->imageFile]] não for null, ou seja, não escolheu uma imagem, então não é preciso fazer o upload
            if (!is_null($this->imageFile)) {
                if (!$this->upload())
                    return false;
            }
        }

        return true;
    }

    /**
     * Antes de dar delete apaga a imagem do server
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $this->deleteImage();

        return true;
    }


    /**
     * Uploads [[$this->imageFile]] to the server and assigns [[$this->image]] to the image file name
     *
     * @return boolean true whether the upload was successfully
     */
    protected function upload()
    {
        if (!FileHelper::createDirectory($this->getUploadPath()))
            return false;

        $image_name = $this->item . '_' . date("d-m-Y_H-i") . '.' . $this->imageFile->extension;
        $image_path = $this->getUploadPath() . '/' . $image_name;

        if ($this->imageFile->saveAs($image_path)) {
            $this->image = $image_name;
            return true;
        }

        return false;
    }

    /**
     * Deletes the image from the server if [[$this->image] != null]
     *
     * @return boolean true whether the image file was deleted from the server successfully
     */
    public function deleteImage()
    {
        if (!is_null($this->image)) {
            if (file_exists($this->getUploadPath() . '/' . $this->image)) {
                if (!unlink($this->getUploadPath() . '/' . $this->image))
                    return false;
            }
        }

        return true;
    }

    public function getState()
    {
        return $this->state == self::STATE_INACTIVE ? "Inativo" : "Ativo";
    }

    /**
     * Gets query for [[Restaurant]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getRestaurant()
    {
        return $this->hasOne(Restaurant::class, ['id' => 'restaurant_id']);
    }
}
