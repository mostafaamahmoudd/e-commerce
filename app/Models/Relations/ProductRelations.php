<?php

namespace App\Models\Relations;

use App\Models\User;

trait ProductRelations
{
    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
