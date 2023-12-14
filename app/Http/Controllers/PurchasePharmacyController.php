<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Customer\Entities\Customer;
    use Domain\Modules\Customer\Repositories\ICustomerRepository;
    use Domain\Modules\Medicine\Repositories\IMedicineRepository;
    use Domain\Modules\Purchase\Entities\Purchase;
    use Domain\Modules\Purchase\Entities\PurchaseMedicine;
    use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
    use Domain\Shared\ValueObjects\Birthdate;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Carbon;
    use Illuminate\Support\Facades\Session;
    use Illuminate\Support\Facades\Validator;
	use App\Models\Customer as CustomerDB;

    class PurchasePharmacyController extends Controller
    {

        protected IMedicineRepository $medicineRepository;
        protected ICustomerRepository $customerRepository;
        protected IPurchaseRepository $purchaseRepository;

        public function __construct(IMedicineRepository $medicineRepository, ICustomerRepository $customerRepository, IPurchaseRepository $purchaseRepository)
        {
            $this->medicineRepository = $medicineRepository;
            $this->customerRepository = $customerRepository;
            $this->purchaseRepository = $purchaseRepository;
        }


        public function index()
        {
            $medicines = $this->medicine_select_templates();
            $customers = $this->customerRepository->All();

            $customers = collect($customers)->mapWithKeys(function ($customer) {
                $c = new Customer($customer->firstname, $customer->lastname, new Birthdate($customer->birthdate), $customer->id);
                return [$c->getId() => $c->completeName()];
            });


            return view('purchase.pharmacy')->with([
                'medicines' => $medicines,
                'customers' => $customers,
                'receipt_number' => generateReceiptNumber()

            ]);
        }

        private function medicine_select_templates(): string
        {

            $result = "";

            $meds = $this->medicineRepository->All();

            $group_categories = collect($meds)->groupBy('category_name');

            foreach ($group_categories as $category => $medicines) {
                $medicines_string = "";
                foreach ($medicines as $medicine) {
                    $medicines_string .= ' <option price="' . $medicine->price . '" value="' . $medicine->id . '">' . $medicine->medicine_name . '</option>';
                }
                $result .= '<optgroup label="' . $category . '">' . $medicines_string . '</optgroup>';
            }


            return '<select class="form-select" id="single-select-optgroup-field" data-placeholder="Select Medicine">
                                <option></option>
                                ' . $result . '
                                    </select>';
        }

        public function store(Request $req)
        {
            try {
				
				
                $val = Validator::make($req->all(), [
                    'date'           => 'required|date',
                    'receipt_number' => 'required',
                    'medicines'      => 'required|array',
                    'cash'           => 'required'
                ]);

                if ($val->fails()) {
                    throw new Exception($val->getMessageBag());
                }

                $purchase = new Purchase(
                    $req->input('date'), $req->input('receipt_number'),$req->input('cash')
                );
				$customer = CustomerDB::first();
                $this->purchaseRepository->Save($purchase, $customer->id);

                foreach ($req->input('medicines') as $med) {
                    $this->purchaseRepository->SavePurchaseMedicine(
                        new PurchaseMedicine($med['qty'], $med['price']),
                        $purchase->getId(),$med['medicine_id']
                    );
                }

                Session::flash('alert-success', 'Purchase medicine has been recorded.');

                return response()->json([
                    'success' => true
                ]);





            } catch (Exception $exception) {
                return response()->json([
                    'success' => false,
                    'errmsg'  => $exception->getMessage()
                ], 500);
            }


        }
    }
