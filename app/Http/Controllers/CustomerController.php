<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Modules\Customer\Entities\Customer;
	use Domain\Modules\Customer\Repositories\ICustomerRepository;
	use Domain\Modules\User\Entities\User;
	use Domain\Shared\ValueObjects\Birthdate;
	use Exception;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Redirect;
	use Illuminate\Support\Facades\Session;
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
			
			$customer_data = $this->customerRepository->GetAllPaginate(1, 10);
			
			$customers = collect($customer_data->items())->map(function ($c) {
				$customer = new Customer($c->firstname, $c->lastname, new Birthdate($c->brithdate), $c->id);
				$customer->setAddress($c->address);
				return (object)[
					'id'        => $customer->getId(),
					'firstname' => $customer->getFirstname(),
					'lastname'  => $customer->getLastname(),
					'birthdate' => $customer->getBirthdate()->simpleFormat(),
					'address'   => $customer->getAddress()
				];
			});
			
			return view('customer.index')->with([
				'customers'  => $customers,
				'pagination' => $customer_data->links()
			]);
		}
		
		public function create()
		{
			return view('customer.create');
		}
		
		public function show($id)
		{
			$customer = $this->customerRepository->Find($id);
			
			
			return view('customer.edit')->with([
				'customer' => (object)[
					'id'        => $id,
					'firstname' => $customer->getFirstname(),
					'lastname'  => $customer->getLastname(),
					'birthdate' => $customer->getBirthdate()->getValue(),
					'address'   => $customer->getAddress(),
					'username'  => $customer->getUser()->getUsername()
				]
			]);
			
		}
		
		public function update(Request $req, $id)
		{
			try {
				
				$validate = Validator::make($req->all(), [
					'firstname' => 'required',
					'lastname'  => 'required',
					'birthdate' => 'required',
					'username'  => 'required'
				]);
				
				if ($validate->fails())
					return Redirect::back()->with([
						'alert-success' => $validate->errors()->first()
					])->withInput();
				
				$customer_data = $this->customerRepository->Find($id);
				
				$customer = new Customer(
					$req->input('firstname'),
					$req->input('lastname'),
					new Birthdate($req->input('birthdate')),
					$id
				);
				
				$customer->setAddress($req->input('address'));
				
				$customer->setUser(new User(
					$req->input('username'),
						$req->input('password') ?? "",
					'customer', $customer_data->getUser()->getId())
				);
				
				$this->customerRepository->Update($customer);
				
				return redirectWithAlert('customer', [
					'alert-success' => 'New customers has been added'
				]);
			
			
			} catch (Exception $e) {
				return redirectWithAlert('customer', [
					'alert-danger' => $e->getMessage()
				]);
			}
			
		}
		
		
		public function store(Request $req)
		{
			try {
				
				$validate = Validator::make($req->all(), [
					'username'  => 'required',
					'password'  => 'required',
					'firstname' => 'required',
					'lastname'  => 'required',
					'birthdate' => 'required'
				]);
				
				if ($validate->fails())
					return Redirect::back()->with([
						'alert-success' => $validate->errors()->first()
					])->withInput();
				
				
				$customer = new Customer(
					$req->input('firstname'),
					$req->input('lastname'),
					new Birthdate($req->input('birthdate')),
				);
				
				$customer->setUser(
					new User(
						$req->input('username'),
						$req->input('password'),
						'customer')
				);
				
				$customer->setAddress($req->input('address'));
				
				$this->customerRepository->Save($customer);
				
				return redirectWithAlert('customer', [
					'alert-success' => 'New customers has been added'
				]);
				
				
			} catch (Exception $e) {
				return redirectWithAlert('customer', [
					'alert-danger' => $e->getMessage()
				]);
			}
			
		}
		
		public function destroy($id)
		{
			$this->customerRepository->Delete($id);
			
			Session::flash('alert-danger', 'Medicine has been deleted successfully.');
			
			return response()->json([
				'success' => true
			]);
		}
		
	}
