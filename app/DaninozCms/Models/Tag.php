<?php

namespace DaninozCms\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function posts()
    {
        return $this->belongsToMany('DaninozCms\Models\Post', 'post_tag');
    }
}