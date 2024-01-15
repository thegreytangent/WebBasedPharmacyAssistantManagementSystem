<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'categories';
    protected $keyType = 'string';
    protected $guarded = [];
}
