<?php
class UserModel  extends CI_Model 
{
	
	function RegisterUser($data)
	{
        $this->db->insert('ci_register',$data);
        dd($data);
	}
	
}