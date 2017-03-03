<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\Channel as o_ChannelModel;
use Illuminate\Support\Facades\Input;

class ChannelController extends Controller
{
    private $o_Channel;
    
    public function __construct() {
        $this->o_Channel = new o_ChannelModel();
    }
    
    /**
     * @author Dienct
     * @since 2/3/2017
     * @des get all projects
     */
    public function getAllChannel() {        
        $a_Data = $this->o_Channel->getAll();
        return view('channel.index', ['a_Data' => $a_Data]);
    }
    /**
     * @Auth: Dienct
     * @Des: Update Project
     * @Since: 9/1/2015
     */
    public function addEditChannel() {

        $a_DataView = array();
        $channelId = (int) Input::get('id', 0);
        $productname = Input::get('submit');
        if (isset($productname) && $productname != "") {
            $this->o_Channel->AddEditChannel($channelId);
                return redirect('list_channel')->with('status', 'Cập nhật thành công!');
        }

        $a_DataView = $this->o_Channel->getChanneltById($channelId);

        return view('channel.edit_channel', ['a_Channel' => $a_DataView, 'i_id' => $channelId]);

        ///get data department one record///
    }
}
