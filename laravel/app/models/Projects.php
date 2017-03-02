<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Util;
use DB;
use Illuminate\Support\Facades\Input;

class Projects extends Model
{
    /**
     * @Auth: Dienct
     * @Des: get all record table department
     * @Since: 07/01/2015
     */
    public function getAll() {
        $a_data = array();
        $a_data = DB::table('projects')->select('id', 'name', 'status', 'created_at', 'updated_at')->orderBy('id', 'asc')->get();
        if(count($a_data) > 0){
            foreach ($a_data as $key => &$val) {
                $val->stt = $key + 1;
                $val->created_at = Util::sz_DateTimeFormat($val->created_at);
                $val->updated_at = Util::sz_DateTimeFormat($val->updated_at);
            }
        }

        return $a_data;
    }
}
