<?php

namespace App\Models;
use CodeIgniter\Model;

class SuperAdmin_model extends Model {
    protected $table = 'super_admins';     

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

    public function update_request_superadmin_balance_amount_for_admin($request_id,$para)
    {
        $builder = $this->db->table("tbl_admin_request_balace_super_admin");
        $builder->where('request_id',$request_id);
        return $builder->update($para);
    }

    public function admin_get_request_balance_amount_by_request_id($request_id)
    {
        $query = $this->db->table('tbl_admin_request_balace_super_admin')
        ->getWhere(['request_id' => $request_id]);
        return $query->getRow();
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

    public function request_balance_amount_admin()
    {
      $builder = $this->db->table("tbl_admin_request_balace_super_admin");
      $query = $builder->join('super_admins', 'super_admins.id = tbl_admin_request_balace_super_admin.admin_id')->get(); 
      //$query = $builder->where('admin_id', $admin_id)->get();    
      return $query->getResult(); // or $query->getResultArray()
    }

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

/*public function get_all_player_users_list($user_id)
{
    return $query->getResult(); 
}*/


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

public function get_all_player_users_list()
{
    $builder = $this->db->table("super_admins");  
   /* $builder->where('status', '1'); */
    $query = $builder->where('role', 'user')->get();
    return $query->getResult(); // or $query->getResultArray()
}


}

