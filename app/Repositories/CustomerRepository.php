<?php
	
	namespace App\Repositories;
	
	use Domain\Modules\Customer\Entities\Customer;
	use Domain\Modules\Customer\Repositories\ICustomerRepository;
	use Domain\Modules\User\Entities\User;
	use Domain\Shared\ValueObjects\Birthdate;
	use Illuminate\Contracts\Pagination\Paginator;
	use Illuminate\Database\Eloquent\Collection;
	use Illuminate\Support\Facades\DB;
	use App\Models\Customer as CustomerDB;
	
	
	class CustomerRepository implements ICustomerRepository
	{
		
		public function Save(Customer $customer): void
		{
			$user = $customer->getUser();
			
			DB::table('users')->insert([
				'id'         => $user->getId(),
				'username'   => $user->getUsername(),
				'password'   => $user->encryptedPassword(),
				'role'       => $user->getRole(),
				'created_at' => now(),
				'updated_at' => now(),
			]);
			
			
			DB::table('customers')->insert([
				'id'         => $customer->getId(),
				'user_id'    => $user->getId(),
				'firstname'  => $customer->getFirstname(),
				'lastname'   => $customer->getLastname(),
				'birthdate'  => $customer->getBirthdate()->getValue(),
				'address'    => $customer->getAddress(),
				'created_at' => now(),
				'updated_at' => now(),
			]);
		}
		
		public function Update(Customer $customer): void
		{
			
			$user = $customer->getUser();
			
			DB::table('users')->where('id', $user->getId())->update([
				'username'   => $user->getUsername(),
			]);
			
			if ($user->getPassword() != "") {
				DB::table('users')->where('id', $user->getId())->update([
					'password'   => $user->encryptedPassword(),
					'updated_at' => now(),
				]);
			}
			
			DB::table('customers')->where('id', $customer->getId())->update([
				'firstname'  => $customer->getFirstname(),
				'lastname'   => $customer->getLastname(),
				'birthdate'  => $customer->getBirthdate()->getValue(),
				'address'    => $customer->getAddress(),
				'updated_at' => now(),
			]);
			
			
		}
		
		public function Delete(string $id): void
		{
			$customer = DB::table('customers')->find($id);
			DB::table('users')->delete($customer->user_id);
			DB::table('customers')->delete($id);
			
		}
		
		public function GetAllPaginate(int $page, int $count): Paginator
		{
			return CustomerDB::paginate($count);
		}
		
		public function Find(string $id): Customer|null
		{
			$c = CustomerDB::with(["User"])->where(['id' => $id])->first();
			if (!$c) return null;
			$customer = new Customer($c->firstname, $c->lastname, new Birthdate($c->birthdate), $id);
			$customer->setAddress($c->address);
			$customer->setUser(new User($c->User->username, $c->User->password, $c->User->role, $c->User->id));
			return $customer;
		}
		
		public function All(): array
		{
			return DB::table('customers')->get()->toArray();
		}
		
		public function FindByUser(string $user_id): CustomerDB
		{
			return CustomerDB::where(['user_id' => $user_id])->first();
		}
	}
