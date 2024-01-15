<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

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

    public function PurchaseMedicines() : HasMany {
        return $this->hasMany(PurchaseMedicine::class);
    }

    public function Orders() : HasMany {
        return $this->hasMany(Order::class);
    }

    public function getPrice() : string {
        return number_format($this->price, 2);
    }

    public function getTotalOrders() : int {
        $result = 0;
        foreach ($this->Orders as $order) {
            $result += $order->qty;
        }

        return $result;
    }

    public function getTotalCustomerPurchases(): int {
        $result = 0;
        foreach ($this->PurchaseMedicines as $purchase) {
            $result += $purchase->qty;
        }
        return $result;
    }
	
	public function totalCountPurchase() {
		return 1;
	}

    public function inventoryBalance() : int {
        $in = $this->getTotalOrders();
        $out = $this->getTotalCustomerPurchases();
        return !$in ? 0 : $in - $out;
    }
	
	public function bgColor($count) {
		if ($count > 20 && $count < 100 ) {
			return 'bg-info';
		} elseif ( $count < 20 ) {
			return 'bg-danger';
		} else {
			return 'bg-success';
		}
	}




}
