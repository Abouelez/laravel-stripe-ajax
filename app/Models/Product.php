<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * For Section-2
 * 1- Create Product Model with (name, price, quantity) fields.
 */
class Product extends Model
{
    protected $fillable = ['name', 'price', 'quantity', 'user_id', 'category_id'];


    public static function get_products_up_price($amount)
    {
        return self::where('price', '>', $amount)->get();
    }
}
