<?php

class CategoryPrice extends Eloquent
{
    protected $table = 'CategoryPrice';
    protected $fillable = ['category_id', 'price_id'];

    public function prices() 
    {
        return $this->belongsTo('Price', 'price_id', 'id');
    }

    public function categories() 
    {
        return $this->belongsTo('Category', 'category_id', 'id');
    }

}