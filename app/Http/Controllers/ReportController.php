<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
	use Illuminate\Http\Request;
	
	class ReportController extends Controller
	{
		protected IPurchaseRepository $purchaseRepository;
		
		
		public function __construct(IPurchaseRepository $purchaseRepository)
		{
			$this->purchaseRepository = $purchaseRepository;
		}
		
		
		public function purchase() {
			$purchases_data = $this->purchaseRepository->GetAll();
			
			$purchases = collect($purchases_data)->map(function ($pu) {
				$purchase = $pu->Purchase;
				return (object) [
					'id'             => $pu->id,
					'date'           => $purchase->getDateDisplay(),
					'receipt_number' => $purchase->receipt_number,
					'amount'         => $purchase->getAmount(),
				];
			});
			
			
			return view('report.purchase_report')->with([
				'purchases'  => $purchases
			]);
			
		}
	}
