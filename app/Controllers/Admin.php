<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use Config\Database;
use App\Models\SuperAdmin_model;
use App\Models\Admin_model;
use App\Models\Notification_model;
class Admin extends Controller
{
    protected $session;
    public function __construct() {
        
        $this->SuperAdminModel = new \App\Models\SuperAdmin_model();
        $this->session = \Config\Services::session();
        $this->Notification_model = new \App\Models\Notification_model();
        $this->Admin_model = new \App\Models\Admin_model();


    }


    public function index()
    {   
        $role = $_SESSION["role"];
        $admin_account_id = $_SESSION["user_id"];  
        echo view("templates/header");
        echo view("templates/sidebar");
        echo view("admin/index");
        echo view("templates/footer");
    }

    public function players_list()
    {
        $role = $_SESSION["role"];
        $admin_account_id = $_SESSION["user_id"];
        $data[
            "admin_users_details"
        ] = $this->Admin_model->get_admin_user_details($admin_account_id);
        $data[
            "players_list"
        ] = $this->SuperAdminModel->get_all_player_users_list(
            $admin_account_id
        );
        $data["player_count"] = count($data["players_list"]);
        echo view("templates/header");
        echo view("templates/sidebar");
        echo view("admin/player_list", $data);
        echo view("templates/footer");
    }

    public function view_notification_admin()
    {        
       $post                  = $this->request->getPost();
       $user_id               = $_SESSION["user_id"];
       $notification_id       = $post["notification_id"];
       $request_id            = $post["request_id"];       
       $notification_from_id  = $post["notification_from_id"]; 
       $data = 
       array
       (
          "notification_status"  => 1
       );
       $result = $this->Notification_model->view_notification($notification_id,$data);
       $session = session();
       if ($result) 
       {
             $session->setFlashdata("success_message","Successfully View Notification.");
       } 
       else 
       {
            $session->setFlashdata("error_message","Failed View Notification.");
       }
       return redirect()->to("admin/list_balance_request_list_super_admin");    

    }    

    public function superadmin_amount_change_request_status_change()
    {
        $role = $_SESSION["role"];
        $user_id = $_SESSION["user_id"];
        $data["request_details"] = $this->Notification_model->superadmin_amount_change_request_status_change($user_id);
        if(!empty( $data["request_details"])){
        echo view("admin/superadmin_amount_extend_request_status_change",$data);
         }
    }

    public function list_balance_request_list_super_admin()
    {
        $role = $_SESSION["role"];
        $admin_account_id = $_SESSION["user_id"];
        $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id);
        //print_r($data["admin_users_details"]);die();
        $data["list_admin_request_balance"] = $this->Admin_model->get_all_balanceamout_request_send_superadmin($admin_account_id
        );  

