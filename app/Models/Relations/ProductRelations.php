<?php

namespace App\Models\Relations;

use App\Models\Category;
use App\Models\User;

trait ProductRelations
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
