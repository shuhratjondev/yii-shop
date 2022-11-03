<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms\Shop
 */

namespace shop\forms\manage\Shop;


use shop\entities\Shop\Characteristic;
use yii\base\Model;

/**
 * Class CharacteristicForm
 *
 * @author sh_abdurasulov
 * @package shop\forms\Shop
 *
 * @property  $name
 * @property  $type
 * @property  $required
 * @property  $default
 * @property  $textVariants
 * @property  $sort
 * @property array $variants
 */
class CharacteristicForm extends Model
{
    public $name;
    public $type;
    public $required;
    public $default;
    public $textVariants;
    public $sort;

    private $_characteristic;

    public function __construct(Characteristic $characteristic = null, $config = [])
    {
        parent::__construct($config);

        if ($characteristic) {
            $this->setAttributes($characteristic->getAttributes());
            $this->textVariants = implode(PHP_EOL, $characteristic->variants);
            $this->_characteristic = $characteristic;
        } else {
            $this->sort = Characteristic::find()->max('sort') + 1;
        }
    }

    public function rules()
    {
        return [
            [['name', 'type', 'sort'], 'required'],
            [['required'], 'boolean'],
            [['default'], 'string', 'max' => 255],
            [['textVariants'], 'string'],
            [['sort'], 'integer'],
//            [
//                ['name'], 'unique', 'targetClass' => Characteristic::class,
//                'filter' => $this->_characteristic ? ['<>', 'id', $this->_characteristic->id] : []
//            ],

        ];
    }

    public function getVariants()
    {
        return preg_split('#[\r\n]+#i', $this->textVariants);
    }

}