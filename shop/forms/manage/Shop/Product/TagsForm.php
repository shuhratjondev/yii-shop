<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms\manage\Shop\Product
 */

namespace shop\forms\manage\Shop\Product;


use shop\entities\Shop\Product\Product;
use yii\base\Model;
use yii\helpers\ArrayHelper;

/**
 * Class TagsForm
 *
 * @author sh_abdurasulov
 * @package shop\forms\manage\Shop\Product
 *
 * @property array $newNames
 */
class TagsForm extends Model
{
    /**
     * @var array
     */
    public array $existing = [];
    /**
     * @var
     */
    public $textNew;

    /**
     * TagsForm constructor.
     * @param Product|null $product
     * @param array $config
     */
    public function __construct(Product $product = null, $config = [])
    {
        if ($product) {
            $this->existing = ArrayHelper::getColumn($product->tagAssignments, 'tag_id');
        }
        parent::__construct($config);
    }

    /**
     * @return array
     */
    public function rules(): array
    {
        return [
            ['existing', 'each', 'rule' => ['integer']],
            ['textNew', 'string'],
        ];
    }

    /**
     * @return array
     */
    public function getNewNames(): array
    {
        return array_map('trim', preg_split('#\s*,\s*#i', $this->textNew));
    }

}