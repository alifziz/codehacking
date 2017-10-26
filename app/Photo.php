<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
	/**
     * Directory name
     *
     * 
     */
	protected $uploads = '/images/';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'file', 
    ];


    /**
     * Create accessor with photos table column name file
     *
     * @var array
     */
    public function getFileAttribute($value){	
    	return $this->uploads.$value;
    }


    
    
}
