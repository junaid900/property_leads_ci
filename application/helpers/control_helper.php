<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/**
 * CodeIgniter
 *
 * An open source application development framework for PHP 5.1.6 or newer
 *
 * @package		CodeIgniter
 * @author		ExpressionEngine Dev Team
 * @copyright	Copyright (c) 2008 - 2011, EllisLab, Inc.
 * @license		http://codeigniter.com/user_guide/license.html
 * @link		http://codeigniter.com
 * @since		Version 1.0
 * @filesource
 */

/*
	 * 判断客户登录客户端
	 * */
	function checkagent(){
		$agent = strtolower($_SERVER['HTTP_USER_AGENT']);  
	    $is_pc = (strpos($agent, 'windows nt')) ? true : false;  
	    $is_iphone = (strpos($agent, 'iphone')) ? true : false;  
	    $is_ipad = (strpos($agent, 'ipad')) ? true : false;  
	    $is_android = (strpos($agent, 'android')) ? true : false;  
	   
	    if($is_ipad){  
	        return 'ipad';
	    }else{
	     	if($is_iphone){  
	        	return 'iphone';
		    }else{
				if($is_android){
			    	return 'android';
			    }else{
			    	return 'pc';
			    }
		    }
	    }
	}
if ( ! function_exists('control_helper'))
{	
	function control_helper(){	
	    $CI =& get_instance();
    	$CI->load->database();
    	$controller_name = $CI->session->userdata('controller_name');
    	if(!empty($controller_name)){
    	    $name = $controller_name;
    	}else{
    	    $CI->session->set_userdata('controller_name','en');
    	    $name = 'en';
    	}
    //	return base_url().'index.php/'.$name.'/';
		return base_url().'/'.$name.'/';
	}
}

function auth_session($token_id)
{
    $CI =& get_instance();
    $CI->load->database();
    $date = date('Y-m-d h:i:s');
    $current_date = strtotime($date);
    $result =  $CI->db->query('select * from brinkman_users where token_id="'.$token_id.'" AND token_expiry>="'.$current_date.'"')->num_rows();
    if($result == 0){
       $tokenData['response'] = 'token_expired';
       response(1, "authentication fail", $tokenData); 
    }else{
        return true;
    }
}

function response($status = 0, $message = "Unauthorized Access", $response = [])
    {
        $resp = [
            "status" => $status,
            "message" => $message,
            "response" => (!empty($response)) ? $response : [],
        ];
        echo json_encode($resp);
        exit();
    }
if ( ! function_exists('apikey'))
{
    function apikey(){
        return 'XXXXXX-XXXXXX-MHnsa1988938922039:012900929';
    }
}
if ( ! function_exists('admin_ctrl'))
{
    function admin_ctrl(){
        return 'admin';
       // return 'index.php/admin';
    }
}
if ( ! function_exists('assets_dir'))
{
    function assets_dir(){
        return base_url() . 'assets/admin/';
    }
}
if ( ! function_exists('system_image'))
{
    function system_image(){
        $CI =& get_instance();
        $CI->load->database();
        return $CI->db->get_where('system_settings',array('type'=>'system_image'))->row()->description;
    }
}
if ( ! function_exists('system_name'))
{
    function system_name(){
        $CI =& get_instance();
        $CI->load->database();
        return $CI->db->get_where('system_settings',array('type'=>'system_name'))->row()->description;
    }
}
/*
if ( ! function_exists('system_permissions'))
{
    function system_permissions(){
        $CI =& get_instance();
        $CI->load->database();
        return $CI->db->get_where('permission',array('users_roles_id'=>$CI->session->userdata('user_roles_id')))->row()->description;
    }
}*/

if ( ! function_exists('tokenkey'))
{
    function tokenkey(){
// base64 token key       WFhYWFhYX1hYWFhYWFhfVEtfMTI5OTQ3NzczNjY2Mj9fVEtOTUpDb2RlcnNUT0tFTg==
        return base64_encode('XXXXXX_XXXXXXX_TK_1299477736662?_TKNMJCodersTOKEN');
    }
}
if ( ! function_exists('isTokenValid'))
{
    function isTokenValid($token){
        $CI =& get_instance();
        $CI->load->database();
        $result = $CI->db->get_where("users_system",array("token_id"=>$token));
        if(!$result) {
            return false;
        }
        if(count($result->result()) != 1){
            return false;
        }
        return true;
    }
}

if ( ! function_exists('generateToken'))
{
    function generateToken(){
      $rand1 = rand() . rand() . rand();
      $date = date("Ymd|hsi");
      $token = md5($date.rand()."MJcod..er..SSPOTOKEN");
      return $token;
    }
}

if ( ! function_exists('generateSession'))
{
    function generateSession(){
        $rand1 = rand() . rand() . rand() .rand();
        $date = date("dYm|ihs");
        $session = md5($date.rand()."MJcod.er..SSPOSESSION");
        return $session;
    }
}
// ------------------------------------------------------------------------
/* End of file control_helper.php */
/* Location: ./system/helpers/control_helper.php */