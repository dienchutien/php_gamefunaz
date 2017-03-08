<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Job as o_JobModel;
use Illuminate\Support\Facades\Input;
use App\models\Projects;
use App\models\Channel;
use App\models\Supplier;
use App\User;
use Illuminate\Support\Facades\Session;
use DB;
use Maatwebsite\Excel\Facades\Excel;

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
    private $o_Supplier;

    public function __construct() {
        $this->o_Job = new o_JobModel();
        $this->o_Project = new Projects();
        $this->o_Channel = new Channel();
        $this->o_user = new User();
        $this->o_Supplier = new Supplier();
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
        
        //get all project view
        $a_DataSupplier = array();
        $a_DataSupplier = $this->o_Supplier->getAll();

        //get channel view
        $aryAllChannel = array();
        $this->o_Channel->getAllChannelByParentID(0, $aryAllChannel);

        $a_DataView = $this->o_Job->getJobById($job_id);

        return view('jobs.edit_jobs', ['a_Jobs' => $a_DataView, 'i_id' => $job_id, 'a_DataProjects'=>$a_DataProjects, 'aryAllChannel'=>$aryAllChannel, 'a_DataSupplier'=>$a_DataSupplier]);
        
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
        $Data_view['money_total'] = $a_Data['money_total'];
        
        $Data_view['a_users'] = $this->o_user->getAll();
        $Data_view['a_projects'] = $this->o_Project->getAll();
        $Data_view['a_supplier'] = $this->o_Supplier->getAll();
        
        $aryAllChannel = array();
        $this->o_Channel->getAllChannelByParentID(0, $aryAllChannel);
        $Data_view['aryAllChannel'] = $aryAllChannel;        

        return view('jobs.index',$Data_view);
        
    }
    
    //Export excel
    public function exportJob(){
        
        $sz_Sql = Session::get('sqlGetJob');        
//        $a_Select = explode('from', $sz_Sql);
//        $a_Select[0] = str_replace("`name`","`name` as `Tên`",$a_Select[0]);
//        $a_Select[0] = str_replace("`department_name`","`department_name` as `Phòng`",$a_Select[0]);
//        $a_Select[0] = str_replace("`code`","`code` as `MNV`",$a_Select[0]);
//        $sz_Sql = $a_Select[0].'from'.$a_Select[1];
        if(strpos($sz_Sql, 'limit') !== false){
            $arr =  explode('limit',$sz_Sql);
            $sz_Sql = $arr[0];
        }
        


        $a_Data = DB::select(DB::raw($sz_Sql));        

        try{
            Excel::create('Danh_Sach_JOb', function($excel) use($a_Data) {
                // Set the title
                $excel->setTitle('no title');
                $excel->setCreator('Dienct')->setCompany('no company');
                $excel->setDescription('report file');
                $excel->sheet('sheet1', function($sheet) use($a_Data) {
                    foreach ($a_Data as $key => $o_person) {

//                        unset($o_person->id);
//                        unset($o_person->user_id);
//                        unset($o_person->email);
//                        unset($o_person->department_id);
                        $ary[] = (array) $o_person;
                        
                    }
                    if(isset($ary)){
                        $sheet->fromArray($ary);
                    }
                    $sheet->cells('A1:BM1', function($cells) {
                        $cells->setFontWeight('bold');
                        $cells->setBackground('#AAAAFF');
                        $cells->setFont(array(
                            'bold' => true
                        ));
                    });
                });
            })->download('xlsx');
        }catch (\Exception $e){
            echo $e->getMessage();
        }

    }
}
