<?php
/**
 * User: sh_abdurasulov
 */

namespace shop\entities;


/**
 * Class Meta
 *
 * @author sh_abdurasulov
 * @package shop\entities
 * @property $title
 * @property $description
 * @property $keywords
 */
class Meta
{
    public $title;
    public $description;
    public $keywords;

    public function __construct($title, $description, $keywords)
    {
        $this->title = $title;
        $this->description = $description;
        $this->keywords = $keywords;
    }


}