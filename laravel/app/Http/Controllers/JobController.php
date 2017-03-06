<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Job as o_JobModel;
use Illuminate\Support\Facades\Input;
use App\models\Projects;
use App\models\Channel;

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

    public function __construct() {
        $this->o_Job = new o_JobModel();
        $this->o_Project = new Projects();
        $this->o_Channel = new Channel();
    }
    /**
     * @Auth: Dienct
     * @Des: Update Project
     * @Since: 9/1/2015
     */
    public function addEditJob() {
        $a_DataView = array();
        $job_id = (int) Input::get('id', 0);
        $productname = Input::get('submit');
        if (isset($productname) && $productname != "") {
            $this->o_Job->AddEditProject($job_id);
                return redirect('list_projects')->with('status', 'Cập nhật thành công!');
        }
        
        //get all project view
        $a_DataProjects = array();
        $a_DataProjects = $this->o_Project->getAll();

        //get channel view
        $a_DataChannels = array();
        $a_DataChannels = $this->o_Channel->getAll();


        $a_DataView = $this->o_Job->getJobById($job_id);

        return view('jobs.edit_jobs', ['a_Jobs' => $a_DataView, 'i_id' => $job_id, 'a_DataProjects'=>$a_DataProjects, 'a_DataChannels'=>$a_DataChannels]);

        ///get data department one record///
    }
}
