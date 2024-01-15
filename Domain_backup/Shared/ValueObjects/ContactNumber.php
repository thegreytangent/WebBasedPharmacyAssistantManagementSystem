<?php

    namespace Domain\Shared\ValueObjects;

    class ContactNumber
    {
        protected int $number;

        public function __construct(int $number)
        {
            $this->number = $number;
        }

        public function getOriginalInput(): int
        {
            return $this->number;
        }

        public function getWithCountryCode(): string
        {

        }


    }
