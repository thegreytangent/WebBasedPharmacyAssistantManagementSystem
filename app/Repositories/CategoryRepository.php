<?php

    namespace App\Repositories;

    use Domain\Modules\Category\Entities\Category;
    use Domain\Modules\Category\Repositories\ICategoryRepository;
    use App\Models\Category as CategoryDB;
    use Illuminate\Support\Facades\DB;


    class CategoryRepository implements ICategoryRepository
    {

        public function Save(Category $category): void
        {
            CategoryDB::create([
                'category_name' => $category->getCategoryName()
            ]);
        }

        public function Update(Category $category): void
        {
            CategoryDB::find($category->getId())->update([
                'category_name' => $category->getCategoryName()
            ]);
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit)
        {
            return CategoryDB::paginate($limit);

        }

        public function Find(string $id): Category|null
        {
            $d = DB::table('categories')->find($id);
            return !$d ? null : new Category($d->category_name, $d->id);
        }
    }
