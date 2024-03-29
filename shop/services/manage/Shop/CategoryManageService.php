<?php
/**
 * User: sh_abdurasulov
 * @package shop\services\manage\Shop
 */

namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\entities\Shop\Category;
use shop\forms\manage\Shop\CategoryForm;
use shop\repositories\Shop\CategoryRepository;

class CategoryManageService
{
    private CategoryRepository $categories;

    public function __construct(CategoryRepository $categories)
    {
        $this->categories = $categories;
    }

    public function create(CategoryForm $form): Category
    {
        $parent = $this->categories->get($form->parentId);
        $category = Category::create(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            ),
        );
        $category->appendTo($parent);
        $this->categories->save($category);
        return $category;
    }

    public function edit($id, CategoryForm $form): void
    {
        /* @var Category $category */
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $parent = $this->categories->get($form->parentId);
        $category->edit(
            $form->name,
            $form->slug,
            $form->title,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords
            ),
        );
        $category->appendTo($parent);
        $this->categories->save($category);
    }

    public function moveUp($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($prev = $category->getPrev()->one()) {
            $category->insertBefore($prev);
        }
        $this->categories->save($category);
    }

    public function moveDown($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        if ($next = $category->getNext()->one()) {
            $category->insertAfter($next);
        }
        $this->categories->save($category);
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $category = $this->categories->get($id);
        $this->assertIsNotRoot($category);
        $this->categories->remove($category);
    }

    private function assertIsNotRoot(Category $category): void
    {
        if ($category->isRoot()) {
            throw new \DomainException("Unable to manage the root category.");
        }
    }

}