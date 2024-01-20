<?php
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\SuperAdmin_model;

class SuperAdmin extends Controller {
    protected $SuperAdminModel;
    protected $session;
    public function __construct() {
        
        $this->SuperAdminModel = new \App\Models\SuperAdmin_model();
        $this->session = \Config\Services::session();
        // helper(['form', 'url']); 
        $this->SuperAdmin_model = new SuperAdmin_model();

    }

    public function index() {
        return view('super_admin/login');
    }

    public function login() {
        $username = $this->request->getPost('username');
        $password = $this->request->getPost('password');        
        $super_admin = $this->SuperAdminModel->verify_login($username, $password);   

        
        // print_r($super_admin); die();
        if (!empty($super_admin)) {            
            $this->session->set('user_id', $super_admin->id);
            $this->session->set('role', $super_admin->role);
            $this->session->set('role', $super_admin->role);
            $this->session->set('username', $super_admin->first_name." ".$super_admin->last_name);
            if($super_admin->role=="super-admin")
            {
                return redirect()->route('superadmin/dashboard');            
            }
            elseif($super_admin->role=="admin")
            {
               
                return redirect()->route('admin/dashboard');  
            }

            elseif($super_admin->role=="user")
            {
                return redirect()->route('superadmin/dashboard');  
            }
            
        } else {
            
            return view('super_admin/login', ['error' => 'Invalid username or password']);
        }
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

    public function dashboard() {

        $data['admins'] = $this->SuperAdminModel->get_all_admins();
        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('super_admin/dashboard', $data); 
        echo view('templates/footer');             
        //return view('super_admin/dashboard', $data);
    }
    public function user_dashboard() {
        $data['users'] = $this->SuperAdminModel->get_all_users();

        echo view('templates/header', $data);
        
        echo view('templates/footer');        
    }
    
    // public function Logout()
    // {
    //     $this->session->sess_destroy();
    //     redirect('superadmin');
    // }
    public function Logout()
    {
        $this->session->destroy();
        return redirect()->to('superadmin');
    }
  
    public function create_account_from_dashboard()
    {
        $validation = \Config\Services::validation();
        $validation->setRule('new_username', 'New Username', 'required|trim|is_unique[super_admins.username]');
        $validation->setRule('new_password', 'New Password', 'required');
    
        if ($validation->withRequest($this->request)->run() === FALSE) {
            return $this->dashboard();
        } else {
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
                'role'         => 'admin'
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



    public function update_account_details_admin($id) {
            
            $validation = \Config\Services::validation();
            $validation->setRule('new_username', 'New Username', 'required|trim');    
          
            if ($validation->withRequest($this->request)->run() === FALSE) 
            {                    
             return $this->dashboard();

            } 
            else 
            {                 
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
                'role'         => 'admin'
            ];           
            $result = $this->SuperAdmin_model->update_admin_account_details($id,$data);
            $session = session();
            if($result)
            {
               $session->setFlashdata('success_message', 'Admin Record Update Successfully');
            }
            else
            {
              $session->setFlashdata('error_message', 'Admin Record Not Updated.');  
            }
    
            return redirect()->to('superadmin/dashboard');
        }
    }


    public function create_account() {
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
            // if ($this->SuperAdmin_model->usernameExists($new_username)) {
            //     // Set flashdata for alert
            //     $this->session->setFlashdata('alert', 'Username already exists. Choose a different username.');
            //     return $this->dashboard();
            // }
    
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
    public function login_as_user($user_id) {
        $user = $this->SuperAdminModel->get_user_by_id($user_id);

        if ($user) {
            $this->session->set('user', $user);
            return redirect()->to('user/home');
        } else {
            return redirect()->to('superadmin/dashboard');
        }
    }
    public function history()
    {
        $data['history'] = $this->SuperAdmin_model->get_user_history();

        echo view('templates/header', $data);
        echo view('templates/sidebar', $data);
        echo view('super_admin/history', $data);
        echo view('templates/footer');
    }
    public function setting()
    {
        $data['setting'] = $this->SuperAdmin_model->get_user_setting();

        return view('super_admin/setting', $data);
    }
public function change_password()
{
    $userRole = $this->session->get('role');

    if ($userRole !== 'super-admin') {
        return redirect()->to('superadmin/dashboard')->with('error', 'You do not have the authority to change the password.');
    }
    echo view('templates/header');
    echo view('templates/sidebar');
    return view('super_admin/change_password');
    echo view('templates/footer');
}

public function profile()
{
    $superAdminId = $this->session->get('user_id');
    $superAdminDetails = $this->SuperAdminModel->get_admin_user_details($superAdminId);

    $data['superAdminDetails'] = $superAdminDetails;
    return view('super_admin/profile', $data);
}

public function update_profile()
{
    $superAdminId = $this->session->get('user_id');
    $superAdminDetails = $this->SuperAdminModel->get_admin_user_details($superAdminId);

    // Validate form inputs
    $validationRules = [
        'first_name' => 'required',
        'last_name'  => 'required',
        'image'      => 'uploaded[image]|max_size[image,1024]|mime_in[image,image/jpg,image/jpeg,image/png]',
    ];

    if (!$this->validate($validationRules)) {
        // Validation failed, return to the profile page with errors
        return redirect()->to('superadmin/profile')->withInput()->with('validation', $this->validator);
    }

    // Handle image upload
    $image = $this->request->getFile('image');
    if ($image->isValid() && !$image->hasMoved()) {
        $newImageName = $superAdminId . '_' . time() . '.' . $image->getExtension();
        $image->move(ROOTPATH . 'public/uploads/profile', $newImageName);

        // Update the database with the new image name
        $this->SuperAdminModel->update_profile_image($superAdminId, $newImageName);
    }

    // Update other profile details
    $data = [
        'first_name' => $this->request->getPost('first_name'),
        'last_name'  => $this->request->getPost('last_name'),
    ];

    $this->SuperAdminModel->update_admin_account_details($superAdminId, $data);

    return redirect()->to('superadmin/profile')->with('success_message', 'Profile updated successfully');
}

}
