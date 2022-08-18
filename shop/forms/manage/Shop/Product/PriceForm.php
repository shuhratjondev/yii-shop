<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms\manage\Shop\Product
 */

namespace shop\forms\manage\Shop\Product;


use shop\forms\manage\Shop\CategoryForm;
use shop\forms\MetaForm;
use yii\base\Model;

/**
 * Class PriceForm
 *
 * @author sh_abdurasulov
 * @package shop\forms\manage\Shop\Product
 *
 * @property MetaForm $meta
 * @property CategoryForm $categories
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class PriceForm extends Model
{
    public $old;
    public $new;


    public function __construct(Product $product, $config = [])
    {
        if ($product) {
            $this->new = $product->price_new;
            $this->old = $product->price_old;
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['new'], 'required'],
            [['old', 'new'], 'integer', 'min' => 0],
        ];
    }


}