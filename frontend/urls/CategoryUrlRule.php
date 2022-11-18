<?php
/**
 * User: sh_abdurasulov
 */

namespace frontend\urls;

use yii\base\BaseObject;
use yii\web\UrlRuleInterface;

class CategoryUrlRule extends BaseObject implements UrlRuleInterface
{

    public function parseRequest($manager, $request)
    {

//        if(){
//            return ['shop/catalog/index', ['lang' => 'ru']];
//        }

        return false;
    }

    public function createUrl($manager, $route, $params)
    {
        return false;
    }
}