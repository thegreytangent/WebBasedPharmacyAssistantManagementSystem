<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Order extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'orders';
    protected $keyType = 'string';
    protected $guarded = [];

    public function Supplier() : BelongsTo {
        return $this->belongsTo(Supplier::class);
    }

    public function Medicine() : BelongsTo {
        return $this->belongsTo(Medicine::class);
    }



}
