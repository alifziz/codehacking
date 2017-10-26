<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'category_id', 'photo_id', 'title', 'body',
    ];


    /**
     * Relation with user
     *
     * @var array
     */
    public function user(){
    	return $this->belongsTo('App\User');
    }

    /**
     * Relation with category
     *
     * @var array
     */
    /*public function category(){
    	return $this->belongsTo('App\Category');
    }
*/

    /**
     * Relation with photo
     *
     * @var array
     */
    public function photo(){
    	return $this->belongsTo('App\Photo');
    }

}
