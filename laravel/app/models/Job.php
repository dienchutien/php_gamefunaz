<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use App\Util;
use DB;
use Illuminate\Support\Facades\Input;
use Auth;
use App\models\Projects;
use App\User;
use App\models\Channel;

class Job extends Model
{
    private $o_Project;
    private $o_Channel;
    private $o_User;

    public function __construct() {
        $this->o_Project = new Projects();
        $this->o_Channel = new Channel();
        $this->o_user = new User();
    }
    
    /**
     * @Auth: Dienct
     * @Des: Add/edit project
     * @Since: 02/03/2017
     */
    public function AddEditJob($id) {
        $a_DataUpdate = array();
        $a_DataUpdate['title'] = Input::get('title');
        $a_DataUpdate['status'] = Input::get('status') == 'on' ? 1 : 0;
        $a_DataUpdate['description'] = Input::get('description');
        $a_DataUpdate['project_id'] = Input::get('projects');
        $a_DataUpdate['channel_id'] = Input::get('channel');
        $time_finish = Input::get('date_finish');
        $a_DataUpdate['date_finish'] = date('Y-m-d',strtotime($time_finish));
        $a_DataUpdate['job_type'] = Input::get('job_type');// 0 la tra truoc, 1 la tra sau
        
        $a_DataUpdate['admin_modify'] = Auth::user()->id;
        $a_DataUpdate['money'] = (int)str_replace(' ','',Input::get('money'));

        $a_DataUpdate['updated_at'] = date('Y-m-d H:i:s', time());
        
        if (is_numeric($id) == true && $id != 0) {
            if(Input::get('job_type') == 1){// => tra sau
                $a_DataUpdate['is_payment'] = 1;
            }else{
                $o_Job = $this->getJobById($id);
                if($o_Job->job_type == 1) $a_DataUpdate['is_payment'] = 0; // tra sau => tra truoc
            }
            DB::table('jobs')->where('id', $id)->update($a_DataUpdate);
        } else {
            $a_DataUpdate['created_at'] = date('Y-m-d H:i:s', time());
            $a_DataUpdate['is_payment']  = Input::get('job_type') == 0 ? 0 : 1;
            
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
            $a_Data->date_finish = Util::sz_DateFinishFormat($a_Data->date_finish);
            $a_Data->updated_at = Util::sz_DateTimeFormat($a_Data->updated_at);
        }
        return $a_Data;
    }
    
    /**
     * @Auth:Dienct
     * @Des: get all record jobs table
     * @Since: 06/03/2017
     */
    public function getAllSearch() {
        $a_data = array();
        $o_Db = DB::table('jobs')->select('*');
        $a_search = array();
               
        //search 
        $i_is_payment = Input::get('is_payment','');
        if($i_is_payment != '') {
            $a_search['i_is_payment'] = $i_is_payment;
            $a_data = $o_Db->where('is_payment', $i_is_payment);
        }        
        
        $sz_title_name = Input::get('title_name','');
        if($sz_title_name != '') {
            $a_search['title_name'] = $sz_title_name;
            $a_data = $o_Db->where('title', 'like', '%'.$sz_title_name.'%');
        }
        
        $i_admin_modify = Input::get('admin_modify','');
        if($i_admin_modify != '') {
            $a_search['admin_modify'] = $i_admin_modify;
            $a_data = $o_Db->where('admin_modify', $i_admin_modify);
        }
        
        $i_project = Input::get('project','');
        if($i_project != '') {
            $a_search['project'] = $i_project;
            $a_data = $o_Db->where('project_id', $i_project);
        }
        
        $i_channel = Input::get('channel','');
        if($i_channel != '') {
            $a_search['channel'] = $i_channel;
            $this->o_Channel->getAllChannelIDByParentID($i_channel,$aryChildID);
            $aryChildID[] = $i_channel;
            $a_data = $o_Db->whereIn('channel_id', $aryChildID);
        }
        
        $sz_from_date = Input::get('from_date','');
        if($sz_from_date != '') {
            $a_search['from_date'] = $sz_from_date;
            $a_data = $o_Db->where('date_finish','>=', date('Y-m-d',strtotime($sz_from_date)));
           
        }
        
        $sz_to_date = Input::get('to_date','');
        if($sz_to_date != '') {
            $a_search['to_date'] = $sz_to_date;
            $a_data = $o_Db->where('date_finish','<=', date('Y-m-d',strtotime($sz_to_date)));
           
        }
        
        $a_data = $o_Db->orderBy('updated_at', 'desc')->paginate(30);
        foreach ($a_data as $key => &$val) {
            $val->stt = $key + 1;
            $val->project = $this->o_Project->getProjectById($val->project_id)->name;
            $val->channel = $this->o_Channel->getChanneltById($val->channel_id)->name;
            $val->user = $this->o_user->GetUserById($val->admin_modify)->email;            
            $val->date_finish = Util::sz_DateFinishFormat($val->date_finish);
            $val->updated_at = Util::sz_DateTimeFormat($val->updated_at);
        }
        $a_return = array('a_data' => $a_data, 'a_search' => $a_search);
        return $a_return;
    }
}
