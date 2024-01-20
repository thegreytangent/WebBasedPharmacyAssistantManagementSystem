<?php
	
	namespace App\Http\Controllers;
	
	use Domain\Modules\Medicine\Repositories\IMedicineRepository;
	use Illuminate\Contracts\View\View;
	use Illuminate\Http\Request;
	
	class InventoryController extends Controller
	{
		protected IMedicineRepository $medicineRepository;
		
		
		public function __construct(IMedicineRepository $medicineRepository)
		{
			$this->medicineRepository = $medicineRepository;
		}
		
		
		public function index()
		{
			$medicines = $this->medicineRepository->GetInventoryBalance();
			$inventories = collect($medicines->items())->map(function ($m) {
				return (object)[
					'id'            => $m->id,
					'medicine_name' => $m->medicine_name,
					'in'            => $m->getTotalOrders(),
					'type'          => $m->getType(),
					'uom'           => $m->getUOM(),
					'balance'       => $m->inventoryBalance()
				];
			});
			
			
			return view('inventory.index')->with([
				'inventories' => $inventories,
				'pagination'  => ''
			]);
		}
		
		
		public function print()
		{
			$medicines = $this->medicineRepository->GetInventoryBalance();
			$inventories = collect($medicines->items())->map(function ($m) {
				return (object)[
					'id'            => $m->id,
					'medicine_name' => $m->medicine_name,
					'in'            => $m->getTotalOrders(),
					'type'          => $m->getType(),
					'uom'           => $m->getUOM(),
					'balance'       => $m->inventoryBalance()
				];
			});
			
			
			return view('inventory.print_inventory')->with([
				'inventories' => $inventories,
				'pagination'  => ''
			]);
		}
	}
