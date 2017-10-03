<?php
 
class UsersController extends BaseController {

    public function __construct()
    {
        $this->beforeFilter('csrf', array('only' => array('postLogin')));
        $this->beforeFilter('auth', array('only'=>array('getDashboard')));
    }
    
    public function getRegister() {
        return View::make('users.register');
    }

    public function postRegister() {
        if(file_exists("register.lock")) {
			return "Registrations closed";
		}
        $rules = array(
            'username'=>'required|alpha_num|min:2',
            'name' => 'required',
            'money' => 'required|integer',
            'password'=>'required|alpha_num|between:6,12|confirmed',
            'password_confirmation'=>'required|alpha_num|between:6,12'
        );

        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails())
        {
            return Redirect::to('/index')->withErrors($validator)->withInput();
        }
        elseif($validator->passes())
        {
            $user = new User;
            $user->username = Input::get('username');
            $user->name = Input::get('name');
            $user->money = Input::get('money');
            $user->password = Hash::make(Input::get('password'));
            $user->save();
            return "Successfully Added !! <a href='/register.html'>Go Back</a>";
        }
        else
        {
            return $_POST['email'];
        }
    }

    public function getLogin() {
        return View::make('users.login');
    }

    public function postLogin() {

        if (Auth::attempt(array('username'=>Input::get('username'), 'password'=>Input::get('password')), (Input::get('remember') === NULL ? false:true))) {
            return Redirect::to('bids')->with('message', 'You are now logged in!');
        } else {
            return Redirect::to('bids')
            ->with('message', 'Your username/password combination was incorrect')
            ->withInput();
        }

        return View::make('users.login');
    }


    public function getDashboard() {
        return View::make('users.dashboard');
    }

    public function getLogout()
    {
        Auth::logout();
         return Redirect::to('/bids')->with('message',"Logged Out !");
    }
	
	public function getLock () 
	{
		$handle = fopen("register.lock", "w");
		fclose($handle);
		return "Registrations Locked !";
	}

}
?>