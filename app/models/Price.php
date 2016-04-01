<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Price extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'prices';
    protected $fillable = ['min', 'max'];
    protected $dates = ['deleted_at'];

    public function categories()
    {
        return $this->belongsToMany('Category', 'category_price', 'price_id', 'category_id');
    }

    public function categoryprices()
    {
        return $this->hasMany('CategoryPrice', 'price_id', 'id');
    }

}
