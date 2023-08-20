<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Customer\Entities\Customer;
    use Domain\Modules\Customer\Repositories\ICustomerRepository;
    use Domain\Shared\ValueObjects\Birthdate;
    use Exception;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Redirect;
    use Illuminate\Support\Facades\Validator;

    class CustomerController extends Controller
    {
        protected ICustomerRepository $customerRepository;


        public function __construct(ICustomerRepository $customerRepository)
        {
            $this->customerRepository = $customerRepository;
        }


        public function index()
        {
            return view('customer.index');
        }

        public function create()
        {
            return view('customer.create');
        }

        public function store(Request $req)
        {
            try {

                $validate = Validator::make($req->all(), [
                    'firstname' => 'required',
                    'lastname'  => 'required',
                    'birthdate' => 'required'
                ]);

                if ($validate->fails())
                    return Redirect::back()->with([
                        'alert-danger' => $validate->errors()->first()
                    ])->withInput();


                $customer = new Customer(
                    $req->input('firstname'),
                    $req->input('lastname'),
                    new Birthdate($req->input('birthdate')),
                );

                $customer->setAddress($req->input('address'));

                $this->customerRepository->Save($customer);


            } catch (Exception $e) {
                return redirectWithAlert('customer', [
                    'alert-danger' => $e->getMessage()
                ]);
            }

        }

    }
