<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms\manage\Shop\Product
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Product\Modification;
use yii\base\Model;

class ModificationForm extends Model
{
    private $modification;
    public $code;
    public $name;
    public $price;

    public function __construct(Modification $modification = null, $config = [])
    {
        parent::__construct($config);
        if ($modification) {
            $this->code = $modification->code;
            $this->name = $modification->name;
            $this->price = $modification->price;
            $this->modification = $modification;
        }
    }

    public function rules()
    {
        return [
            [['code', 'name', 'price'], 'required'],
            [['code', 'name'], 'string'],
            [['price'], 'integer'],
        ];
    }


}