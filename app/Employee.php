<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    //
    protected $fillable = [
    	'name',
    	'department_id',
    	'email',
    	'job',
    	'phone',
        'photo',
    ];
    public function department(){
    	return $this->belongsTo('App\Department');
    }
}
