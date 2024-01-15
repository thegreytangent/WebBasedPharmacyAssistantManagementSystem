<?php

    namespace Domain\Modules\Category\Entities;

    use Domain\Shared\Entity;

    class Category extends Entity
    {

        protected string $category_name;


        public function __construct(string $category_name, string $id = null)
        {
            parent::__construct($id);

            $this->category_name = $category_name;
        }


        public function getCategoryName(): string
        {
            return $this->category_name;
        }


    }
