<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Money extends Model
{
	protected $table = "tb_money";

	protected $primaryKey = "money_id";

	protected $fillable = [
	
	'package_id'
	
	
	];

	
}
