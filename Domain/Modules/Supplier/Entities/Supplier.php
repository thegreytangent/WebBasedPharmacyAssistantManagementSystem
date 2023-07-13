<?php

	namespace Domain\Modules\Supplier\Entities;

	use Domain\Shared\Entity;
    use Domain\Shared\ValueObjects\ContactNumber;

    class Supplier extends Entity
	{

        protected string $name;
        protected ContactNumber $contactNumber;

        public function __construct(string $name, ContactNumber $contactNumber,?string $id = null)
        {
            parent::__construct($id);
            $this->name          = $name;
            $this->contactNumber = $contactNumber;
        }


        public function getName(): string
        {
            return $this->name;
        }

        public function getContactNumber(): ContactNumber
        {
            return $this->contactNumber;
        }




    }
