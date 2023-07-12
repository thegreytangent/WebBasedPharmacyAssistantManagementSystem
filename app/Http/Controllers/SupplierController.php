<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Supplier\Repositories\ISupplierRepository;
    use Illuminate\Http\Request;

    class SupplierController extends Controller
    {

        protected ISupplierRepository $supplierRepository;


        public function __construct(ISupplierRepository $supplierRepository)
        {
            $this->supplierRepository = $supplierRepository;
        }


        public function index() {
            return view('supplier.index');
        }

        public function create() {
            return view('supplier.create');
        }
    }
