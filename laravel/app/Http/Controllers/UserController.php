<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    private $o_User;
    public function __construct() {
        $this->o_User = new User();
    }
    
    /**
     * @author Dienct
     * @since 2/3/2017
     * @des get all projects
     */
    public function getAllUser() {
        $a_Data = $this->o_User->getAll();
        return view('user.index', ['a_Data' => $a_Data]);
    }
    
    /**

     * @author dienct
     * @since 16/03/2017
     * @des Edituser
     *      */
    
    public function EditUser(){
        $a_DataView = array();
        $user_id = (int) Input::get('id', 0);
        $checksubmit = Input::get('submit');
        if (isset($checksubmit) && $checksubmit != "") {
            $this->o_User->AddEditProject($user_id);            
                return redirect('list_projects')->with('status', 'Cập nhật thành công!');
        }

        $a_DataView = $this->o_User->GetUserById($user_id);

        return view('user.edit', ['a_User' => $a_DataView, 'i_id' => $user_id]);
        
    }
    
    
}
