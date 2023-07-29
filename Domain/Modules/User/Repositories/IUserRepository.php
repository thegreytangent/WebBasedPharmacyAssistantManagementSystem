<?php

    namespace Domain\Modules\User\Repositories;

    use Domain\Modules\User\Entities\User;

    interface IUserRepository
    {
        public function FindByUsername(string $username): User|null;

        public function FindByPassword(string $password): User|null;
    }
