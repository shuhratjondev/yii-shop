<?php
/**
 * User: sh_abdurasulov
 * @package frontend\controllers\shop
 */

namespace frontend\controllers\shop;

use shop\forms\Shop\CartForm;
use shop\forms\Shop\ReviewForm;
use shop\readModels\Shop\BrandReadRepository;
use shop\readModels\Shop\CategoryReadRepository;
use shop\readModels\Shop\ProductReadRepository;
use shop\readModels\Shop\TagReadRepository;
use yii\web\Controller;
use yii\web\NotFoundHttpException;

class CatalogController extends Controller
{
    public $layout = 'catalog';

    private ProductReadRepository $products;
    private CategoryReadRepository $categories;
    private BrandReadRepository $brands;
    private TagReadRepository $tags;

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
     * @throws NotFoundHttpException
     */
    public function actionCategory($id)
    {
        $category = $this->categories->find($id);
        if (!$category) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $dataProvider = $this->products->getAllByCategory($category);

        return $this->render('category', [
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

        return $this->render('brand', [
            'brand' => $brand,
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
        $dataProvider = $this->products->getAllByTag($tag);

        return $this->render('tag', [
            'tag' => $tag,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @throws NotFoundHttpException
     */
    public function actionProduct($id)
    {
        if (!$product = $this->products->find($id)) {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
        $this->layout = 'blank';

        $cartForm = new CartForm($product);
        $reviewForm = new ReviewForm();

        return $this->render('product', [
            'product' => $product,
            'cartForm' => $cartForm,
            'reviewForm' => $reviewForm,
        ]);
    }


}