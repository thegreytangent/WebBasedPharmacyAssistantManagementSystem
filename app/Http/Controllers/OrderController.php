<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Medicine\Repositories\IMedicineRepository;
    use Domain\Modules\Order\Entities\Order;
    use Domain\Modules\Order\Repositories\IOrderRepository;
    use Domain\Modules\Supplier\Entities\Supplier;
    use Domain\Modules\Supplier\Repositories\ISupplierRepository;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
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
            $this->orderController    = $orderController;
        }


        public function index()
        {

            return view('order.index')->with([
                'orders'     => [],
                'pagination' => ""
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

        public function store(Request $req) : RedirectResponse
        {

            $val = Validator::make($req->all(), [
                'order_number'  => 'required',
                'date'          => 'required|date',
                'medicine' => 'required',
                'supplier'      => 'required',
                'qty'           => 'required|int'
            ]);

            if ($val->fails()) {
                return redirectWithInput($val);
            }

            $order = new Order(
                $req->input('order_number'),
                $req->input('date'),
                $req->input('qty')
            );


            $this->orderController->Save($order,$req->input('supplier'), $req->input('medicine'));

            return redirectWithAlert('/order', [
                'alert-success' => 'New Order has been added!'
            ]);
        }
    }
