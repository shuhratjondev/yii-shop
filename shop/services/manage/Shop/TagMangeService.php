<?php
/**
 * User: sh_abdurasulov
 * @package shop\services\manage
 */

namespace shop\services\manage\Shop;

use shop\entities\Shop\Tag;
use shop\forms\manage\Tag\TagForm;
use shop\repositories\Shop\TagRepository;
use yii\helpers\Inflector;

class TagMangeService
{
    /**
     * @var TagRepository
     */
    private TagRepository $tags;

    /**
     * TagMangeService constructor.
     * @param TagRepository $tags
     */
    public function __construct(TagRepository $tags)
    {
        $this->tags = $tags;
    }

    /**
     * @param TagForm $form
     * @return Tag
     */
    public function create(TagForm $form): Tag
    {
        $tag = Tag::create(
            $form->name,
            $form->slug ?: Inflector::slug($form->name)
        );
        $this->tags->save($tag);
        return $tag;
    }

    /**
     * @throws \yii\db\StaleObjectException
     */
    public function remove($id): void
    {
        $tag = $this->tags->findById($id);
        $this->tags->remove($tag);
    }

}