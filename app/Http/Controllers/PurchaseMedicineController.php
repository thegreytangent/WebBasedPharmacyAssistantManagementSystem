<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
    use Illuminate\Http\Request;
    use Illuminate\View\View;

    class PurchaseMedicineController extends Controller
    {
        protected IPurchaseRepository $purchaseRepository;

        public function __construct(IPurchaseRepository $purchaseRepository)
        {
            $this->purchaseRepository = $purchaseRepository;
        }


        public function index(): View
        {
            $data = $this->purchaseRepository->GetAllPurchaseMedicineByPaginate(1, 4);

            $purchase_medicines = collect($data->items())->map(function ($item) {
                return (object)[
                    'id'            => $item->id,
                    'category_name' => $item->Medicine->Category->category_name,
                    'medicine_name' => $item->Medicine->medicine_name,
                    'price'         => $item->Medicine->getPrice(),
                ];
            });


            return view('purchase_medicine.index')->with([
                'purchase_medicines' => $purchase_medicines,
                'pagination'         => ""
            ]);
        }
    }
