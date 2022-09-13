<?php


namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\entities\Shop\Product\Product;
use shop\forms\manage\Shop\Product\CategoriesForm;
use shop\forms\manage\Shop\Product\PhotosForm;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\repositories\Shop\BrandRepository;
use shop\repositories\Shop\CategoryRepository;
use shop\repositories\Shop\Product\ProductRepository;
use shop\repositories\Shop\TagRepository;

class ProductManageService
{
    private ProductRepository $products;
    private BrandRepository $brands;
    private CategoryRepository $categories;
    private TagRepository $tags;

    /**
     * ProductManageService constructor.
     * @param ProductRepository $products
     * @param BrandRepository $brands
     * @param CategoryRepository $categories
     * @param TagRepository $tags
     */
    public function __construct(
        ProductRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories,
        TagRepository $tags
    )
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
        $this->tags = $tags;
    }


    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product = Product::create(
            $brand->id,
            $category->id,
            $form->code,
            $form->name,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords,
            )
        );

        $product->setPrice($form->price->new, $form->price->old);

        foreach ($form->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }

        foreach ($form->photos as $photo){
            $product->addPhoto($photo);
        }

//        foreach ($form->tags->existing as $tagId){
            //$product->
//        }


        $this->products->save($product);

        return $product;
    }

    // category
    public function changeCategories($id, CategoriesForm $form): void
    {
        $product = $this->products->get($id);
        $category = $this->categories->get($form->main);
        $product->changeMainCategory($category->id);
        $product->revokeCategories();
        foreach ($form->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }
        $this->products->save($product);
    }

    // Photo
    public function addPhotos($id, PhotosForm $form): void
    {
        $product = $this->products->get($id);
        foreach ($form->files as $file) {
            $product->addPhoto($file);
        }
        $this->products->save($product);
    }

    public function movePhotoUp($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoUp($photoId);
        $this->products->save($product);
    }

    public function movePhotoDown($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->movePhotoDown($photoId);
        $this->products->save($product);
    }

    public function removePhoto($id, $photoId): void
    {
        $product = $this->products->get($id);
        $product->removePhoto($photoId);
        $this->products->save($product);
    }


    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id)
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }


}