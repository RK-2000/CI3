<?php
class UserModel  extends CI_Model 
{
	
	function RegisterUser($data)
	{
        $this->db->insert('ci_register',$data);
        dd($data);
	}
	function LoginCheckModel($login_data)
	{
		$email = $login_data['email'];
		$password = $login_data['password'];
		$q = $this->db->query("Select * from ci_register where email='$email' and password ='$password'")->result_array();
		// dd($q);
		if (!empty($q)) {
			return $q;
		} else {
			return FALSE;
		}
	}
	
}