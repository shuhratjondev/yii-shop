<?php

namespace frontend\forms;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\entities\User;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;


    public function rules(): array
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => 6],
        ];
    }
}
