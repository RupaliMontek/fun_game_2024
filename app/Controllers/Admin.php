<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SuperAdmin_model;
use App\Models\Admin_model;

class Admin extends Controller
{

    protected $session;
    public function __construct() 
    {        
        $this->SuperAdminModel = new \App\Models\SuperAdmin_model();
        $this->session = \Config\Services::session();
        $this->Admin_model = new Admin_model();
        $this->SuperAdmin_model = new SuperAdmin_model();
    }


    public function dashboard()
    {      
        $admin_account_id = $_SESSION["user_id"]; 
        $data['players_list'] = $this->SuperAdminModel->get_all_player_users_list($admin_account_id);
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('admin/dashboard',$data); 
        echo view('templates/footer');          
    }

    public function add_player()
    {
        $admin_account_id = $_SESSION["user_id"]; 
        $admin_users_details= $this->Admin_model->get_admin_user_details($admin_account_id);
        $data['limit_user_add'] = $admin_users_details->limit_user;
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('user/user_add',$data); 
        echo view('templates/footer');       
    }


     public function edit_player_details($user_id)
    {
        $data['player_details'] = $this->Admin_model->get_player_user_details($user_id);
        echo view('templates/header');
        echo view('templates/sidebar');
        echo view('user/user_edit',$data); 
        echo view('templates/footer');       
    }


    public function update_players_account_details($id) {
            
            $validation = \Config\Services::validation();
            $validation->setRule('new_username', 'New Username', 'required|trim');    
            $admin_account_id = $_SESSION["user_id"];    
            if ($validation->withRequest($this->request)->run() === FALSE) 
            {                    
             return $this->dashboard();

            } 
            else 
            {                 
            $post = $this->request->getPost();

            $admin_users_details= $this->Admin_model->get_admin_user_details($admin_account_id);
            $amout_givens = $admin_users_details->amout_given;
            $new_username = $post["new_username"];
            $new_password = md5($post['new_password']);
            $amout_given  = $post["amout_given"];             
            $first_name   = $post["first_name"];
            $last_name    = $post["last_name"];
            $password     = $post["password"];     
            $player_user_details = $this->Admin_model->get_admin_user_details($id);    
            $player_current_amt = $player_user_details->amout_given;
            $player_request_amt = $amout_given-$player_current_amt;
            $amount_remaning_admin= $amout_givens-$player_request_amt; 
             
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
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'role'         => 'user'
            ];           
            $result = $this->SuperAdmin_model->update_admin_account_details($id,$data);
            $session = session();
            if($result)
            {
               if($player_request_amt!=0)
               {
                  $data = array("current_wallet"=>$amount_remaning_admin);
                  $update_balance = $this->Admin_model->update_admin_account_details($admin_account_id,$data);
               } 
               
               $session->setFlashdata('success_message', 'players User Record Update Successfully');
            }
            else
            {
              $session->setFlashdata('error_message', 'Player User Record Not Updated.');  
            }
    
            return redirect()->to('admin/dashboard');
        }
    }



     public function create_players_account()
    {
        $validation = \Config\Services::validation();
        $validation->setRule('new_username', 'New Username', 'required|trim|is_unique[super_admins.username]');
        $validation->setRule('new_password', 'New Password', 'required');
        $admin_account_id = $_SESSION["user_id"];
        $admin_users_details= $this->Admin_model->get_admin_user_details($admin_account_id);
        $amout_givens = $admin_users_details->amout_given;

        if ($validation->withRequest($this->request)->run() === FALSE) {
            return $this->dashboard();
        } else {
            $post = $this->request->getPost();
            $new_username = $post["new_username"];
            $new_password = md5($post['new_password']);
            $amout_given  = $post["amout_given"]; 
            $first_name   = $post["first_name"];
            $last_name    = $post["last_name"];
            $amount_remaning_admin= $amout_givens-$amout_given;            
            $data = [
                'username'     => $new_username,
                'password'     => $new_password,
                'amout_given'  => $amout_given,                
                'first_name'   => $first_name,
                'last_name'    => $last_name,
                'role'         => 'user',
                'added_by'     => $admin_account_id
            ];           
            $result = $this->SuperAdmin_model->create_admin_account($data);
            $session = session();
            if($result)
            {
                $data = array("current_wallet"=>$amount_remaning_admin);
                $update_balance = $this->Admin_model->update_admin_account_details($admin_account_id,$data);
               $session->setFlashdata('success_message', 'Data inserted successfully');
            }
            else
            {
              $session->setFlashdata('error_message', 'Data not inserted.');  
            }
    
            return redirect()->to('admin/dashboard');
        }
    }


   public function check_player_user_add_limit()
    {
        $email = $this->input->post('candidate_email',TRUE);
        $result=$this->M_Candidate_profile->check_if_email_exists($email);
         if($result>=1)
        {
            echo "false";
        }
        else
        {
            echo "true";
        }

}


}
