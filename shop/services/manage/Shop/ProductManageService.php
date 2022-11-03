<?php


namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\entities\Shop\Product\Product;
use shop\entities\Shop\Tag;
use shop\forms\manage\Shop\Product\CategoriesForm;
use shop\forms\manage\Shop\Product\PhotosForm;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\forms\manage\Shop\Product\ProductEditForm;
use shop\repositories\Shop\BrandRepository;
use shop\repositories\Shop\CategoryRepository;
use shop\repositories\Shop\Product\ProductRepository;
use shop\repositories\Shop\TagRepository;
use shop\services\TransactionManager;

class ProductManageService
{
    private ProductRepository $products;
    private BrandRepository $brands;
    private CategoryRepository $categories;
    private TagRepository $tags;
    private TransactionManager $transaction;

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
        TagRepository $tags,
        TransactionManager $transaction
    )
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
        $this->tags = $tags;
        $this->transaction = $transaction;
    }


    /**
     * @throws \Exception
     */
    public function create(ProductCreateForm $form): Product
    {
        $brand = $this->brands->get($form->brandId);
        $category = $this->categories->get($form->categories->main);

        $product = Product::create(
            $brand->id,
            $category->id,
            $form->code,
            $form->name,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords,
            )
        );

        $product->setPrice($form->price->new, $form->price->old);

        // categories
        foreach ($form->categories->others as $otherId) {
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        // characteristic values
        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }

        // photos
        foreach ($form->photos as $photo) {
            $product->addPhoto($photo);
        }

        // existing tags
        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->findById($tagId);
            $product->assignTag($tag->id);
        }

        // new tags
        $this->transaction->wrap(function () use ($product, $form) {
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }

            $this->products->save($product);
        });

        return $product;
    }

    /**
     * @throws \Exception
     */
    public function edit($id, ProductEditForm $form): void
    {
        $product = $this->products->get($id);
        $brand = $this->brands->get($form->brandId);

        $product->edit(
            $brand->id,
            $form->code,
            $form->name,
            $form->description,
            new Meta(
                $form->meta->title,
                $form->meta->description,
                $form->meta->keywords,
            )
        );

        // characteristic values
        foreach ($form->values as $value) {
            $product->setValue($value->id, $value->value);
        }

        $product->revokeTags();

        // existing tags
        foreach ($form->tags->existing as $tagId) {
            $tag = $this->tags->findById($tagId);
            $product->assignTag($tag->id);
        }

        // new tags
        $this->transaction->wrap(function () use ($product, $form) {
            foreach ($form->tags->newNames as $tagName) {
                if (!$tag = $this->tags->findByName($tagName)) {
                    $tag = Tag::create($tagName, $tagName);
                    $this->tags->save($tag);
                }
                $product->assignTag($tag->id);
            }
        });
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