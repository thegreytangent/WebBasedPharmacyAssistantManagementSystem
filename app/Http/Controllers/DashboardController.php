<?php
	
	namespace App\Http\Controllers;
	
	use App\Models\Medicine;
	use Domain\Modules\Order\Repositories\IOrderRepository;
	use Domain\Modules\Purchase\Entities\Purchase;
	use Domain\Modules\Purchase\Entities\PurchaseMedicine;
	use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
	use Domain\Modules\Supplier\Repositories\ISupplierRepository;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\DB;
	use Illuminate\View\View;
	
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
			$total_orders = $this->orderRepository->CountAllTotalOrders();
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
			$purchases = DB::table('purchases')->get();
			foreach ($purchases as $purchase) {
				$result += $purchase->total_amount;
				
			}
		
			return $result;
		}
		
		
		public function getMonthlySales()
		{
			$result = [];
			$sales = $this->purchaseRepository->GetAllMonthlySales(2023);
			
			for ($i = 1; $i <= 12; $i++) {
				$result[$i] = 0;
				foreach ($sales as $sale) {
					if ($sale->month == $i) {
						$result[$i] = (float)$sale->total;
					}
				}
				
				
			}
			
			return $result;
		}
		
		
	}
