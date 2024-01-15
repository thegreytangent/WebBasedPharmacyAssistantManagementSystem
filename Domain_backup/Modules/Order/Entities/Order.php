<?php
	
	namespace Domain\Modules\Order\Entities;
	
	use Domain\Shared\Entity;
	use Illuminate\Support\Carbon;
	
	class Order extends Entity
	{
		
		protected string $order_number;
		protected string $date;
		protected int $qty;
		protected string $date_expired;
		
		
		public function __construct($order_number, $date, $qty, $date_expired, ?string $id = null)
		{
			$this->order_number = $order_number;
			$this->date = $date;
			$this->qty = $qty;
			$this->date_expired = $date_expired;
			
			parent::__construct($id);
		}
		
		public static function generateOrderNumber(): string
		{
			return 'DR-' . mt_rand();
		}
		
		/**
		 * @return string
		 */
		public function getOrderNumber(): string
		{
			return $this->order_number;
		}
		
		/**
		 * @return string
		 */
		public function getDate(): string
		{
			return $this->date;
		}
		
		public function longDate(): string
		{
			return Carbon::parse($this->date)->format('F j, Y');
		}
		
		/**
		 * @return int
		 */
		public function getQty(): int
		{
			return $this->qty;
		}
		
		public function dateExpired() : string
		{
			return $this->date_expired;
		}
		
		
	}
