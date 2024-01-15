<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\Medicine;
	use App\Models\Purchase;
	use App\Models\PurchaseMedicine;
	use Domain\Modules\Order\Repositories\IOrderRepository;
	use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
	use Domain\Modules\Supplier\Repositories\ISupplierRepository;
	use Illuminate\Support\Carbon;
	use Illuminate\Support\Facades\DB;
	
	class DashboardController extends Controller
	{
		
		protected IOrderRepository $orderRepository;
		protected IPurchaseRepository $purchaseRepository;
		protected ISupplierRepository $supplierRepository;
		
		
		public function __construct(IOrderRepository $orderRepository, IPurchaseRepository $purchaseRepository, ISupplierRepository $supplierRepository)
		{
			$this->orderRepository = $orderRepository;
			$this->purchaseRepository = $purchaseRepository;
			$this->supplierRepository = $supplierRepository;
		}
		
		
		public function index()
		{
			$total_orders = Purchase::count();
			$count_suppliers = $this->supplierRepository->CountNumberOfSuppliers();
			$total_sales = $this->totalSales();
			$monthly_sales = $this->getMonthlySales();
			$total_customers = DB::table('customers')->count();
			$medicines = Medicine::with('PurchaseMedicines')->get();
			
			
			$medicines = $medicines->map(function ($i) {
				$count = $i->getTotalCustomerPurchases();
				return (object)[
					'name'  => $i->medicine_name,
					'count' => $count,
					'bg'    => $i->bgColor($count)
				];
			});
			
			
			return view('dashboard.index')->with([
				'total_orders'    => $total_orders,
				'total_sales'     => number_format($total_sales, 2),
				'total_customers' => $total_customers,
				'total_suppliers' => $count_suppliers,
				'monthly_sales'   => array_values($monthly_sales),
				'medicines'       => $medicines
			]);
		}
		
		public function totalSales(): int
		{
			$result = 0;
			$purchases = Purchase::all();
			foreach ($purchases as $purchase) {
				$result += $purchase->getAllTotalPurchase();
				
			}
			
			return $result;
		}
		
		
		public function getMonthlySales()
		{
			$result = [];
			
			$sales_data = Purchase::all()->groupBy(function ($val) {
				return Carbon::parse($val->date)->format('m');
			});
			
			for ($i = 1; $i <= 12; $i++) {
				$result[$i] = 0;
				$total = [];
				foreach ($sales_data as $month => $sales) {
					foreach ($sales as $sale) {
						$purchases = PurchaseMedicine::where(['purchase_id' => $sale->id])->get();
						if ($month == $i) {
							foreach ($purchases as $purchase) {
								$total[] = (float)$purchase->total();
							}
							
						}
					}
					
				}
				
				$result[$i] = array_sum($total);
				
				
			}
			
			
			return $result;
		}
		
		
	}
