<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Job as o_JobModel;
use Illuminate\Support\Facades\Input;

class JobController extends Controller
{
    /**
     * @author Dienct
     * @since 2/3/2017
     * @Des function construct
     */
    private $o_Job;

    public function __construct() {
        $this->o_Job = new o_JobModel();
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

        $a_DataView = $this->o_Job->getJobById($job_id);

        return view('projects.edit_projects', ['a_Project' => $a_DataView, 'i_id' => $job_id]);

        ///get data department one record///
    }
}
