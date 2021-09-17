<?php


function dd($data)
{
    echo "<pre>";
    print_r($data);
    echo "</pre>";
}


function is_authenticated(){
    $ci =& get_instance();
    if($ci->session->userdata('email')) {
        return true;
    } else { 
        return false;
    }
}



?>