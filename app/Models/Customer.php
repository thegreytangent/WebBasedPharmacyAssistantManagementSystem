<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
	
	public function User() : BelongsTo {
		return $this->belongsTo(User::class);
	}
}
