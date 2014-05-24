<?php

namespace DaninozCms\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo('DaninozCms\Models\Category', 'category_id');
    }
}