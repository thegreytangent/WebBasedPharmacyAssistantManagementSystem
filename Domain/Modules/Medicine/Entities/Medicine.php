<?php

    namespace Domain\Modules\Medicine\Entities;

    use Domain\Modules\Medicine\ValueObjects\Price;
    use Domain\Shared\Entity;
    use Domain\Shared\ValueObjects\Quantity;

    class Medicine extends Entity
    {
        protected string $name;
        protected Price $price;
        protected int $quantity;
        protected string $category_name;
        protected string $supplier_name;
		protected string $type;
		protected string $unit_of_measurement;


        public function __construct(string $name, Price $price,?string $id = null)
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
        public function price(): Price
        {
            return $this->price;
        }



        public function getCategoryName(): string
        {
            return $this->category_name;
        }

        public function setCategoryName(string $category_name): void
        {
            $this->category_name = $category_name;
        }


        public function getSupplierName(): string
        {
            return $this->supplier_name;
        }

        public function setSupplierName(string $supplier_name): void
        {
            $this->supplier_name = $supplier_name;
        }
	    
	    public function getType(): string
	    {
		    return $this->type;
	    }
	    
	    public function setType(string $type): void
	    {
		    $this->type = $type;
	    }
	    
	    public function getUnitOfMeasurement(): string
	    {
		    return $this->unit_of_measurement;
	    }
	    
	    public function setUnitOfMeasurement(string $unit_of_measurement): void
	    {
		    $this->unit_of_measurement = $unit_of_measurement;
	    }
		
		








    }
