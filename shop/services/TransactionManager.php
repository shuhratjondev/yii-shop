<?php
/**
 * User: sh_abdurasulov
 */

namespace shop\services;

class TransactionManager
{
    /**
     * @throws \Exception
     */
    public function wrap(callable $function): void
    {
        \Yii::$app->db->transaction($function);
    }

}