<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Menu;
use App\Models\Category;
use App\Models\Plan;
use App\Models\SubPlan;
use App\Models\Product;
use App\Models\Custom_plan;
use DateTime;
use Carbon\Carbon;


class SubscrptionController extends Controller
{
    //
    public function index()
    {

        $custom_plan =   Custom_plan::join('customers', 'customer_plans.customer', '=', 'customers.id')
            ->join('plans', 'customer_plans.plan', '=', 'plans.id')
            ->join('sub_plans', 'customer_plans.subplan', '=', 'sub_plans.id')
            ->select('*')
            ->selectRaw('plans.planname as pname , sub_plans.splanname as splan, customer_plans.id as cid ')
            ->where('customer_plans.status', 1)
            ->orderBy('cid', 'DESC')
            ->get();

        return view('viewsubscrption-list', ['custom_plan' => $custom_plan]);
    }
    public function create()
    {
        return view('viewsubscrption-list');
    }

    public function find_custom_plan(Request $request)
    {

        // $start = new DateTime('2023-03-14');
        // $end = new DateTime('2023-03-20');
        // $days = $start->diff($end, true)->days;        
        // $fridays = intval($days / 7) + ($start->format('5') + $days % 7 >= 5);
        // dd($fridays);

        $custom_plan_id = $request->id;
        $custom_plan = Custom_plan::find($custom_plan_id);
        $from = new DateTime($custom_plan->plan_from);
        $dt = date("d-m-Y", strtotime($custom_plan->plan_from));
        $to = new DateTime($custom_plan->plan_to);

        $fridays = [];
        $startDate = Carbon::parse($custom_plan->plan_from)->next(Carbon::FRIDAY);
        $endDate = Carbon::parse($custom_plan->plan_to);
        for ($date = $startDate; $date->lte($endDate); $date->addWeek()) {
            $fridays[] = $date->format('Y-m-d');
        }
        $num = count($fridays);
        // dd($num);

        $diff = $from->diff($to)->days - $num;
        // dd($diff);
        $menu = explode(',', $custom_plan->menu);
        $category = explode(',', $custom_plan->category);
        $mnu_arr = [];
        $i=0;
        foreach($menu as $mnu){
            $mnu_arr[$i]['id'] = Menu::where('id', $mnu)->value('id');
            $category = Menu::where('id', $mnu)->value('category');
            $mnu_arr[$i]['category'] = Category::where('id', $category)->value('categoryname');
            $mnu_arr[$i]['category_code'] = Category::where('id', $category)->value('categorycode');
            $mnu_arr[$i]['category_id'] =  Menu::where('id', $mnu)->value('category');
            $mnu_arr[$i]['name'] = Menu::where('id', $mnu)->value('menuname');
            $mnu_arr[$i]['image'] = Menu::where('id', $mnu)->value('image');
            $i++;
        }
    //    dd($mnu_arr);
       
        for ($i = 0; $i < $diff; $i++) {
            echo
            '
           <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table" style="
           font-size: 13px;
       ">
                <tr style="height:50px">
                <td>
                         <input type="hidden" value="' . $custom_plan_id . '" name="customplanid">
                         <input type="hidden" value="' . $diff . '" name="numdays">                          
                         <input type="text" name="date-' . $i . '"  value="' . $dt . '">
                        &nbsp;&nbsp;</td>';  
                            foreach ($mnu_arr as $ma) {
                                        echo
                                        '<td>'.
                                     
                            '<div id="button" href="#" class="btn btn-outline-primary rounded iq-col-masonry-block">
                           
                            <input type="checkbox" name="' . $ma['category_code'] . '-' . $i . '[]" value="' . $ma['id'] . '" class="check" >' . $ma['name'] . ' 
                            <img src="'.asset("storage/menuimages/".$ma['image']).'" height="20px" width="20px">
                            </div>'.
                            '</td>  
                        ';

                       
                                
                            }
                           
            echo    '&nbsp;&nbsp;

                </tr>
           </table>
           ';
           
           $dt = date('d-m-Y', strtotime($dt . ' + 1 days'));
           $day = new DateTime($dt);
           $day = $day->format('l');
           if($day == "Friday"){
            $dt = date('d-m-Y', strtotime($dt . ' + 1 days'));
           }

        }
        // $date = date("d-m-Y", strtotime($custom_plan->plan_from));
        // $timestamp = strtotime($date);
        // $weekday= date("l", $timestamp );
        // $normalized_weekday = strtolower($weekday);
        // dd($normalized_weekday);
    }

