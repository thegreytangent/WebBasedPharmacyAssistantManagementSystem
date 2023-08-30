<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'customers';
    protected $keyType = 'string';
    protected $guarded = [];

    public function completeName() : string {
        return $this->lastname .", ". $this->firstname;
    }
}
