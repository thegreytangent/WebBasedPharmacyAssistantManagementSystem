<?php

    namespace Domain\Shared\ValueObjects;

    use Illuminate\Support\Carbon;

    class Birthdate
    {
        protected string $date;


        public function __construct(?string $date)
        {
            $this->date = $date ?? now();
        }

        public function getValue(): string
        {
            return $this->date;
        }

        public function simpleFormat(): string
        {
			
            return Carbon::create($this->date)->format('M, d, Y');
        }


    }
