<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PurchaseMedicine extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'purchase_medicines';
    protected $keyType = 'string';
    protected $guarded = [];


    public function Medicine() : BelongsTo {
        return $this->belongsTo(Medicine::class);
    }
	
	public function Purchase() : BelongsTo {
		return $this->belongsTo(Purchase::class);
	}


}
