<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'suppliers';
    protected $keyType = 'string';
    protected $guarded = [];
}
