<?php

namespace DaninozCms\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function posts()
    {
        return $this->hasMany('DaninozCms\Models\Post', 'category_id');
    }
}