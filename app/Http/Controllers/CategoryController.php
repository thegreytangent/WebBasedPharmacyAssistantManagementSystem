<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Category\Entities\Category;
    use Domain\Modules\Category\Repositories\ICategoryRepository;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Validator;
    use Illuminate\View\View;

    class CategoryController extends Controller
    {
        protected ICategoryRepository $categoryRepository;


        public function __construct(ICategoryRepository $categoryRepository)
        {
            $this->categoryRepository = $categoryRepository;
        }


        public function index() : view
        {

            $categories = [];

            return view('category.index')->with([
                'categories' => $categories
            ]);
        }


        public function create()
        {
            return view('category.create');
        }

        public function store(Request $request) {

            $val = Validator::make($request->all(), [
                'category_name'           => 'required|string',
            ]);

            if ($val->fails()) {
                return redirectWithErrors($val);
            }


            $category = new Category(
                $request->input('category_name')
            );

            $this->categoryRepository->Save($category);

            return redirectWithAlert('/supplier', [
                'alert-success' => 'New Category has been added!'
            ]);







        }






    }
