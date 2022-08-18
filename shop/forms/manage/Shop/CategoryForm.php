<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms\Shop
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\Category;
use shop\forms\CompositeForm;
use shop\forms\MetaForm;
use shop\validators\SlugValidator;

/**
 * @property MetaForm $meta;
 *
 * */
class CategoryForm extends CompositeForm
{
    public $name;
    public $slug;
    public $title;
    public $description;
    public $parentId;

    private Category $_category;

    public function __construct(Category $category, $config = [])
    {
        if ($category) {
            $this->name = $category->name;
            $this->slug = $category->slug;
            $this->title = $category->title;
            $this->description = $category->description;
            $this->parentId = $category->parent ? $category->parent->id : null;
            $this->meta = new MetaForm($category->meta);
            $this->_category = $category;
        } else {
            $this->meta = new MetaForm();
        }
        parent::__construct($config);
    }

    public function rules()
    {
        return [
            [['name', 'slug'], 'required'],
            [['name', 'slug'], 'string', 'max' => 255],
            [['slug'], SlugValidator::class],
            [['name', 'slug'], 'unique', 'targetClass' => Category::class, 'filter' => $this->_category ? ['<>', 'id' => $this->_category->id] : []]
        ];
    }

    protected function internalForms(): array
    {
        return ['meta'];
    }
}