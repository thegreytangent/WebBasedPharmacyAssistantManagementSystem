<?php

    namespace App\Http\Controllers;

    use Domain\Modules\Category\Entities\Category;
    use Domain\Modules\Category\Repositories\ICategoryRepository;
    use Illuminate\Http\RedirectResponse;
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


        public function index(): view
        {
            $page = request()->input('page') ?? 1;

            $data = $this->categoryRepository->GetAllPaginate($page, 5);

            $categories = collect($data->items())->map(function ($d) {
                $d = new Category($d->category_name, $d->id);
                return (object)[
                    'id' => $d->getId(),
                    'category_name' => $d->getCategoryName()
                ];
            });

            return view('category.index')->with([
                'categories' => $categories,
                'pagination' => $data->links()
            ]);
        }


        public function create()
        {
            return view('category.create');
        }

        public function store(Request $request): RedirectResponse
        {

            $val = Validator::make($request->all(), [
                'category_name' => 'required|string',
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

        public function show(string $id): View
        {
            $category = $this->categoryRepository->Find($id);
            return view('category.edit')->with([
                'category' => (object)[
                    'category_name' => $category->getCategoryName(),
                    'id' => $category->getId()
                ]
            ]);
        }

        public function Update(Request $request, string $id): RedirectResponse
        {

            $val = Validator::make($request->all(), [
                'category_name' => 'required|string',
            ]);

            if ($val->fails()) {
                return redirectWithErrors($val);
            }


            $category = new Category(
                $request->input('category_name'),
                $id
            );

            $this->categoryRepository->Update($category);

            return redirectWithAlert('/category', [
                'alert-info' => 'Category has been updated!'
            ]);


        }


    }
