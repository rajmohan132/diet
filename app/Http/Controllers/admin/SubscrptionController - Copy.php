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


        // $start = new DateTime('2023-02-11');
        // $end = new DateTime('2023-02-23');
        // $days = $start->diff($end, true)->days;
        // dd($days);
        // $fridays = intval($days / 7) + ($start->format('5') + $days % 7 >= 5);
        // dd($fridays);

        $custom_plan_id = $request->id;
        $custom_plan = Custom_plan::find($custom_plan_id);
        $from = new DateTime($custom_plan->plan_from);
        $dt = date("d-m-Y", strtotime($custom_plan->plan_from));
        $to = new DateTime($custom_plan->plan_to);
        $diff = $from->diff($to)->days;
        $menu = explode(',', $custom_plan->menu);
        $category = $custom_plan->category;
        $mnu_arr = [];
        $i=0;
        foreach($menu as $mnu){
            $mnu_arr[$i]['id'] = Menu::where('id', $mnu)->value('id');
            $category = Menu::where('id', $mnu)->value('category');
            $mnu_arr[$i]['category'] = Category::where('id', $category)->value('categoryname');
            $mnu_arr[$i]['category_id'] =  Menu::where('id', $mnu)->value('category');
            $mnu_arr[$i]['name'] = Menu::where('id', $mnu)->value('menuname');
            $mnu_arr[$i]['image'] = Menu::where('id', $mnu)->value('image');
            $i++;
        }
    //    dd($mnu_arr);
       
        for ($i = 0; $i < $diff; $i++) {
            echo
            '
           <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
                <tr style="height:50px">
                <tr>
                         <input type="hidden" value="' . $custom_plan_id . '" name="customplanid">
                         <input type="hidden" value="' . $diff . '" name="numdays">                          
                         <input type="text" name="date-' . $i . '"  value="' . $dt . '" style="
                         border-radius: 4px;
                         padding-left: 19px;
                     ">
                        &nbsp;&nbsp;</tr>';  
                            foreach ($mnu_arr as $ma) {
                                        echo
                                        '<td>
                                    
                            <div id="button" href="#" class="btn btn-outline-primary rounded iq-col-masonry-block">
                            <img src="'.asset("storage/menuimages/".$ma['image']).'" height="100px" width="100px"><br>
                            <input type="checkbox" name="' . $ma['category'] . '-' . $i . '[]" value="' . $ma['id'] . '" class="check" >' . $ma['name'] . ' 
                        
                            </div> 
                            </td>  
                        ';

                       
                                
                            }
                           
            echo    '&nbsp;&nbsp;

                </tr>
           </table>
           ';
           $dt = date('d-m-Y', strtotime($dt . ' + 1 days'));
        }
        // $date = date("d-m-Y", strtotime($custom_plan->plan_from));
        // $timestamp = strtotime($date);
        // $weekday= date("l", $timestamp );
        // $normalized_weekday = strtolower($weekday);
        // dd($normalized_weekday);
    }




    

    

    public function add_bulk_menu(Request $request)
    {
 //dd($request);
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
                "date" => $request['date-' . $d], "breakfast" => $request['BreakFast-' . $d],
                "lunch" => $request['Lunch-' . $d],"snacks" => $request['Snacks-' . $d],"dinner" => $request['Dinner-' . $d]
            ];
        }
        // var_dump($datas);die();
        $data_aray = [];
        $breakfast = "";
        $imp_data = "";
        $imp_lunch = "";
        $imp_snacks = "";
        $imp_dinner = "";
 //dd($datas);
        foreach ($datas as $data) {
            $exp_data = [];
            $lunch_exp = [];
            foreach ($data['breakfast'] as $bf) {
                $exp_data[] = $bf;
            }
            foreach ($data['lunch'] as $lh) {
                $lunch_exp[] = $lh;
               // dd($data['lunch']);
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
            $data_aray[] = ["date" => $data["date"], "breakfast" => $imp_data, "lunch" => $imp_lunch,"snacks" => $imp_snacks,"dinner" => $imp_dinner];
        }

        $custom_plan->menu = json_encode($data_aray);
        $custom_plan->update();

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
        // dd($custom_plan->menu);
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
        // dd($jd);
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
            $dn_names = [];
            $sn_names = [];
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
                foreach ($menu as $menn) {
                    if ($s == $menn->id) {
                        $sn_name[] = $menn->menuname;
                    }
                }
            }

            foreach ($dn_array as $d) {
                foreach ($menu as $menn) {
                    if ($d == $menn->id) {
                        $dn_name[] = $menn->menuname;
                    }
                }
            }
            $bf_names = implode(",", $bf_name);
            $lh_names = implode(",", $lh_name);
            $sn_names = implode(",", $sn_name);
            $dn_names = implode(",", $dn_name);



            $final_array[] = ["date" => $cpm->date, "breakfast" => $bf_names, "lunch" => $lh_names,"snacks" => $sn_names,"dinner" => $dn_names];
        }

        return view('food_list', ['customPlan' => $custom_plan, "food" => $final_array]);
    }

    public function food_list_ajax(Request $request)
    {
        $cid = $request['cid'];
        $custom_plan = Custom_plan::find($id);
        echo json_encode($custom_plan);
    }




