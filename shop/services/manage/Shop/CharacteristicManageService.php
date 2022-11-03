<?php
/**
 * User: sh_abdurasulov
 * @package shop\services\manage\Shop
 */

namespace shop\services\manage\Shop;


use shop\entities\Shop\Characteristic;
use shop\forms\manage\Shop\CharacteristicForm;
use shop\repositories\Shop\CharacteristicRepository;

class CharacteristicManageService
{

    private CharacteristicRepository $characteristics;

    public function __construct(CharacteristicRepository $characteristics)
    {
        $this->characteristics = $characteristics;
    }

    public function create(CharacteristicForm $form): Characteristic
    {
        $characteristic = Characteristic::create(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort,
        );

        $this->characteristics->save($characteristic);
        return $characteristic;
    }

    public function edit($id, CharacteristicForm $form): void
    {
        /* @var Characteristic $characteristic */
        $characteristic = $this->characteristics->get($id);

        $characteristic->edit(
            $form->name,
            $form->type,
            $form->required,
            $form->default,
            $form->variants,
            $form->sort,
        );

        $this->characteristics->save($characteristic);
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $characteristic = $this->characteristics->get($id);
        $this->characteristics->remove($characteristic);
    }


}