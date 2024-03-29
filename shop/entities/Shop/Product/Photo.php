<?php


namespace shop\entities\Shop\Product;


use PHPThumb\GD;
use shop\services\WaterMarker;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property $id
 * @property $product_id
 * @property $file
 * @property $sort
 * @property \yiidreamteam\upload\ImageUploadBehavior
 *
 */
class Photo extends ActiveRecord
{

    public static function create(UploadedFile $file): self
    {
        $photo = new self();
        $photo->file = $file;
        return $photo;
    }

    public function setSort($sort): void
    {
        $this->sort = $sort;
    }

    public function isIdEqualTo(int $id): bool
    {
        return $this->id === $id;
    }

    ##################################
    public static function tableName(): string
    {
        return "{{%shop_photos}}";
    }

    public function behaviors()
    {
        return [
            [
                'class' => '\yiidreamteam\upload\ImageUploadBehavior',
                'attribute' => 'file',
                'createThumbsOnRequest' => true,
                'filePath' => '@staticPath/origin/products/[[attribute_product_id]]/[[pk]].[[extension]]',
                'fileUrl' => '@staticHost/origin/products/[[attribute_product_id]]/[[pk]].[[extension]]',
                'thumbPath' => '@staticPath/cache/products/[[attribute_product_id]]/[[profile]]_[[pk]].[[extension]]',
                'thumbUrl' => '@staticHost/cache/products/[[attribute_product_id]]/[[profile]]_[[pk]].[[extension]]',
                'thumbs' => [
                    'admin' => ['width' => 100, 'height' => 70],
                    'thumb' => ['width' => 640, 'height' => 480],
                    'catalog_list' => ['width' => 228, 'height' => 228],
//                    'catalog_product_main' => ['width' => 750, 'height' => 1000],
                    'catalog_product_main' => ['processor' =>
                        [new WaterMarker(750, 1000, '@frontend/web/image/logo.png'), 'process'],
                    ],
                    'catalog_product_additional' => ['width' => 66, 'height' => 66],
                    'catalog_origin' => ['processor' =>
                        [new WaterMarker(1024, 768, '@frontend/web/image/logo.png'), 'process'],
                    ],
                ],
            ],
        ];
    }

}