//     public function find_custom_plan_OLD(Request $request)
//     {

//         $meal_list = Category::All();
//         $menu_list = Menu::All();
//         $custom_plan_id = $request->id;
//         $custom_plan = Custom_plan::find($custom_plan_id);
//         $from = date("d-m-Y", strtotime($custom_plan->plan_from));

//         $meal_types = $custom_plan->category;
//         $meal_type_array = explode(",", $meal_types);
//         $count_meal_type = count($meal_type_array);

//         $category_meal_menu =   Product::where('plan', '=', $custom_plan->plan)
//             ->where('subplan', '=', $custom_plan->subplan)
//             ->where('category', '=', $custom_plan->category)
//             ->get();


//         $menu_array = explode(",", $category_meal_menu[0]->menu);

//         $m_t_options = "";
//         $menu_options = "";
//         $total_data = [];


//         $date_from = strtotime($custom_plan->plan_from);

//         $date_to = strtotime($custom_plan->plan_to);
//         $diff = $date_to - $date_from;
//         $days =  round($diff / 86400);

//         // echo date('Y-m-d', strtotime($custom_plan->plan_from. ' + 1 days'));

//         $dt = date("d-m-Y", strtotime($custom_plan->plan_from));
//         $meal_types = '';


//         $total_data = $dt . $m_t_options . $menu_options;

//         for ($i = 0; $i < $days; $i++) {

//             echo
//             '
//            <table id="user-list-table" class="table table-striped" role="grid" data-toggle="data-table">
//                 <tr style="height:50px">
//                     <td>
//                          <input type="hidden" value="' . $days . '" name="numdays">  
//                          <input type="hidden" value="' . $custom_plan_id . '" name="customplanid">
//                         <input type="text" name="date-' . $i . '"  value="' . $dt . '">
//                         &nbsp;&nbsp;</td>';


//             for ($r = 0; $r < $count_meal_type - 1; $r++) {
//                 foreach ($meal_type_array as $mta) {

//                     foreach ($meal_list as $ml) {
//                         if ($ml->id == $mta) {
//                             echo
//                             '   <td>
//                             <label for="vehicle1">' . $ml->categoryname . '</label><hr>
                            
//                             </td>
                           
//                             ';
//                             foreach ($menu_array as $ma) {

//                                 foreach ($menu_list as $mnl) {
//                                     if ($mnl->id == $ma) {
//                                         echo
//                                         '
//                             <div id="button" href="#" class="btn btn-outline-primary rounded iq-col-masonry-block">
//                             <input type="checkbox" name="' . $ml->categoryname . '-' . $i . '[]" value="' . $mnl->id . '" class="check" >' . $mnl->menuname . ' </div>
                            
//                         ';
//                                     }
//                                 }
//                             }

//                             echo '                            
//                             </select>

//                         ';
//                         }
//                     }
//                 }
//             }

//             echo    '&nbsp;&nbsp;

//                 </tr>
//            </table>
            
//            ';

//             $dt = date('d-m-Y', strtotime($dt . ' + 1 days'));
//         }
//     }




    
// }

}
