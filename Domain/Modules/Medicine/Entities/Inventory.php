<?php

	namespace Domain\Modules\Medicine\Entities;

	use Domain\Shared\Entity;

    class Inventory extends Entity
	{

        protected string $date;
        protected int $qty;


        public function __construct(string $date, int $qty, ?string $id = null)
        {
            parent::__construct($id);
            $this->date = $date;
            $this->qty  = $qty;
        }


        public function getDate(): string
        {
            return $this->date;
        }

        public function getQty(): int
        {
            return $this->qty;
        }




    }
