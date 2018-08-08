<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
	protected $table = "tb_package";

	protected $primaryKey = "package_id";

	protected $fillable = [
	
	'package_id'
	];
}

