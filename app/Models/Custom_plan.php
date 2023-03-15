<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Plan;
use App\Models\SubPlan;
use App\Models\Customer;

class Custom_plan extends Model
{
    use HasFactory;

    protected $table = 'customer_plans';

    protected $fillable = [
        'customer',
        'plan',
        'subplan',
        'category',
        'menu',
        'plan_from',
        'plan_to',
        'status',


    ];

    public function get_subscription($id)
    {
        $data = Custom_plan::where('customer', $id)->get();
        if($data->isEmpty()){
            return null;
        }
        $arr = [];
        $i = 0;
        foreach ($data as $dta) {
            $arr[$i]['customer_name'] = Customer::where('id', $dta->customer)->value('firstname');
            $arr[$i]['plan'] = Plan::where('id', $dta->plan)->value('planname');
            $arr[$i]['calorie_plan'] = Plan::where('id', $dta->subplan)->value('planname');
            $arr[$i]['amount'] = $dta->price;
            $arr[$i]['start_date'] = $dta->plan_from;
            $arr[$i]['end_date'] = $dta->plan_to;
            
            $arr[$i]['status'] = $dta->status;
            $i++;
        }
        return $arr;
    }
    public function name()
    {
        return $this->belongsTo(Customer::class,'customer');
    }
    public function subname()
    {
        return $this->belongsTo(Plan::class,'plan');
    }
    public function splan()
    {
        return $this->belongsTo(SubPlan::class,'subplan');
    }
}
