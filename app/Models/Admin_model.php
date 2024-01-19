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


  public function update_admin_account_details($id,$data)
    {
        $builder = $this->db->table("super_admins");
        $builder->where('id',$id);
        return $builder->update($data);
    }

    public function get_player_user_details($user_id)
    {
        $query = $this->db->table('super_admins')->getWhere(['id' => $user_id]);
        return $superAdmin = $query->getRow();   
    }    


}
?>