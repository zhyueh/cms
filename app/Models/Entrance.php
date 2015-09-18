<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Entrance extends Model
{
    use SoftDeletes;

    protected $table = "entrance";

    protected $fillable = [
        'title',
        'target_url',
    ];
    //
}
