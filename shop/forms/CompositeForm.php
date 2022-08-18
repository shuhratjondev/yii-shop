<?php
/**
 * User: sh_abdurasulov
 * @package shop\forms
 */

namespace shop\forms;


use yii\base\Model;
use yii\helpers\ArrayHelper;

abstract class CompositeForm extends Model
{
    /* @var Model[] $forms */
    private array $forms = [];

    abstract protected function internalForms(): array;

    public function load($data, $formName = null): bool
    {
        $success = parent::load($data, $formName);
        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                $success = Model::loadMultiple($form, $data, $formName ? null : $name) && $success;
            } else {
                $success = $form->load($data, $formName ? null : $name) && $success;
            }
        }
        return $success;
    }


    /**
     * @throws \Exception
     */
    public function validate($attributeNames = null, $clearErrors = true): bool
    {
        $parentNames = array_filter($attributeNames, 'is_string');
        $success = parent::validate($parentNames, $clearErrors);
        foreach ($this->forms as $name => $form) {
            if (is_array($form)) {
                $success = Model::validateMultiple($form) && $success;
            } else {
                $innerNames = ArrayHelper::getValue($attributeNames, $name);
                $success = $form->validate($innerNames, $clearErrors) && $success;
            }
        }
        return $success;
    }

    public function __get($name)
    {
        return $this->forms[$name] ?? parent::__get($name);
    }

    public function __set($name, $value)
    {
        if (in_array($name, $this->internalForms(), true)) {
            $this->forms[$name] = $value;
        }
        parent::__set($name, $value);
    }

    public function __isset($name)
    {
        return isset($this->forms[$name]) || parent::__isset($name);
    }


}