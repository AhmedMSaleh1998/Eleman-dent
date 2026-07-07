<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Astrotomic\Translatable\Contracts\Translatable as TranslatableContract;
use Astrotomic\Translatable\Translatable;
class Category extends Model 
{
    use Translatable;

    public $translatedAttributes = ['name', 'alt', 'keywords', 'keywords_meta', 'title', 'description', 'description_meta'];
    protected $table = 'categories';
    public $timestamps = true;
    protected $fillable = array('image', 'banner', 'status', 'parent_id');

    public function category_products()
    {
        return $this->hasMany('App\Models\Product');
    }

    public function products()
    {
        return $this->belongsToMany(Product::class);
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id');
    }

    public function children()
    {
        return $this->hasMany(Category::class, 'parent_id');
    }

    public function activeChildren()
    {
        return $this->hasMany(Category::class, 'parent_id')->where('status', 1);
    }

    /**
     * ids of all descendants (children, grandchildren, ... any depth)
     */
    public function descendantIds()
    {
        $ids = [];
        $queue = $this->children()->pluck('id')->all();
        while (!empty($queue)) {
            $id = array_shift($queue);
            $ids[] = $id;
            foreach (Category::where('parent_id', $id)->pluck('id')->all() as $childId) {
                $queue[] = $childId;
            }
        }
        return $ids;
    }

    /**
     * chain of parents from root down to the direct parent
     */
    public function ancestors()
    {
        $ancestors = [];
        $node = $this->parent;
        while ($node) {
            array_unshift($ancestors, $node);
            $node = $node->parent;
        }
        return $ancestors;
    }
}