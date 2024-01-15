<?php

	namespace Domain\Shared\ValueObjects;

	class Quantity
	{
        protected int $qty;

        public function __construct(int $qty)
        {
            $this->qty = $qty;
        }


        public function getQty() : int {
            return $this->qty;
        }


    }
