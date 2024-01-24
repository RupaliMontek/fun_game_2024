<?php

namespace App\Models;
use CodeIgniter\Model;
class Admin_model extends Model 
{
  protected $table = 'super_admins'; 
  
  public function get_admin_user_details($id)
    {
         $query = $this->db->table('super_admins')->getWhere(['id' => $id]);
         return $superAdmin = $query->getRow();
    }   

  public function send_balance_request_superadmin($data)
  {
    $this->db->table('tbl_admin_request_balace_super_admin')->insert($data);
    $lastInsertId = $this->db->insertID();
    return $lastInsertId;
  }  

  public function update_admin_account_details($id,$data)
  {
        $builder = $this->db->table("super_admins");
        $builder->where('id',$id);
        return $builder->update($data);
  }
  public function get_all_balanceamout_request_send_superadmin($admin_id)
  {
    $builder = $this->db->table("tbl_admin_request_balace_super_admin");
    $builder->join('super_admins', 'super_admins.id = tbl_admin_request_balace_super_admin.superadmin_id');
    $query = $builder->where('admin_id', $admin_id)->get();    
    return $query->getResult(); // or $query->getResultArray()
  }  

    public function get_player_user_details($user_id)
    {
        $query = $this->db->table('super_admins')->getWhere(['id' => $user_id]);
        return $superAdmin = $query->getRow();   
    }    

    /*public function check_player_username_exist($username)
    {
      $query = $this->db->table('super_admins')->getWhere(['username' => $username]);
      $result = $query->getResult();
      return count($result);
    }*/

    public function check_player_username_exist($username)
    {
      $query = $this->db->table('super_admins')->getWhere(['username' => $username]);
      return $result =  $query->getRow();      
    }

  }
?>