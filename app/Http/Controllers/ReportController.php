<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
	
	class ReportController extends Controller
	{
		protected IPurchaseRepository $purchaseRepository;
		
		
		public function __construct(IPurchaseRepository $purchaseRepository)
		{
			$this->purchaseRepository = $purchaseRepository;
		}
		
		
		public function purchase() {
			$purchases_data = $this->purchaseRepository->GetAll();
			
			$total = 0;
			$result = [];
			
			foreach ($purchases_data as $pu) {
				$t = $pu->getAllTotalPurchase();
				
				$result[] = (object)[
					'id'             => $pu->id,
					'date'           => $pu->getDateDisplay(),
					'receipt_number' => $pu->receipt_number,
					'amount'         => number_format($t, 2),
				];
				
				$total += $t;
				
			}
			
			
			
			return view('report.purchase_report')->with([
				'purchases' => $result,
				'total'     => number_format($total, 2)
			]);
			
		}
	}
