<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->library('session');
        $userData = ["directory" => "madmin"];
        $this->session->set_userdata($userData);
         $this->session->set_userdata('current_language', 'Bilingual');
            $this->session->set_userdata('language_country', 'Bilingual');
    }

    /***** ADMIN INDEX *********/
    public function index()
    {
        if ($this->session->userdata('login') == 1) {
            redirect(base_url() . admin_ctrl() . '/dashboard', 'refresh');
        }
        $this->load->view('madmin/login');
    }
    /***** ADMIN INDEX *********/
    /* VERIFY ACCOUNT */
    public function login()
    {
        // Validate the user can login
        $result = $this->Db_model->login_varify_accounts();
      
        /*	if($result =='blocked'){
                $this->session->set_flashdata('msg_error', 'Due to many unsuccessful times, your account is now locked. Please try again 2hours later.');
                redirect(base_url().'admin', 'refresh');
                l
            }else if($result =='permanent_blocked'){

                $this->session->set_flashdata('msg_error', 'Please contact the administrator to unlock your account. Please check your email for contact information');
                redirect(base_url().'admin', 'refresh');
            }*/

        // Now we verify the result
        if ($result) {
            if ($result->status == 'Inactive') {
                //                echo "here";
                //                exit();
                $this->session->set_flashdata('msg_error', 'your account is Inactive!');
                redirect(base_url() . admin_ctrl(), 'refresh');
            }
            /* $check_login_status = $this->db->get_where('user_login',array('user_accounts_id'=>$result->user_accounts_id));
             if($check_login_status->num_rows()>0){
                 //$_SERVER['REMOTE_ADDR'] == $check_login_status->row()->user_ip &&
                 if($check_login_status->row()->status == 'Active'){
                    $this->session->set_flashdata('msg_error', 'your account is already login from other device!');
                    redirect(base_url().'admin', 'refresh');
                 }else{
                     $s_update['status']  = 'Inactive';
                     $this->db->where('user_accounts_id',$result->user_accounts_id);
                     $this->db->update('user_login',$s_update);
                 }
             }
             $loginData['user_accounts_id'] = $result->user_accounts_id;
             $loginData['user_ip']          = $_SERVER['REMOTE_ADDR'];
             $loginData['date_added']       = date('Y-m-d h:i:s');
             $loginData['status']           = 'Active';
             $this->db->insert('user_login', $loginData);*/
            $permissions =  $this->db->get_where('permission',array('users_roles_id'=>$result->users_roles_id))->row();
            $this->session->set_userdata('permissions', $permissions);
            $this->session->set_userdata('user_name', $result->first_name);
            $this->session->set_userdata('users_id', $result->users_system_id);
            $this->session->set_userdata('users_email', $result->email);
            $this->session->set_userdata('user_roles_id', $result->users_roles_id);
            $this->session->set_userdata('directory', 'madmin');
            
            
            $this->session->set_userdata('login', 1);
            $this->session->set_flashdata('msg_success', 'Login Successfully.');
            redirect(base_url() . admin_ctrl() . '/dashboard', 'refresh');
        } else {
            //            echo "reror";
            //            exit();
            // If user did validate,
            $this->session->set_flashdata('msg_error', 'Email or password  is incorrect!');
            redirect(base_url() . admin_ctrl(), 'refresh');
        }
    }


   public function forgot_password(){
		$this->load->view('madmin/forgot_password');
	}
	
	public function CheckEmail($param1='', $param2 =''){
		$email  = $this->input->post('email');
		$db_val = $this->db->get_where('users_system', array('email' => $email))->num_rows();
		if($db_val >0){
			echo 'email already exist';
		}else{
			echo 'notexist';
		}
		exit;
	}
	
	public function retrieve_password($param1='', $param2 =''){
	
		$user_email = $this->input->post('retrive_email');   
		$response = $this->Db_model->retrieve_password($user_email);
		if($response== 'Mail Sent'){
			$this->session->set_flashdata('msg_success', ' Password Reset Link Sent To Your Email Successfully');					
		} else if($response== 'Mail Not Sent'){
			$this->session->set_flashdata('msg_error', ' Error In Sending Mail. Try Again.');					
		} else if($response== 'Email Not Found'){
			$this->session->set_flashdata('msg_error', ' Email Not Found, Please Check Your Email');					
		}
		redirect(base_url() . admin_ctrl(), 'refresh');
	}
	
    /*****REGION WISE REPORT ******/
     public function region_wise_report($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        if($param1 == 'search'){
            $postal_code  = $this->input->post('postal_code');
            $data['leads_data']     = $this->db->query("select * from leads where lead_type='customer' AND postal_code=".$postal_code)->result_array();
            $data['postal_code']    =  $postal_code;
        }else{
            $data['leads_data']     = $this->db->query("select * from leads where lead_type='customer' group by postal_code")->result_array();
        }
        $data['param1'] = $param1;
        $data['postal_codes']   = $this->db->query("SELECT DISTINCT postal_code FROM leads")->result_array();
        $data['page_title'] = 'Region Wise Report';
        $data['page_sub_title'] = 'Region Wise Report';
        $data['page_name'] = 'region_wise';
        $data['actor'] = 'region_wise_report';
        $data['main_page_name'] = 'region_wise_report';
        $data["htmlPage"] = "region_wise";
        
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
     /*****REGION WISE REPORT ******/
     /*****User System Email ******/
    public function userSystemEmail($param1 = '', $param2 = ''){
        $users_system_id =  $this->input->post('users_system_id');
        $email =  $this->input->post('email');
        $result = $this->db->query("select * from users_system where users_system_id!=$users_system_id")->result_array();
       
        $emailExist = 'notexist';
        foreach($result as $data){
            if($data['email'] == $email){
                $emailExist = 'exist';
                break;
            }
        }
        echo $emailExist;
        exit;
    }
    public function userSystemEmailExist($param1 = '', $param2 = ''){
        $email =  $this->input->post('email');
        $result = $this->db->query("select * from users_system where email='$email'")->num_rows();
        if($result>0){
            $emailExist = 'exist'; 
        }else{
            $emailExist = 'notexist';
        }
        
       
        echo $emailExist;
        exit;
    }
    
    /*****User System Email ******/
    /***** EMAIL TEMPLATES *********/
    public function email_templates($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        if ($param1 == 'update_status') {
            $data_id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('email_templates_id', $data_id);
            $result = $this->db->update('email_templates', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }
        if ($param1 == 'delete') {
            $this->db->where('email_templates_id', $param2);
            $result = $this->db->delete('email_templates');
            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/email_templates', 'refresh');
        }
       
        $users_id = $this->session->userdata('users_id');
        if($this->session->userdata('user_roles_id') == 1){
           $data['email_templates']     = $this->db->get('email_templates')->result_array();
        }else{
            $data['email_templates']     = $this->db->get_where('email_templates',array('users_system_id'=>$users_id))->result_array();
        }
        
        $data['page_title'] = 'Manage Email Templates';
        $data['page_sub_title'] = 'Manage Email Templates';
        $data['page_name'] = 'email_templates';
        $data['actor'] = 'email_templates';
        $data['main_page_name'] = 'email_templates';
        $data["htmlPage"] = "email_templates";
        
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
     public function add_email_template($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        
        if($param1 =='add'){
            $users_id = $this->session->userdata('users_id');
            $subject = $this->input->post('subject');
            $data['type']    = str_replace(' ', '_', $subject);
			$data['subject'] = $subject;
			$data['body'] 	 = $this->input->post('body');
			$data['users_system_id'] = $users_id;
			$data['status']  = 'Active';
			$result = $this->db->insert('email_templates',$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/email_templates', 'refresh');
		
		}
		$data['page_title'] = 'Add Template ';
        $data['page_sub_title'] = 'Edit Template';
        $data['page_name'] = 'email_templates';
        $data['actor'] = 'email_templates';
        $data['main_page_name'] = 'Email Templates';
        $data['main_page_link'] = 'email_templates';
        $data["htmlPage"] = "add_email_template";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    

    
     public function edit_email_template($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        
        if($param1 =='edit'){
			$subject = $this->input->post('subject');
           // $data['type']    = str_replace(' ', '_', $subject);
			$data['subject'] = $subject;
			$data['body'] 	 = $this->input->post('body');
			$result = $this->Db_model->update_data('email_templates',$param2,$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/email_templates', 'refresh');
		
		}
		$email_array = $this->db->get_where('email_templates', array('email_templates_id' => $param1))->row();
	    $data['request']      = $email_array;
        $data['param1']         = $param1;
        $data['page_title'] = 'Edit '.$email_array->subject;
        $data['page_sub_title'] = 'Edit '.$email_array->subject;
        $data['page_name'] = 'email_templates';
        $data['actor'] = 'email_templates';
        $data['main_page_name'] = 'Email Templates';
        $data['main_page_link'] = 'email_templates';
        $data["htmlPage"] = "edit_email_template";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

   /* public function add_category($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . strtolower($this->session->userdata('directory')), 'refresh');
        }
        if ($param1 == 'save') {
            $data['en_name']             = $this->input->post('en_name');
            $data['ch_name']             = $this->input->post('ch_name');
            $data['status']              = $this->input->post('status');
            $result = $this->db->insert('brinkman_products_category', $data);
            if ($result) {
                $this->session->set_flashdata('msg_success', ' Data Added Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . admin_ctrl() . '/manage_category', 'refresh');
        }
        $data['system_data']     = $this->db->get('brinkman_system_settings')->result();
        $data['page_title']     = 'Category';
        $data['page_sub_title'] = 'Products';
        $data['page_name']         = 'add_category';
        $data['actor']          = 'add_category';
        $data['main_page_name'] = 'manage_category';
        $data["htmlPage"]       = "add_category";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    */
   
    /***** EMAIL TEMPLATE *********/

    /***** Language *********/
    public function change_language()
    {
        $lang = $this->input->post('lang');

        if ($lang == 'english') {
            $this->session->set_userdata('current_language', 'english');
            $this->session->set_userdata('language_country', 'english');
            $this->session->set_userdata('controller_name', 'en');
        } else {
            $this->session->set_userdata('current_language', 'Bilingual');
            $this->session->set_userdata('language_country', 'Bilingual');
            $this->session->set_userdata('controller_name', 'bi');
        }

        exit;
    }

    public function language($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        $data['profile_data'] = $this->db->get_where('users_system', array('users_system_id' => '1'))->row();
        $data['page_title'] = get_phrase('manage_language');
        $data['page_sub_title'] = 'Manage Language';
        $data['page_name'] = 'manage_language';
        $data['actor'] = 'manage_language';
        $data['main_page_name'] = 'manage_language';
        $data["htmlPage"] = "manage_language";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function edit_language($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'edit') {
            $phrase_id = $this->input->post('phrase_id');
            $lang = $this->input->post('lang');
            $data[$lang] = $this->input->post('phrase_value');
            //$this->db->where('Spainish',$this->input->post('phrase_value'));
            $this->db->where('phrase_id', $phrase_id);
            $result = $this->db->update('language', $data);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        // $data['profile_data'] = $this->db->get_where('brinkman_users_system', array('users_system_id' => '1'))->row();
        $data['profile_data'] = $this->db->get_where('users_system', array('users_system_id' => '1'))->row();
        $data['param1'] = $param1;
        $data['page_title'] = get_phrase('edit_language');
        $data['page_sub_title'] = 'Edit Language';
        $data['page_name'] = 'edit_language';
        $data['actor'] = 'edit_language';
        $data['main_page_name'] = 'edit_language';
        $data["htmlPage"] = "edit_language";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** Language *********/

    /***** DASBOARD *********/
    public function dashboard($param1='')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
     
        $role             = $this->session->userdata('user_roles_id');
        $data['role']     = $role;
        if($role == 1){
            $data['user_dt']  = $this->db->get_where('users_system',array('users_system_id'=>$this->session->userdata('users_id')))->row();
            //admin
            $leads_list     = $this->db->get_where('leads', array('lead_type' => 'lead'));
            $customer_list  = $this->db->get_where('leads', array('lead_type' => 'customer'));
            $sold_list      = $this->db->get_where('leads', array('lead_type' => 'sold'));
            
            $data['leads_bullets']   = $this->Db_model->leads_list_counter($leads_list->result_array());
            $data['customer_bullets']= $this->Db_model->customer_list_counter($customer_list->result_array());
            $data['sold_bullets']    = $this->Db_model->sold_list_counter($sold_list->result_array());
            $data['total_leads']     = $leads_list->num_rows();
            $data['broker_list']     = $this->db->get_where('users_system',array('users_roles_id'=>2))->result_array();
            $data['employee_list']   = $this->db->get_where('users_system',array('users_roles_id'=>3))->result_array();
            $data['total_brokers']   = $this->db->get_where('users_system', array('users_roles_id' => 2))->num_rows();
            $data['total_employees'] = $this->db->get_where('users_system', array('users_roles_id' => 3))->num_rows();
            $data['total_customer']  = $customer_list->num_rows();
            $data['total_sold']      = $sold_list->num_rows();
            $data['distinct_regions']= $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='customer' group by postal_code")->result_array();
            $data['leads_data']      = $this->db->order_by("leads_id", "desc")->limit(10)->get_where('leads',array('lead_type'=>'lead'))->result_array();
            $data['customer_data']   = $this->db->order_by("leads_id", "desc")->limit(10)->get_where('leads',array('lead_type'=>'customer'))->result_array();
        }else if($role == 2){
            //broker 
            
            $broker_id      = $this->session->userdata('users_id');
            $data['user_dt']  = $this->db->get_where('users_system',array('users_system_id'=>$broker_id))->row();
            
            $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$broker_id))->result_array();
            $employee_array=array();
            foreach($employee_list as $emp){
                array_push($employee_array,$emp['users_system_id']);
            }
            array_push($employee_array,$broker_id);
            $data['employee_list']   = $employee_list;
            $data['total_employees'] = Count($employee_array)-1;
            if(!empty($employee_array)){
                $leads_data    = $this->db->query("SELECT * FROM leads WHERE lead_type='lead' AND parent_id IN (" . implode(',', $employee_array) . ")")->result_array();
                $customer_data = $this->db->query("SELECT * FROM leads WHERE lead_type='customer' AND parent_id IN (" . implode(',', $employee_array) . ")")->result_array();
                $sold_data     = $this->db->query("SELECT * FROM leads WHERE lead_type='sold' AND parent_id IN (" . implode(',', $employee_array) . ")")->result_array();
                /* leads bullets */
              
                $data['leads_bullets']   = $this->Db_model->leads_list_counter($leads_data);
                $data['customer_bullets']= $this->Db_model->customer_list_counter($customer_data);
                $data['sold_bullets']    = $this->Db_model->sold_list_counter($sold_data);
                
                $data['leads_data']      = $leads_data;
                $data['customer_data']   = $customer_data;
                $data['total_leads']     = Count($leads_data);
                $data['total_customer']  = Count($customer_data);
                $data['total_sold']      = Count($sold_data);
                $data['distinct_regions']= $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='customer' AND parent_id IN (" . implode(',', $employee_array) . ") group by postal_code")->result_array();
            }else{
                $data['total_leads']     = 0;
                $data['total_customer']  = 0;
                $data['leads_data']      = array();
                $data['customer_data']   = array();
                $data['distinct_regions']= array();
            }
        }else if($role == 3){
            $employee_id      = $this->session->userdata('users_id');
            $data['user_dt']  = $this->db->get_where('users_system',array('users_system_id'=>$employee_id))->row();
            $leads_data    = $this->db->query("SELECT * FROM leads WHERE lead_type='lead' AND parent_id=$employee_id")->result_array();
            $customer_data = $this->db->query("SELECT * FROM leads WHERE lead_type='customer' AND parent_id=$employee_id")->result_array();
            $sold_data     = $this->db->query("SELECT * FROM leads WHERE lead_type='sold' AND parent_id=$employee_id")->result_array();
            
            /* leads bullets */
            $data['leads_bullets']   = $this->Db_model->leads_list_counter($leads_data);
            $data['customer_bullets']= $this->Db_model->customer_list_counter($customer_data);
            
            $data['sold_bullets']    = $this->Db_model->sold_list_counter($sold_data);
            $data['leads_data']      = $leads_data;
            $data['customer_data']   = $customer_data;
            $data['total_sold']      = Count($sold_data);
            $data['total_leads']     = Count($leads_data);
            $data['total_customer']  = Count($customer_data);
            $data['distinct_regions']= $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='customer' AND parent_id=$employee_id group by postal_code")->result_array();
        
        }
        
        //number_of_time_data_exported
        $role      = $this->session->userdata('user_roles_id');
        $users_id  = $this->session->userdata('users_id');
        if($role == '2'){
             $user_data = $this->db->query("select * from users_system where users_system_id=$users_id")->row();
             $data['past_data_shown_allowed']      =  $user_data->past_data_shown_allowed;
             $data['number_of_time_data_exported'] =  $user_data->number_of_time_data_exported;
            
             $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id ")->result_array();
             $employee_array=array();
             foreach($employee_list as $emp){
                array_push($employee_array,$emp['users_system_id']);
             }
             array_push($employee_array,$users_id);
             $data['total_exports'] = '';
             if(!empty($employee_array)){
              $data['total_exports'] = $this->db->query("select count(export_report_id) as total_exports from export_report where users_system_id IN (" . implode(',', $employee_array) . ") AND DATE(created_at) between date_sub(now(),INTERVAL 1 WEEK) and now()")->row()->total_exports;
             }
            
        }else if($role == '3'){
            $broker_id = $this->db->query("select parent_id from users_system where users_system_id =$users_id")->row()->parent_id;
            if($broker_id){
                $user_data = $this->db->query("select * from users_system where users_system_id=$broker_id")->row();
                $data['past_data_shown_allowed']      =  $user_data->past_data_shown_allowed;
                $data['number_of_time_data_exported'] =  $user_data->number_of_time_data_exported;
               
                 $employee_list  = $this->db->query("select * from users_system where parent_id =$broker_id ")->result_array();
                 $employee_array=array();
                 foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                 }
                 array_push($employee_array,$users_id);
                 $data['total_exports'] = '';
                 if(!empty($employee_array)){
                    $data['total_exports'] = $this->db->query("select count(export_report_id) as total_exports from export_report where users_system_id IN (" . implode(',', $employee_array) . ") AND DATE(created_at) between date_sub(now(),INTERVAL 1 WEEK) and now()")->row()->total_exports;
                 } 
            }      
        }       
    
        $data['house_types']     = $this->db->get_where('house_types',array('status'=>'Active'))->result_array();
        $data['region_list']     = $this->db->query("SELECT * FROM leads group by postal_code")->result_array();
        $data['main_page_name']  = '';
        $data['main_page_link']  = '';
        $data['page_title']      = 'Dashboard';
        $data['page_sub_title']  = '';
        $data['page_name']       = 'dashboard';
        $data["htmlPage"]        = "dashboard";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    public function export_report($param1='',$param2='',$param3=''){
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
         if($param1 =='get_postal_codes'){
                $str_date = '';
                $report_type='lead';
                $result = array();
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                }
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                $users_id  = $param3;
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $result= $this->db->query("SELECT leads.* FROM leads where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id IN (" . implode(',', $employee_array) . ") $str_date group by leads.postal_code")->result_array();
                    }else{
                       $result = array(); 
                    }
                }else if($param2 == 'employee'){
                    $result= $this->db->query("SELECT leads.* FROM leads  where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id $str_date group by leads.postal_code")->result_array();
                }
                echo json_encode($result);
                exit;
         }
         if($param1 =='get_avg_selling_price_per_region'){
                $str_date = '';
                $report_type='lead';
                $result = array();
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                }
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                $users_id  = $param3;
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $result= $this->db->query("SELECT leads.postal_code as postal_code,leads.city as city,AVG(leads.sold_price) as soldPrice  FROM  leads  where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id IN (" . implode(',', $employee_array) . ")  $str_date GROUP BY leads.postal_code")->result_array();   
                    }else{
                       $result = array(); 
                    }
                }else if($param2 == 'employee'){
                    $result= $this->db->query("SELECT leads.postal_code as postal_code,leads.city as city,AVG(leads.sold_price) as soldPrice FROM  leads where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id $str_date GROUP BY leads.postal_code")->result_array();
                }
                echo json_encode($result);
                exit;
         }
          if($param1 =='get_avg_selling_price'){
                $str_date = '';
                $report_type='lead';
                $result = array();
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                }
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                $users_id  = $param3;
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $result= $this->db->query("SELECT leads.house_types_id,AVG(leads.sold_price) as soldPrice ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                        ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id IN (" . implode(',', $employee_array) . ")  $str_date GROUP BY leads.house_types_id")->result_array();   
                    }else{
                       $result = array(); 
                    }
                }else if($param2 == 'employee'){
                    $result= $this->db->query("SELECT leads.house_types_id,AVG(leads.sold_price) as soldPrice ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                        ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id $str_date GROUP BY leads.house_types_id")->result_array();
                }
                echo json_encode($result);
                exit;
         }
         if($param1 =='get_listing_per_type'){
                $str_date = '';
                $report_type='lead';
                $result = array();
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                }
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                $users_id  = $param3;
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $result= $this->db->query("SELECT leads.house_types_id,COUNT(leads.leads_id) as total_lead ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                        ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id IN (" . implode(',', $employee_array) . ")  $str_date GROUP BY leads.house_types_id")->result_array();   
                    }else{
                       $result = array(); 
                    }
                }else if($param2 == 'employee'){
                    $result= $this->db->query("SELECT leads.house_types_id,COUNT(leads.leads_id) as total_lead ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                        ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id $str_date GROUP BY leads.house_types_id")->result_array();
                }
                echo json_encode($result);
                exit;
         }
         if($param1 == 'leads_by_house_situation'){
                $str_date = '';
                $result = array();
                $broker_list = '';
                $report_type='lead';
                
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                }
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                
                $users_id  = $param3;
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $raw_data= $this->db->query("SELECT leads.*, house_situation.name as house_situation,house_types.name as house_types FROM leads LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id IN (" . implode(',', $employee_array) . ")  $str_date ")->result_array();
                    }else{
                       $raw_data = array(); 
                    }
                }else if($param2 == 'employee'){
                    $raw_data= $this->db->query("SELECT leads.*, house_situation.name as house_situation,house_types.name as house_types FROM leads LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id  $str_date ")->result_array();
                }
                if(!empty($raw_data)){
                    $house_types_arr = array();
                    foreach($raw_data as $data){
                         $house_types = $data['house_types'];
                         $house_types_arr[$house_types][]=$data;
                    }
                    $situation_array = array();
                    $types_array = array();
                    $situation_counter = 1;
                    $new_array = array();
                    foreach($house_types_arr as $ind=>$data){
                        $new_array = [];
                        foreach($data as $key=>$situ){
                            $situ['leads_count']  = 1;
                            if(in_array($situ['house_types_id'], $types_array) && in_array($situ['house_situation_id'], $situation_array)){
                                $situ['leads_count']  = $situ['leads_count']+ 1;
                            }
                            $new_array[$situ['house_types']][$situ['house_situation']] = $situ;
                            $situation_array[]=$situ['house_situation_id'];
                            $types_array[]=$situ['house_types_id'];
                            
                        }
                        $house_types_arr[$ind] = $new_array[$ind];
                    }
                    $result =  $house_types_arr;
                }
             echo json_encode($result);
             exit;
        }
        if($param1 == 'get_leads_region_wise'){
                $str_date = '';
                $report_type = 'lead';
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(sold_date) BETWEEN '$start' AND '$end'"; 
                }
                 if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                $users_id  = $param3;
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' AND parent_id IN (" . implode(',', $employee_array) . ") $str_date group by postal_code")->result_array();
                     
                    }else{
                       $result = array(); 
                    }
                    
                }else if($param2 == 'employee'){
                    $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' AND parent_id =$users_id  $str_date group by postal_code")->result_array();
                }
         
             echo json_encode($result);
             exit;
        }
         if($param1 == 'get_leads_month_wise'){
                $users_id  = $param3;
                $region ='';
                if(!empty($_POST['region'])){
                    $region = " AND leads.postal_code =".$_POST['region'];
                }
                $house_types = '';
                if(!empty($_POST['house_types'])){
                    $house_types = " AND leads.house_types_id ='".$_POST['house_types']."'";
                }
                $axis =1;
                if(!empty($_POST['axis'])){
                    if($_POST['axis'] =='Monthly'){
                        $axis = 1;
                    }else if($_POST['axis'] =='Yearly'){
                        $axis = 12;
                    }
                    
                   
                }
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $leads = $this->db->query("SELECT leads.*,house_types.name as house_types ,house_situation.name as house_situation  from leads LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id  where leads.lead_type='sold' AND leads.parent_id IN (" . implode(',', $employee_array) . ") $region $house_types ")->result_array();
                    }else{
                       $leads = array(); 
                    }
                    
                }else if($param2 == 'employee'){
                $leads = $this->db->query("SELECT leads.*,house_types.name as house_types ,house_situation.name as house_situation  from leads LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id  where leads.lead_type='sold' AND leads.parent_id =$users_id $region $house_types ")->result_array();
                }
            $region_array =array();
            $postal_code_array = array();
            $city_array =array();
            foreach($leads as $data){
                $date1      = $data['first_contact'];
                $date2      = $data['sold_date'];
                $d1=new DateTime($date2); 
                $d2=new DateTime($date1);    
                //$date = $d1->modify('-1 day')->format('Y-m-d H:i:s');
                $Months = $d2->diff($d1); 
                $ManyMonths = (($Months->y) * 12) + ($Months->m);
                if(!empty($house_types)){
                     $region_array[$data['house_situation']][] = $ManyMonths;
                }else if(!empty($region)){
                    $region_array[$data['house_types']][] = $ManyMonths;
                }else{
                    $region_array[$data['postal_code']][] = $ManyMonths;
                    $city_array[$data['postal_code']]     = $data['city'];
                }
               
            }
            
            $duration_array = array();
            foreach($region_array as $key=>$data){
                $duration_array[] = (array_sum($data) / count($data))/$axis;
                if(!empty($house_types)){
                    $postal_code_array[] = $key;
                }else if(!empty($region)){
                    $postal_code_array[] = $key;
                }else{
                 $postal_code_array[] = $key.' '.$city_array[$key];   
                }
                
            }
            
            $result['duration'] = $duration_array;
            $result['region'] = $postal_code_array;    
            echo json_encode($result);
            exit;
        }
        if($param1=='listing_off'){
                $postal_code ='';
                if(!empty($_POST['region'])){
                    $postal_code = " AND leads.postal_code =".$_POST['region'];
                }
                $house_types = '';
                if(!empty($_POST['house_types'])){
                    $house_types = " AND leads.house_types_id ='".$_POST['house_types']."'";
                }
                $axis =1;
                if(!empty($_POST['axis'])){
                    if($_POST['axis'] =='Monthly'){
                        $axis = 1;
                    }else if($_POST['axis'] =='Yearly'){
                        $axis = 12;
                    }
                    
                   
                }
                $result = array();
                
                $users_id  = $param3;
                $leads_array=array();
                $xValues = array();
                $counter= 1;
                if($param2 == 'broker'){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    $emp_list = "";
                    if(!empty($employee_list)){
                        $emp_list = "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                    }
                    $leads_data = $this->db->query("SELECT *  FROM  leads  where  1=1 $emp_list $postal_code $house_types")->result_array();   
                   // echo $this->db->last_query();
                    foreach($leads_data as $key=>$lead){
                        //sold - estimate/estimate *100
                        $minus = $lead['sold_price']-$lead['estimate_price'];
                        $estimate_value = $minus/$lead['estimate_price'] *100 ;
                        array_push($leads_array,round($estimate_value,3));
                        array_push($xValues,$counter);
                        $counter++;
                    }
                }else if($param2 == 'employee'){
                     $leads_data = $this->db->query("SELECT *  FROM  leads  where  1=1 AND leads.parent_id =$users_id $postal_code $house_types")->result_array();   
                     foreach($leads_data as $key=>$lead){
                        //sold - estimate/estimate *100
                        $minus = $lead['sold_price']-$lead['estimate_price'];
                        $estimate_value = $minus/$lead['estimate_price'] *100 ;
                        array_push($leads_array,round($estimate_value,3));
                        array_push($xValues,$counter);
                        $counter++;
                    }
                    
                }
                $data['Y'] = $leads_array;
                $data['X'] = $xValues;
                echo json_encode($data);
                exit;
        }
        if($param1=='save_export'){
            $users_id  = $this->session->userdata('users_id');
            $save['users_system_id'] = $users_id;
            $result = $this->db->insert('export_report',$save);
            echo $result;
            exit;
        }
        
        //number_of_time_data_exported
            $role      = $this->session->userdata('user_roles_id');
            $data['role'] = $role;
            $users_id  = $this->session->userdata('users_id');
            if($role == '2'){
                 $user_data = $this->db->query("select * from users_system where users_system_id=$users_id")->row();
                 $data['past_data_shown_allowed']      =  $user_data->past_data_shown_allowed;
                 $data['number_of_time_data_exported'] =  $user_data->number_of_time_data_exported;
                 
                 $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id ")->result_array();
                 $employee_array=array();
                 foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                 }
                 array_push($employee_array,$users_id);
                 $data['total_exports'] = $this->db->query("select count(export_report_id) as total_exports from export_report where users_system_id IN (" . implode(',', $employee_array) . ") AND DATE(created_at) between date_sub(now(),INTERVAL 1 WEEK) and now()")->row()->total_exports;
                
            }else if($role == '3'){
                $broker_id = $this->db->query("select parent_id from users_system where users_system_id =$users_id")->row()->parent_id;
                if($broker_id){
                    $user_data = $this->db->query("select * from users_system where users_system_id=$broker_id")->row();
                    $data['past_data_shown_allowed']      =  $user_data->past_data_shown_allowed;
                    $data['number_of_time_data_exported'] =  $user_data->number_of_time_data_exported;
                   
                     $employee_list  = $this->db->query("select * from users_system where parent_id =$broker_id ")->result_array();
                     $employee_array=array();
                     foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                     }
                     array_push($employee_array,$users_id);
                     $data['total_exports'] = $this->db->query("select count(export_report_id) as total_exports from export_report where users_system_id IN (" . implode(',', $employee_array) . ") AND DATE(created_at) between date_sub(now(),INTERVAL 1 WEEK) and now()")->row()->total_exports;
                      
                }      
            }       
           
         
            
             
        
        $data['broker_data']     = $this->db->get_where('users_system',array('users_system_id'=>$param2))->row();
        $data['house_types']     = $this->db->get_where('house_types',array('status'=>'Active'))->result_array();
        $data['region_list']     = $this->db->query("SELECT * FROM leads group by postal_code")->result_array();
        $data['param1']          = $param1;
        $data['param2']          = $param2;
        $data['main_page_name']  = '';
        $data['main_page_link']  = '';
        $data['page_title']      = 'Report';
        $data['page_sub_title']  = '';
        $data['page_name']       = 'export_report';
        $data["htmlPage"]        = "export_report";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    public function dashboard_stats($param1='',$param2=''){
        /* start luck */
        if($param1 =='get_listing_per_type'){
            $role      = $this->session->userdata('user_roles_id');
            $users_id  = $this->session->userdata('users_id');
            $str_date = '';
            $report_type='lead';
            $result = array();
            if(!empty($_POST['start']) && !empty($_POST['end'])){
                $start     = date("Y-m-d", strtotime($_POST['start']));
                $end       = date("Y-m-d", strtotime($_POST['end']));
                $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
            }
            
            if(!empty($_POST['report_type'])){
                $report_type = $_POST['report_type'];
            }
            
            if($role == 1){
                $broker_list ='';
                if(!empty($_POST['broker_id'])){
                    $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                    $emp_array=array();
                    foreach($empl_list as $emp){
                        array_push($emp_array,$emp['users_system_id']);
                    }
                    array_push($emp_array,$_POST['broker_id']);
                    if(!empty($emp_array)){
                        $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                    }
                }
                $result= $this->db->query("SELECT leads.house_types_id,COUNT(leads.leads_id) as total_lead ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                    ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' $broker_list $str_date GROUP BY leads.house_types_id")->result_array();
                
            }else if($role == 2){
                $broker_list = '';
                if(!empty($_POST['broker_id'])){
                    $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                }else{
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                    }
                }
                
               
                $result= $this->db->query("SELECT leads.house_types_id,COUNT(leads.leads_id) as total_lead ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' $broker_list $str_date GROUP BY leads.house_types_id")->result_array();   
             
                
            }else if($role == 3){
                $result= $this->db->query("SELECT leads.house_types_id,COUNT(leads.leads_id) as total_lead ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                    ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id $str_date GROUP BY leads.house_types_id")->result_array();
            }
            echo json_encode($result);
            exit;
        }
        if($param1 =='get_avg_selling_price'){
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                $str_date = '';
                $report_type='lead';
                $result = array();
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                }
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                
                if($role == 1){
                    $broker_list ='';
                    if(!empty($_POST['broker_id'])){
                        $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                        $emp_array=array();
                        foreach($empl_list as $emp){
                            array_push($emp_array,$emp['users_system_id']);
                        }
                        array_push($emp_array,$_POST['broker_id']);
                        if(!empty($emp_array)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                        }
                    }
                    $result= $this->db->query("SELECT leads.house_types_id,AVG(leads.sold_price) as soldPrice ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                        ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' $broker_list $str_date GROUP BY leads.house_types_id")->result_array();
                }else if($role == 2){
                    $broker_list = '';
                    if(!empty($_POST['broker_id'])){
                        $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                    }else{
                        $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                        $employee_array=array();
                        foreach($employee_list as $emp){
                            array_push($employee_array,$emp['users_system_id']);
                        }
                        array_push($employee_array,$users_id);
                        if(!empty($employee_list)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                        }
                    }
                    $result= $this->db->query("SELECT leads.house_types_id,AVG(leads.sold_price) as soldPrice ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                        ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' $broker_list  $str_date GROUP BY leads.house_types_id")->result_array();   
                   
                }else if($role == 3){
                    $result= $this->db->query("SELECT leads.house_types_id,AVG(leads.sold_price) as soldPrice ,house_types.name as house_types FROM  leads LEFT JOIN house_types 
                        ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id $str_date GROUP BY leads.house_types_id")->result_array();
                }
                echo json_encode($result);
                exit;
            }
            if($param1 =='get_avg_selling_price_per_region'){
                    $role      = $this->session->userdata('user_roles_id');
                    $users_id  = $this->session->userdata('users_id');
                    $str_date = '';
                    $report_type='lead';
                    $result = array();
                    if(!empty($_POST['start']) && !empty($_POST['end'])){
                        $start     = date("Y-m-d", strtotime($_POST['start']));
                        $end       = date("Y-m-d", strtotime($_POST['end']));
                        $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                    }
                    if(!empty($_POST['report_type'])){
                        $report_type = $_POST['report_type'];
                    }
                    if($role == 1){
                        $broker_list ='';
                        if(!empty($_POST['broker_id'])){
                            $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                            $emp_array=array();
                            foreach($empl_list as $emp){
                                array_push($emp_array,$emp['users_system_id']);
                            }
                            array_push($emp_array,$_POST['broker_id']);
                            if(!empty($emp_array)){
                                $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                            }
                        }
                        $result= $this->db->query("SELECT leads.postal_code as postal_code,leads.city as city,AVG(leads.sold_price) as soldPrice FROM  leads where  1=1 AND leads.lead_type='$report_type' $broker_list $str_date GROUP BY leads.postal_code")->result_array();
                    }else if($role == 2){
                        $broker_list = '';
                        if(!empty($_POST['broker_id'])){
                            $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                        }else{
                            $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                            $employee_array=array();
                            foreach($employee_list as $emp){
                                array_push($employee_array,$emp['users_system_id']);
                            }
                            array_push($employee_array,$users_id);
                            if(!empty($employee_list)){
                                $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                            }
                        }
                        $result= $this->db->query("SELECT leads.postal_code as postal_code,leads.city as city,AVG(leads.sold_price) as soldPrice  FROM  leads  where  1=1 AND leads.lead_type='$report_type' $broker_list $str_date GROUP BY leads.postal_code")->result_array();   
                    }else if($role == 3){
                        $result= $this->db->query("SELECT leads.postal_code as postal_code,leads.city as city,AVG(leads.sold_price) as soldPrice FROM  leads where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id $str_date GROUP BY leads.postal_code")->result_array();
                    }
                    echo json_encode($result);
                    exit;
                }
        if($param1=='listing_off'){
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                $postal_code ='';
                if(!empty($_POST['region'])){
                    $postal_code = " AND leads.postal_code =".$_POST['region'];
                }
                $house_types = '';
                if(!empty($_POST['house_types'])){
                    $house_types = " AND leads.house_types_id ='".$_POST['house_types']."'";
                }
                $axis =1;
                if(!empty($_POST['axis'])){
                    if($_POST['axis'] =='Monthly'){
                        $axis = 1;
                    }else if($_POST['axis'] =='Yearly'){
                        $axis = 12;
                    }
                    
                    
                }
                $result = array();
                
               // $users_id  = $param3;
                $leads_array=array();
                $xValues = array();
                $counter= 1;
                if($role == 1){
                    $leads_data = $this->db->query("SELECT *  FROM  leads  where  1=1 $postal_code $house_types")->result_array(); 
                  
                    foreach($leads_data as $key=>$lead){
                        //sold - estimate/estimate *100
                        $minus = $lead['sold_price']-$lead['estimate_price'];
                        $estimate_value = $minus/$lead['estimate_price'] *100 ;
                        array_push($leads_array,round($estimate_value,3));
                        array_push($xValues,$counter);
                        $counter++;
                    }
                }else if($role == 2){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    $emp_list = "";
                    if(!empty($employee_list)){
                        $emp_list = "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                    }
                    $leads_data = $this->db->query("SELECT *  FROM  leads  where  1=1 $emp_list $postal_code $house_types")->result_array();   
                    foreach($leads_data as $key=>$lead){
                        //sold - estimate/estimate *100
                        $minus = $lead['sold_price']-$lead['estimate_price'];
                        $estimate_value = $minus/$lead['estimate_price'] *100 ;
                        array_push($leads_array,round($estimate_value,3));
                        array_push($xValues,$counter);
                        $counter++;
                    }
                }else if($role == 3){
                        $leads_data = $this->db->query("SELECT *  FROM  leads  where  1=1 AND leads.parent_id =$users_id $postal_code $house_types")->result_array();   
                        foreach($leads_data as $key=>$lead){
                            //sold - estimate/estimate *100
                            $minus = $lead['sold_price']-$lead['estimate_price'];
                            $estimate_value = $minus/$lead['estimate_price'] *100 ;
                            array_push($leads_array,round($estimate_value,3));
                            array_push($xValues,$counter);
                            $counter++;
                        }
                    
                }
                $data['Y'] = $leads_array;
                $data['X'] = $xValues;
                echo json_encode($data);
                exit;
        }
        /* end luck */
        if($param1 =='get_employee_list'){
            $employee_list = $this->db->get_where('users_system',array('parent_id'=>$_POST['id']))->result_array();
            $div='<option disabled selected>Please select employee</option>';
            if(!empty($employee_list)){foreach($employee_list as $data){
	        $div.='<option value="'.$data['users_system_id'].'" >'.$data['first_name'].' '.$data['last_name'].'</option>';
            } } 
            echo $div;
            exit;
        }
        if($param1 == 'get_leads_date_wise'){
                $str_date = '';
                $broker_list = '';
                $report_type = 'lead';
            
                if(!empty($_POST['report_type'])){
                        $report_type = $_POST['report_type'];
                    }
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(sold_date) BETWEEN '$start' AND '$end'"; 
                }
                $role      = $this->session->userdata('user_roles_id');
               
                $users_id  = $this->session->userdata('users_id');
                if($role == 1){
                    $broker_list ='';
                    if(!empty($_POST['broker_id'])){
                        $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                        $emp_array=array();
                        foreach($empl_list as $emp){
                            array_push($emp_array,$emp['users_system_id']);
                        }
                        array_push($emp_array,$_POST['broker_id']);
                        if(!empty($emp_array)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                        }
                    }
                    $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' $broker_list $str_date group by sold_date")->result_array();
                   // echo  $this->db->last_query();
                    //exit;
                }else if($role == 2){
                    $broker_list = '';
                    if(!empty($_POST['broker_id'])){
                        $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                    }else{
                        $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                        $employee_array=array();
                        foreach($employee_list as $emp){
                            array_push($employee_array,$emp['users_system_id']);
                        }
                        array_push($employee_array,$users_id);
                        if(!empty($employee_list)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                        }
                    }
                    $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' $broker_list $str_date group by sold_date")->result_array();
                   
                    
                }else if($role == 3){
                    $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' AND parent_id =$users_id $str_date group by sold_date")->result_array();
                }
           /* }else{
                $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='customer'  group by type_changed_date")->result_array();
            }*/
            echo json_encode($result);
            exit;
        }
        if($param1 == 'get_leads_region_wise'){
                $str_date = '';
                $report_type='lead';
                
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(sold_date) BETWEEN '$start' AND '$end'"; 
                }
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                if($role == 1){
                    $broker_list ='';
                    if(!empty($_POST['broker_id'])){
                        $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                        $emp_array=array();
                        foreach($empl_list as $emp){
                            array_push($emp_array,$emp['users_system_id']);
                        }
                        array_push($emp_array,$_POST['broker_id']);
                        if(!empty($emp_array)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                        }
                    }

                    $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' $broker_list $str_date group by postal_code")->result_array();
                }else if($role == 2){
                    $broker_list = '';
                    if(!empty($_POST['broker_id'])){
                        $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                    }else{
                        $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                        $employee_array=array();
                        foreach($employee_list as $emp){
                            array_push($employee_array,$emp['users_system_id']);
                        }
                        array_push($employee_array,$users_id);
                        if(!empty($employee_list)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                        }
                    }
                        $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' AND parent_id IN (" . implode(',', $employee_array) . ") $str_date group by postal_code")->result_array();
                    
                    
                }else if($role == 3){
                    $result = $this->db->query("SELECT * , count(leads_id) as total_leads FROM leads where lead_type='$report_type' AND parent_id =$users_id $str_date group by postal_code")->result_array();
                }
         
             echo json_encode($result);
             exit;
        }
        if($param1=='avg_listing_by_region'){
                $str_date = '';
               
                $report_type = '';
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(sold_date) BETWEEN '$start' AND '$end'"; 
                }
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                if($role == 1){
                    $broker_list ='';
                    if(!empty($_POST['broker_id'])){
                        $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                        $emp_array=array();
                        foreach($empl_list as $emp){
                            array_push($emp_array,$emp['users_system_id']);
                        }
                        array_push($emp_array,$_POST['broker_id']);
                        if(!empty($emp_array)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                        }
                    }

                    $result = $this->db->query("SELECT * , avg(listing_price) as listing_price FROM leads where lead_type='$report_type' $broker_list $str_date group by postal_code")->result_array();
                }else if($role == 2){
                    $broker_list = '';
                    if(!empty($_POST['broker_id'])){
                        $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                    }else{
                        $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                        $employee_array=array();
                        foreach($employee_list as $emp){
                            array_push($employee_array,$emp['users_system_id']);
                        }
                        array_push($employee_array,$users_id);
                        if(!empty($employee_list)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                        }
                    }
                    $result = $this->db->query("SELECT * , avg(listing_price) as listing_price FROM leads where lead_type='$report_type' $broker_list $str_date group by postal_code")->result_array();
                    
                    
                }else if($role == 3){
                    $result = $this->db->query("SELECT * , avg(listing_price) as listing_price FROM leads where lead_type='$report_type' AND parent_id =$users_id $str_date group by postal_code")->result_array();
                }
         
             echo json_encode($result);
             exit;
        }
        if($param1 == 'leads_by_house_situation'){
                $str_date = '';
                $result = array();
                $broker_list = '';
                $report_type='lead';
                
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(leads.sold_date) BETWEEN '$start' AND '$end'"; 
                }
                if(!empty($_POST['report_type'])){
                    $report_type = $_POST['report_type'];
                }
                
                //$users_id  = $param3;
                if($role == 1){
                    $broker_list ='';
                    if(!empty($_POST['broker_id'])){
                        $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                        $emp_array=array();
                        foreach($empl_list as $emp){
                            array_push($emp_array,$emp['users_system_id']);
                        }
                        array_push($emp_array,$_POST['broker_id']);
                        if(!empty($emp_array)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                        }
                    }

                    $raw_data= $this->db->query("SELECT leads.*, house_situation.name as house_situation,house_types.name as house_types FROM leads LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id where  1=1 AND  leads.lead_type='sold' $broker_list $str_date ")->result_array();
                   
                }else if($role == 2){
                    
                    $broker_list = '';
                    if(!empty($_POST['broker_id'])){
                        $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                    }else{
                        $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                        $employee_array=array();
                        foreach($employee_list as $emp){
                            array_push($employee_array,$emp['users_system_id']);
                        }
                        array_push($employee_array,$users_id);
                        if(!empty($employee_list)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                        }
                    }
                   
                        $raw_data= $this->db->query("SELECT leads.*, house_situation.name as house_situation,house_types.name as house_types FROM leads LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' $broker_list  $str_date ")->result_array();
                   
                }else if($role == 3){
                    $raw_data= $this->db->query("SELECT leads.*, house_situation.name as house_situation,house_types.name as house_types FROM leads LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id where  1=1 AND leads.lead_type='$report_type' AND leads.parent_id =$users_id  $str_date ")->result_array();
                }
                if(!empty($raw_data)){
                    $house_types_arr = array();
                    foreach($raw_data as $data){
                         $house_types = $data['house_types'];
                         $house_types_arr[$house_types][]=$data;
                    }
                    $situation_array = array();
                    $types_array = array();
                    $situation_counter = 1;
                    $new_array = array();
                    foreach($house_types_arr as $ind=>$data){
                        $new_array = [];
                        foreach($data as $key=>$situ){
                            $situ['leads_count']  = 1;
                            if(in_array($situ['house_types_id'], $types_array) && in_array($situ['house_situation_id'], $situation_array)){
                                $situ['leads_count']  = $situ['leads_count']+ 1;
                            }
                            $new_array[$situ['house_types']][$situ['house_situation']] = $situ;
                            $situation_array[]=$situ['house_situation_id'];
                            $types_array[]=$situ['house_types_id'];
                            
                        }
                        $house_types_arr[$ind] = $new_array[$ind];
                    }
                    $result =  $house_types_arr;
                }
             echo json_encode($result);
             exit;
        }
       
        if($param1 == 'get_leads_detail'){
                $postal_code =  $this->input->post('postal_code');
                $leads= $this->db->query("select * from leads where lead_type='sold' AND postal_code=".$postal_code)->result_array();
                $div='';
                $count=0;
                foreach($leads as $lead){ $count++;
                    $ep_lp = $lead['estimate_price'] - $lead['listing_price'];
                    $lp_sp = $lead['listing_price']- $lead['sold_price'];
                   	$date1 = new DateTime($lead['customer_date']);
                    $date2 = new DateTime();
                    
                    $interval = $date1->diff($date2);
                    $duration='';
                    $class='';
			        if($interval->y != 0 ){
			             $duration =  $interval->y . " year(s) ago";
			        }else if($interval->m !=0){
			            $duration = $interval->m." month(s) ago";
			            if($interval->m>=1 && $interval->m<=2){
			               $class = 'text-info'; 
			            }else if($interval->m>2 && $interval->m<=4){
			                $class="text-warning";
			            }else if($interval->m>=5){
			                $class="text-danger";
			            }
			        }else if($interval->d !=0){
			            $duration =$interval->d." day(s) ago";
			        }
			        $div.='<tr>';
			        $div.='<td>'.$count.'</td>';
                    $div.='<td>'.$lead['city'].'</td>';
                    $div.='<td><a href="'.base_url().'admin/view_lead/'.$lead['leads_id'].'/'.$lead['parent_id'].'">'.$lead['first_name'].'</a></td>';
                    $div.='<td>'.$ep_lp.'</td>';
                    $div.='<td>'.$lp_sp.'</td>';
                    if($duration ==''){
                         $div.='<td><b class="'.$class.'">0 days ago</b></td>';  
                    }else{
                         $div.='<td><b class="'.$class.'">'.$duration.'</b></td>';  
                    }
                    $div.='</tr>';
                }
                echo $div;
                exit;
        }
        if($param1=='get_data_by_employee'){
            $id =  $this->input->post('id');
            $distinct_regions = $this->db->query("select *,count(*) as total_leads from leads where lead_type='sold' AND parent_id=".$id." group by postal_code")->result_array();
            //echo $this->db->last_query();
            //exit;
            $div = '';
            if(!empty($distinct_regions)){foreach($distinct_regions as $key=>$data){
                $div.='<div class="card">';
                $div.='    <div class="card-header" id="headingOne_'.$key.'" style="padding:0px">';
                $div.='        <h5 class="mb-0 mt-0 font-16">';
                $div.='         <a data-toggle="collapse" data-parent="#accordion"
                               href="#collapseOne_'.$key.'" aria-expanded="false"
                               aria-controls="collapseOne" class="text-dark" onclick="get_customer_data('.$data['postal_code'].','.$key.')" style="display: block;padding: 0.75rem 1.25rem;">
                                '.$data['city'].' ('.$data['postal_code'].') - <b>'.$data['total_leads'].' Leads</b></a>';
                $div.='        </h5>';
                $div.='    </div>';
                $div.='<div id="collapseOne_'.$key.'" class="collapse "
                    aria-labelledby="headingOne_<?php echo $key; ?>" data-parent="#accordion">';
                $div.='        <div class="card-body">';
                $div.='            <div class="row">';
                $div.='                <div class="table-responsive">';
                $div.='                    <table class="table table-hover mb-0">';
                $div.='                     <thead>';
                $div.='                     <tr>';
                $div.='                         <th>#</th>';
                $div.='                         <th>City</th>';
                $div.='                         <th>Name</th>';
                $div.='                         <th>Est.P - Sell.P</th>';
                $div.='                         <th>List.P - Sell.P</th>';
                $div.='                         <th>Duration (lead to customer)</th>';
                $div.='                       </tr>';
                $div.='                       </thead>';
                $div.='                       <tbody id="tbl_bd_'.$key.'">';
                $div.='                        </tbody>';
                $div.='                    </table>';
                $div.='                </div>';
                $div.='             </div>';
                $div.='        </div>';
                $div.='    </div>';
                $div.='</div>';
                 }} 
                if(empty($div)){
                    $div.='<div class="col-md-12 text-center" style="padding: 3em 0em;"><b>No data found!</b></div>';
                }
                
                echo $div;
                exit;
        }
        
        if($param1 == 'get_listing_region_wise'){
                $str_date = '';
                $broker_list = '';
                
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(sold_date) BETWEEN '$start' AND '$end'"; 
                }
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                if($role == 1){
                    $broker_list ='';
                    if(!empty($_POST['broker_id'])){
                        $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                        $emp_array=array();
                        foreach($empl_list as $emp){
                            array_push($emp_array,$emp['users_system_id']);
                        }
                        array_push($emp_array,$_POST['broker_id']);
                        if(!empty($emp_array)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                        }
                    }
                    $estimate_data = $this->db->query("select * from leads where lead_type='sold' $broker_list $str_date")->result_array();
                }else if($role == 2){
                    $broker_list = '';
                    if(!empty($_POST['broker_id'])){
                        $broker_list = "AND leads.parent_id = ".$_POST['broker_id'];
                    }else{
                        $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                        $employee_array=array();
                        foreach($employee_list as $emp){
                            array_push($employee_array,$emp['users_system_id']);
                        }
                        array_push($employee_array,$users_id);
                        if(!empty($employee_list)){
                            $broker_list =  "AND leads.parent_id IN (" . implode(',', $employee_array) . ")";
                        }
                    }
                    $estimate_data = $this->db->query("select * from leads where lead_type='sold' $broker_list $str_date")->result_array();
                    
                }else if($role == 3){
                    $estimate_data = $this->db->query("select * from leads where lead_type='sold' AND parent_id=$users_id $str_date")->result_array();    
                }
                $estimate_array = array();
                $city_array = array();
                $postal_code_array = array();
                foreach($estimate_data as $data){
                    if($data['listing_price'] == $data['sold_price']){
                        $estimate_array[$data['postal_code']]['balance'][] = 1;
                    }
                    if($data['listing_price'] < $data['sold_price']){
                        $estimate_array[$data['postal_code']]['negative'][] = 1;
                    }
                    if($data['listing_price'] > $data['sold_price']){
                        $estimate_array[$data['postal_code']]['positive'][] = 1;
                    }
                   // $city_array[$data['postal_code']]     = $data['city'];
                }
                
                foreach($estimate_array as $key=>$data){
                    $estimate_array[$key]['positive']  =  0;
                    $estimate_array[$key]['negative']  =  0;
                    $estimate_array[$key]['balance']  =  0;
                    if(!empty($data['positive'])){
                        $estimate_array[$key]['positive']  = array_sum($data['positive']);
                    }
                    if(!empty($data['negative'])){
                        $estimate_array[$key]['negative']  = array_sum($data['negative']);
                    }
                    if(!empty($data['balance'])){
                        $estimate_array[$key]['balance']  = array_sum($data['balance']);
                    }
                    //.' '.$city_array[$key]
                    $postal_code_array[] = $key; 
                }
               
                $result['est'] = $estimate_array;
                $result['postal_code'] = $postal_code_array;
                echo json_encode($result);
                exit;
        }
        
        if($param1 == 'get_estimate_region_wise'){
                $str_date = '';
                $broker_list = '';
                if(!empty($_POST['broker_id'])){
                    $empl_list  = $this->db->get_where('users_system',array('parent_id'=>$_POST['broker_id']))->result_array();
                    $emp_array=array();
                    foreach($empl_list as $emp){
                        array_push($emp_array,$emp['users_system_id']);
                    }
                    array_push($emp_array,$_POST['broker_id']);
                    if(!empty($emp_array)){
                        $broker_list =  "AND leads.parent_id IN (" . implode(',', $emp_array) . ")";
                    }
                }
                if(!empty($_POST['start']) && !empty($_POST['end'])){
                    $start     = date("Y-m-d", strtotime($_POST['start']));
                    $end       = date("Y-m-d", strtotime($_POST['end']));
                    $str_date =  "AND DATE(sold_date) BETWEEN '$start' AND '$end'"; 
                }
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                if($role == 1){
                    $estimate_data = $this->db->query("select * from leads where lead_type='sold' $broker_list $str_date")->result_array();
                }else if($role == 2){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_array)){
                        $estimate_data = $this->db->query("select * from leads where lead_type='sold' AND parent_id IN (" . implode(',', $employee_array) . ") $str_date")->result_array();
                    }else{
                        $estimate_data = array();
                    }
                }else if($role == 3){
                    $estimate_data = $this->db->query("select * from leads where lead_type='sold' AND parent_id=$users_id $str_date")->result_array();    
                }
                $estimate_array = array();
                $city_array = array();
                $postal_code_array = array();
                foreach($estimate_data as $data){
                    if($data['estimate_price'] == $data['sold_price']){
                        $estimate_array[$data['postal_code']]['balance'][] = 1;
                    }
                    if($data['estimate_price'] < $data['sold_price']){
                        $estimate_array[$data['postal_code']]['negative'][] = 1;
                    }
                    if($data['estimate_price'] > $data['sold_price']){
                        $estimate_array[$data['postal_code']]['positive'][] = 1;
                    }
                   // $city_array[$data['postal_code']]     = $data['city'];
                }
                
                foreach($estimate_array as $key=>$data){
                    $estimate_array[$key]['positive']  =  0;
                    $estimate_array[$key]['negative']  =  0;
                    $estimate_array[$key]['balance']  =  0;
                    if(!empty($data['positive'])){
                        $estimate_array[$key]['positive']  = array_sum($data['positive']);
                    }
                    if(!empty($data['negative'])){
                        $estimate_array[$key]['negative']  = array_sum($data['negative']);
                    }
                    if(!empty($data['balance'])){
                        $estimate_array[$key]['balance']  = array_sum($data['balance']);
                    }
                    //.' '.$city_array[$key]
                    $postal_code_array[] = $key; 
                }
               
                $result['est'] = $estimate_array;
                $result['postal_code'] = $postal_code_array;
                echo json_encode($result);
                exit;
        }
        if($param1 == 'get_leads_month_wise'){
                $role      = $this->session->userdata('user_roles_id');
                $users_id  = $this->session->userdata('users_id');
                $region ='';
                if(!empty($_POST['region'])){
                    $region = " AND leads.postal_code =".$_POST['region'];
                }
                $house_types = '';
                if(!empty($_POST['house_types'])){
                    $house_types = " AND leads.house_types_id ='".$_POST['house_types']."'";
                }
                $axis =1;
                if(!empty($_POST['axis'])){
                    if($_POST['axis'] =='Monthly'){
                        $axis = 1;
                    }else if($_POST['axis'] =='Yearly'){
                        $axis = 12;
                    }
                    
                   
                }
                if($role == 1){
                    $leads = $this->db->query("SELECT leads.*,house_types.name as house_types ,house_situation.name as house_situation  from leads LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id  where leads.lead_type='sold' $region $house_types ")->result_array();
                }else if($role == 2){
                    $employee_list  = $this->db->get_where('users_system',array('parent_id'=>$users_id))->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    if(!empty($employee_list)){
                        $leads = $this->db->query("SELECT leads.*,house_types.name as house_types ,house_situation.name as house_situation  from leads LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id  where leads.lead_type='sold' AND leads.parent_id IN (" . implode(',', $employee_array) . ") $region $house_types ")->result_array();
                    }else{
                       $leads = array(); 
                    }
                    
                }else if($role == 3){
                    $leads = $this->db->query("SELECT leads.*,house_types.name as house_types ,house_situation.name as house_situation  from leads LEFT JOIN house_types
ON leads.house_types_id = house_types.house_types_id LEFT JOIN house_situation
ON leads.house_situation_id = house_situation.house_situation_id  where leads.lead_type='sold' AND leads.parent_id=$users_id $region $house_types ")->result_array();
                }
            $region_array =array();
            $postal_code_array = array();
            $city_array =array();
            foreach($leads as $data){
                $date1      = $data['first_contact'];
                $date2      = $data['sold_date'];
                $d1=new DateTime($date2); 
                $d2=new DateTime($date1);    
                //$date = $d1->modify('-1 day')->format('Y-m-d H:i:s');
                $Months = $d2->diff($d1); 
                $ManyMonths = (($Months->y) * 12) + ($Months->m);
                if(!empty($house_types)){
                     $region_array[$data['house_situation']][] = $ManyMonths;
                }else if(!empty($region)){
                    $region_array[$data['house_types']][] = $ManyMonths;
                }else{
                    $region_array[$data['postal_code']][] = $ManyMonths;
                    $city_array[$data['postal_code']]     = $data['city'];
                }
               
            }
            
            $duration_array = array();
            foreach($region_array as $key=>$data){
                $duration_array[] = (array_sum($data) / count($data))/$axis;
                if(!empty($house_types)){
                    $postal_code_array[] = $key;
                }else if(!empty($region)){
                    $postal_code_array[] = $key;
                }else{
                 $postal_code_array[] = $key.' '.$city_array[$key];   
                }
                
            }
            
            $result['duration'] = $duration_array;
            $result['region'] = $postal_code_array;    
            echo json_encode($result);
            exit;
        }
    }
   
    /***** DASBOARD *********/

    /**** customer list *****/
    public function customer_list($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == "get_ajax") {
            $draw = $_POST['draw'];
            $row = $_POST['start'];
            $rowperpage = $_POST['length']; // Rows display per page
            $columnIndex = $_POST['order'][0]['column']; // Column index
            $columnName = $_POST['columns'][$columnIndex]['data']; // Column name
            if ($columnName == "name") {
                $columnName = "first_name";
            }
            $columnSortOrder = $_POST['order'][0]['dir']; // asc or desc
            $searchValue = $_POST['search']['value']; // Search value

            ## Search 
            $searchQuery = " ";
            if ($searchValue != '') {
                $searchQuery = " and (first_name like '%" . $searchValue . "%' or last_name like '%" . $searchValue . "%' or 
                    email like '%" . $searchValue . "%' or sp_points like '%" . $searchValue . "%' or 
                    mobile like'%" . $searchValue . "%' ) ";
            }
            $totalRecords = $this->db->count_all("users_system");
            $res = $this->db->query("select count(users_system_id) as c from brinkman_users_system where users_system_id != '-1' $searchQuery")->first_row();
            // echo $this->db->last_query();
            $totalRecordwithFilter = $res->c;
            $query = "select * from brinkman_users_system WHERE 1 " . $searchQuery . " order by " . $columnName . " " . $columnSortOrder . " limit " . $row . "," . $rowperpage;
            // echo $query;
            $users = $this->db->query($query)->result();
            $tabledata = [];
            foreach ($users as $user) {
                $data = [];
                $data["users_system_id"] = $user->users_system_id;
                $data["name"] = $user->first_name . " " . $user->last_name;
                $data["sp_points"] = $user->sp_points;
                $data["email"] = $user->email;
                $data["mobile"] = $user->mobile;
                $status = '<div class="toggle-btn1 ';
                if ($user->status == 'Active') {
                    $status .= 'active"';
                }
                $status .= ">";
                $status .= '<input type="checkbox"   class="cb-value" value="' . $user->users_system_id . '"';
                if ($user->status == 'Active') {
                    $status .= ' checked';
                }
                $status .= "/>";
                $status .= '<span class="round-btn"></span></div>';

                $data["status"] = $status;
                $action = "<a href='" . base_url() . "admin/edit_user/" . $user->users_system_id . "'>
                                            <i class='fa fa-pencil'></i>
                                        </a>";
                // $user['users_system_id']
                // $count;

                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->users_system_id ."')><i class='fa fa-trash-o'></i></a>";
                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->users_system_id ."')><i class='fa fa-trash-o'></i></a>";
                // $action .= "<a href='javascript:;' onclick=confirm_modal_action('". base_url().strtolower($this->session->userdata('directory')) . "/manage_users/delete/". $user->users_system_id ."')><i class='fa fa-trash-o'></i></a>";
                $d["user"] = ["users_system_id" => $user->users_system_id];
                $d["count"] = $user->users_system_id;
                $data["action"] = $this->load->view(strtolower($this->session->userdata('directory')) . '/manage_user_actions', $d, true);
                $tabledata[] = $data;
            }
            $response = array(
                "draw" => intval($draw),
                "iTotalRecords" => $totalRecords,
                "iTotalDisplayRecords" => $totalRecordwithFilter,
                "aaData" => $tabledata
            );

            echo json_encode($response);
            exit();
        }
        if ($param1 == 'get_logs') {
            $id = $_REQUEST['id'];
            $this->db->order_by("points_log_id", "DESC");
            $res = $this->db->get_where("points_log", ["user_id" => $id]);
            $data = [];
            if ($res) {
                $data["result"] = $res->result();
                $data["status"] = 1;
            } else {
                //   $data["result"] = $res->result();
                $data["status"] = 1;
            }
            echo json_encode($data);

            exit;
        }
        if ($param1 == 'delete') {
            $this->db->where('users_system_id', $param2);
            $this->db->delete('users_system');
            $this->session->set_flashdata('msg_success', ' Data Deleted Successfully');
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }
        if ($param1 == 'update_status') {
            $user_id = $this->input->post('user_id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('users_system_id', $user_id);
            $result = $this->db->update('brinkman_users_system', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        // $this->db->limit($limit, $start);
        // $this->db->limit(300);  
        // $data['customer_list'] = $this->db->get_where('users_system')->result_array();
        $data['page_title'] = 'Manage Users';
        $data['page_sub_title'] = 'manage_users';
        $data['page_name'] = 'manage_users';
        $data['actor'] = 'manage_users';
        $data['main_page_name'] = 'manage_users';
        $data["htmlPage"] = "manage_users";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function add_user($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'add') {
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/users/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $saveData['user_image'] = $file_name;
            }
            $saveData['first_name'] = $this->input->post('name');
            $saveData['email'] = $this->input->post('email');
            $saveData['mobile'] = $this->input->post('mobile');
            $saveData['password'] = $this->input->post('password');
            $saveData['city'] = $this->input->post('city');
            $saveData['address'] = $this->input->post('address');
            $sp_points = $this->input->post('sp_points');
            if (!empty($sp_points)) {
                $saveData['sp_points'] = $sp_points;
            }
            $saveData['users_roles_id'] = $this->input->post('roles');
            $saveData['status'] = 'Active';
            $result = $this->db->insert('brinkman_users_system', $saveData);
            if (!empty($saveData['sp_points'])) {
                $id = $this->db->insert_id();
                $saveData2 = ["user_id" => $id, "type" => "Increment", "description" => "Added from admin panel", "points" => $saveData['sp_points'], "current_points" => $saveData['sp_points']];
                $result2 = $this->db->insert('brinkman_points_log', $saveData2);
            }
            if ($result) {
                $this->session->set_flashdata('msg_success', ' User Added Successfully');
            }
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }

        $data['page_title'] = 'Add User';
        $data['page_sub_title'] = 'add_user';
        $data['page_name'] = 'add_user';
        $data['actor'] = 'add_user';
        $data['main_page_name'] = 'add_user';
        $data["htmlPage"] = "add_user";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    public function edit_user($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'edit') {
            if (!empty($_FILES['image']['name'])) {
                $file_name = time() . '_image.jpg';
                $path_to_file = 'uploads/users/' . $file_name;
                move_uploaded_file($_FILES['image']['tmp_name'], $path_to_file);
                $saveData['user_image'] = $file_name;
            }
            $muser = $this->db->get_where('brinkman_users_system', array('users_system_id' => $param2))->first_row();
            $saveData['first_name'] = $this->input->post('name');
            $saveData['email'] = $this->input->post('email');
            $saveData['mobile'] = $this->input->post('mobile');
            //            $saveData['password'] = $this->input->post('password');
            $saveData['city'] = $this->input->post('city');
            $saveData['address'] = $this->input->post('address');
            $saveData['users_roles_id'] = $this->input->post('roles');
            $saveData['status'] = 'Active';
            $sp_type = $this->input->post("sp_points_type");
            $sp_points = $this->input->post('sp_points');
            if (!empty($sp_points)) {
                if ($sp_type == "increase") {
                    $saveData['sp_points'] = $sp_points + $muser->sp_points;
                } else if ($sp_type == "decrease") {
                    $saveData['sp_points'] = $muser->sp_points - $sp_points;
                }
            }

            $this->db->where('users_system_id', $param2);
            $result = $this->db->update('brinkman_users_system', $saveData);
            if (!empty($sp_points)) {
                $id = $param2;
                $type = $sp_type == "increase" ? "Increment" : "Decrement";
                $points = $sp_points;
                $saveData2 = ["user_id" => $id, "type" => $type, "description" => "Added from admin panel", "points" => $points, "current_points" => $saveData['sp_points']];
                $result2 = $this->db->insert('brinkman_points_log', $saveData2);
            }
            if ($result) {
                $this->session->set_flashdata('msg_success', ' User Added Successfully');
            }
            redirect(base_url() . admin_ctrl() . '/customer_list', 'refresh');
        }
        $data['page_data'] = $this->db->get_where('brinkman_users_system', array('users_system_id' => $param1))->row();
        $data['page_title'] = 'Edit User';
        $data['page_sub_title'] = 'edit_user';
        $data['page_name'] = 'edit_user';
        $data['actor'] = 'edit_user';
        $data['main_page_name'] = 'edit_user';
        $data["htmlPage"] = "edit_user";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** customer list ****/

    /***** MY PROFILE *********/
    public function myprofile($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        // exit;
        /*	if($this->session->userdata('login') != 1){
                redirect(base_url().strtolower($this->session->userdata('directory')), 'refresh');
            } */

        if ($param1 == 'update') {
            $response = $this->Db_model->update_admin_profile();

            $this->session->set_flashdata('msg_success', ' Updated Successfully');
            redirect(base_url() . admin_ctrl() . '/myprofile', 'refresh');
        }

        $data['profile_data'] = $this->db->get_where('users_system', array('users_system_id' => $this->session->userdata('users_id')))->row();
        $data['main_page_name'] = '';
        $data['main_page_link'] = '';
        $data['page_title'] = 'Update Your Profile';
        $data['page_sub_title'] = 'Profile';
        $data['page_name'] = 'myprofile';
        $data["htmlPage"] = "myprofile";

        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /***** MY PROFILE *********/

    /***** SYSTEM SETTINGS *********/
    public function system_settings($param1 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }

        if ($param1 == 'update') {
            $response = $this->Db_model->update_system_settings();
            $this->session->set_flashdata('msg_success', ' Updated Successfully');
            redirect(base_url() . admin_ctrl() . '/system_settings', 'refresh');
        }

        $data['system_data'] = $this->db->get('system_settings')->result();
        $data['main_page_name'] = '';
        $data['main_page_link'] = '';
        $data['page_title'] = 'Update Your System Settings';
        $data['page_sub_title'] = 'System Settings';
        $data['page_name'] = 'system_settings';
        $data["htmlPage"] = "system_settings";
        
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    /***** SYSTEM SETTINGS *********/


    public function resetpassword($verification_code = '')
    {
        $decoded_code = base64_decode($verification_code);
        $code_array = explode("_", $decoded_code);
        $user_id = $code_array[0];
        $data['user_id'] = $user_id;
        $this->load->view('madmin/reset_password', $data);
    }

    public function reset_password($verification_code = '', $user_id = '')
    {
        if ($verification_code == 'update_password') {
            $new_password = $this->input->post('new_password');
            $confirm_password = $this->input->post('confirm_password');
            if ($new_password != $confirm_password) {
                $this->session->set_flashdata('msg_error', ' Your password did not match, try again.');
                redirect(base_url() . 'admin', 'refresh');
            } else if ($new_password == $confirm_password) {
                $this->db->query("UPDATE users_system SET password = '" . md5($new_password) . "', reset_password_code = ''  WHERE users_system_id = '" . $user_id . "'  ");
                $this->session->set_flashdata('msg_success', ' Password Updated Successfully.');
                redirect(base_url() . 'admin', 'refresh');
            }
        }
    }

    /***** Retrieve Password Page *********/
    public function logout()
    {
        /*  $s_update['status']  = 'Inactive';
          $this->db->where('user_accounts_id',$this->session->userdata('users_id'));
          $this->db->update('user_login',$s_update);*/
        $this->session->unset_userdata('login');
        $this->session->sess_destroy();
        $this->session->set_flashdata('msg_error', 'logout Successfully!.');
        redirect(base_url() . admin_ctrl(), 'refresh');
    }

    /* VERIFY ACCOUNT */
    /**** manage leads *****/
    public function manage_leads($param1 = '', $param2 = '',$param3 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }   
        
        
        if($param1=='add_to_customer'){
            $updateData['start_date'] = date('Y-m-d',strtotime($this->input->post('start_date')));
            $updateData['end_date']   = date('Y-m-d',strtotime($this->input->post('end_date')));
            $updateData['lead_type']  = 'customer';
            $updateData['type_changed_by']  = $this->input->post('parent_id');
            $updateData['type_changed_date']  = date('Y-m-d h:i:s');
            $updateData['customer_date']    = date('Y-m-d h:i:s');
            $this->db->where('leads_id', $param2);
            $result = $this->db->update('leads', $updateData);
            
            
            
            if($result){
                $leads_data = $this->db->get_where('leads', array('leads_id'=>$param2))->row();
                $email = $leads_data->email;
                $users_id = $this->session->userdata('users_id');
                $get_template   = $this->db->get_where('email_templates', array('type'=>'add_to_customer','users_system_id'=>$users_id))->row();
    			$sub = $get_template->subject;
    			$message = $get_template->body;
    			
    			$message = $this->Db_model->gen_string_body($leads_data->first_name,$email,$leads_data->listing_price,$message);
    		    $email_sent =  $this->Email_model->do_email($message, $sub, $email);
    		    if($email_sent){
    		        $this->Db_model->save_email($param2,$email,$sub,$message);
    		    }
                
		       $this->session->set_flashdata('msg_success', 'Customer Added Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() .admin_ctrl().'/manage_customer/', 'refresh');
           exit;
        }
        if($param1=='add_to_sold'){
//             		echo "=================".$param2."===========".$param1;
// // 			exit;
            $visitor_id = $this->input->post('visitor_id');
            if($visitor_id ==0){
                $data['first_name']       = $this->input->post('first_name');
    			$data['last_name'] 	      = $this->input->post('last_name');
    			$data['email'] 	          = $this->input->post('email');
    			$data['phone_number'] 	  = $this->input->post('phone_number');
    			$data['sold_amount']      = $this->input->post('sold_price');
    			$data['additional_notes'] = $this->input->post('additional_notes');
    			$data['address'] 	      = $this->input->post('address');
    			$data['parent_id']        = $this->input->post('parent_id');
    			$data['type']             = 'sold';
    			$data['leads_id']         = $param2;
    			$result = $this->db->insert('leads_visitors',$data);
            }else{
                /* visitor table */               
                $data['type']         = 'sold';
                $data['sold_amount']   = $this->input->post('sold_price');
                
                
                $this->db->where('visitor_id', $visitor_id);
                $result = $this->db->update('leads_visitors', $data);
                /* leads table */
               
            }
            $lead['lead_type']    = 'sold';
            $lead['sold_date']    = date('Y-m-d h:i:s');
            $lead['sold_price']   = $this->input->post('sold_price');
            $lead['end_date']     = date('Y-m-d');
            $this->db->where('leads_id', $param2);
            $result = $this->db->update('leads', $lead);
            
        	
			
			if($result){
			    
			    $leads_data = $this->db->get_where('leads', array('leads_id'=>$param2))->row();
                $email = $leads_data->email;
                $users_id = $this->session->userdata('users_id');
                $get_template   = $this->db->get_where('email_templates', array('type'=>'add_to_sold','users_system_id'=>$users_id))->row();
    			$sub = $get_template->subject;
    			$message = $get_template->body;
    			
    			$message = $this->Db_model->gen_string_body($leads_data->first_name,$email,$leads_data->listing_price,$message);
    		    $email_sent =  $this->Email_model->do_email($message, $sub, $email);
    		    
    		    if($email_sent){
    		        $this->Db_model->save_email($param2,$email,$sub,$message);
    		    }
			    
				$this->session->set_flashdata('msg_success', 'Sold Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() .admin_ctrl().'/manage_sold/', 'refresh');
        }
        if($param1=='excel_import'){
            $this->load->library('excel');
          if(isset($_FILES["file"]["name"]))
          {
           $path = $_FILES["file"]["tmp_name"];
      
           $object = PHPExcel_IOFactory::load($path);
           $data =array();
           foreach($object->getWorksheetIterator() as $worksheet)
           {
            $highestRow = $worksheet->getHighestRow();
            $highestColumn = $worksheet->getHighestColumn();
            for($row=2; $row<=$highestRow; $row++)
            {
            $first_name = $worksheet->getCellByColumnAndRow(0, $row)->getValue();    
            $last_name = $worksheet->getCellByColumnAndRow(1, $row)->getValue();    
            $email = $worksheet->getCellByColumnAndRow(2, $row)->getValue();    
            $phone_number = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
            $date_of_birth = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
            $postal_code = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
            $city = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
            $address = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
            $house_types = $worksheet->getCellByColumnAndRow(8, $row)->getValue();
            $house_situation = $worksheet->getCellByColumnAndRow(9, $row)->getValue();
            $estimate_price = $worksheet->getCellByColumnAndRow(10, $row)->getValue();
            $listing_price = $worksheet->getCellByColumnAndRow(11, $row)->getValue();
            $sold_price = $worksheet->getCellByColumnAndRow(12, $row)->getValue();
            $lead_type = $worksheet->getCellByColumnAndRow(13, $row)->getValue();
            $revenue = $worksheet->getCellByColumnAndRow(14, $row)->getValue();
            $first_contact = $worksheet->getCellByColumnAndRow(15, $row)->getValue();
            $last_contact = $worksheet->getCellByColumnAndRow(16, $row)->getValue();
            $start_date = $worksheet->getCellByColumnAndRow(17, $row)->getValue();
            $end_date = $worksheet->getCellByColumnAndRow(18, $row)->getValue();
            $type_changed_by = $worksheet->getCellByColumnAndRow(19, $row)->getValue();
            $created_at = $worksheet->getCellByColumnAndRow(20, $row)->getValue();
            $updated_at = $worksheet->getCellByColumnAndRow(21, $row)->getValue();
            $parent_id = $this->session->userdata('users_id');
            // $parent_id = $this->db->get_where('users_system',array('email'=>$parent_email))->row()->users_system_id;
            if(!empty($type_changed_by)){
                $type_changed_id = $this->db->get_where('users_system',array('email'=>$type_changed_by))->row()->users_system_id;
            }else{
                $type_changed_id = '';
            }
            if(!empty($house_types)){
                $house_types_id = $this->db->get_where('house_types',array('name'=>$house_types))->row()->house_types_id;
            }else{
                $house_types_id = 0;
            }
            if(!empty($house_situation)){
                $house_situation_id = $this->db->get_where('house_situation',array('name'=>$house_situation))->row()->house_situation_id;
            }else{
                $house_situation_id = 0;
            }
             $today = date('Y-m-d');    
             $data[] = array(
              'parent_id'  => $parent_id,
              'lead_type'   => $lead_type!=''?$lead_type:'lead',
              'first_name'    => $first_name==''?'':$first_name,
              'last_name'  => $last_name==''?'':$last_name,
              'email' =>$email==''?'':$email,
              'phone_number'   => $phone_number==''?'':$phone_number,
              'date_of_birth'   => $date_of_birth==''?'00-00-0000':$date_of_birth,
              'city'   => $city==''?'':$city,
              'address' =>$address==''?'':$address,
              'postal_code'   => $postal_code==''?'':$postal_code,
              'estimate_price'   => $estimate_price==''?0:$estimate_price,
              'listing_price'   => $listing_price==''?0:$listing_price,
              'sold_price'   => $sold_price==''?0:$sold_price,
              'revenue'   => $revenue==''?0:$revenue,
              'house_types'   => $house_types==''?0:$house_types_id,
              'house_situation'   => $house_situation==''?0:$house_situation_id,
              'first_contact'   => $first_contact==''?date('Y-m-d h:i:s'):$first_contact,
              'last_contact'   => $last_contact==''?'':$last_contact,
              'start_date'   => $start_date==''?$today:$start_date,
              'end_date'   =>  $end_date==''?$today:$end_date,
              'type_changed_by'   => $type_changed_id!=''?$type_changed_id:0,
              'created_at'   => $created_at!=''?$created_at:date('Y-m-d h:i:s'),
              'updated_at'   => $updated_at!=''?$updated_at:date('Y-m-d h:i:s'),
             );
            }
           }
           $result = $this->db->insert_batch('leads',$data);
           if($result){
		       $this->session->set_flashdata('msg_success', ' Excel Imported Successfully');
            }else{
		       $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
		    redirect(base_url() .admin_ctrl().'/manage_leads/'.$param2, 'refresh');
           exit;
         } 
    
        }
        
        if($param1 =='back_to_lead'){
            $updateData['type_changed_by']  = $this->session->userdata('users_id');
            $updateData['type_changed_date']  = date('Y-m-d h:i:s');
            $updateData['customer_date']    = NULL;
            $updateData['lead_type'] = 'lead'; 
            $this->db->where('leads_id', $param2);
            $result = $this->db->update('leads', $updateData);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Lead Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/manage_leads', 'refresh');
        }
        /*
        if($param1 =='back_to_customer'){
            $updateData['lead_type'] = 'customer'; 
            $updateData['sold_date']    = NULL;
            $updateData['sold_price']   = NULL;
            $updateData['end_date']     = NULL;
            
            $this->db->where('leads_id', $param2);
            $result = $this->db->update('leads', $updateData);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Lead Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/manage_customer', 'refresh');
        } */
        
        if ($param1 == 'update_status') {
            $id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('users_system_id', $id);
            $result = $this->db->update('users_system', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }


        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('leads', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
           //return redirect()->to($_SERVER['HTTP_REFERER']);
           //.$param3
            redirect(base_url() .admin_ctrl().'/manage_leads/', 'refresh');
        }
        
        //anas
        // if ($param1 == 'get_template'){
        //   $template = $this->db->get_where('users_system',array('parent_id'=>$_POST['id']))->result_array();
        //   echo $template;
        // }
        
        if($param1=='duration'){
           
             $users_id = $this->session->userdata('users_id');
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            if($this->session->userdata('user_roles_id') == 3){
                $this->db->where("leads.parent_id",$users_id);
            }else if($this->session->userdata('user_roles_id') == 2){
                $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id AND users_roles_id=3")->result_array();
                $employee_array=array();
                foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                }
                array_push($employee_array,$users_id);
                $this->db->where("leads.parent_id IN (" . implode(',', $employee_array) . ")");
            }
            $broker_name = '';
            $startDate =  date("Y-m-d",strtotime("-$param3 month"));
            $endDate   = date("Y-m-d",strtotime("-$param2 month"));
            $this->db->where("DATE(leads.first_contact) BETWEEN '" . $startDate. "' AND '" . $endDate. "' ");
            $this->db->where("leads.lead_type","lead");
            $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            
            $data['parent_name']= '';
            $data['param1'] =  $param1;
        }else if(!empty($param1)){
             
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            $this->db->where("leads.parent_id",$param1);
            $this->db->where("leads.lead_type","lead");
            $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            $parent_data =  $this->db->get_where('users_system',array('users_system_id'=>$param1))->row();
            $data['parent_name']=  $parent_data->user_name;
            $broker_name =  "| <code class='text-capitalize'>".$this->db->get_where('users_system',array('users_system_id'=>$parent_data->parent_id))->row()->user_name."</code>";
            $data['param1'] =  $param1;
        }else{
            
            $users_id = $this->session->userdata('users_id');
            
            
            
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            if($this->session->userdata('user_roles_id') == 3){
                $broker_id = $this->db->query("select parent_id from users_system where users_system_id =$users_id")->row()->parent_id;
                if($broker_id){
                    $data['maximum_number_leads_allowed'] = $this->db->query("select maximum_number_leads_allowed from users_system where users_system_id =$broker_id")->row()->maximum_number_leads_allowed;
                    $employee_list  = $this->db->query("select * from users_system where parent_id =$broker_id")->result_array();
                    $employee_array=array();
                    foreach($employee_list as $emp){
                        array_push($employee_array,$emp['users_system_id']);
                    }
                    array_push($employee_array,$users_id);
                    $data['total_leads'] =  $this->db->query("select * from leads where parent_id IN (" . implode(',', $employee_array) . ")")->num_rows();
                   
                }
                $this->db->where("leads.parent_id",$users_id);
            }else if($this->session->userdata('user_roles_id') == 2){
                
                $data['maximum_number_leads_allowed'] = $this->db->query("select maximum_number_leads_allowed from users_system where users_system_id =$users_id")->row()->maximum_number_leads_allowed;
              
                
                $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id AND users_roles_id=3")->result_array();
                $employee_array=array();
                foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                }
                array_push($employee_array,$users_id);
                $data['total_leads'] =  $this->db->query("select * from leads where parent_id IN (" . implode(',', $employee_array) . ")")->num_rows();
                
                $this->db->where("leads.parent_id IN (" . implode(',', $employee_array) . ")");
            }
            $this->db->where("leads.lead_type","lead");
            $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            
            $broker_name = '';
            $data['param1'] = $users_id;
            $data['parent_name']= '';
            
        }
       
        $data['page_title'] = "Manage Leads $broker_name";
        $data['page_sub_title'] = get_phrase('manage_leads');
        $data['page_name'] = 'manage_leads';
        $data['actor'] = 'manage_leads';
        $data['main_page_name'] = 'manage_leads';
        $data["htmlPage"] = "manage_leads";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
        
        
    }
     
    /* manage customer */
     public function manage_customer($param1 = '', $param2 = '',$param3 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }  
        
        if($param1=='duration'){
             $users_id = $this->session->userdata('users_id');
             $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            if($this->session->userdata('user_roles_id') == 3){
                $this->db->where("leads.parent_id",$users_id);
            }else if($this->session->userdata('user_roles_id') == 2){
                $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id")->result_array();
                $employee_array=array();
                foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                }
                 array_push($employee_array,$users_id);
                $this->db->where("leads.parent_id IN (" . implode(',', $employee_array) . ")");
            }
            $broker_name = '';
            $startDate =  date("Y-m-d",strtotime("-$param3 month"));
            $endDate   = date("Y-m-d",strtotime("-$param2 month"));
            $this->db->where("DATE(leads.customer_date)  BETWEEN '" . $startDate. "' AND '" . $endDate. "' ");
            $this->db->where("leads.lead_type","customer");
             $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            $data['parent_name']= '';
            $data['param1'] =  $param1;
        }else if(!empty($param1)){
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            $this->db->where("leads.parent_id",$param1);
            $this->db->where("leads.lead_type","customer");
             $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get('leads')->result_array();
            $parent_data =  $this->db->get_where('users_system',array('users_system_id'=>$param1))->row();
            $data['parent_name']=  $parent_data->user_name;
            $broker_name =  "<code><'".$this->db->get_where('users_system',array('users_system_id'=>$parent_data->parent_id))->row()->user_name."'></code>";
            $data['param1'] =  $param1;
        }else{
            $users_id = $this->session->userdata('users_id');
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            if($this->session->userdata('user_roles_id') == 3){
                $this->db->where("leads.parent_id",$users_id);
            }else if($this->session->userdata('user_roles_id') == 2){
                $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id")->result_array();
                $employee_array=array();
                foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                }
                array_push($employee_array,$users_id);
                if(!empty($employee_array)){
                    $this->db->where("leads.parent_id IN (" . implode(',', $employee_array) . ")");
                }
                
            }
            $this->db->where("leads.lead_type","customer");
            $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            $broker_name = '';
            $data['param1'] = '';
            $data['parent_name']= '';
        }
        
        
        
        $data['param1'] =  $param1;
        $data['page_title'] = "Manage Customer $broker_name";
        $data['page_sub_title'] = get_phrase('manage_customer');
        $data['page_name'] = 'manage_customer';
        $data['actor'] = 'manage_customer';
        $data['main_page_name'] = 'manage_customer';
        $data["htmlPage"] = "manage_customer";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /* manage customer */
    /* manage sold */
     public function manage_sold($param1 = '', $param2 = '',$param3 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }  
        
        if($param1=='duration'){
            $users_id = $this->session->userdata('users_id');
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            if($this->session->userdata('user_roles_id') == 3){
                $this->db->where("leads.parent_id",$users_id);
            }else if($this->session->userdata('user_roles_id') == 2){
                $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id")->result_array();
                $employee_array=array();
                foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                }
                array_push($employee_array,$users_id);
                $this->db->where("leads.parent_id IN (" . implode(',', $employee_array) . ")");
            }
            $broker_name = '';
            $startDate =  date("Y-m-d",strtotime("-$param3 month"));
            $endDate   = date("Y-m-d",strtotime("-$param2 month"));
            $this->db->where("DATE(leads.sold_date)  BETWEEN '" . $startDate. "' AND '" . $endDate. "' ");
            $this->db->where("leads.lead_type","sold");
            $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            $data['parent_name']= '';
            $data['param1'] =  $param1;
        }else if(!empty($param1)){
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            $this->db->where("leads.parent_id",$param1);
            $this->db->where("leads.lead_type","sold");
            $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            $parent_data =  $this->db->get_where('users_system',array('users_system_id'=>$param1))->row();
            $data['parent_name']=  $parent_data->user_name;
            $broker_name =  "<code><'".$this->db->get_where('users_system',array('users_system_id'=>$parent_data->parent_id))->row()->user_name."'></code>";
            $data['param1'] =  $param1;
        }else{
            $users_id = $this->session->userdata('users_id');
            $this->db->select('leads.*,users_system.user_name as added_by,users_system.users_roles_id as role');
            $this->db->from('leads');
            if($this->session->userdata('user_roles_id') == 3){
                $this->db->where("leads.parent_id",$users_id);
            }else if($this->session->userdata('user_roles_id') == 2){
                $employee_list  = $this->db->query("select * from users_system where parent_id =$users_id")->result_array();
                $employee_array=array();
                foreach($employee_list as $emp){
                    array_push($employee_array,$emp['users_system_id']);
                }
                array_push($employee_array,$users_id);
                if(!empty($employee_array)){   
                    $this->db->where("leads.parent_id IN (" . implode(',', $employee_array) . ")");
                }
            }
            $this->db->where("leads.lead_type","sold");
            $this->db->join('users_system', 'users_system.users_system_id = leads.parent_id', 'left');
            $data['leads_data'] = $this->db->get()->result_array();
            $broker_name = '';
            $data['param1'] = '';
            $data['parent_name']= '';
        }
        
        $data['param1'] =  $param1;
        $data['page_title'] = "Manage Sold $broker_name";
        $data['page_sub_title'] = get_phrase('manage_sold');
        $data['page_name'] = 'manage_sold';
        $data['actor'] = 'manage_sold';
        $data['main_page_name'] = 'manage_sold';
        $data["htmlPage"] = "manage_sold";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    /* manage sold */
     public function add_lead($param1 = '', $param2 = '')
    {
  	
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        if($param1 =='add'){
            
            $user_name  = $this->input->post('first_name').' '.$this->input->post('last_name');
		    $email = $this->input->post('email');
			$listing_price = $this->input->post('listing_price');
			$data['email'] 	        = $email;
            $data['first_name']     = $this->input->post('first_name');
			$data['last_name'] 	    = $this->input->post('last_name');
			$data['email'] 	        = $this->input->post('email');
			$data['phone_number'] 	= $this->input->post('phone_number');
			$data['postal_code'] 	= $this->input->post('postal_code');
			$data['city'] 	        = $this->input->post('city');
			$data['address'] 	    = $this->input->post('address');
			$data['estimate_price'] = $this->input->post('estimate_price');
			$data['listing_price'] 	= $listing_price;
		//	$data['sold_price'] 	= $this->input->post('sold_price');
			$data['lead_type'] 	    = 'lead';
			$data['house_types_id'] 	= $this->input->post('house_types');
			$data['house_situation_id']= $this->input->post('house_situation');
			$data['first_contact']  = date('Y-m-d h:i:s');
			$data['start_date']     = date('Y-m-d h:i:s');
			$data['date_of_birth']  = date("Y-m-d", strtotime($this->input->post('dob')));
			$data['parent_id'] 	    = $this->input->post('parent_id');
           
			$result = $this->db->insert('leads',$data);
			$leads_id = $this->db->insert_id();
			
			if($leads_id){
			    if(isset($_POST['send_email'])){
			        $sub = $this->input->post('subject');
        			$message = $this->input->post('body');
        			$message = $this->Db_model->gen_string_body($user_name,$email,$listing_price,$message);
        		    $email_sent =  $this->Email_model->do_email($message, $sub, $email);
        		    if($email_sent){
        		        $this->Db_model->save_email($leads_id,$email,$sub,$message);
        		    }
			        if(!empty($_POST['emails'])){
			            foreach($_POST['emails'] as $dt){
    			               if(!empty($dt)){
    			                 $sub = $this->input->post('subject');
                    			 $message = $this->input->post('body');
                    			 $message = $this->Db_model->gen_string_body($user_name,$dt,$listing_price,$message);
                    		     $email_sent =  $this->Email_model->do_email($message, $sub, $dt);
                    		     if($email_sent){
                    		        $this->Db_model->save_email($leads_id,$dt,$sub,$message);
                    		     }  
    			               }
    			        }
		        	}
			    }	
        		   
			}
			
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_leads', 'refresh');
		    //$this->input->post('parent_id')
		} 
		$users_id = $this->session->userdata('users_id');
		$data['request']         = $this->db->get_where('email_templates', array('users_system_id'=>$users_id))->result();
		$data['house_types']     = $this->db->get_where('house_types',array('status'=>'Active'))->result_array();
		$data['house_situation'] = $this->db->get_where('house_situation',array('status'=>'Active'))->result_array();
		$data['param1'] =  $param1;
	    $data['page_title'] = 'Add Lead';
        $data['page_sub_title'] = 'Add Lead';
        $data['page_name'] = 'add_lead';
        $data['actor'] = 'add_lead';
        $data['main_page_name'] = 'Manage Lead';
        $data['main_page_link'] = 'manage_leads';
        $data["htmlPage"] = "add_lead";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    public function edit_lead($param1 = '', $param2 = '', $param3 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='edit'){
          	$data['first_name']     = $this->input->post('first_name');
			$data['last_name'] 	    = $this->input->post('last_name');
			$data['email'] 	        = $this->input->post('email');
			$data['phone_number'] 	= $this->input->post('phone_number');
			$data['postal_code'] 	= $this->input->post('postal_code');
			$data['city'] 	        = $this->input->post('city');
			$data['address'] 	    = $this->input->post('address');
			$data['house_types_id'] 	= $this->input->post('house_types');
			$data['house_situation_id']= $this->input->post('house_situation');
			$data['estimate_price'] = $this->input->post('estimate_price');
			$data['listing_price'] 	= $this->input->post('listing_price');
			//$data['sold_price'] 	= $this->input->post('sold_price');
		//	$data['lead_type'] 	    = $this->input->post('lead_type');
			$data['date_of_birth']  = date("Y-m-d", strtotime($this->input->post('dob')));
			$data['parent_id'] 	    = $this->input->post('parent_id');
		/*	 if($this->input->post('lead_type') == 'customer'){
                $data['type_changed_by'] 	= $this->input->post('parent_id');
                $data['type_changed_date']  = date('Y-m-d h:i:s');
                $data['last_contact']      = date('Y-m-d h:i:s');
                $data['revenue'] 	        = $this->input->post('revenue');
            }	 */
            
            //error  -- redirect have no value.   (anas)
            $redirect = $this->input->post('redirect');
            
			$result = $this->Db_model->update_data('leads',$param2,$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}

		    redirect(base_url() . admin_ctrl() . '/manage_'.$redirect, 'refresh');
		    //$this->input->post('parent_id')
		}
		$data['house_types']     = $this->db->get_where('house_types',array('status'=>'Active'))->result_array();
		$data['house_situation'] = $this->db->get_where('house_situation',array('status'=>'Active'))->result_array();
		$data['request']   = $this->db->get_where('leads', array('leads_id' => $param1))->row();
	    $data['param1']         = $param1;
	    $data['param2']         = $param2;
	    $data['param3']         = $param3;
        $data['page_title'] = 'Edit Lead';
        $data['page_sub_title'] = 'Edit Lead';
        $data['page_name'] = 'edit_lead';
        $data['actor'] = 'edit_lead';
        $data['main_page_name'] = 'Manage Leads';
        $data['main_page_link'] = 'manage_leads';
        $data["htmlPage"] = "edit_lead";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
     public function view_lead($param1 = '', $param2 = '', $param3 = '',$param4='',$param5='')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='edit'){
          	$data['first_name']     = $this->input->post('first_name');
			$data['last_name'] 	    = $this->input->post('last_name');
			$data['email'] 	        = $this->input->post('email');
			$data['phone_number'] 	= $this->input->post('phone_number');
			$data['postal_code'] 	= $this->input->post('postal_code');
			$data['city'] 	        = $this->input->post('city');
			$data['address'] 	    = $this->input->post('address');
			
			$data['estimate_price'] = $this->input->post('estimate_price');
			$data['listing_price'] 	= $this->input->post('listing_price');
			$data['sold_price'] 	= $this->input->post('sold_price');
			$data['lead_type'] 	    = $this->input->post('lead_type');
			$data['first_contact']  = date('Y-m-d h:i:s');
			$data['date_of_birth']  = date("Y-m-d", strtotime($this->input->post('dob')));
			$data['parent_id'] 	    = $this->input->post('parent_id');
			$result = $this->Db_model->update_data('leads',$param2,$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_leads/'.$this->input->post('parent_id'), 'refresh');
		
		}
		if ($param1 == 'delete') {
		    $result = $this->Db_model->delete_data('notes', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/view_lead/'.$param3.'/'.$param4.'/'.$param5, 'refresh');
        }
        if ($param1 == 'delete_visitor') {
            $this->db->where('visitor_id',$param2);
		    $result = $this->db->delete('leads_visitors');
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/view_lead/'.$param3, 'refresh');
        }
         if($param1 =='add_note'){
            $parent_id =  $this->input->post('parent_id');
          	$data['task']           = $this->input->post('task');
			$data['description']    = $this->input->post('description');
			$data['parent_id']      = $parent_id;
			$data['leads_id']       = $param2;
			
			$result = $this->db->insert('notes',$data);
			
			if($result){
				$this->session->set_flashdata('msg_success', 'Note Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/view_lead/'.$param2.'/'.$parent_id.'/'.$param3, 'refresh');
		
		}
		if($param1 =='add_visitor'){
		    $parent_id = $this->input->post('parent_id');
          	$data['first_name']       = $this->input->post('first_name');
			$data['last_name'] 	      = $this->input->post('last_name');
			$data['email'] 	          = $this->input->post('email');
			$data['phone_number'] 	  = $this->input->post('phone_number');
			$data['offered_amount']   = $this->input->post('offered_amount');
			$data['additional_notes'] = $this->input->post('additional_notes');
			$data['address'] 	      = $this->input->post('address');
			$data['parent_id']        = $parent_id;
			$data['leads_id']         = $param2;
			$result = $this->db->insert('leads_visitors',$data);
			
			if($result){
				$this->session->set_flashdata('msg_success', 'Visitor Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/view_lead/'.$param2.'/'.$parent_id.'/'.$param3, 'refresh');
		
		}
         if($param1 =='edit_note'){
             
          	$data['task']           = $this->input->post('task');
			$data['description']    = $this->input->post('description');
			$result = $this->Db_model->update_data('notes',$param2,$data);
			
			if($result){
				$this->session->set_flashdata('msg_success', 'Note Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/view_lead/'.$param3.'/'.$this->input->post('parent_id').'/'.$param4, 'refresh');
		
		}
		if($param1 =='edit_visitor'){
          	$data['first_name']       = $this->input->post('first_name');
			$data['last_name'] 	      = $this->input->post('last_name');
			$data['email'] 	          = $this->input->post('email');
			$data['phone_number'] 	  = $this->input->post('phone_number');
			$data['offered_amount']   = $this->input->post('offered_amount');
			if(!empty($_POST['sold_amount'])){
		    	$data['sold_amount']   = $this->input->post('sold_amount');
			}
			$data['additional_notes'] = $this->input->post('additional_notes');
			$data['address'] 	    = $this->input->post('address');
			$this->db->where('visitor_id',$param2);
			$result = $this->db->update('leads_visitors',$data);
			
			if($result){
				$this->session->set_flashdata('msg_success', 'Visitor Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/view_lead/'.$param3.'/'.$this->input->post('parent_id').'/'.$param4, 'refresh');
		
		}
		 if($param1=='add_to_sold'){
            $visitor_id = $param2;
           
            /* visitor table */               
            $data['type']         = 'sold';
            $data['sold_amount']   = $this->input->post('sold_price');
            
            
            $this->db->where('visitor_id', $visitor_id);
            $result = $this->db->update('leads_visitors', $data);
                /* leads table */
               
            
            $lead['lead_type']    = 'sold';
            $lead['sold_date']    = date('Y-m-d h:i:s');
            $lead['sold_price']   = $this->input->post('sold_price');
            $lead['end_date']     = date('Y-m-d');
            $this->db->where('leads_id', $param3);
            $result = $this->db->update('leads', $lead);
            
        	
			
			if($result){
			    
			    $leads_data = $this->db->get_where('leads', array('leads_id'=>$param3))->row();
                $email = $leads_data->email;
                $users_id = $this->session->userdata('users_id');
                $get_template   = $this->db->get_where('email_templates', array('type'=>'add_to_sold','users_system_id'=>$users_id))->row();
    			$sub = $get_template->subject;
    			$message = $get_template->body;
    			
    			$message = $this->Db_model->gen_string_body($leads_data->first_name,$email,$leads_data->listing_price,$message);
    		    $email_sent =  $this->Email_model->do_email($message, $sub, $email);
    		    
    		    if($email_sent){
    		        $this->Db_model->save_email($param2,$email,$sub,$message);
    		    }
			    
				$this->session->set_flashdata('msg_success', 'Sold Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/view_lead/'.$param3.'/'.$this->input->post('parent_id').'/sold', 'refresh');
        }
		
		$data['request']        = $this->db->get_where('leads', array('leads_id' => $param1))->row();
		$data['notes']          = $this->Db_model->get_notes($param1);
		$data['visitor']        = $this->Db_model->get_visitors($param1);
	    $data['param1']         = $param1;
	    $data['param2']         = $this->session->userdata('users_id');
	    $data['param3']         = $param3;
        $data['page_title'] = 'View Lead';
        $data['page_sub_title'] = 'View Lead';
        $data['page_name'] = 'view_lead';
        $data['actor'] = 'view_lead';
        if($param3 =='lead'){
            $data['main_page_name'] = 'Manage Leads';
            $data['main_page_link'] = 'manage_leads';
        }else if($param3 =='customer'){
            $data['main_page_name'] = 'Manage Customer';
            $data['main_page_link'] = 'manage_customer';
        }else if($param3 =='sold'){
            $data['main_page_name'] = 'Manage Sold';
            $data['main_page_link'] = 'manage_sold';
        }
        
        
        $data["htmlPage"] = "view_lead";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    
    
    /**** manage leads *****/
    
    
     /**** manage employees *****/
    public function manage_employees($param1 = '', $param2 = '',$param3 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }   
        if ($param1 == 'update_status') {
            $id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('users_system_id', $id);
            $result = $this->db->update('users_system', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }


        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('users_system', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Data Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/manage_employees/'.$param3, 'refresh');
        }
        $data['param1'] =  $param1;
        if($this->session->userdata('user_roles_id') == 2){
            $user_id = $this->session->userdata('users_id');
            $data['employees_data'] = $this->db->query('select *,users_system_id as user_id , (select count(leads_id) as total_leads from leads where parent_id =user_id AND lead_type="lead") as total_leads  from users_system where users_roles_id =3 AND parent_id='.$user_id)->result_array();
           // $data['employees_data'] = $this->db->get_where('users_system',array('users_roles_id'=>'3','parent_id'=>$this->session->userdata('users_id')))->result_array();
            $user_data    =  $this->db->get_where('users_system',array('users_system_id'=>$this->session->userdata('users_id')))->row();
            $parent_name = $user_data->user_name;
            $data['broker_detail'] = $user_data;
        }else{
            $data['employees_data'] = $this->db->query('select *,users_system_id as user_id , (select count(leads_id) as total_leads from leads where parent_id =user_id AND lead_type="lead") as total_leads  from users_system where users_roles_id =3 AND parent_id='.$param1)->result_array();
            //$data['employees_data'] = $this->db->get_where('users_system',array('users_roles_id'=>3,'parent_id'=>$param1))->result_array();
            $parent_name    =  $this->db->get_where('users_system',array('users_system_id'=>$param1))->row()->user_name;
           // $data['broker_detail'] = $user_data;
            $data['main_page_link'] = 'manage_brokers';
        }
        $data['role'] = $this->session->userdata('user_roles_id');
        $data['page_title'] = "Manage Employees | <code class='text-capitalize'>".$parent_name."</code>";
        $data['page_sub_title'] = get_phrase('manage_employees'); 
        $data['page_name'] = 'manage_employees';
        $data['actor'] = 'manage_employees';
        $data['main_page_name'] = 'Manage Brokers';
        $data["htmlPage"] = "manage_employees";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    public function add_employee($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='add'){
            $data['user_name']      = $this->input->post('first_name').' '.$this->input->post('last_name');
			$data['first_name']     = $this->input->post('first_name');
			$data['last_name'] 	    = $this->input->post('last_name');
			$data['email'] 	        = $this->input->post('email');
			$data['mobile'] 	    = $this->input->post('mobile');
			$data['biv_number'] 	= $this->input->post('biv_number');
			$data['city'] 	        = $this->input->post('city');
			$data['address'] 	    = $this->input->post('address');
			$data['password'] 	    = md5($this->input->post('password'));
			$data['parent_id'] 	    = $this->input->post('parent_id');
			$data['users_roles_id'] = 3;
			$result = $this->db->insert('users_system',$data);
			if($result){
			    $employee_id = $this->db->insert_id();
			    $this->Db_model->clone_email_templates($employee_id);
				$this->session->set_flashdata('msg_success', 'Data Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_employees/'.$this->input->post('parent_id'), 'refresh');
		
		}
		$role = $this->session->userdata('user_roles_id');
		if($role == 2){
		   $data['param1']  = $this->session->userdata('users_id');
		   $data['main_page_link'] = 'manage_employees';
		}else{
		    $data['param1'] =  $param1;
		    $data['main_page_link'] = 'manage_employees/'.$param1;
		}
		$data['page_title'] = 'Add Employee';
        $data['page_sub_title'] = 'Add Employee';
        $data['page_name'] = 'add_employee';
        $data['actor'] = 'add_employee';
        $data['main_page_name'] = 'Manage Employee';
        $data["htmlPage"] = "add_employee";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    public function edit_employee($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='edit'){
            $data['user_name']      = $this->input->post('first_name').' '.$this->input->post('last_name');
			$data['first_name'] = $this->input->post('first_name');
			$data['last_name'] 	 = $this->input->post('last_name');
			$data['email'] 	    = $this->input->post('email');
			$data['mobile'] 	 = $this->input->post('mobile');
			$data['biv_number'] 	= $this->input->post('biv_number');
			if(!empty($this->input->post('password'))){
			    $data['password'] 	    = md5($this->input->post('password'));
			}
			$data['parent_id'] 	    = $this->input->post('parent_id');
			$data['city'] 	        = $this->input->post('city');
			$data['address'] 	 = $this->input->post('address');
			$result = $this->Db_model->update_data('users_system',$param2,$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_employees/'.$this->input->post('parent_id'), 'refresh');
		
		}
		$data['request']   = $this->db->get_where('users_system', array('users_system_id' => $param1))->row();
	   
	    $role = $this->session->userdata('user_roles_id');
		if($role == 2){
		   $data['param2']  = $this->session->userdata('users_id');
		   $data['main_page_link'] = 'manage_employees';
		}else{
		    $data['param2'] =  $param2;
		    $data['main_page_link'] = 'manage_employees/'.$param1;
		}
	    $data['param1']         = $param1;
        $data['page_title'] = 'Edit Employee';
        $data['page_sub_title'] = 'Edit Employee';
        $data['page_name'] = 'edit_employee';
        $data['actor'] = 'edit_employee';
        $data['main_page_name'] = 'Manage Employee';
        $data["htmlPage"] = "edit_employee";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
 
    /**** manage employee *****/
    /**** manage brokers *****/
    public function manage_brokers($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }   
        if ($param1 == 'update_status') {
            $id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('users_system_id', $id);
            $result = $this->db->update('users_system', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        if ($param1 == 'edit') {
            $updateData['confirmation_number'] = $this->input->post('confirmation_number');
            $this->db->where('users_system_id', $param2);
            $result = $this->db->update('users_system', $updateData);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Govt Number Assigned Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        }

        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('users_system', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Role Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/manage_brokers', 'refresh');
        }
        
        $data['brokers_data'] = $this->db->query('select *,users_system_id as user_id , (select count(users_system_id) as total_employees from users_system where parent_id =user_id) as total_employees  from users_system where users_roles_id =2')->result_array();
        $data['page_title'] = 'Manage Brokers';
        $data['page_sub_title'] = get_phrase('manage_brokers');
        $data['page_name'] = 'manage_brokers';
        $data['actor'] = 'manage_brokers';
        $data['main_page_name'] = 'manage_brokers';
        $data["htmlPage"] = "manage_brokers";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    public function add_broker($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='add'){
            $data['user_name']      = $this->input->post('first_name').' '.$this->input->post('last_name');
			$data['first_name']     = $this->input->post('first_name');
			$data['last_name'] 	    = $this->input->post('last_name');
			$data['email'] 	        = $this->input->post('email');
			$data['biv_number'] 	= $this->input->post('biv_number');
			$data['mobile'] 	    = $this->input->post('mobile');
			$data['address'] 	    = $this->input->post('address');
			$data['business_name'] 	= $this->input->post('business_name');
			$data['password'] 	    = md5($this->input->post('password'));
			$data['city'] 	        = $this->input->post('city');
			$data['date_of_birth'] 	= date("Y-m-d", strtotime($_POST['date_of_birth']));
			$data['number_of_employees_allowed'] = $this->input->post('number_of_employees_allowed');
			$data['number_of_time_data_exported'] = $this->input->post('number_of_time_data_exported');
			$data['past_data_shown_allowed'] 	 = $this->input->post('past_data_shown_allowed');
			$data['maximum_number_leads_allowed']= $this->input->post('maximum_number_leads_allowed');
			$data['users_roles_id'] = 2;
			$result = $this->db->insert('users_system',$data);
			if($result){
			    $broker_id = $this->db->insert_id();
			    $this->Db_model->clone_email_templates($broker_id);
				$this->session->set_flashdata('msg_success', 'Data Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_brokers', 'refresh');
		
		}
	    $data['page_title'] = 'Add Broker';
        $data['page_sub_title'] = 'Add Broker';
        $data['page_name'] = 'add_broker';
        $data['actor'] = 'add_broker';
        $data['main_page_name'] = 'Manage Brokers';
        $data['main_page_link'] = 'manage_brokers';
        $data["htmlPage"] = "add_broker";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    public function edit_broker($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='edit'){
            $data['user_name']      = $this->input->post('first_name').' '.$this->input->post('last_name');
			$data['first_name'] = $this->input->post('first_name');
			$data['last_name'] 	 = $this->input->post('last_name');
			$data['email'] 	    = $this->input->post('email');
			$data['biv_number'] 	 = $this->input->post('biv_number');
			$data['mobile'] 	 = $this->input->post('mobile');
			$data['business_name'] 	= $this->input->post('business_name');
			$data['city'] 	        = $this->input->post('city');
			$data['date_of_birth'] 	= date("Y-m-d", strtotime($_POST['date_of_birth']));
			if(!empty($this->input->post('password'))){
			    $data['password'] 	    = md5($this->input->post('password'));
			}
			$data['address'] 	 = $this->input->post('address');
			$data['number_of_employees_allowed'] 	 = $this->input->post('number_of_employees_allowed');
			$data['past_data_shown_allowed'] 	 = $this->input->post('past_data_shown_allowed');
			$data['past_data_shown_allowed'] 	 = $this->input->post('past_data_shown_allowed');
			$data['maximum_number_leads_allowed'] 	 = $this->input->post('maximum_number_leads_allowed');
			$result = $this->Db_model->update_data('users_system',$param2,$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_brokers', 'refresh');
		
		}
		$data['request']   = $this->db->get_where('users_system', array('users_system_id' => $param1))->row();
	    $data['param1']         = $param1;
        $data['page_title'] = 'Edit Broker';
        $data['page_sub_title'] = 'Edit Broker';
        $data['page_name'] = 'edit_broker';
        $data['actor'] = 'edit_broker';
        $data['main_page_name'] = 'Manage Brokers';
        $data['main_page_link'] = 'manage_brokers';
        $data["htmlPage"] = "edit_broker";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
 
    /**** manage broker *****/
    
    
    /**** manage_house_types *****/
    
     public function manage_house_types($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }   
        if ($param1 == 'update_status') {
            $id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('house_types_id', $id);
            $result = $this->db->update('house_types', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        // if ($param1 == 'edit') {
        //     $updateData['confirmation_number'] = $this->input->post('confirmation_number');
        //     $this->db->where('house_types_id', $param2);
        //     $result = $this->db->update('house_types', $updateData);
        //     if ($result) {
        //         $this->session->set_flashdata('msg_success', 'Govt Number Assigned Successfully');
        //     } else {
        //         $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
        //     }
        //     redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        // }

        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('house_types', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Role Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/manage_house_types', 'refresh');
        }
        $data['house_types_data'] = $this->db->get('house_types')->result_array();
        $data['page_title'] = 'House Types';
        $data['page_sub_title'] = get_phrase('manage_house_types');
        $data['page_name'] = 'manage_house_types';
        $data['actor'] = 'manage_house_types';
        $data['main_page_name'] = 'manage_house_types';
        $data["htmlPage"] = "manage_house_types";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
     public function add_house_types($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='add'){
            
			$data['name']     = $this->input->post('name');
			$result = $this->db->insert('house_types',$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_house_types', 'refresh');
		
		}
	    $data['page_title'] = 'Add House Types';
        $data['page_sub_title'] = 'Add House Types';
        $data['page_name'] = 'add_house_types';
        $data['actor'] = 'add_house_types';
        $data['main_page_name'] = 'House Types';
        $data['main_page_link'] = 'manage_house_types';
        $data["htmlPage"] = "add_house_types";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
     public function edit_house_types($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='edit'){
			$data['name'] = $this->input->post('name');
			$result = $this->Db_model->update_data('house_types',$param2,$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_house_types', 'refresh');
		
		}
		$data['request']   = $this->db->get_where('house_types', array('house_types_id' => $param1))->row();
	    $data['param1']         = $param1;
        $data['page_title'] = 'Edit House Types';
        $data['page_sub_title'] = 'Edit House Types';
        $data['page_name'] = 'edit_house_types';
        $data['actor'] = 'edit_house_types';
        $data['main_page_name'] = 'House Types';
        $data['main_page_link'] = 'manage_house_types';
        $data["htmlPage"] = "edit_house_types";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
     
     /**** manage_house_situation *****/
    
     public function manage_house_situation($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }   
        if ($param1 == 'update_status') {
            $id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('house_situation_id', $id);
            $result = $this->db->update('house_situation', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        // if ($param1 == 'edit') {
        //     $updateData['confirmation_number'] = $this->input->post('confirmation_number');
        //     $this->db->where('house_types_id', $param2);
        //     $result = $this->db->update('house_types', $updateData);
        //     if ($result) {
        //         $this->session->set_flashdata('msg_success', 'Govt Number Assigned Successfully');
        //     } else {
        //         $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
        //     }
        //     redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        // }

        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('house_situation', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Role Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() .admin_ctrl().'/manage_house_situation', 'refresh');
        }
        $data['house_situation_data'] = $this->db->get('house_situation')->result_array();
        $data['page_title'] = 'House Situation';
        $data['page_sub_title'] = get_phrase('manage_house_situation');
        $data['page_name'] = 'manage_house_situation';
        $data['actor'] = 'manage_house_situation';
        $data['main_page_name'] = 'manage_house_situation';
        $data["htmlPage"] = "manage_house_situation";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
     public function add_house_situation($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='add'){
            
			$data['name']     = $this->input->post('name');
			$result = $this->db->insert('house_situation',$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Added Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_house_situation', 'refresh');
		
		}
	    $data['page_title'] = 'Add House Situation';
        $data['page_sub_title'] = 'Add House Situation';
        $data['page_name'] = 'add_house_situation';
        $data['actor'] = 'add_house_situation';
        $data['main_page_name'] = 'House Situation';
        $data['main_page_link'] = 'manage_house_situation';
        $data["htmlPage"] = "add_house_situation";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    public function edit_house_situation($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url().admin_ctrl(), 'refresh');
        }
        
        if($param1 =='edit'){
			$data['name'] = $this->input->post('name');
			$result = $this->Db_model->update_data('house_situation',$param2,$data);
			if($result){
				$this->session->set_flashdata('msg_success', 'Data Updated Successfully');
			}else{
				$this->session->set_flashdata('msg_error', 'Oops!something went wrong');
			}
		    redirect(base_url() . admin_ctrl() . '/manage_house_situation', 'refresh');
		
		}
		$data['request']   = $this->db->get_where('house_situation', array('house_situation_id' => $param1))->row();
	    $data['param1']         = $param1;
        $data['page_title'] = 'Edit House Situation';
        $data['page_sub_title'] = 'Edit House Situation';
        $data['page_name'] = 'edit_house_situation';
        $data['actor'] = 'edit_house_situation';
        $data['main_page_name'] = 'House Situation';
        $data['main_page_link'] = 'manage_house_situation';
        $data["htmlPage"] = "edit_house_situation";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }
    
    /**** manage_house_situation_ends *****/

    /**** manage roles *****/
    public function manage_roles($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }   
        if ($param1 == 'update_status') {
            $brands_id = $this->input->post('id');
            $updateData['status'] = $this->input->post('status');
            $this->db->where('users_roles_id', $brands_id);
            $result = $this->db->update('users_roles', $updateData);
            if ($result) {
                echo 'success';
            } else {
                echo 'fail';
            }
            exit;
        }

        if ($param1 == 'edit') {
            $updateData['confirmation_number'] = $this->input->post('confirmation_number');
            $this->db->where('users_system_id', $param2);
            $result = $this->db->update('users_system', $updateData);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Govt Number Assigned Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        }

        if ($param1 == 'delete') {
            $result = $this->Db_model->delete_data('user_roles', $param2);
            if ($result) {
                $this->session->set_flashdata('msg_success', 'Role Deleted Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'Oops!something went wrong');
            }
            redirect(base_url() . strtolower($this->session->userdata('directory')) . '/customer_list', 'refresh');
        }
        $data['user_roles'] = $this->db->get_where('users_roles',array('name'=>'Broker'))->result_array();
        $data['page_title'] = 'Manage Roles & Permissions';
        $data['page_sub_title'] = get_phrase('manage_roles');
        $data['page_name'] = 'manage_roles';
        $data['actor'] = 'manage_roles';
        $data['main_page_name'] = 'manage_roles';
        $data["htmlPage"] = "manage_roles";
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }

    /**** manage roles *****/
    /**** manage permission ****/
    public function manage_permissions($param1 = '', $param2 = '')
    {
        if ($this->session->userdata('login') != 1) {
            redirect(base_url() . 'admin', 'refresh');
        }
        if ($param1 == 'do_update') {
            $data_per['dashboard'] = $this->check_value($this->input->post('dashboard'));
            /*$data_per['myprofile'] = $this->check_value($this->input->post('myprofile'));
            $data_per['manage_system'] = $this->check_value($this->input->post('manage_system'));*/
            $data_per['manage_leads'] = $this->check_value($this->input->post('manage_leads'));
            
            $data_per['add_lead'] = $this->check_value($this->input->post('add_lead'));
            $data_per['add_visitor'] = $this->check_value($this->input->post('add_visitor'));
            $data_per['view_lead'] = $this->check_value($this->input->post('view_lead'));
            $data_per['delete_lead'] = $this->check_value($this->input->post('delete_lead'));
            $data_per['edit_lead'] = $this->check_value($this->input->post('edit_lead'));
            $data_per['view_note'] = $this->check_value($this->input->post('view_note'));
            $data_per['edit_note'] = $this->check_value($this->input->post('edit_note'));
            $data_per['view_visitor'] = $this->check_value($this->input->post('view_visitor'));
            $data_per['delete_note'] = $this->check_value($this->input->post('delete_note'));
            $data_per['delete_visitor'] = $this->check_value($this->input->post('delete_visitor'));
            $data_per['edit_visitor'] = $this->check_value($this->input->post('edit_visitor'));
            
           // $data_per['manage_employees'] = $this->check_value($this->input->post('manage_employees'));
        /*     $data_per['manage_brokers'] = $this->check_value($this->input->post('manage_brokers'));
           $data_per['email_templates'] = $this->check_value($this->input->post('email_templates'));
            $data_per['manage_permissions'] = $this->check_value($this->input->post('manage_permissions'));
            $data_per['roles'] = $this->check_value($this->input->post('roles'));
            $data_per['reports'] = $this->check_value($this->input->post('reports'));
            $data_per['add_house_types'] = $this->check_value($this->input->post('add_house_types'));
            $data_per['edit_house_types'] = $this->check_value($this->input->post('edit_house_types'));
            $data_per['delete_house_types'] = $this->check_value($this->input->post('delete_house_types'));
            $data_per['add_house_situation'] = $this->check_value($this->input->post('add_house_situation'));
            $data_per['edit_house_situation'] = $this->check_value($this->input->post('edit_house_situation'));
            $data_per['delete_house_situation'] = $this->check_value($this->input->post('delete_house_situation'));*/
            
            $this->db->where('users_roles_id', $param2);
            $result = $this->db->update('permission', $data_per);

            if ($result == 'success') {
                $this->session->set_flashdata('msg_success', 'Permissions Updated Successfully');
            } else {
                $this->session->set_flashdata('msg_error', 'oops!Permissions not updated! try again.');
            }
            redirect(base_url() . 'admin/manage_roles/', 'refresh');
        }
        $data['param1'] = $param1;
        $data['previleges'] 	= $this->db->query('SELECT * FROM permission WHERE users_roles_id='.$param1)->result_array();
	    $data['page_title'] = 'Edit Permissions';
        $data['page_sub_title'] = 'Edit Permissions';
        $data['page_name'] = 'manage_permissions';
        $data['main_page_name'] = 'Manage Permissions';
        $data['main_page_link'] = 'manage_roles';

        $data['htmlPage'] = 'manage_permissions';
        $this->load->view(strtolower($this->session->userdata('directory')) . '/index', $data);
    }



    function check_value($check_box_value)
    {
        if ($check_box_value == 1) {
            return 1;
        } else {
            return 0;
        }
    }

    /**** manage permission ****/
    public function replace_underscore($string)
    {
        $replaced = str_replace(' ', '_', $string);
        return $replaced;
    }

    public function check_null($param)
    {
        if ($param) {
            return $param;
        } else {
            return '0';
        }
    }

    public function getSortNumber($table)
    {
        $count = $this->db->get($table)->num_rows();
        $count = $count + 1;
        return $count;
    }

    public function redirect_me($path, $controller = "admin")
    {
        echo "<script>location.href = '" . base_url() . $controller . "/" . $path . "'; </script>";
        //        redirect(strtolower($this->session->userdata('directory')) . '/' . $controller . "/".$path);
    }
    public function manage_template($param1 = ''){
        if($param1 == 'get_template_data'){
         $template = $this->db->get_where('email_templates',array('email_templates_id'=>$_POST['id']))->row_array();
        //  print_r($template);
         echo json_encode(["subject"=>$template['subject'],"body"=>$template['body']]);
        
        
        
        
        
         
    }
    }
}
