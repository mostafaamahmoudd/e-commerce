<?php

namespace App\Models;

use App\Models\Relations\CategoryRelations;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use CategoryRelations;

    protected $fillable = [
        'name',
        'description',
        'slug',
    ];
}
