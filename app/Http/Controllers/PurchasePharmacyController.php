<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Medicine\Repositories\IMedicineRepository;

    class PurchasePharmacyController extends Controller
    {

        protected IMedicineRepository $medicineRepository;

        /**
         * @param IMedicineRepository $medicineRepository
         */
        public function __construct(IMedicineRepository $medicineRepository)
        {
            $this->medicineRepository = $medicineRepository;
        }


        public function index()
        {
            $medicines = $this->medicine_select_templates();
            return view('purchase.pharmacy')->with([
                'medicines' => $medicines
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
                    $medicines_string .= ' <option price="'.$medicine->price.'" value="'.$medicine->id.'">'.$medicine->medicine_name.'</option>';
                }
                $result .= '<optgroup label="' . $category . '">'.$medicines_string.'</optgroup>';
            }


            return '<select class="form-select" id="single-select-optgroup-field" data-placeholder="Select Medicine">
                                <option></option>
                                ' . $result . '
                                    </select>';
        }
    }
