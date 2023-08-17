<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Category\Entities\Category;
    use Domain\Modules\Category\Repositories\ICategoryRepository;
    use Domain\Modules\Medicine\Entities\Medicine;
    use Domain\Modules\Medicine\Repositories\IMedicineRepository;
    use Domain\Modules\Medicine\ValueObjects\Price;
    use Domain\Modules\Supplier\Entities\Supplier;
    use Domain\Modules\Supplier\Repositories\ISupplierRepository;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class MedicineController extends Controller
    {

        protected IMedicineRepository $medicineRepository;
        protected ISupplierRepository $supplierRepository;
        protected ICategoryRepository $categoryRepository;

        public function __construct(IMedicineRepository $medicineRepository, ISupplierRepository $supplierRepository, ICategoryRepository $categoryRepository)
        {
            $this->medicineRepository = $medicineRepository;
            $this->supplierRepository = $supplierRepository;
            $this->categoryRepository = $categoryRepository;
        }


        public function index(): View
        {

            $medicine_pagination = $this->medicineRepository->GetAllPaginate(1, 5);


            $medicines = collect($medicine_pagination->items())->map(function ($medicine) {
                $med = new Medicine($medicine->medicine_name, new Price($medicine->price), $medicine->id);
                $med->setCategoryName($medicine->Category->category_name);
                $med->setSupplierName($medicine->Supplier->name);
                return (object)[
                    'id'            => $med->getId(),
                    'medicine_name' => $med->getName(),
                    'price'         => $med->price()->displayPrice(),
                    'category_name' => $med->getCategoryName(),
                    'supplier_name' => $med->getSupplierName()
                ];
            })->toArray();


            return view('medicine.index')->with([
                'medicines'  => $medicines,
                'pagination' => $medicine_pagination->links()
            ]);
        }

        public function create(): View
        {

            $suppliers = collect($this->supplierRepository->All())->mapWithKeys(function ($sup) {
                /** @var Supplier $sup */
                return [$sup->getId() => $sup->getName()];
            });


            $categories = collect($this->categoryRepository->All())->mapWithKeys(function ($cat) {
                /** @var Category $cat */
                return [$cat->getId() => $cat->getCategoryName()];
            });


            return view('medicine.create')->with([
                'suppliers'  => $suppliers,
                'categories' => $categories
            ]);
        }

        public function store(Request $req)
        {
            $val = Validator::make($req->all(), [
                'supplier'      => 'required',
                'category'      => 'required',
                'medicine_name' => 'required',
                'price'         => 'required|numeric',
                'qty'           => 'required|int'
            ]);

            if ($val->fails()) {
                return redirectWithInput($val);
            }

            $medicine = new Medicine(
                $req->input('medicine_name'),
                $req->input('price')
            );

            $medicine->setQuantity($req->input('qty'));

            $this->medicineRepository->Save(
                $medicine,
                $req->input('category'),
                $req->input('supplier')
            );

            return redirectWithAlert('/medicine', [
                'alert-success' => 'New medicine has been added!'
            ]);


        }
    }
