<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
    		'name',
    		'office_number',
    		'manager',
    ];

    public function employees(){
    	return $this->hasMany('App\Employee');
    }
}
