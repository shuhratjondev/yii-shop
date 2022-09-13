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
    public array $files;


    public function rules()
    {
        return [
            ['files', 'each', 'rule' => ['image']],
        ];
    }

    public function beforeValidate(): bool
    {
        if (parent::beforeValidate()) {
            $this->files = UploadedFile::getInstances($this, 'files');
            return true;
        }
        return false;
    }

}