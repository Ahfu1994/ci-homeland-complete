<?php

namespace App\Controllers\Users;

use App\Controllers\BaseController;

class UsersController extends BaseController
{

    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }

    public function propsRequests(){

        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url());
        }
        $id = auth()->user()->id;
        // dd($id);
        $propsRequest = $this->db->query("SELECT * FROM requests WHERE  user_id = '$id' ")
        ->getResult();
        // dd($propsRequest);

        return view('users/props-requests', compact('propsRequest'));
    }

    public function propsSaved(){


        if(!isset(auth()->user()->id)){
            return redirect()->to(base_url());
        }
        
        $id = auth()->user()->id;
        $propsSaved = $this->db->query("SELECT * FROM savedproperties WHERE  user_id = '$id' ")
        ->getResult();

        return view('users/props-saved', compact('propsSaved'));
    }
}
