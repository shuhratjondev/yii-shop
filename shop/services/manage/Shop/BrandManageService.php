<?php
/**
 * User: sh_abdurasulov
 * @package shop\services\manage\Shop
 */

namespace shop\services\manage\Shop;


use shop\entities\Meta;
use shop\entities\Shop\Brand;
use shop\forms\MetaForm;
use shop\forms\manage\Shop\BrandForm;
use shop\repositories\Shop\BrandRepository;

class BrandManageService
{
    private BrandRepository $brands;

    public function __construct(BrandRepository $brands)
    {
        $this->brands = $brands;
    }

    public function create(BrandForm $form, MetaForm $metaForm): Brand
    {
        $brand = Brand::create(
            $form->name,
            $form->slug,
            new Meta(
                $metaForm->title,
                $metaForm->description,
                $metaForm->keywords,
            )
        );
        $this->brands->save($brand);
        return $brand;
    }

    public function edit($id, BrandForm $form, MetaForm $metaForm): Brand
    {
        $brand = $this->brands->get($id);
        $brand->edit(
            $form->name,
            $form->slug,
            new Meta(
                $metaForm->title,
                $metaForm->description,
                $metaForm->keywords,
            )
        );
        $this->brands->save($brand);
        return $brand;
    }


}