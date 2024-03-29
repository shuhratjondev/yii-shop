<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms\Shop
 */

namespace shop\forms\manage\Shop;

use shop\entities\Shop\Brand;
use shop\forms\CompositeForm;
use shop\forms\manage\MetaForm;
use shop\validators\SlugValidator;

/**
 * Class BrandForm
 *
 * @author sh_abdurasulov
 * @package shop\forms\Shop
 * @property MetaForm $meta
 */
class BrandForm extends CompositeForm
{

    public $name;
    public $slug;

    private ?Brand $_brand;

    public function __construct(Brand $brand = null, $config = [])
    {
        $this->_brand = $brand;
        if ($this->_brand) {
            $this->name = $this->_brand->name;
            $this->slug = $this->_brand->slug;
            $this->meta = new MetaForm($this->_brand->meta);
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], SlugValidator::class],
            [
                ['name', 'slug'], 'unique', 'targetClass' => Brand::class,
                'filter' => $this->_brand ? ['<>', 'id', $this->_brand->id] : []
            ]
        ];
    }


    protected function internalForms(): array
    {
        return [
            'meta'
        ];
    }
}