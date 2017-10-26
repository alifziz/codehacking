<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'role_id', 'is_active', 'password', 'photo_id',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    /**
     * Role relation
     *
     * 
     */
    public function role(){
        return $this->belongsTo('App\Role');
    }


    /**
     * Photo relation
     *
     * 
     */
    public function photo(){
        return $this->belongsTo('App\Photo');
    }


     /**
     * Check if logged i user is admin
     *
     * 
     */
     public function isAdmin(){
        if($this->role->name == 'administrator' AND $this->is_active == 1){
            return true;
        }

        return false;
     }

}
