<?php

    namespace Domain\Modules\User\Entities;

	use Domain\Shared\Entity;

    class User extends Entity
	{
        protected string $username;
        protected string $password;
        protected string $role;

        public function __construct(string $username, string $password, string $role, ?string $id = null)
        {
            parent::__construct($id);
            $this->username = $username;
            $this->password = $password;
            $this->role     = $role;
        }

        /**
         * @return string
         */
        public function getUsername(): string
        {
            return $this->username;
        }

        /**
         * @return string
         */
        public function getPassword(): string
        {
            return $this->password;
        }

        /**
         * @return string
         */
        public function getRole(): string
        {
            return $this->role;
        }





    }
