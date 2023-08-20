<?php

	namespace Domain\Shared\ValueObjects;

	class Birthdate
	{
        protected string $date;


        public function __construct(string $date)
        {
            $this->date = $date;
        }

        public function getValue() : string {
         return $this->date;
        }

        public function simpleFormat() : string {
            return $this->date;
        }


    }
