<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Projects as o_ProjectModel;

class ProjectsController extends Controller
{
    /**
     * @author Dienct
     * @since 2/3/2017
     * @Des function construct
     */
    private $o_Project;
    public function __construct()
    {
        $this->o_Project = new o_ProjectModel();
    }
    
    /**
     * @author Dienct
     * @since 2/3/2017
     * @des get all projects
     */
    public function getAllProject(){
        $a_Data = $this->o_Project->getAll();
        return view('projects.index',['a_Data'=>$a_Data]);        
        }
    
    
}
