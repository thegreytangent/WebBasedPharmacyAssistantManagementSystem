<?php

    namespace Domain\Modules\Purchase\Entities;

    use Domain\Shared\Entity;

    class Purchase extends Entity
    {
        protected string $date;
        protected string $receipt_number;
        protected string $total_amount;
        protected array $purchaseMedicines;


        public function __construct(string $date, string $receipt_number, string $total_amount, ?string $id = null)
        {
            parent::__construct($id);
            $this->date           = $date;
            $this->receipt_number = $receipt_number;
            $this->total_amount   = $total_amount;
        }


        public function getPurchaseMedicines(): array
        {
            return $this->purchaseMedicines;
        }

        /**
         * @param PurchaseMedicine $purchaseMedicines
         */
        public function setPurchaseMedicines(PurchaseMedicine $purchaseMedicines): void
        {
            $this->purchaseMedicines[] = $purchaseMedicines;
        }


        /**
         * @return string
         */
        public function getDate(): string
        {
            return $this->date;
        }

        /**
         * @return string
         */
        public function getReceiptNumber(): string
        {
            return $this->receipt_number;
        }

        /**
         * @return string
         */
        public function getTotalAmount(): string
        {
            return $this->total_amount;
        }


    }