        echo view("templates/header");
        echo view("templates/sidebar");
        echo view("admin/list_balance_request_super_admin", $data);
        echo view("templates/footer");
    }

    public function send_balance_request_superadmin()
    {
       $post = $this->request->getPost();
       $admin_account_id = $_SESSION["user_id"];
       $admin_users_details = $this->Admin_model->get_admin_user_details($admin_account_id);
       $admin_superadmin_id    = $admin_users_details->added_by;
       $current_wallet_amount  = $admin_users_details->current_wallet; 
       $data = 
       array
       (
        "balance_request_amt"    => $post["balance_request_amt"],
        "admin_id"               => $_SESSION["user_id"],
        "superadmin_id"          => $admin_superadmin_id,
        "current_wallet_amount"  => $current_wallet_amount,
        "created_at"             => date("Y-m-d h:i:s"),
       );
       $result = $this->Admin_model->send_balance_request_superadmin($data);

       $para = 
       array
       (
        "request_id"            =>    $result,
        "notification_title"    =>    "Balance Amount Extends Request Send Superadmin",
        "notification_from_id"  =>    $_SESSION["user_id"],
        "notification_to_id"    =>    $admin_superadmin_id,
        "notification_type"     =>    "extend request balance amount",
        "created_at"            => date("Y-m-d h:i:s"),

       );
        $results= $this->Notification_model->notification_insert($para);      
        $session = session();
        if ($result) 
        {
             $session->setFlashdata("success_message","Send  Balance Request Successfully To Superamin");
        } 
        else 
        {
            $session->setFlashdata("error_message","Failed Send  Balance Request Successfully To Superamin");
        }

        return redirect()->to("admin/list_balance_request_list_super_admin");       

    }

    public function send_balance_request_super_admin()
    {
        $role = $_SESSION["role"];
        $admin_account_id = $_SESSION["user_id"];
        $data["admin_users_details"] = $this->Admin_model->get_admin_user_details($admin_account_id); 
        echo view("templates/header");
        echo view("templates/sidebar");
        echo view("admin/send_balance_request_super_admin.php", $data);
        echo view("templates/footer");
    }

    public function check_player_username_exist()
    {
        $post = $this->request->getPost();
        $username = $post["new_username"];
        $db = Database::connect();
        $check_user_name_exist = $this->Admin_model->check_player_username_exist(
            $username
        );

        if (!empty($check_user_name_exist)) {
            echo "false";
        } else {
            echo "true";
        }
    }

    public function add_player()
    {
        $admin_account_id = $_SESSION["user_id"];
        $admin_users_details = $this->Admin_model->get_admin_user_details(
            $admin_account_id
        );
        $data["limit_user_add"] = $admin_users_details->limit_user;
        echo view("templates/header");
        echo view("templates/sidebar");
        echo view("user/user_add", $data);
        echo view("templates/footer");
    }

    public function edit_player_details($user_id)
    {
        $data["player_details"] = $this->Admin_model->get_player_user_details(
            $user_id
        );
        echo view("templates/header");
        echo view("templates/sidebar");
        echo view("user/user_edit", $data);
        echo view("templates/footer");
    }

    public function update_players_account_details($id)
    {
        $validation = \Config\Services::validation();
        $validation->setRule("new_username", "New Username", "required|trim");
        $admin_account_id = $_SESSION["user_id"];
        if ($validation->withRequest($this->request)->run() === false) {
            return $this->dashboard();
        } else {
            $post = $this->request->getPost();
            $admin_users_details = $this->Admin_model->get_admin_user_details(
                $admin_account_id
            );
            $amout_givens = $admin_users_details->amout_given;
            $new_username = $post["new_username"];
            $new_password = md5($post["new_password"]);
            $amout_given = $post["amout_given"];
            $first_name = $post["first_name"];
            $last_name = $post["last_name"];
            $password = $post["password"];
            $player_user_details = $this->Admin_model->get_admin_user_details(
                $id
            );
            $player_current_amt = $player_user_details->amout_given;
            $player_request_amt = $amout_given - $player_current_amt;
            $amount_remaning_admin = $amout_givens - $player_request_amt;

            if (!empty($password)) {
                $password_set = $new_password;
            } else {
                $password_set = $password;
            }
            $data = [
                "username" => $new_username,
                "password" => $password_set,
                "amout_given" => $amout_given,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "role" => "user",
            ];
            $result = $this->SuperAdmin_model->update_admin_account_details(
                $id,
                $data
            );
            $session = session();
            if ($result) {
                $session->setFlashdata(
                    "success_message",
                    "players User Record Update Successfully"
                );
            } else {
                $session->setFlashdata(
                    "error_message",
                    "Player User Record Not Updated."
                );
            }

            return redirect()->to("admin/dashboard");
        }
    }

    public function create_players_account()
    {
        $validation = \Config\Services::validation();
        $validation->setRule(
            "new_username",
            "New Username",
            "required|trim|is_unique[super_admins.username]"
        );
        $validation->setRule("new_password", "New Password", "required");
        $admin_account_id = $_SESSION["user_id"];
        $admin_users_details = $this->Admin_model->get_admin_user_details(
            $admin_account_id
        );
        print_r($admin_users_details);
        die();
        if (empty($admin_users_details->current_wallet)) {
            $amout_givens = $admin_users_details->amout_given;
        } else {
            $amout_givens = $admin_users_details->current_wallet;
        }
        if ($validation->withRequest($this->request)->run() === false) {
            return $this->dashboard();
        } else {
            $post = $this->request->getPost();
            $new_username = $post["new_username"];
            $new_password = md5($post["new_password"]);
            $amout_given = $post["amout_given"];
            $first_name = $post["first_name"];
            $last_name = $post["last_name"];
            $amount_remaning_admin = $amout_givens - $amout_given;
            $data = [
                "username" => $new_username,
                "password" => $new_password,
                "amout_given" => $amout_given,
                "first_name" => $first_name,
                "last_name" => $last_name,
                "role" => "user",
                "added_by" => $admin_account_id,
            ];
            $result = $this->SuperAdmin_model->create_admin_account($data);
            $session = session();
            if ($result) {
                $session->setFlashdata(
                    "success_message",
                    "Data inserted successfully"
                );
            } else {
                $session->setFlashdata("error_message", "Data not inserted.");
            }

            return redirect()->to("admin/dashboard");
        }
    }

    public function check_player_user_add_limit()
    {
        $email = $this->input->post("candidate_email", true);
        $result = $this->M_Candidate_profile->check_if_email_exists($email);
        if ($result >= 1) {
            echo "false";
        } else {
            echo "true";
        }
    }
}
