<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Util;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;

class Job extends Model
{
    //
    
    /**

     * @Auth: Dienct
     * @Des: Add/edit project
     * @Since: 02/03/2017
     */
    public function AddEditProject($id) {
        $a_DataUpdate = array();
        $a_DataUpdate['title'] = Input::get('title');
        $a_DataUpdate['status'] = Input::get('status') == 'on' ? 1 : 0;
        $a_DataUpdate['description'] = Input::get('description');
        $a_DataUpdate['project_id'] = Input::get('projects');
        $a_DataUpdate['channel_id'] = Input::get('channel');       
        $time_finish = Input::get('date_finish');
        $a_DataUpdate['date_finish'] = date('Y-m-d',strtotime($time_finish));
        $a_DataUpdate['job_type'] = Input::get('job_type');// 0 la tra truoc, 1 la tra sau
        $a_DataUpdate['is_payment']  = Input::get('job_type') == 0 ? 0 : 1;
        $a_DataUpdate['admin_modify'] = Auth::user()->id;
        $a_DataUpdate['updated_at'] = date('Y-m-d H:i:s', time());
        
        if (is_numeric($id) == true && $id != 0) {            
            DB::table('jobs')->where('id', $id)->update($a_DataUpdate);
        } else {
            $a_DataUpdate['created_at'] = date('Y-m-d H:i:s', time());
            DB::table('jobs')->insert($a_DataUpdate);
        }
    }
    
    /**
     * @Auth: Dienct
     * @Des: 
     * @Since: 2/3/2017
     */
    public function getJobById($id) {

        $a_Data = array();
        $a_Data = DB::table('jobs')->where('id', $id)->first();
        if (count($a_Data) > 0){
            $a_Data->created_at = Util::sz_DateTimeFormat($a_Data->created_at);
            $a_Data->date_finish = Util::sz_DateTimeFormat($a_Data->date_finish);
            $a_Data->updated_at = Util::sz_DateTimeFormat($a_Data->updated_at);
        }
        return $a_Data;
    }
}
