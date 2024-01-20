<?php
namespace App\Models;
use CodeIgniter\Model;
class Login_model extends Model 
{

public function verify_login($username, $password) 
{
        // Your database query to fetch user details based on username
        $query = $this->db->table('super_admins')
        ->where('username', $username)
        ->where('password', md5($password))
        ->where('status',1)
        ->get();
        $result = $query->getResult();
        if (count($result) == 1) 
        {
          return $result[0];
        } 
        else 
        {
            return null;
        }
}

public function update_user_status($id,$data)
{
    $builder = $this->db->table("super_admins");
    $builder->where('id',$id);
    return $builder->update($data);
}




    

}


?>