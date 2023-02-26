<?php

namespace common\models;

use Yii;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * This is the model class for table "store".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property string $phone
 * @property string|null $open_time
 * @property string|null $close_time
 * @property string|null $logo
 * @property string|null $website
 */
class Store extends \yii\db\ActiveRecord
{
    public $logoFile;

    // Nome do ficheiro de placeholder caso a loja não ter logo
    public $logoPlaceholder = 'logo-placeholder.svg';
    // Nome do ficheiro de placeholder caso a loja ter logo mas não foi possível carregá-lo
    public $logoPlaceholderOnError = 'logo-placeholder-on-error.svg';

    /**
     * Retorna o path onde se faz os uploads relacionados a este modelo
     * 
     * @return string path
     */
    public function getUploadPath()
    {
        $formatedName = preg_replace('/\s+/', '_', $this->name);
        $path = Yii::getAlias('@uploadStores/') . $formatedName;

        return $path;
    }

    /**
     * Retorna o url onde se faz os uploads relacionados a este modelo
     * 
     * @return string url
     */
    public function getUploadUrl()
    {
        $formatedName = preg_replace('/\s+/', '_', $this->name);
        $path = '@uploadStoresUrl/' . $formatedName;

        return $path;
    }


    /**
     * Retorna o url do path do logo,
     * caso seja null na BD então retorna [[$this->logoPlaceholder]]
     *
     * @return string Url do path do logo
     */
    public function getLogoPathUrl()
    {
        $pathUrl = '';

        // Se não existir logo na DB então dá o URL do [[$this->placeholder]]
        if (is_null($this->logo))
            $pathUrl = '@web/images/' . $this->logoPlaceholder;
        // Se existir logo na DB mas não existir no server então dá o URL do [[$this->placeholder-on-error]]
        else if (!file_exists($this->getUploadPath() . '/' . $this->logo))
            $pathUrl = '@web/images/' . $this->logoPlaceholderOnError;
        // Se existir logo na DB e no server então dá o URL do logo
        else
            $pathUrl = $this->getUploadUrl() . '/' . $this->logo;

        return $pathUrl;
    }

    // Formatar as datas visualmente se encontrar um registo
    public function afterFind()
    {
        $this->close_time = Yii::$app->formatter->asTime($this->close_time);
        $this->open_time = Yii::$app->formatter->asTime($this->open_time);
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'store';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'phone', 'logo', 'website', 'open_time', 'close_time'], 'trim'],
            [['logo', 'website', 'open_time', 'close_time'], 'default', 'value' => null],

            [['name', 'description', 'phone'], 'required', 'message' => "{attribute} não pode ser vazio."],
            [['open_time', 'close_time'], 'time', 'message' => "{attribute} contém o formato errado."],
            [
                'name', 'string',
                'max' => 75, 'tooLong' => 'O {attribute} e não pode exceder os 75 caracteres.'
            ],
            [
                'description', 'string',
                'max' => 255, 'tooLong' => 'A {attribute} não pode exceder os 255 caracteres.'
            ],

            [
                'phone', 'number',
                'numberPattern' => '/[\d]{4,15}$/', 'message' => "O nº de telemóvel só pode conter números, ter pelo menos 4 números e não pode exceder os 15 números.",
            ],

            [
                'website', 'string',
                'max' => 50, 'tooLong' => 'O {attribute} e não pode exceder os 50 caracteres.'
            ],
            [['name'], 'unique', 'message' => "Este {attribute} já está a ser utilizado."],

            [
                'logoFile', 'image', 'notImage' => '{file} não é uma imagem.'
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
            'name' => 'Nome',
            'description' => 'Descrição',
            'phone' => 'Nº Telemóvel',
            'open_time' => 'Horário de abertura',
            'close_time' => 'Horário de fecho',
            'logo' => 'Logo da loja',
            'logoFile' => 'Logo da loja',
            'website' => 'Website',
        ];
    }

    /**
     * Antes de validar dá a instancia do UploadedFila a [[$this->logoFile]]
     */
    public function beforeValidate()
    {
        $this->logoFile = UploadedFile::getInstance($this, 'logoFile');

        return parent::beforeValidate();
    }

    public function beforeSave($insert)
    {
        if (!parent::beforeSave($insert)) {
            return false;
        }

        // Se estivermos num update
        if (!$insert) {
            $store = Store::findOne($this->id);
            $store->changeUploadDirName($this->getUploadPath());
            // Se existir um novo logo então dá delete do antigo, é dá upload do novo
            if ($this->logoFile !== null) {
                $this->deleteLogo();
                if (!$this->upload())
                    return false;
            }
        } else {
            // Se o [[$this->logoFile]] não for null, ou seja, não escolheu um logo, então não é preciso fazer o upload
            if ($this->logoFile !== null) {
                if (!$this->upload())
                    return false;
            }
        }

        return true;
    }

    /**
     * Antes de dar delete apaga o logo do server
     */
    public function beforeDelete()
    {
        if (!parent::beforeDelete()) {
            return false;
        }

        $this->deleteLogo();

        return true;
    }


    /**
     * Uploads [[$this->logoFile]] to the server and assigns [[$this->logo]] to the logo file name
     *
     * @return boolean true whether the upload was successfully
     */
    protected function upload()
    {
        if (!FileHelper::createDirectory($this->getUploadPath()))
            return false;

        $image_name = "Logo_" . date("d-m-Y_H-i") . '.' . $this->logoFile->extension;
        $image_path = $this->getUploadPath() . '/'  . $image_name;

        if ($this->logoFile->saveAs($image_path)) {
            $this->logo = $image_name;
            return true;
        }

        return false;
    }

    private function changeUploadDirName($store_new_name){
        return rename($this->getUploadPath(),$store_new_name);
    }

    /**
     * Deletes the logo from the server if [[$this->logo] != null]
     *
     * @return boolean true whether the logo file was deleted from the server successfully
     */
    public function deleteLogo()
    {
        if (!is_null($this->logo)) {
            if (file_exists($this->getUploadPath() . '/' . $this->logo)) {
                if (!unlink($this->getUploadPath() . '/' . $this->logo))
                    return false;
            }
        }

        return true;
    }
}
