<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Modules\Medicine\Repositories\IMedicineRepository;
	use Domain\Modules\Order\Entities\Order;
	use Domain\Modules\Order\Repositories\IOrderRepository;
	use Domain\Modules\Supplier\Entities\Supplier;
	use Domain\Modules\Supplier\Repositories\ISupplierRepository;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	use Illuminate\Support\Carbon;
	use Illuminate\Support\Facades\Validator;
	
	class OrderController extends Controller
	{
		protected ISupplierRepository $supplierRepository;
		protected IMedicineRepository $medicineRepository;
		protected IOrderRepository $orderController;
		
		public function __construct(ISupplierRepository $supplierRepository, IMedicineRepository $medicineRepository, IOrderRepository $orderController)
		{
			$this->supplierRepository = $supplierRepository;
			$this->medicineRepository = $medicineRepository;
			$this->orderController = $orderController;
		}
		
		
		public function index()
		{
			if (request()->input('medicine_id')) {
				$orders_data = $this->orderController->GetAllMedicinePaginate(
					request()->input('medicine_id'),
					request()->input('page') ?? 1, 3);
			} else {
				$orders_data = $this->orderController->GetAllPaginate(request()->input('page') ?? 1, 3);
			}
			
			
			$orders = collect($orders_data->items())->map(function ($o) {
				
				return (object)[
					'id'              => $o->id,
					'name'            => $o->name,
					'supplier_id'     => $o->supplier_id,
					'medicine_id'     => $o->medicine_id,
					'medicine_name'   => $o->Medicine->medicine_name,
					'supplier_name'   => $o->Supplier->name,
					'qty'             => $o->total_qty,
					'expiration_date' => Carbon::parse($o->date_expired)->format('M. d Y')
				];
			});
			
			
			return view('order.index')->with([
				'orders'     => $orders,
				'pagination' => $orders_data->links()
			]);
		}
		
		public function create()
		{
			$suppliers = collect($this->supplierRepository->All())->mapWithKeys(function ($sup) {
				/** @var Supplier $sup */
				return [$sup->getId() => $sup->getName()];
			});
			
			$medicines = collect($this->medicineRepository->All())->mapWithKeys(function ($med) {
				return [$med->id => $med->medicine_name];
			});
			
			return view('order.create')->with([
				'suppliers'    => $suppliers,
				'medicines'    => $medicines,
				'order_number' => Order::generateOrderNumber()
			]);
		}
		
		public function store(Request $req): RedirectResponse
		{
			
			$val = Validator::make($req->all(), [
				'order_number' => 'required',
				'date'         => 'required|date',
				'medicine'     => 'required',
				'supplier'     => 'required',
				'qty'          => 'required|int',
				'date_expired' => 'required'
			]);
			
			if ($val->fails()) {
				return redirectWithInput($val);
			}
			
			$order = new Order(
				$req->input('order_number'),
				$req->input('date'),
				$req->input('qty'),
				$req->input('date_expired')
			);
			
			
			$this->orderController->Save($order, $req->input('supplier'), $req->input('medicine'));
			
			return redirectWithAlert('/order', [
				'alert-success' => 'New Order has been added!'
			]);
		}
	}
