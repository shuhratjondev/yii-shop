<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities
 */

namespace shop\entities\User;


use Webmozart\Assert\Assert;
use yii\db\ActiveRecord;

/**
 * @property integer $user_id
 * @property string $identity
 * @property string $network
 */
class Network extends ActiveRecord
{

    /**
     * @param $network
     * @param $identity
     * @return Network
     */
    public static function create($network, $identity): Network
    {
        Assert::notEmpty($network);
        Assert::notEmpty($identity);
        $item = new self();
        $item->network = $network;
        $item->identity = $identity;
        return $item;
    }

    /**
     * @param $network
     * @param $identity
     * @return bool
     */
    public function isFor($network, $identity): bool
    {
        return $this->network === $network && $this->identity === $identity;
    }

    /**
     * @return string
     */
    public static function tableName(): string
    {
        return "{{%user_networks}}";
    }


}