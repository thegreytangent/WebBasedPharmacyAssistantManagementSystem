<?php

    namespace Domain\Modules\Medicine\Entities;

    use Domain\Shared\Entity;
    use Domain\Shared\ValueObjects\Quantity;

    class Medicine extends Entity
    {
        protected string $name;
        protected float $price;
        protected int $quantity;

        public function __construct(string $name, float $price,?string $id = null)
        {
            parent::__construct($id);
            $this->name = $name;
            $this->price = $price;
        }

        public function getQuantity(): int
        {
            return $this->quantity;
        }

        public function setQuantity(int $quantity): void
        {
            $this->quantity = $quantity;
        }

        /**
         * @return string
         */
        public function getName(): string
        {
            return $this->name;
        }

        /**
         * @return float
         */
        public function getPrice(): float
        {
            return $this->price;
        }



    }
