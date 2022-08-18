<?php
/**
 * User: sh_abdurasulov
 */

namespace shop\forms\manage\Shop\Product;

use yii\base\Model;
use yii\web\UploadedFile;


class PhotosForm extends Model
{
    /* @var UploadedFile[] */
    public $files;


    public function rules()
    {
        return [
            ['files', 'each', 'rule' => ['image']],
        ];
    }

    public function beforeValidate(): bool
    {
        $this->files = UploadedFile::getInstances($this, 'files');
        return parent::beforeValidate();
    }

}