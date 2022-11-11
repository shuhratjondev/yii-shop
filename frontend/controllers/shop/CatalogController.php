<?php
/**
 * User: sh_abdurasulov
 * @package frontend\controllers\shop
 */

namespace frontend\controllers\shop;

use shop\entities\Shop\Product\Product;
use shop\readModels\Shop\BrandReadRepository;
use shop\readModels\Shop\CategoryReadRepository;
use shop\readModels\Shop\ProductReadRepository;
use shop\readModels\Shop\TagReadRepository;
use yii\data\ActiveDataProvider;
use yii\data\Pagination;
use yii\data\Sort;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{

    private $products;
    private $categories;
    private $brands;
    private $tags;

    public function __construct(
        $id, $module,
        ProductReadRepository $products,
        CategoryReadRepository $categories,
        BrandReadRepository $brands,
        TagReadRepository $tags,
        $config = []
    )
    {
        parent::__construct($id, $module, $config);
        $this->products = $products;
        $this->categories = $categories;
        $this->brands = $brands;
        $this->tags = $tags;
    }


    public function actionIndex()
    {
        $category = $this->categories->getRoot();
        $dataProvider = $this->products->getAll();

        return $this->render('index', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionBrand($id): string
    {
        $brand = $this->brands->find($id);
        if (!$brand) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByBrand($brand);

        return $this->render('index', [
            'brand' => $brand,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        $category = $this->categories->find($id);
        if (!$category) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByCategory($category);

        return $this->render('index', [
            'category' => $category,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @param $id
     * @return string
     * @throws NotFoundHttpException
     */
    public function actionTag($id): string
    {
        $tag = $this->tags->find($id);
        if (!$tag) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByBrand($tag);

        return $this->render('index', [
            'tag' => $tag,
            'dataProvider' => $dataProvider,
        ]);
    }


}