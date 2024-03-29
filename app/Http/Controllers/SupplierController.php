<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Modules\Supplier\Entities\Supplier;
	use Domain\Modules\Supplier\Repositories\ISupplierRepository;
	use Domain\Shared\ValueObjects\ContactNumber;
	use Illuminate\Contracts\View\View;
	use Illuminate\Http\JsonResponse;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Facades\Validator;
	
	class SupplierController extends Controller
	{
		
		protected ISupplierRepository $supplierRepository;
		
		
		public function __construct(ISupplierRepository $supplierRepository)
		{
			$this->supplierRepository = $supplierRepository;
		}
		
		
		public function index(): View
		{
			$data = $this->supplierRepository->GetAllPaginate(1, 5);
			$suppliers = collect($data->items())->map(function ($d) {
				$d = new Supplier($d->name, new ContactNumber($d->contact_number), $d->id);
				return (object)[
					'id'             => $d->getId(),
					'name'           => $d->getName(),
					'contact_number' => $d->getContactNumber()->getOriginalInput()
				];
			});
			return view('supplier.index')->with([
				'suppliers'  => $suppliers,
				'pagination' => $data->links()
			]);
		}
		
		public function show($id)
		{
			
			$supplier = $this->supplierRepository->Find($id);
			
			if (!$supplier) {
				return redirectWithAlert('/supplier', [
					'alert-danger' => 'Supplier not found!'
				]);
			}
			
			$supplier = (object)[
				'id'             => $supplier->getId(),
				'name'           => $supplier->getName(),
				'contact_number' => $supplier->getContactNumber()->getOriginalInput()
			];
			
			
			return view('supplier.edit', [
				'supplier' => $supplier
			]);
		}
		
		public function update(Request $request, $id)
		{
			$val = Validator::make($request->all(), [
				'name'           => 'required',
				'contact_number' => 'required|numeric'
			]);
			
			if ($val->fails()) {
				return redirectWithErrors($val);
			}
			
			
			$supplier = new Supplier(
				$request->input('name'),
				new ContactNumber($request->input('contact_number')),
				$id
			);
			
			$this->supplierRepository->Update($supplier);
			
			return redirectWithAlert('/supplier', [
				'alert-info' => 'Supplier has been updated'
			]);
		}
		
		
		public function create(): View
		{
			return view('supplier.create');
		}
		
		public function store(Request $request): RedirectResponse
		{
			
			$val = Validator::make($request->all(), [
				'name'           => 'required',
				'contact_number' => 'required|numeric'
			]);
			
			if ($val->fails()) {
				return redirectWithErrors($val);
			}
			
			
			$supplier = new Supplier(
				$request->input('name'),
				new ContactNumber($request->input('contact_number'))
			);
			
			$this->supplierRepository->Save($supplier);
			
			return redirectWithAlert('/supplier', [
				'alert-success' => 'New Vehicle has been added!'
			]);
			
		}
		
		
		public function destroy($id)
		{
			$this->supplierRepository->Delete($id);
			
			Session::flash('alert-danger', 'Supplier has been deleted successfully.');
			
			return response()->json([
				'success' => true
			]);
		}
		
		public function getMedicines(string $supplier_id) : JsonResponse
		{
			
			$result = $this->supplierRepository->GetAllMedicines($supplier_id);
			
			return response()->json([
				'success' => true,
				'data'    => $result
			]);
			
		}
		
		
	}
