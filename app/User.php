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
    /*public function photo(){
        return $this->belongsTo('App\Photo');
    }*/

}
