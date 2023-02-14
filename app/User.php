<?php

namespace App;

use System\Database\ORM\Model;

class User extends Model
{

    protected $table = "users";
    protected $fillable = ['email', 'first_name', 'last_name', 'avatar', 'status', 'is_active', 'password', 'verify_token', 'user_type', 'remember_token', 'remember_token_expire'];
    protected $deletedAt = 'deleted_at';
    
    public function roles(){
        return $this->belongsToMany('\App\Role', 'user_role', 'id', 'user_id', 'role_id', 'id');
    }

    public function category(){
        return $this->belongsTo('\App\Category','parent_id','id');
    }


}