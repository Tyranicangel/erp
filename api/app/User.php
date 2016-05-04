<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model {

	public function officedetails(){
		return $this->hasOne('App\OfficeUser','user','id');
	}

}
