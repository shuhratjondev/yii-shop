<?php


namespace shop\forms\manage\Shop\Product;

use shop\entities\Shop\Characteristic;
use shop\entities\Shop\Product\Product;
use shop\forms\CompositeForm;
use shop\forms\MetaForm;

/**
 * @property PriceForm $price
 * @property MetaForm $meta
 * @property CategoriesForm $categories
 * @property PhotosForm $photos
 * @property TagsForm $tags
 * @property ValueForm[] $values
 */
class ProductEditeForm extends CompositeForm
{
    public $brandId;
    public $code;
    public $name;

    private Product $_product;

    public function __construct(Product $product, $config = [])
    {
        $this->meta = $product->meta;
        $this->tags = new TagsForm($product);
        $this->_product = $product;
        $this->values = array_map(function (Characteristic $characteristic) {
            return new ValueForm($characteristic, $this->_product->getValue($characteristic->id));
        }, Characteristic::find()->orderBy('sort')->all());

        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['brandId', 'code', 'name'], 'required'],
            [['code', 'name'], 'string', 'max' => 255],
            [['brandId'], 'integer'],
            ['code', 'unique', 'targetClass' => Product::class, 'filter' => $this->_product ? ['<>', 'id' => $this->_product->id] : []],
        ];
    }


    protected function internalForms(): array
    {
        return ['meta', 'tags', 'values'];
    }
}