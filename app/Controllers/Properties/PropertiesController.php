<?php

namespace App\Controllers\Properties;

use App\Controllers\BaseController;
use App\Models\Property\Property;
use App\Models\Image\Image;
use App\Models\Request\Request;
use App\Models\SavedProperty\SavedProperty;
use App\Models\HomeType\HomeType;

class PropertiesController extends BaseController
{
    public function __construct()
    {
        $this->db = \Config\Database::connect();
    }


    public function getByProptype($type)
    {
        $propties = $this->db->query("SELECT * FROM properties WHERE type='$type' ")
        ->getResult();

        return view('props/props-by-type', compact('propties', 'type'));
    }

    public function getByPropPrice($type)
    {

        $propties = $this->db->query("SELECT * FROM properties ORDER BY price $type")
        ->getResult();

        return view('props/props-by-price', compact('propties', 'type'));
    }

    public function propSingle($id)
    {

        $props = new Property();
        $images = new Image();

        $homeType = new HomeType();

        $singleProps = $props->find($id);
       
        $singleProps = $this->db->query("SELECT * FROM properties WHERE id=$id")->getResult();

        $images = $this->db->query("SELECT * FROM images WHERE prop_id='$id'")->getResult();

        
        $relatedProps = 0;
        if(count($singleProps) >0 ){
            $relatedProps = $this->db->query("SELECT * FROM properties WHERE home_type='".$singleProps[0]->home_type."' AND id != $id ")->getResult();
        }

        $allHomeType = $homeType->findAll();

        if(isset(auth()->user()->id)){

          
            //checking for sending request to props
            $checkingForSendingRequests = $this->db->table('requests')
            ->where('user_id', auth()->user()->id)
            ->where('prop_id', $id)
            ->countAllResults();

            //checking for saving props
            $checkingSavedProps = $this->db->table('savedproperties')
            ->where('user_id', auth()->user()->id)
            ->where('prop_id', $id)
            ->countAllResults();

            return view('props/single', compact('singleProps', 
            'images', 'relatedProps', 'checkingForSendingRequests',
            'checkingSavedProps', 'allHomeType'));
        
        }else{
            return view('props/single', compact('singleProps', 
            'images', 'relatedProps', 'allHomeType'));
        }

      


    }

    public function sendRequest($id){
        $request = new Request();

        $data = [
            "name" =>  $this->request->getPost('name'),
            "email" =>  $this->request->getPost('email'),
            "phone" =>  $this->request->getPost('phone'),
            'prop_image' => $this->request->getPost('prop_image'),
            'prop_name' => $this->request->getPost('prop_name'),
            'prop_price' => $this->request->getPost('prop_price'),
            'prop_location' =>  $this->request->getPost('prop_location'),
            'user_id' => auth()->user()->id,
            'prop_id' => $id

        ];

        $request->save($data);

       if($request){
            return redirect()->to(base_url('props/prop-single/'.$id))->with('sent', 'Request sent successfully');
       }
    }


    public function saveProperty($id){
        $savedProps = new SavedProperty();

        $data = [
            "user_id" => auth()->user()->id,
            "prop_id" => $id,
            "email" =>  $this->request->getPost('email'),
            "phone" =>  $this->request->getPost('phone'),
            "prop_image" =>  $this->request->getPost('prop_image'),
            "prop_name" =>  $this->request->getPost('prop_name'),
            "prop_price" =>  $this->request->getPost('prop_price'),
            "prop_location" =>  $this->request->getPost('prop_location'),
            "name" =>  $this->request->getPost('name')
        ];

        $savedProps->save($data);
        if($savedProps){
                return redirect()->to(base_url('props/prop-single/'.$id))->with('save', 'Property saved successfully');
        }
    }

    public function propsByHomeType($type){
        $propsByHomeType = $this->db->query("SELECT * FROM properties WHERE home_type='$type' ")
        ->getResult();

        return view('props/props-by-hometype', compact('propsByHomeType'));
    }

    public function search(){

        $props = new Property();
        $homeType = $this->request->getPost("home_type");
        $type = $this->request->getPost("type");
        $location = $this->request->getPost("location");

        // $searchProps = $props->like('home_type', $homeType)->like('type', $type)
        // ->like('location', $location)->getResult();
        $sql = "SELECT * FROM properties ";
        if($homeType != "" || $homeType == null){
            $sql .= "WHERE home_type LIKE '%$homeType%' ";
        }

        if($type != "" || $type != null){
            $sql .= "AND type LIKE '%$type%' ";
        }

        if($location != "" || $location != null){
            $sql .= "AND location LIKE '%$location%' ";
        }

        // dd($sql);
        $searchProps = $this->db->query($sql)->getResult();

        // dd($searchProps);
        return view('props/search', compact('searchProps'));
    }



    
}
