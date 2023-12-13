<?php
	
	namespace App\Http\Controllers;
	
	use App\Exceptions\ErrorException;
	use Domain\Modules\User\Entities\User;
	use Domain\Modules\User\Repositories\IUserRepository;
	use Exception;
	use Illuminate\Http\RedirectResponse;
	use Illuminate\Http\Request;
	use Illuminate\Support\Facades\Auth;
	use Illuminate\Support\Facades\Hash;
	use Illuminate\Support\Facades\Session;
	use Illuminate\Support\Facades\Validator;
	use Illuminate\Support\Str;
	use Illuminate\View\View;
	
	class LoginController extends Controller
	{
		
		protected IUserRepository $userRepository;
		
		public function __construct(IUserRepository $userRepository)
		{
			$this->userRepository = $userRepository;
		}
		
		
		public function index(): View
		{
			return view('login.index');
		}
		
		public function login(Request $request)
		{
			try {
				$validate = Validator::make($request->all(), [
					'username' => 'required',
					'password' => 'required'
				]);
				
				if ($validate->fails())
					throw new Exception($validate->errors()->first());
				
				
				$username = $request->input('username');
				$password = $request->input('password');
				
				$user = $this->userRepository->FindByUsername($username);
				
				if (!$user) {
					throw new Exception('Username/Password not found!');
				}
				
				if ($user->getUsername() != $username || !Hash::check($password, $user->getPassword())) {
					throw new Exception('Wrong credentials. Please try again');
				}
				
				
				Session::put('role', $user->getRole());
				Session::put('username', $user->getUsername());
				
				Auth::login(\App\Models\User::find($user->getId()));
				
				if ($user->getRole() == "customer") {
					return redirect('/customer/purchase');
				} else {
					return redirect('/dashboard');
				}
				
				
			} catch (Exception $exception) {
				return redirectWithAlert('login', [
					'alert-danger' => $exception->getMessage()
				]);
			}
			
			
		}
	}
