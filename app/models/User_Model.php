<?php
defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed');

/**
 * Model: User_Model
 * 
 * Automatically generated via CLI.
 */

class User_Model extends Model {
    protected $table = 'userss';
    protected $primary_key = 'id';

    //mass assignment, gagamitin na sa lahat
    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password'
    ];
    


    public function getAll($q, $records_per_page = null, $page = null){
        if(is_null($page)){
             return $this->db->table($this->table)->get_all();
        } else {
            $query = $this->db->table($this->table);

            $query->like('id', '%'.$q. '%')
                ->or_like('first_name', '%'.$q. '%')
                ->or_like('last_name', '%'.$q. '%')
                ->or_like('username', '%'.$q. '%')
                ->or_like('email', '%'.$q. '%');

                $countQuery = clone $query;

            // Count total rows (for pagination)
            $data['total_rows'] = $countQuery->select_count('*', 'count')
                                            ->get()['count'];

            // Get paginated records
            $data['records'] = $query->pagination($records_per_page, $page)
                                    ->get_all();

            return $data;
                
        }
       

    }

    
  
    public function getByEmail($email){
        return $this->db->table($this->table)
                        ->where('email', $email)
                        ->get();
    }

        public function getByUsername($username){
        return $this->db->table($this->table)
                        ->where('username', $username)
                        ->get();
    }



}