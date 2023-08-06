<?php

    namespace Domain\Modules\Category\Repositories;

    use Domain\Modules\Category\Entities\Category;

    interface ICategoryRepository
    {

        public function Save(Category $category): void;

        public function Update(Category $category): void;

        public function Delete(string $id): void;

        public function GetAllPaginate(int $page, int $limit);

        public function Find(string $id) : Category | null;

    }
