<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pay extends Model
{
	protected $table = "tb_pay";

	protected $primaryKey = "Pay_id";

	protected $fillable = [
	'Payname',
	'Pay_money',
	'package_id'];
}
