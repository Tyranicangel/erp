<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class OfficeUser extends Model {

	public function officedata(){
		return $this->belongsTo('App\Office','office','id');
	}

}
