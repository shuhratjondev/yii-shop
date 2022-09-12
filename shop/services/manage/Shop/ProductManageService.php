<?php


namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\forms\manage\Shop\Product\ProductCreateForm;
use shop\repositories\Shop\BrandRepository;
use shop\repositories\Shop\CategoryRepository;

class ProductManageService
{
    private $products;
    private $brands;
    private $categories;

    /**
     * ProductManageService constructor.
     * @param $products
     * @param $brands
     * @param $categories
     */
    public function __construct(
        ProductsRepository $products,
        BrandRepository $brands,
        CategoryRepository $categories
    )
    {
        $this->products = $products;
        $this->brands = $brands;
        $this->categories = $categories;
    }

    public function create(ProductCreateForm $form)
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

        foreach ($form->categories->others as $otherId){
            $category = $this->categories->get($otherId);
            $product->assignCategory($category->id);
        }

        $this->products->save($product);

        return $product;
    }

    public function remove($id)
    {
        $product = $this->products->get($id);
        $this->products->remove($product);
    }


}