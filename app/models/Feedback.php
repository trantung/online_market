<?php

use Illuminate\Auth\UserInterface;
use Illuminate\Auth\Reminders\RemindableInterface;
use Illuminate\Database\Eloquent\SoftDeletingTrait;

class Feedback extends Eloquent
{
	use SoftDeletingTrait;
    protected $table = 'feedbacks';
    protected $fillable = ['product_id', 'user_id', 'message', 'status'];
    protected $dates = ['deleted_at'];

}