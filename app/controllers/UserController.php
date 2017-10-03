<?php
 
class UserController extends BaseController {
 	
 	public function getRegister() {
    	$this->layout->content = View::make('users.register');
	}



}
?>