<?php

    namespace App\Models;

    use Illuminate\Database\Eloquent\Factories\HasFactory;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Database\Eloquent\Relations\BelongsTo;
    use Illuminate\Database\Eloquent\Relations\HasMany;
    use Illuminate\Support\Carbon;
    
    class Purchase extends Model
    {
        use HasFactory;
        use Uuid;

        public $incrementing = false;
        protected $table = 'purchases';
        protected $keyType = 'string';
        protected $guarded = [];

        protected $casts = [
            'total_amount' => 'float'
        ];


        public function PurchaseMedicine(): HasMany
        {
            return $this->hasMany(PurchaseMedicine::class);
        }
		

        public function Customer() : BelongsTo {
            return $this->belongsTo(Customer::class);
        }

        public function getDateDisplay() : string {
            return Carbon::parse($this->date)->format('F d, Y');
        }

        public function getAmount() : string {

            return number_format( $this->total_amount, 2);
        }
		
		public function getAllTotalPurchase() : float {
			$total = 0;
			foreach ($this->PurchaseMedicine as $p) {
				$total += $p->total();
			}
			return $total;
		}
	    
	    public function countAllPurchase(): int
	    {
		    return $this->PurchaseMedicine->count();
	    }


    }
