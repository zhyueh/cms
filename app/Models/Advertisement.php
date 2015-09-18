<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Advertisement extends Model
{
    use SoftDeletes;

    protected $table = "advertisement";

    protected $fillable = [
        'name',
        'ad_place_id',
        'target_url',
        ];


    //
}
