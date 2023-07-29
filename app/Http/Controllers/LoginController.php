<?php

    namespace App\Http\Controllers;

    use App\Exceptions\ErrorException;
    use Domain\Modules\User\Entities\User;
    use Domain\Modules\User\Repositories\IUserRepository;
    use Illuminate\Http\RedirectResponse;
    use Illuminate\Http\Request;
    use Illuminate\Support\Facades\Hash;
    use Illuminate\Support\Facades\Validator;
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
                $validate = Validator::make($request->all(),[
                    'username' => 'required',
                    'password' => 'required'
                ]);

                if ($validate->fails())
                    throw new \Exception($validate->errors()->first());


                $username = $request->input('username');
                $password = $request->input('password');

                $user = $this->userRepository->FindByUsername($username);

                if (!$user) {
                    throw new \Exception('Username/Password not found!');
                }

                if ($user->getUsername() != $username || Hash::check($password, $user->getPassword())) {
                    redirectWithAlert('/login', [
                        'alert-danger' => 'Wrong credentials. Please try again'
                    ]);
                }
                return redirect('/dashboard');
            }catch (\Exception $exception) {
                return redirectWithAlert('login', [
                    'alert-danger' => $exception->getMessage()
                ]);
            }


        }
    }
