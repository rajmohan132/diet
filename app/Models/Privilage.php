<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use auth;
use App\Models\Role;
use Request;

class Privilage extends Model
{

    public function getprivilage($user_role = '', $curr_id = '')
    {

        if ($curr_id == 1) {
            $permittedmenus = Privilage::all();
            // $permittedmenus = Menu::where('id', '!=', 1)->get();
            $mnu_arr = [];
            $i = 0;
            foreach ($permittedmenus as $mnu) {
                $mnu_arr[] = $mnu->id;
                $i++;
            }
            $permittedmenus = $mnu_arr;
        } else {
            $permittedmenus = userrole::where('id', $user_role)->first();
            $permittedmenus = unserialize($permittedmenus->permitted_menus);
        }
        $menus = Privilage::where([['status', 1], ['parent', '#']])->orderBy('menu_order', 'ASC')->whereIn('id', $permittedmenus)->get();
        $menu_arr = [];
        $i = 0;
        foreach ($menus as $data) {
            $menu_arr[$i]['id'] = $data->id;
            $menu_arr[$i]['name'] = $data->name;
            $menu_arr[$i]['route'] = $data->route;
            $menu_arr[$i]['icon'] = $data->icon;
            $menu_arr[$i]['submenu'] = $this->getSubMenu($data->id, $permittedmenus);
            $menu_arr[$i]['sub_menu_active'] = $this->checkSubmenu($data->id);
            // if($menu_arr[$i]['sub_menu_active'] != null){
            //     $menu_arr[$i]['main_menu_active'] = "active";
            // }else{
            //     $menu_arr[$i]['main_menu_active'] = null;
            // }
            $i++;
        }
        return $menu_arr;
    }

    public function getSubMenu($id, $permittedmenus)
    {

        $menus = Privilage::where([['status', 1], ['parent', $id]])->whereIn('id', $permittedmenus)->get();
        $menu_arr = [];
        $i = 0;
        foreach ($menus as $data) {
            $menu_arr[$i]['id'] = $data->id;
            $menu_arr[$i]['name'] = $data->name;
            $menu_arr[$i]['route'] = $data->route;
            $i++;
        }
        return $menu_arr;
    }

    public function checkSubmenu($parent_id)
    {
        $curr_url = "/".Request::path();
        $menu = Privilage::where('parent', $parent_id)->get();
        $arr = [];
        $i = 0;
        foreach ($menu as $mnu) {
            $arr[] = $mnu->route;
            $i++;
        }

        if(in_array($curr_url,$arr)){
            return "display: block;";
        }else{
            return null;
        }
    }
}
