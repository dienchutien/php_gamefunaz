<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use DB;

use Auth;
use App\Http\Requests;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Input;

use App\Util;
use App\MailApi;
use Illuminate\Support\Facades\Session;

class AjaxController extends Controller
{
    private $i_id;
    private $i_type;
    private $sz_func;
    private $sz_tbl;
    private $sz_field;
    private $sz_val;
    private $o_LeaveRequestModel;
    protected $_o_MailApi;


    /**
     * function __Contruct    
     */
    public function __construct() {
        
        $this->i_id = Input::get('id',0);
        $this->i_type = Input::get('type',0);
        $this->sz_func = Input::get('func');
        $this->sz_tbl = Input::get('tbl');
        $this->sz_field = Input::get('field');
        $this->sz_val = Input::get('val');
        $this->o_LeaveRequestModel = new request_model();
        $this->_o_MailApi = new MailApi();
    }
    
    public function SetProcess(){
        echo "<pre>";
        print_r('sfdsf');
        echo "</pre>";
        die;

        if($this->sz_func == "") exit;
        switch ($this->sz_func) {
            case "delete-row":
                $this->DeleteRow();
                break;
        }
    }
    
    /**

     * Auth: DienCt
     * Edit: HuyNN 04/04/2016
     * Des: Delete record
     * Since: 31/12/2015
     */
    protected function DeleteRow(){
        echo "<pre>";
        print_r($this->i_id);
        echo "</pre>";
        die;



        if($this->i_id == 0 || $this->i_type == 0 || $this->sz_tbl == "") exit;
        if($this->i_type == 1){
            // update            
            $res = DB::table($this->sz_tbl)->where('id',(int)$this->i_id)->update(array('status' => 2));
            
        }else if($this->i_type == 2){
            $res = DB::table($this->sz_tbl)->where('id', '=', $this->i_id)->delete();
        }
        if($res){
            $arrayRes = array('success' => "Cập nhật dữ liệu thành công!",
                              'result' => 1 
                );
           
        }else{
            $arrayRes = array('success' => "Không thể cập nhật dữ liệu!",
                               'result' => 0,
                );
        }
        echo json_encode($arrayRes);       
    }
    
    
    
}
