<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms\manage\Shop\Product
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Characteristic;
use yii\base\Model;

class ValueForm extends Model
{
    public $value;

    private $_characteristics;

    public function __construct(Characteristic $characteristic, Value $value = null, $config = [])
    {
        $this->_characteristics = $characteristic;
        if ($value) {
            $this->value = $value;
        }
        parent::__construct($config);
    }

    public function rules(): array
    {
        return array_filter([
            $this->_characteristics->required ? ['value', 'required'] : false,
            $this->_characteristics->isString() ? ['value', 'string', 'max' => 255] : false,
            $this->_characteristics->isInteger() ? ['value', 'integer'] : false,
            $this->_characteristics->isFloat() ? ['value', 'number'] : false,
            ['value', 'safe']
        ]);
    }

    public function attributeLabels(): array
    {
        return [
            'value' => $this->_characteristics->name
        ];
    }

    public function getId(): int
    {
        return $this->_characteristics->id;
    }

}