<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Header extends Model
{
    use SoftDeletes;

    protected $table = 'headers';

    protected $fillable = [
        'name',
        'header_type_id',
        'title',
        'target_url',
        'display_order',
    ];
}
