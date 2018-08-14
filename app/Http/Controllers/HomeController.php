<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Money;
use App\Package;
use App\Typeproduct;
use App\Pay;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        $package = Package::join('tb_money', 'tb_money.package_id', '=', 'tb_package.package_id')
            ->join('tb_member', 'tb_member.mid', '=', 'tb_package.mid')
            ->select('tb_package.package_id','tb_package.package_date','tb_package.package_status',
                'tb_money.money_id', 'tb_money.money_total', 'tb_package.mid', 'tb_member.mname', 'tb_member.mlastname')
            ->where('package_status',0)
            ->whereMonth('package_date', '=', date('m'))
            ->orderBy('package_date', 'desc')->get();
        
            foreach ($package as $key) {
                $date_start = Carbon::parse($key['package_date']);
                $return[] = array($date_start->format('d/m/Y'),$key['money_total']
                );
            }
        // return $return;
        return view('welcome')->with('list',json_encode($return,JSON_NUMERIC_CHECK));
    }

    
}
