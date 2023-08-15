<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Medicine extends Model
{
    use HasFactory;
    use Uuid;

    public $incrementing = false;
    protected $table = 'medicines';
    protected $keyType = 'string';
    protected $guarded = [];


    public function Category() : BelongsTo {
        return $this->belongsTo(Category::class);
    }

    public function Supplier() : BelongsTo {
        return $this->belongsTo(Supplier::class);
    }
}
