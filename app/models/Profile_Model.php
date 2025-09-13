<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: Proile_Model
 * 
 * Automatically generated via CLI.
 */
class Profile_Model extends Model {
    protected $table = 'profile';
    protected $primary_key = 'id';

    protected $fillable = [
        'user_id', 'phone', 'address', 'birthday', 'gender', 'course',
        'emergency_contact', 'about', 'facebook', 'linkedin', 'github', 'profile_pic'
    ];


    // public function profile($id){
    //   return  $this->has_one('User_Model', 'user_id', $id);
    // }    

       public function getForeignId($user_id) {
        return $this->db->table($this->table)
                  ->where('user_id', $user_id)
                  ->get();
    }

    public function findByUserId($user_id) {
    return $this->db->table($this->table)
              ->where('user_id', $user_id)
              ->get();
              
}

    
}