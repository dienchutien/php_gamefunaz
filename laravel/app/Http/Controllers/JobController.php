<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Job as o_JobModel;
use Illuminate\Support\Facades\Input;
use App\models\Projects;
use App\models\Channel;
use App\User;

class JobController extends Controller
{
    /**
     * @author Dienct
     * @since 2/3/2017
     * @Des function construct
     */
    private $o_Job;
    private $o_Project;
    private $o_Channel;
    private $o_User;

    public function __construct() {
        $this->o_Job = new o_JobModel();
        $this->o_Project = new Projects();
        $this->o_Channel = new Channel();
        $this->o_user = new User();
    }
    /**
     * @Auth: Dienct
     * @Des: Update Project
     * @Since: 1/3/2017
     */
    public function addEditJob() {
        $a_DataView = array();
        $job_id = (int) Input::get('id', 0);
        $productname = Input::get('submit');
        if (isset($productname) && $productname != "") {
            $this->o_Job->AddEditJob($job_id);
                return redirect('list_job')->with('status', 'Cập nhật thành công!');
        }
        
        //get all project view
        $a_DataProjects = array();
        $a_DataProjects = $this->o_Project->getAll();

        //get channel view
        $a_DataChannels = array();
        $a_DataChannels = $this->o_Channel->getAll();


        $a_DataView = $this->o_Job->getJobById($job_id);

        return view('jobs.edit_jobs', ['a_Jobs' => $a_DataView, 'i_id' => $job_id, 'a_DataProjects'=>$a_DataProjects, 'a_DataChannels'=>$a_DataChannels]);
        
    }
    
    /**
     * @Auth: Dienct
     * @Des: list Job.
     * @Since: 6/3/2017
     */
    public function getAllJob() {
        $a_Data = $this->o_Job->getAllSearch();
        $Data_view['a_Jobs'] = $a_Data['a_data'];
        $Data_view['a_search'] = $a_Data['a_search'];
        
        $Data_view['a_users'] = $this->o_user->getAll();
        $Data_view['a_projects'] = $this->o_Project->getAll();
        $Data_view['a_channels'] = $this->o_Channel->getAll();

        return view('jobs.index',$Data_view);
        
    }
}
