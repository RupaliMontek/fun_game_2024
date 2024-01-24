<?php

namespace App\Models;
use CodeIgniter\Model;
class Notification_model extends Model 
{  
 protected $table = 'notification';
 public function notification_insert($data)
  {
    $this->db->table('notification')->insert($data);
    $lastInsertId = $this->db->insertID();
    return $lastInsertId;
  } 

  public function check_list_admin_user_admin_request_superadmin($admin_id)
  {
  	$builder = $this->db->table("notification");
    $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
    $builder->join('tbl_admin_request_balace_super_admin', 'tbl_admin_request_balace_super_admin.request_id = notification.request_id');
    $builder->where('notification_title', "Balance Amount Extends Request Send Superadmin");
    $builder->where('notification_type', "extend request balance amount");
    $builder->where('notification.notification_status','0');
    $query = $builder->where('notification_to_id', $admin_id)->get();    
    return $query->getRow(); // or $query->getResultArray()
  }

  public function superadmin_amount_change_request_status_change($admin_id)
  {
    $builder = $this->db->table("notification");
    $builder->join('super_admins', 'super_admins.id = notification.notification_from_id');
    $builder->join('tbl_admin_request_balace_super_admin', 'tbl_admin_request_balace_super_admin.request_id = notification.request_id');
    $builder->where('notification_title', "Superadmin Change Balance Amount Request Status");
    $builder->where('notification_type', "Superadmin Change Balance Request Status");
    $builder->where('notification.notification_status','0');
    $query = $builder->where('notification_to_id', $admin_id)->get();    
    return $query->getRow(); // or $query->getResultArray()
  }

  public function view_notification($notificaton_id,$data)
  {
  	    $builder = $this->db->table("notification");
        $builder->where('notification_id',$notificaton_id);
        return $builder->update($data);	
  }




}
?>