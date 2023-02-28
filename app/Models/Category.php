<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    public function subCategory()
    {
        return $this->hasMany('App\Models\Category');
    }
    public function mainCategory()
    {
        return $this->belongsTo('App\Models\Category', 'category_id', 'id')->select('id','name');
    }
}
