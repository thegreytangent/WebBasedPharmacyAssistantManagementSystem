<?php

    namespace Domain\Modules\Medicine\Entities;

    use Domain\Modules\Medicine\ValueObjects\Quantity;
    use Domain\Shared\Entity;

    class Medicine extends Entity
    {
        protected string $name;
        protected float $price;

        protected Quantity $quantity;

        public function __construct(string $name, float $price,?string $id = null)
        {
            parent::__construct($id);
            $this->name = $name;
            $this->price = $price;
        }

        public function getQuantity(): Quantity
        {
            return $this->quantity;
        }

        public function setQuantity(Quantity $quantity): void
        {
            $this->quantity = $quantity;
        }


    }
