<?php

	namespace Domain\Modules\Customer\Entities;

	use Domain\Shared\Entity;
    use Domain\Shared\ValueObjects\Birthdate;

    class Customer extends Entity
	{
            protected string $firstname;
            protected string $lastname;
            protected Birthdate $birthdate;
            protected string $address;


        public function __construct(string $firstname, string $lastname, Birthdate $birthdate, ?string $id = null)
        {
            parent::__construct($id);
            $this->firstname = $firstname;
            $this->lastname  = $lastname;
            $this->birthdate = $birthdate;
        }

        /**
         * @return string
         */
        public function getFirstname(): string
        {
            return $this->firstname;
        }

        /**
         * @return string
         */
        public function getLastname(): string
        {
            return $this->lastname;
        }

        /**
         * @return string
         */
        public function getBirthdate(): Birthdate
        {
            return $this->birthdate;
        }



        public function getAddress(): string
        {
            return $this->address;
        }

        public function setAddress(?string $address): void
        {
            $this->address = $address ?? "";
        }





    }
