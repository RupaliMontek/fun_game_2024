<?php

namespace App\Models;
use CodeIgniter\Model;

class SuperAdmin_model extends Model {
    protected $table = 'super_admins'; 

    public function verify_login($username, $password) {
        // Your database query to fetch user details based on username
        $query = $this->db->table('super_admins')
                          ->where('username', $username)
                          ->where('password', md5($password))
                          ->get();
                          $result = $query->getResult();

                          if (count($result) == 1) {
                              return $result[0];
                          } else {
                              return null;
                          }
    }

    public function update_admin_account_details($id,$data)
    {
        $builder = $this->db->table("super_admins");
        $builder->where('id',$id);
        return $builder->update($data);
    }

    public function get_admin_user_details($id)
    {
         $query = $this->db->table('super_admins')->getWhere(['id' => $id]);
         return $superAdmin = $query->getRow();
    }    


    public function create_admin_account($data) {
        $this->db->table('super_admins')->insert($data);
    }
    public function usernameExists($username)
    {
        $query = $this->db->table('super_admins')->where('username', $username)->get();
        return ($query->getNumRows() > 0);
    }

    // public function get_admin_by_id($admin_id)
    // {
    //     $query = $this->db->table('super_admins')->where(['id' => $admin_id])->get();

    //     return $query->first();
    // }
    // public function get_admin_by_id($admin_id)
    // {
    //     return $this->where('id', $admin_id)->first();
    // }
    public function get_admin_by_id(int $admin_id): ?object
    {
        $query = $this->db->table('super_admins')->getWhere(['id' => $admin_id]);
    
        // Check if the result is not empty before returning
        return ($query->getNumRows() > 0) ? $query->getRow() : null;
    }

    public function get_all_admins() 
    {        
        $builder = $this->db->table("super_admins");      
        $query= $builder->where('role','admin')->get();;
        return $query->getResult();
    }

public function get_all_player_users_list($user_id)
{
    $builder = $this->db->table("super_admins");
    $builder->where('added_by', $user_id);
    $query = $builder->where('role', 'user')->get();
    return $query->getResult(); // or $query->getResultArray()
}


    public function create_user_account($data)
{
    $this->db->table('super_admins')->insert($data);
}
public function get_all_users() {
    $query = $this->db->table('super_admins')->get();
    return $query->getResult();
}

public function get_user_by_id(int $user_id): ?object
    {
    $query = $this->db->table('super_admins')->getWhere(['id' => $user_id]);
    
        // Check if the result is not empty before returning
        return ($query->getNumRows() > 0) ? $query->getRow() : null;
    }
}

