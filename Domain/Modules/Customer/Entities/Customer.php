<?php

    namespace Domain\Modules\Customer\Entities;

    use Domain\Modules\User\Entities\User;
    use Domain\Shared\Entity;
    use Domain\Shared\ValueObjects\Birthdate;

    class Customer extends Entity
    {
        protected string $firstname;
        protected string $lastname;
        protected Birthdate $birthdate;
        protected string $address;
		protected User $user;

        public function __construct(string $firstname, string $lastname, Birthdate $birthdate, ?string $id = null)
        {
            parent::__construct($id);
            $this->firstname = $firstname;
            $this->lastname  = $lastname;
            $this->birthdate = $birthdate;
        }
		
		public function setUser(User $user) : void {
			$this->user = $user;
		}
		
		public function getUser() : User {
			return $this->user;
		}
		
		

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

        public function completeName(): string
        {
            return ucfirst($this->getFirstname()) . " " . ucfirst($this->getLastname());
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


    }
