<?php
/**
 * User: sh_abdurasulov
 * @package shop\entities\Shop\Product
 */

namespace shop\entities\Shop\Product;


use yii\db\ActiveRecord;

/**
 * Class Review
 *
 * @author sh_abdurasulov
 * @package shop\entities\Shop\Product
 *
 * @property $id
 * @property $user_id
 * @property $vote
 * @property $text
 * @property $active
 * @property $created_at
 */
class Review extends ActiveRecord
{

    public static function create($userId, $vote, $text)
    {
        $review = new self();
        $review->user_id = $userId;
        $review->vote = $vote;
        $review->text = $text;
        $review->created_at = time();
        $review->active = false;
        return $review;
    }

    public function edit($vote, $text): void
    {
        $this->vote = $vote;
        $this->text = $text;
    }

    public function activate(): void
    {
        $this->active = true;
    }

    public function draft(): void
    {
        $this->active = true;
    }

    public function isActive(): bool
    {
        return $this->active === true;
    }

    public function getRating()
    {
        return $this->vote;
    }

    public function isIdEqualTo($id): bool
    {
        return $this->id === $id;
    }


    #################################
    public static function tableName(): string
    {
        return '{{%shop_reviews}}';
    }


}