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
    
    
}
