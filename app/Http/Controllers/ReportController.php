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
				return (object) [
					'id'             => $pu->id,
					'date'           => $pu->getDateDisplay(),
					'receipt_number' => $pu->receipt_number,
					'customer_name'  => $pu->Customer->completeName(),
					'amount'         => $pu->getAmount(),
				];
			});
			
			return view('report.purchase_report')->with([
				'purchases'  => $purchases
			]);
			
		}
	}
