<?php

    namespace App\Repositories;

    use Domain\Modules\Category\Entities\Category;
    use Domain\Modules\Category\Repositories\ICategoryRepository;
    use App\Models\Category as CategoryDB;


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
            // TODO: Implement Update() method.
        }

        public function Delete(string $id): void
        {
            // TODO: Implement Delete() method.
        }

        public function GetAllPaginate(int $page, int $limit)
        {
            // TODO: Implement GetAllPaginate() method.
        }
    }
