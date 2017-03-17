<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Util;
use Illuminate\Support\Facades\Input;
use DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;

class Role extends Model
{
    protected $name = '';
    protected $controller = '';
    
    /**
     * @Auth: Dienct
     * @Des: Get allsearch role group
     * @Since: 16/03/2017
     */
    public function a_GetAllRoleGroupSearch(&$a_Result = array()){
        $a_Field = array('id','name','status','created_at','updated_at');
        
        $a_data = array();
        $o_Db = DB::table('rolegroups')->select($a_Field);
        $a_search = array();
        $i_search_status = Input::get('search_status','');
        $sz_search_field = Input::get('search_field','');
        
        if($i_search_status != '') {
            $a_search['search_status'] = $i_search_status;
            $a_data = $o_Db->where('status', $i_search_status);
        }
        if($sz_search_field != '') {
            $a_search['search_field'] = $sz_search_field;
            $a_data = $o_Db->where('name', 'like', '%'.$sz_search_field.'%');
        }
        $a_data = $o_Db->get();
        foreach($a_data as $key =>&$val){
                $val->stt = $key + 1;
                $val->created_at = Util::sz_DateTimeFormat($val->created_at);
                $val->updated_at = Util::sz_DateTimeFormat($val->updated_at);
        }
        $a_return = array('a_data' => $a_data, 'a_search' => $a_search);
        return $a_return;
    }
    
    /**
     * @Auth: Dienct
     * @Des: Add edit Role
     * @Since: 13/1/2016
     */
    public function AddEditRole($i_RoleGroup_id){

        // delete all role by rolegroup
        DB::table('roles')->where('rolegroup_id', '=', $i_RoleGroup_id)->delete();
        
        $a_DataUpdate =  Input::all();
        
        unset($a_DataUpdate["_token"]);
        unset($a_DataUpdate["submit"]);
        unset($a_DataUpdate["id"]);
        
        foreach($a_DataUpdate as $keyController =>$a_val){
            foreach($a_val as $keyAction => $szVal){
                $a_DataInsert['rolegroup_id'] = $i_RoleGroup_id;
                $a_DataInsert['controller'] = $keyController;
                $a_DataInsert['action'] = $keyAction;
                $a_DataInsert['created_at'] = date('Y-m-d H:i:s',time());
                $a_DataInsert['updated_at'] = date('Y-m-d H:i:s',time());
                DB::table('roles')->insert($a_DataInsert);
            }
        }

    }
    /**
     * @Auth: Dienct
     * @Des: Get all role by role_group_id
     * @Since: 12/1/2016
     */
    public function a_GetAllRoleByRoleGroupIDFilter($i_RoleGroupId){
        if(isset($i_RoleGroupId) && $i_RoleGroupId > 0) {
            $a_DataRole = array();
            $a_DataRole = DB::table('roles')->select('controller','action')->where('rolegroup_id', $i_RoleGroupId)->get();
            
            $arrayReturn = array();
            if(count($a_DataRole) > 0){
                foreach($a_DataRole as $key=>$val){
                    if(!isset($arrayReturn[$val->controller]))
                    {
                        $arrayReturn[$val->controller] = array();
                    }
                    if(!isset($arrayReturn[$val->controller][$val->action]))
                    {
                        $arrayReturn[$val->controller][] = $val->action;
                    }
                }
            }
            return $arrayReturn;
        }
    }
    
}
