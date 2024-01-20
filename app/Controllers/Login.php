<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Login_model;
class Login extends Controller 
{
    protected $SuperAdminModel;
    protected $session;
    public function __construct() 
    {
      $this->session = \Config\Services::session();
      $this->Login_model = new Login_model();
    }

    public function index() 
    {
        return view('login/index');
    }

    public function users_status_change()
    {
        $post = $this->request->getPost();
        $status = $post["status"];
        $user_id =$post["user_id"];
        $data = array("status"=>$status);
        $result = $this->Login_model->update_user_status($user_id,$data);
        if($result)
        {
            echo "1";
        }
        else
        {
             echo "0";  
        }   
    
    }


    public function check_login() {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');        
        $super_admin = $this->Login_model->verify_login($username, $password);        
        
        if (!empty($super_admin)) {            
            $this->session->set('user_id', $super_admin->id);
            $this->session->set('role', $super_admin->role);
            $this->session->set('role', $super_admin->role);
            $this->session->set('username', $super_admin->first_name." ".$super_admin->last_name);
            if($super_admin->role=="super-admin")
            {
                return redirect()->route('superadmin');            
            }
            elseif($super_admin->role=="admin")
            {
               
                return redirect()->route('admin');  
            }

            elseif($super_admin->role=="user")
            {
                return redirect()->route('superadmin');  
            }
            
        } 
        else 
        {
            return redirect()->route('login'); 
        }
    }


    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('login');
    }


    
}
