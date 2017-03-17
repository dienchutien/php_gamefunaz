<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use DB;

class User extends Authenticatable {

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function GetUserById($id) {
        $a_Data = array();
        $a_Data = DB::table('users')->where('id', $id)->first();
        if (count($a_Data) > 0) {
            $a_Data->created_at = Util::sz_DateTimeFormat($a_Data->created_at);
            $a_Data->updated_at = Util::sz_DateTimeFormat($a_Data->updated_at);
        }
        return $a_Data;
    }

    /**

     * @auth: Dienct
     * @since: 06/03/2017
     * @des: get all user
     *
     */
    public function getAll() {
        $a_Data = array();
        $a_Data = DB::table('users')->where('status', 1)->orderBy('name', 'asc')->get();
        if (count($a_Data) > 0) {
            foreach ($a_Data as $key => &$val) {
                $val->stt = $key + 1;
                $val->created_at = Util::sz_DateTimeFormat($val->created_at);
                $val->updated_at = Util::sz_DateTimeFormat($val->updated_at);
            }
        }
        return $a_Data;
    }
    /**

     * @Auth: Dienct
     * @Des: Add/edit User
     * @Since: 02/03/2017
     */
    public function AddEditProject($id) {
        $a_DataUpdate = array();
        $a_DataUpdate['name'] = Input::get('name');
        $a_DataUpdate['status'] = Input::get('status') == 'on' ? 1 : 0;
        $a_DataUpdate['description'] = '';
        if (is_numeric($id) == true && $id != 0) {
            $a_DataUpdate['updated_at'] = date('Y-m-d H:i:s', time());
            DB::table('projects')->where('id', $id)->update($a_DataUpdate);
        } else {
            $a_DataUpdate['created_at'] = date('Y-m-d H:i:s', time());
            $a_DataUpdate['updated_at'] = date('Y-m-d H:i:s', time());
            DB::table('projects')->insert($a_DataUpdate);
        }
    }

}
