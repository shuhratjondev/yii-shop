<?php


namespace shop\entities\Shop\Product;


use lhs\Yii2SaveRelationsBehavior\SaveRelationsBehavior;
use shop\behaviors\MetaBehavior;
use shop\entities\Meta;
use shop\entities\Shop\Brand;
use shop\entities\Shop\Category;
use shop\entities\Shop\Tag;
use yii\db\ActiveQuery;
use yii\db\ActiveRecord;
use yii\web\UploadedFile;

/**
 * @property integer $id
 * @property string $code
 * @property string $name
 * @property integer $category_id
 * @property integer $brand_id
 * @property integer $price_old
 * @property integer $price_new
 * @property integer $rating
 * @property integer $meta_json
 * @property integer $created_at
 *
 * @property Meta $meta
 * @property Brand $brand
 * @property Category $category
 * @property CategoryAssignment[] $categoryAssignments
 * @property Value[] $values
 * @property Photo[] $photos
 * @property TagAssignment[] $tagAssignments
 */
class Product extends ActiveRecord
{
    public Meta $meta;

    public static function create($brandId, $categoryId, $code, $name, Meta $meta): self
    {
        $product = new self();
        $product->brand_id = $brandId;
        $product->category_id = $categoryId;
        $product->code = $code;
        $product->name = $name;
        $product->meta = $meta;
        $product->created_at = time();
        return $product;
    }

    public function setPrice($new, $old)
    {
        $this->price_new = $new;
        $this->price_old = $old;
    }

    public function changeMainCategory($categoryId)
    {
        $this->category_id = $categoryId;
    }


    // Value
    public function setValue($id, $value)
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return;
            }
        }
        $values[] = Value::create($id, $value);
        $this->values = $values;
    }

    public function getValue($id): Value
    {
        $values = $this->values;
        foreach ($values as $val) {
            if ($val->isForCharacteristic($id)) {
                return $val;
            }
        }
        return Value::blank($id);
    }

    // Category
    public function assignCategory($id)
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForCategory($id)) {
                return;
            }
        }
        $assignments[] = CategoryAssignment::create($id);
        $this->categoryAssignments = $assignments;
    }

    public function revokeCategory($id)
    {
        $assignments = $this->categoryAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForCategory($id)) {
                unset($assignments[$i]);
                $this->categoryAssignments = $assignments;
                return;
            }
        }
    }

    public function revokeCategories(): void
    {
        $this->categoryAssignments = [];
    }

    // Tags
    public function assignTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $assignment) {
            if ($assignment->isForTag($id)) {
                return;
            }
        }
        $assignments[] = TagAssignment::create($id);
        $this->tagAssignments = $assignments;
    }

    public function revokeTag($id): void
    {
        $assignments = $this->tagAssignments;
        foreach ($assignments as $i => $assignment) {
            if ($assignment->isForTag($id)) {
                unset($assignments[$i]);
                $this->tagAssignments = $assignments;
                return;
            }
        }
        throw new \DomainException('Assignment not found.');
    }

    public function revokeTags(): void
    {
        $this->tagAssignments = [];
    }

    // Photo
    public function addPhoto(UploadedFile $file)
    {
        $photos = $this->photos;
        $photos[] = Photo::create($file);
        $this->setPhotos($photos);
    }

    public function removePhoto($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id)) {
                unset($photos[$i]);
                $this->setPhotos($photos);
                return;
            }
        }
        throw new \DomainException("Photo is not found");
    }

    public function removePhotos(): void
    {
        $this->setPhotos([]);
    }

    public function movePhotoUp($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id) && $prev = $photos[$i - 1] ?? null) {
                $photos[$i - 1] = $photo;
                $photos[$i] = $prev;
                $this->setPhotos($photos);
            }
        }
        throw new \DomainException("Photo is not found");
    }

    public function movePhotoDown($id)
    {
        $photos = $this->photos;
        foreach ($photos as $i => $photo) {
            if ($photo->isIdEqualTo($id) && $next = $photos[$i + 1] ?? null) {
                $photos[$i + 1] = $photo;
                $photos[$i] = $next;
                $this->setPhotos($photos);
            }
        }
        throw new \DomainException("Photo is not found");
    }

    private function setPhotos(array $photos)
    {
        foreach ($photos as $i => $photo) {
            $photo->setSort($i);
        }
        $this->photos = $photos;
    }


    // Relations

    public function getBrand(): ActiveQuery
    {
        return $this->hasOne(Brand::class, ['id' => 'brand_id']);
    }

    public function getCategory(): ActiveQuery
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getCategoryAssignments(): ActiveQuery
    {
        return $this->hasMany(CategoryAssignment::class, ['product_id' => 'id']);
    }

    public function getValues(): ActiveQuery
    {
        return $this->hasMany(Value::class, ['product_id' => 'id']);
    }

    public function getPhotos(): ActiveQuery
    {
        return $this->hasMany(Photo::class, ['product_id' => 'id']);
    }

    public function getTagAssignments(): ActiveQuery
    {
        return $this->hasMany(TagAssignment::class, ['product_id' => 'id']);
    }

    #############################
    public static function tableName(): string
    {
        return "{{%shop_products}}";
    }

    public function behaviors(): array
    {
        return [
            MetaBehavior::class,
            [
                'class' => SaveRelationsBehavior::class,
                'relations' => ['categoryAssignments', 'values']
            ]
        ];
    }

    public function transactions(): array
    {
        return [
            self::SCENARIO_DEFAULT => self::OP_ALL
        ];
    }


}