<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Modules\Customer\Repositories\ICustomerRepository;
	use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
	use Illuminate\Contracts\View\View;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	
	class CustomerPurchaseController extends Controller
	{
		
		protected IPurchaseRepository $IPurchaseRepository;
		protected ICustomerRepository $customerRepository;
		
		
		public function __construct(IPurchaseRepository $IPurchaseRepository, ICustomerRepository $customerRepository)
		{
			$this->IPurchaseRepository = $IPurchaseRepository;
			$this->customerRepository  = $customerRepository;
		}
		
		
		public function index(): View
		{
			
			$customer = $this->customerRepository->FindByUser(Auth::id());
			
			$purchase_data = $this->IPurchaseRepository->GetallCustomerPurchasesPaginate(
				$customer->id, request()->input('page') ?? 1
			);
			
			$purchases = collect($purchase_data->items())->map(function ($item) {
				return (object)[
					'id'             => $item->id,
					'date'           => $item->getDateDisplay(),
					'receipt_number' => $item->receipt_number,
					'total_amount'   => $item->total_amount
				];
			});

			
			
			
			return view('customer-purchase.index')->with([
				'purchases' => $purchases,
				'paginate' => $purchase_data->links()
			]);
		}
	}
