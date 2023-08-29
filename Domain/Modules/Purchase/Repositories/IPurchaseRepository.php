<?php

    namespace Domain\Modules\Purchase\Repositories;

    use Domain\Modules\Purchase\Entities\Purchase;

    interface IPurchaseRepository
    {

        public function Save(Purchase $purchase): void;

        public function Update(Purchase $purchase): void;

        public function Delete(string $id): void;

        public function GetAllPaginate(int $page, int $limit): array;

    }
