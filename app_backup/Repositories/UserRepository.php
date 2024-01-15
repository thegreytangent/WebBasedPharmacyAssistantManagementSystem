<?php

	namespace App\Repositories;

	use Domain\Modules\User\Entities\User;
    use Domain\Modules\User\Repositories\IUserRepository;
    use Illuminate\Support\Facades\DB;

    class UserRepository implements IUserRepository
	{

        public function FindByUsername(string $username): User|null
        {
            $user = DB::table('users')->where(['username' => $username])->first();
            return !$user ? null : new User($user->username, $user->password, $user->role, $user->id);
        }

        public function FindByPassword(string $password): User|null
        {
            // TODO: Implement FindByPassword() method.
        }
    }
