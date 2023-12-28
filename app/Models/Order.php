<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Support\Carbon;

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
	
	public function label() : string
	{
		$date = Carbon::parse($this->date_expired);
		$now = Carbon::now();
		
		if ($now < $date) {
			return 'bg-primary';
		}
		return 'bg-success';
	}
	
	public function label_message() : string
	{
		$now = Carbon::now();
		$date = Carbon::parse($this->date_expired);
		
		if ($now < $date) {
			return 'Expired';
		}
		return 'Not Expired';
	}



}
