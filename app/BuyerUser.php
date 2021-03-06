<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BuyerUser extends Model
{
    protected $primaryKey = 'user_id';

    public $incrementing = false;

    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'favorite_json',
    ];
}
