<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "lost_item".
 *
 * @property int $id
 * @property string $description
 * @property string $state
 * @property string $image
 *
 * @property TicketItem $ticketItem
 */
class LostItem extends \yii\db\ActiveRecord
{
    public $imageFile;

    // Nome do ficheiro de placeholder caso o item dos perdidos e achados não tenha imagem
    public $imagePlaceholder = 'logo-placeholder.svg';
    // Nome do ficheiro do placeholder caso o item dos perdidos e achados tenha imagem, mas seja possível carregar
    public $imagePlaceholderOnError = 'logo-placeholder-on-error.svg';

    const STATE_DELIVERED = "Entregue";
    const STATE_FOR_DELIVERING = "Por entregar";
    const STATE_LOST = "Perdido";

    public $POSSIBLE_STATES_FOR_DROPDOWN = [

        'Entregue' => 'Entregue',
        'Por entregar' => 'Por entregar',
        'Perdido' => 'Perdido'
    ];


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
        else if (!file_exists(Yii::getAlias('@uploadLostItems/') . $this->image))
            $pathUrl = '@web/images/' . $this->imagePlaceholderOnError;
        // Se existir imagem na DB e no server então dá o URL da imagem
        else
            $pathUrl = '@uploadLostItemsUrl/' . $this->image;

        return $pathUrl;
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%lost_item}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['description', 'state'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['description', 'state', 'image'], 'trim'],
            ['state', 'in', 'range' => [
                'Entregue',
                'Por entregar',
                'Perdido'
            ], 'strict' => true],
            ['image', 'default', 'value' => null],
            ['state', 'default', 'value' => 'Por entregar'],
            ['description', 'string', 'max' => 100, 'tooLong' => 'A descrição e não pode exceder os 100 caracteres.'],
            ['image', 'string', 'max' => 75, 'tooLong' => 'A imagem e não pode exceder os 75 caracteres.'],
            ['image', 'unique', 'message' => "Esta imagem já está a ser utilizada."],
            [
                'imageFile', 'image', 'notImage' => '{file} não é uma imagem.'
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'description' => 'Descrição',
            'state' => 'Estado',
            'image' => 'Imagem',
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
            if ($this->imageFile !== null) {
                $this->deleteImage();
                if (!$this->upload())
                    return false;
            }
        } else {
            // Se o [[$this->imageFile]] não for null, ou seja, não escolheu uma imagem, então não é preciso fazer o upload
            if ($this->imageFile !== null) {
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
        if (!FileHelper::createDirectory(Yii::getAlias('@uploadLostItems')))
            return false;

        $image_name = date("d-m-Y_H-i-s") . '.' . $this->imageFile->extension;
        $image_path = Yii::getAlias('@uploadLostItems/') . $image_name;

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
            if (file_exists(Yii::getAlias('@uploadLostItems/') . $this->image)) {
                if (!unlink(Yii::getAlias('@uploadLostItems/') . $this->image))
                    return false;
            }
        }

        return true;
    }


    /**
     * Gets query for [[TicketItem]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getTicketItem()
    {
        return $this->hasOne(TicketItem::class, ['lost_item_id' => 'id']);
    }
}
