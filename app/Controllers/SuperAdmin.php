<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SuperAdmin_model;
use App\Models\Notification_model;

class SuperAdmin extends Controller {
    protected $SuperAdminModel;
    protected $session;
    public function __construct() {
        
        $this->SuperAdminModel = new \App\Models\SuperAdmin_model();
        $this->session = \Config\Services::session();
        // helper(['form', 'url']); 
        $this->SuperAdmin_model = new SuperAdmin_model();
         $this->Notification_model = new \App\Models\Notification_model();

    }

    public function index() 
    {
        $data["players_list"]= $this->SuperAdminModel->get_all_player_users_list();
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('super_admin/index',$data); 
        echo view('templates/footer');     
    }

    public function request_balance_amount_admin()
    {
       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];

       $data["request_list_admin"] = $this->SuperAdminModel->request_balance_amount_admin();
       echo view('templates/header');
       echo view('templates/sidebar');
       echo view('super_admin/request_balance_amount_admin',$data); 
       echo view('templates/footer');    
    }

    
    public function check_list_admin_user_admin_request_superadmin()
    {

       $role = $_SESSION["role"];
       $user_id = $_SESSION["user_id"];
       $data["request_details"] = $this->Notification_model->check_list_admin_user_admin_request_superadmin($user_id);
       if(!empty($data["request_details"])){
       echo view("admin/balance_amount_extend_request_admin",$data);
        }

    }

    public function change_status_admin_send_request_balance_amount()
    {
       $post = $this->request->getPost();
       $user_id = $_SESSION["user_id"];
       $notification_id       = $post["notification_id"];
       $request_id            = $post["request_id"];
       $superadmin_status     = $post["superadmin_status"];
       $notification_from_id  = $post["notification_from_id"]; 
       $data = 
       array
       (
          "notification_status"  => 1
       );
       $result = $this->Notification_model->view_notification($notification_id,$data);
       $request_details = $this->SuperAdminModel->admin_get_request_balance_amount_by_request_id($request_id);
       $request_from_details = $this->SuperAdminModel->get_admin_user_details($notification_from_id);
       if($superadmin_status==1)
       {
       
       $balance_request_amt = $request_details->balance_request_amt;
       $amout_given = $request_from_details->amout_given+$balance_request_amt;       
       $current_wallet = $request_from_details->current_wallet+$balance_request_amt;
       if(!empty($current_wallet))
       {
           $current_wallet = $current_wallet; 
       }
       else
       {
           $current_wallet = 0;  
       }       
       $datas= 
       array
       (
        "amout_given"     => $amout_given,
        "current_wallet"  => $current_wallet,
       );
       $resultss = $this->SuperAdminModel->update_admin_account_details($notification_from_id,$datas);
       $para = array
       (
        "amout_given_balace_amt"     =>  $amout_given, 
        "wallet_balance_amt"         =>  $current_wallet,
        "superadmin_accept_status"   =>  $superadmin_status,
       );
       $results = $this->SuperAdminModel->update_request_superadmin_balance_amount_for_admin($request_id,$para);
    }
      $notification_array = 
       array
       (
         "request_id"           =>  $request_id ,
         "notification_title"   =>  "Superadmin Change Balance Amount Request Status",
         "notification_from_id" =>  $user_id,
         "notification_to_id"   =>  $notification_from_id,
         "notification_type"    =>  "Superadmin Change Balance Request Status",
         "created_at"           =>  date("Y-m-d h:i:s"),
       );
    $notification_status = $this->Notification_model->notification_insert($notification_array);   
    $session = session();
    if(@$result)
    {
        $session->setFlashdata('success_message', 'Status Chanage Successfully');
    }
    else
    {
        $session->setFlashdata('error_message', 'Something Went Wrong..!!');  
    }
    
    return redirect()->to('superadmin/request_balance_amount_admin');
}

    public function add_admin_user()
    {
        $data['admins'] = $this->SuperAdminModel->get_all_admins();
        echo view('templates/header', @$data);
        echo view('templates/sidebar', @$data);
        echo view('admin/add_admin', @$data); 
        echo view('templates/footer',@$data);         
    }    


    public function edit_admin_user($admin_id)
    {
        $data['admins_details'] = $this->SuperAdminModel->get_admin_user_details($admin_id);
        echo view('templates/header', @$data);
        echo view('templates/sidebar', @$data);
        echo view('admin/edit_admin', @$data); 
        echo view('templates/footer',@$data);         
    }    

    public function admin_user_list() 
    {

        $data['admins'] = $this->SuperAdminModel->get_all_admins();
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('super_admin/admin_list', $data); 
        echo view('templates/footer');             
        //return view('super_admin/dashboard', $data);
    }
    public function user_dashboard() 
    {
        $data['users'] = $this->SuperAdminModel->get_all_users();

        echo view('templates/header', $data);
        
        echo view('templates/footer');        
    }   
    
  
    public function create_account_from_dashboard()
    {
        $validation = \Config\Services::validation();
        $validation->setRule('new_username', 'New Username', 'required|trim|is_unique[super_admins.username]');
        $validation->setRule('new_password', 'New Password', 'required');
    
        if ($validation->withRequest($this->request)->run() === FALSE) {
            return $this->dashboard();
        } else {
            $admin_account_id = $_SESSION["user_id"]; 
            $post = $this->request->getPost();
            $new_username = $post["new_username"];
            $new_password = md5($post['new_password']);
            $amout_given  = $post["amout_given"]; 
            $limit_user   = $post["limit_user_create"];
            $first_name   = $post["first_name"];
            $last_name    = $post["last_name"];

            $data = [
                'username'     => $new_username,
                'password'     => $new_password,
                'amout_given'  => $amout_given,
                'limit_user'   => $limit_user,
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'role'         => 'admin',
                'added_by'     => $admin_account_id
            ];           
            $result = $this->SuperAdmin_model->create_admin_account($data);
            $session = session();
            if($result)
            {
               $session->setFlashdata('success_message', 'Data inserted successfully');
            }
            else
            {
              $session->setFlashdata('error_message', 'Data not inserted.');  
            }
    
            return redirect()->to('superadmin/dashboard');
        }
    }



    public function update_account_details_admin($id) 
    {
            
            $validation = \Config\Services::validation();
            $validation->setRule('new_username', 'New Username', 'required|trim');    
          
            if ($validation->withRequest($this->request)->run() === FALSE) 
            {                    
             return $this->dashboard();

            } 
            else 
            {  
            $admin_account_id = $_SESSION["user_id"];                
            $post = $this->request->getPost();
            $new_username = $post["new_username"];
            $new_password = md5($post['new_password']);
            $amout_given  = $post["amout_given"]; 
            $limit_user   = $post["limit_user_create"];
            $first_name   = $post["first_name"];
            $last_name    = $post["last_name"];
            $password     = $post["password"];  
            
            if(!empty($password))
            {
                $password_set = $new_password;
            }
            else
            {
                 $password_set = $password;
            }

            $data = [
                'username'     => $new_username,
                'password'     => $password_set,
                'amout_given'  => $amout_given,
                'limit_user'   => $limit_user,
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'role'         => 'admin',
                'added_by'     => $admin_account_id
            ];           
            $result = $this->SuperAdmin_model->update_admin_account_details($id,$data);
            $session = session();
            if($result)
            {
               $session->setFlashdata('success_message', 'Admin Record Update Successfully');
            }
            else
            {
              $session->setFlashdata('error_message', 'Admin Record Not Updated');  
            }
    
            return redirect()->to('superadmin/dashboard');
        }
    }


    public function create_account() 
    {
        $validation = \Config\Services::validation();
        $validation->setRule('new_username', 'New Username', 'required|trim|is_unique[super_admins.username]');
        $validation->setRule('new_password', 'New Password', 'required');
    
        if ($validation->withRequest($this->request)->run() === FALSE) {
            return $this->dashboard();
        } else {
            $new_username = $this->request->getPost('new_username');
            $new_password = password_hash($this->request->getPost('new_password'), PASSWORD_BCRYPT);
    
            $data = [
                'username' => $new_username,
                'password' => $new_password,
                'role'     => 'user'
            ];           
    
            $this->SuperAdmin_model->create_user_account($data);
            return redirect()->to('superadmin/user_dashboard');
        }
    }

    public function login_as($admin_id)
    {
        $admin = $this->SuperAdminModel->get_admin_by_id($admin_id);
        if ($admin) {
            $this->session->set('admin', $admin);

            // Redirect to the Admin dashboard
            return redirect()->to('admin/dashboard');
        } else {
            // Handle error if the admin account is not found
            return redirect()->to('superadmin/dashboard');
        }
    }
  public function login_as_user($user_id) 
    {
        $user = $this->SuperAdminModel->get_user_by_id($user_id);

        if ($user) {
            $this->session->set('user', $user);
            return redirect()->to('user/home');
        } else {
            return redirect()->to('superadmin/dashboard');
        }
    }
}