    public function add_bulk_menu(Request $request)
    {
    // dd($request);
        $days = $request['numdays'];
        $cid = $request['customplanid'];
        $custom_plan = Custom_plan::find($cid);
        $categories = Category::All();
        $categories_aray = explode(",", $custom_plan->category);

        $datas = array();
        $category_list = [];
        $category_list[] = "date";
        foreach ($categories as $category) {
            foreach ($categories_aray as $cat) {
                if ($cat == $category->id) {
                    $category_list[] = $category->categoryname;
                }
            }
        }
        for ($d = 0; $d < $days; $d++) {
            // foreach($category_list  as $cl){
            //      $datas[$cl] = $request[$cl."-".$d];
            // }
            $datas[] = [
                "date" => $request['date-' . $d], "breakfast" => $request['CG0001-' . $d],
                "lunch" => $request['CG0002-' . $d], "snacks" => $request['CG0003-' . $d], "dinner" => $request['CG0004-' . $d]
            ];
        }
        // var_dump($datas);die();
        $data_aray = [];
        $breakfast = "";
        $imp_data = "";
        $imp_lunch = "";
        $imp_snacks = "";
        $imp_dinner = "";
        // dd($datas);
        
        foreach ($datas as $data) {
            $exp_data = [];
            $lunch_exp = [];
            $snacks_exp = [];
            $dinner_exp = [];
            foreach ($data['breakfast'] as $bf) {
                $exp_data[] = $bf;
            }
            foreach ($data['lunch'] as $lh) {
                $lunch_exp[] = $lh;
            }
            foreach ($data['snacks'] as $sn) {
                $snacks_exp[] = $sn;
            }
            foreach ($data['dinner'] as $dn) {
                $dinner_exp[] = $dn;
            }
            $imp_data = implode(",", $exp_data);
            $imp_lunch = implode(",", $lunch_exp);
            $imp_snacks = implode(",", $snacks_exp);
            $imp_dinner = implode(",", $dinner_exp);
            $data_aray[] = ["date" => $data["date"], "breakfast" => $imp_data, "lunch" => $imp_lunch, "snacks" => $imp_snacks, "dinner" => $imp_dinner];
        }
        // dd($data_aray[]);

        $custom_plan->menu = json_encode($data_aray);
        $res = $custom_plan->update();
        if($res){
            $custom_plan->assign_status = 1;
            $custom_plan->update();
        }

        return redirect()->route('addcustom-plan')
            ->with('success', 'Food assigned successfully.');
    }

    public function view_custom_plan()
    {

        $custom_plans = Custom_plan::find(9);
        $cp = $custom_plans['menu'];
        $c = json_decode($cp);
        foreach ($c as $c) {
            echo $c->date . "&nbsp;&nbsp;category" . $c->breakfast . "&nbsp;&nbsp;Food" . $c->lunch;
        }
    }

    public function food_list($id)
    {
        $custom_plan = Custom_plan::find($id);
        $category = Category::All();
        $menu = Menu::All();
        $jd = json_decode($custom_plan->menu);
        $bf = "";
        $lh = "";
        $sn = "";
        $dn = "";
        $bf_array = "";
        $lh_array = "";
        $sn_array = "";
        $dn_array = "";
        $final_array = [];
        foreach ($jd as $cpm) {

            $bf = $cpm->breakfast;
            $lh = $cpm->lunch;
            $sn = $cpm->snacks;
            $dn = $cpm->dinner;
            $bf_name = [];
            $lh_name = [];
            $sn_name = [];
            $dn_name = [];
            $bf_names = [];
            $lh_names = [];
            $sn_names = [];
            $dn_names = [];
            $bf_array = explode(",", $bf);
            $lh_array = explode(",", $lh);
            $sn_array = explode(",", $sn);
            $dn_array = explode(",", $dn);
            foreach ($bf_array as $b) {
                foreach ($menu as $men) {
                    if ($men->id == $b) {
                        $bf_name[] = $men->menuname;
                    }
                }
            }

            foreach ($lh_array as $l) {
                foreach ($menu as $menn) {
                    if ($l == $menn->id) {
                        $lh_name[] = $menn->menuname;
                    }
                }
            }

            foreach ($sn_array as $s) {
                foreach ($menu as $mennn) {
                    if ($s == $mennn->id) {
                        $sn_name[] = $mennn->menuname;
                    }
                }
            }

            foreach ($dn_array as $d) {
                foreach ($menu as $mennnn) {
                    if ($d == $mennnn->id) {
                        $dn_name[] = $mennnn->menuname;
                    }
                }
            }
            $bf_names = implode(",", $bf_name);
            $lh_names = implode(",", $lh_name);
            $sn_names = implode(",", $sn_name);
            $dn_names = implode(",", $dn_name);

            $final_array[] = ["date" => $cpm->date, "breakfast" => $bf_names, "lunch" => $lh_names, "snacks" => $sn_names, "dinner" => $dn_names];
        }
        return view('food_list', ['customPlan' => $custom_plan, "food" => $final_array]);
    }

    public function food_list_ajax(Request $request)
    {
        $cid = $request['cid'];
        $custom_plan = Custom_plan::find($id);
        echo json_encode($custom_plan);
    }





    
}
