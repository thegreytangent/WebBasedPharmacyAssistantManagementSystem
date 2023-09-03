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
            $id = request()->input('purchase_id');

            $purchase = $this->purchaseRepository->Find($id);

            $data = $this->purchaseRepository->FindAllPurchaseMedicineByPaginate(1, 4, $id);

            $purchase_medicines = collect($data->items())->map(function ($item) {
                return (object)[
                    'id'            => $item->id,
                    'category_name' => $item->Medicine->Category->category_name,
                    'medicine_name' => $item->Medicine->medicine_name,
                    'price'         => $item->Medicine->getPrice(),
                ];
            });

            $purchase = (object)[
                'date'           => $purchase->date,
                'customer_name' => $purchase->Customer->completeName(),
                'receipt_number' => $purchase->receipt_number,
                'total_amount'   => $purchase->total_amount,
            ];


            return view('purchase_medicine.index')->with([
                'purchase_medicines' => $purchase_medicines,
                'purchase'           => $purchase,
                'pagination'         => $data->links()
            ]);
        }
    }
