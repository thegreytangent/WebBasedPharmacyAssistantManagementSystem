<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Purchase\Repositories\IPurchaseRepository;
    use Illuminate\Http\JsonResponse;
    use Illuminate\Http\Response;
    use Illuminate\Support\Facades\Session;

    class PurchaseController extends Controller
    {

        protected IPurchaseRepository $purchaseRepository;


        public function __construct(IPurchaseRepository $purchaseRepository)
        {
            $this->purchaseRepository = $purchaseRepository;
        }


        public function index()
        {

            $purchases_data = $this->purchaseRepository->GetAllPaginate(request()->input('page') ?? 1, 4);

            $purchases = collect($purchases_data->items())->map(function ($pu) {
                return (object) [
                    'id'             => $pu->id,
                    'date'           => $pu->getDateDisplay(),
                    'receipt_number' => $pu->receipt_number,
                    'customer_name'  => $pu->Customer->completeName(),
                    'amount'         => number_format($pu->getAllTotalPurchase(), 2),
                ];
            });
            return view('purchase.index')->with([
                'purchases'  => $purchases,
                'pagination' => $purchases_data->links()
            ]);
        }

        public function destroy(string $id) : JsonResponse {
            $this->purchaseRepository->Delete($id);

            Session::flash('alert-danger', 'Purchases has been deleted!');

            return response()->json([
                'success' => true
            ]);

        }
    }
