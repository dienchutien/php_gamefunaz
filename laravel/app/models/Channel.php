<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Util;
use DB;
use Illuminate\Support\Facades\Input;
use App\User;
use Illuminate\Support\Facades\Auth;

class Channel extends Model
{
    private $o_User;
    
    public function __construct() {
        $this->o_User = new User();
    }
    /**
     * @Auth: Dienct
     * @Des: get all record table department
     * @Since: 2/3/2017
     */
    public function getAll() {
        $a_data = array();
        $a_data = DB::table('channel')->select('id', 'name', 'status', 'created_at', 'updated_at', 'amdin_modify')->where('status', 1)->orderBy('id', 'asc')->get();
        if(count($a_data) > 0){
            foreach ($a_data as $key => &$val) {
                $val->stt = $key + 1;
                $val->created_at = Util::sz_DateTimeFormat($val->created_at);
                $val->updated_at = Util::sz_DateTimeFormat($val->updated_at);
                $val->admin = $this->o_User->GetUserById($val->amdin_modify)->email ;
            }
        }

        return $a_data;
    }
    
    /**

     * @Auth: Dienct
     * @Des: 
     * @Since: 2/3/2017
     */
    public function getChanneltById($id) {
        $a_Data = array();
        $a_Data = DB::table('channel')->where('id', $id)->first();
        if (count($a_Data) > 0){
            $a_Data->created_at = Util::sz_DateTimeFormat($a_Data->created_at);
            $a_Data->updated_at = Util::sz_DateTimeFormat($a_Data->updated_at);
        }            

        return $a_Data;
    }
    
    /**

     * @Auth: Dienct
     * @Des: Add/edit project
     * @Since: 02/03/2017
     */
    public function AddEditChannel($id) {
        $a_DataUpdate = array();
        $a_DataUpdate['name'] = Input::get('name');
        $a_DataUpdate['status'] = Input::get('status') == 'on' ? 1 : 0;
        $a_DataUpdate['description'] = '';
        $a_DataUpdate['amdin_modify'] = Auth::user()->id;
        if (is_numeric($id) == true && $id != 0) {
            $a_DataUpdate['updated_at'] = date('Y-m-d H:i:s', time());
            DB::table('channel')->where('id', $id)->update($a_DataUpdate);
        } else {
            $a_DataUpdate['created_at'] = date('Y-m-d H:i:s', time());
            $a_DataUpdate['updated_at'] = date('Y-m-d H:i:s', time());
            DB::table('channel')->insert($a_DataUpdate);
        }
    }
}
