<?php

namespace App\Http\Controllers;

use App\Money;
use App\Package;
use App\Typeproduct;
use App\Pay;
use Auth;
use Illuminate\Http\Request;
class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    function list() {
        $package = Package::join('tb_money', 'tb_money.package_id', '=', 'tb_package.package_id')
            ->join('tb_member', 'tb_member.mid', '=', 'tb_package.mid')
            ->select('tb_package.package_id','tb_package.package_date','tb_package.package_status',
                'tb_money.money_id', 'tb_money.money_total', 'tb_package.mid', 'tb_member.mname', 'tb_member.mlastname')
            ->where('package_status',0)->orderBy('package_date', 'desc')->get();
        return view('pages.payment.list')->with('list', $package);
    }
    public function create()
    {   
        $type = Typeproduct::get();
        return view('pages.payment.create')->with('type',$type);
    }
    public function insert(Request $r)
    {
        $package_date = date('Y/m/d', strtotime($r->input('date1')));
        $package = new Package();
        $package->package_date = $package_date;
        $package->comment = $r->input('comment');
        $package->package_status = 0;
        $package->mid = Auth::user()->mid;
        $package->save();

        $attrtype = $r->input('attrtype');
        $attrname = $r->input('attrname');
        $attrvalue = $r->input('attrvalue');
        $package1 = 0;
        for ($i = 0; $i < count($attrname); $i++) {
            if ($attrname[$i] != "" && $attrvalue[$i] != "") {
                $newattr = new Pay();
                $newattr->Payname = $attrname[$i];
                $newattr->Pay_money = $attrvalue[$i];
                $newattr->Pay_type = $attrtype[$i];
                $newattr->package_id = $package->package_id;
                $package1 += $attrvalue[$i];
                $newattr->save();
            }
        }

        $money = new Money();
        $money->money_total = $package1;
        $money->package_id = $package->package_id;
        $money->save();

        return redirect('payment/list')->with('status','Success! message sent successfully.');
    }
    public function edit(Request $r)
    {
        $type = Typeproduct::get();
        $package_data = Package::where('package_id', $r->id)->first();
        if ($package_data) {
            $attributes = Pay::where('package_id', $package_data->package_id)->get();
            $property = Money::where('package_id', $package_data->package_id)->get();

            return view(
                'pages.payment.info',
                [
                    'data' => $package_data,
                    'property' => $property,
                    'attributes' => $attributes,
                    'type' => $type,
                ]
            );
        } else {
            return redirect('payment/list');
        }
    }
    public function update(Request $r)
    {
        $packageid = $r->input('package_id');
        $comment = $r->input('comment');
        $attrtype = $r->input('attrtype');
        $attrname = $r->input('attrname');
        $attrvalue = $r->input('attrvalue');
        $package_date = date('Y/m/d', strtotime($r->input('packagedate')));

        $package = Package::find($packageid);
        $package->package_date = $package_date;
        $package->comment = $comment;
        $package->save();

        $delete_package_attr = $this->delete_package_attr($r->input('delete_package_attr'));

        for ($a = 0; $a < count($attrname); $a++) {
            if ($attrname[$a] != "" && $attrvalue[$a] != "") {
                $newattr = new Pay();
                $newattr->Payname = $attrname[$a];
                $newattr->Pay_money = $attrvalue[$a];
                $newattr->Pay_type = $attrtype[$i];
                $newattr->package_id = $package->package_id;
                $newattr->save();
            }
        }

        $attrtype = $this->update_field_attr($r->input('old_attrtype'), 'Pay_type');
        $attrname = $this->update_field_attr($r->input('old_attrname'), 'Payname');
        $attrvalue = $this->update_field_attr($r->input('old_attrvalue'), 'Pay_money');

        $newattr1 = Pay::where('package_id', $packageid)->get();

        $total = 0;
        foreach ($newattr1 as $value) {
            if (isset($value['Pay_money'])) {
                $total = $total + $value['Pay_money'];
            }
        }

        $money = Money::where('package_id', $packageid)->first();
        $money->money_total = $total;
        $money->save();

        return back()->with('status','Success! message sent successfully.');
    }
    public function destroy(Request $r)
    {
        if($r->payment_id) {
            $package = Package::where('package_id', $r->payment_id)->first();
            $package->package_status = 1;
            $package->save();
            return back()->with('status','Success! message sent successfully.');
        } else {
            return back()->with('error','Error!! sometime error.');
        }
    }

    private function delete_package_attr($string) {
        if($string!="") {
            $ids = explode(",", $string);
            if(count($ids)>0&&$ids!="") {
                $return = array();
                foreach($ids as $id) {
                    Pay::find($id)->delete();
                    $return[] = $id;
                }
    
            }
        }
    
        return null;
    }
    
    private function update_field_attr ($array , $field) {
        $return = array();
        if(count($array)>0&&$field!=null) {
            foreach($array as $arr =>$key) {
                $val = explode("-", $arr);
                if(count($val)>1) {
                    $return['update'][] = ["id"=>$val[1],"value"=>$key];
                    $p = Pay::where('Pay_id','=',$val[1])->update([$field=>$key]);
                }
            }
        }
    
        return $return;
    }
}
