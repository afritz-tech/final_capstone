<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;

    protected $table = 'category';

    static public function getSingle($id)
    {
        return CategoryModel::find($id);
    }

    static public function getResult()
    {
        return CategoryModel::select('category.*')
        ->where('is_delete', '=', 0)
        ->orderBy('id', 'desc')
        ->paginate(20);
    }

    static public function getCategory()
    {
        return CategoryModel::select('category.*')
        ->where('status', '=', 1)
        ->where('is_delete', '=', 0)
        ->get();
    }


    public function totalhub()
    {
        return $this->hasMany(HubModel::class, 'category_id')
        ->where('hub.status', '=', 1)
        ->where('hub.is_publish', '=', 1)
        ->where('hub.is_delete', '=', 0)
        ->count();
    }


}
