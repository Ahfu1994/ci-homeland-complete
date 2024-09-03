<?php

namespace App\Controllers\Admins;
use CodeIgniter\HTTP\ResponseInterface;
use App\Controllers\BaseController;
use App\Models\Admin\Admin;
use App\Models\HomeType\HomeType;
use App\Models\Property\Property;
use App\Models\Image\Image;
use App\Models\Request\Request;


class AdminsController extends BaseController
{

    public function __construct()
    {
       
        $this->db = \Config\Database::connect();
    }
    
    public function index(){
        $session = session();

        $propsCount = $this->db->table('properties')
        ->countAllResults();

        $homeTypeCount = $this->db->table('hometypes')
        ->countAllResults();

        $adminsCount = $this->db->table('admins')
        ->countAllResults();

        return view('admins/index', compact('session', 'propsCount', 'homeTypeCount', 'adminsCount'));
    }

    public function login(){

        return view('admins/login');
    }

    public function checkLogin(){

        $session = session();
        $admin = new Admin();
        $email = $this->request->getVar('email');
        $password = $this->request->getVar('password');
        
        $data = $admin->where('email', $email)->first();
        
        if($data){
            $pass = $data['password'];
            $authenticatePassword = password_verify($password, $pass);
            if($authenticatePassword){
                $ses_data = [
                    'id' => $data['id'],
                    'name' => $data['name'],
                    'email' => $data['email'],
                    'isLoggedIn' => TRUE
                ];
                $session->set($ses_data);
                return redirect()->to(base_url('admins/index'));
            
            }else{
                $session->setFlashdata('msg', 'Password is incorrect.');
                return redirect()->to(base_url('admins/login'));
            }
        }else{
            $session->setFlashdata('msg', 'Email does not exist.');
            return redirect()->to(base_url('admins/login'));
	    }


    }

    public function logout(){
        $session = session();

        $ses_data = [
            'id' => "",
            'name' => "",
            'email' => "",
            'isLoggedIn' => FALSE
        ];
        $session->set($ses_data);
        return redirect()->to(base_url('admins/login'));
    }

    public function displayAdmins(){
        $session = session();
        $admin = new Admin();
       
        $allAdmins = $admin->findAll();

        return view('admins/all-admins', compact('session', 'allAdmins'));
    }

    public function createAdmin(){
        $session = session();

        return view('admins/create', compact('session'));
    }

    public function storeAdmin(){

        $session = session();
        $inputs = $this->validate([
            'name' => 'required|min_length[5]',
            'email' => 'required|valid_email',
            'password' => 'required|min_length[5]|alpha_numeric',
            
        ]);

        if (!$inputs) {
            return view('admins/create', [
                'validation' => $this->validator,
                'session' => $session
            ]);
        }else{
            $admin = new Admin();

            $data = [
                "name" =>  $this->request->getPost('name'),
                "email" =>  $this->request->getPost('email'),
                "password" =>  password_hash($this->request->getPost('password'), PASSWORD_DEFAULT)
            ];
    
            $admin->save($data);
    
           if($admin){
                return redirect()->to(base_url('admins/all-admins'))->with('create', 'Admin created successfully');
           }
        } 
    }

    public function displayHomeTypes(){
        $session = session();
        $homeTypes = new HomeType();
       
        $allHomeType = $homeTypes->findAll();

        return view('admins/all-home-type', compact('session', 'allHomeType'));
    }

    public function createHomeTypes(){
        $session = session();

        return view('admins/create-home-type', compact('session'));
    }

    public function storeHomeTypes(){
        $session = session();
        $inputs = $this->validate([
            'name' => 'required|min_length[5]'
            
        ]);
        if (!$inputs) {
            return view('admins/create-home-type', [
                'validation' => $this->validator,
                'session' => $session
            ]);
        }else{
            $homeTypes = new HomeType();

            $data = [
                "name" =>  $this->request->getPost('name')
            ];
    
            $homeTypes->save($data);
    
           if($homeTypes){
                return redirect()->to(base_url('admins/all-home-type'))->with('create', 'Home Type created successfully');
           }
        }
    }


    public function deleteHomeTypes($id){

        $session = session();
        $homeTypes = new HomeType();
        $homeTypes->delete($id);
        if($homeTypes){
            return redirect()->to(base_url('admins/all-home-type'))->with('delete', 'Home Type deleted successfully');
       }
    }

    public function updateHomeTypes($id){

        $session = session();
        $homeTypes = new HomeType();
        $gethometype = $homeTypes->find($id);
        // dd($gethometype);
        return view('admins/update-home-type', compact('session', 'gethometype'));
    }

    public function editHomeTypes($id){
        $session = session();
        $homeTypes = new HomeType();
        $data = [
            "name" =>  $this->request->getPost('name')
        ];
        $homeTypes->update($id, $data);
        if($homeTypes){
            return redirect()->to(base_url('admins/all-home-type'))->with('update', 'Home Type updated successfully');
       }
    }

    public function displayProps(){
        $session = session();
        $props = new Property();
       
        $allProps = $props->findAll();

        return view('admins/all-props', compact('session', 'allProps'));
    }

    public function createProps(){
        $session = session();
    
        return view('admins/create-props', compact('session'));
    }



    public function storeProps(){
        $session = session();
        $props = new Property();

        $img = $this->request->getFile('image');
        $img->move('public/assets/images');

        $data = [
            "name" =>  $this->request->getPost('name'),
            "image" =>  $img->getClientName(),
            "price" =>  $this->request->getPost('price'),
            "num_beds" =>  $this->request->getPost('num_beds'),
            "num_baths" =>  $this->request->getPost('num_baths'),
            "sq_ft" =>  $this->request->getPost('sq_ft'),
            "home_type" =>  $this->request->getPost('home_type'),
            "year_built" =>  $this->request->getPost('year_built'),
            "price_sq_ft" =>  $this->request->getPost('price_sq_ft'),
            "description" =>  $this->request->getPost('description'),
            "type" =>  $this->request->getPost('type'),
            "location" =>  $this->request->getPost('location')
        ];

        $props->save($data);

       if($props){
            return redirect()->to(base_url('admins/all-props'))->with('create-props', 'Property created successfully');
       }
    }

    
    public function createGallery(){
        $session = session();
        $props = new Property();
       
        $allProps = $props->findAll();
        return view('admins/create-gallery', compact('session', 'allProps'));
    }

    public function storeGallery(){
        $db = $this->db->table('images'); 
        $msg = 'Please select a valid files';
          
        if ($this->request->getFileMultiple('images')) {
    
            $i = 0;
                foreach($this->request->getFileMultiple('images') as $file)
                {   
                $newFileName = $file->getClientName().'_'.strtotime("now +".$i." sec");
                $file->move('public/assets/gallery', $newFileName);
               
                // $data = [
                // 'name' =>  $file->getClientName(),
                // 'type'  => $file->getClientMimeType()
                // ];
                $data = [
                    'image' => $newFileName,
                    'prop_id'  => $this->request->getPost('prop_id')
                    ];
    
                $save = $db->insert($data);
                $msg = 'Files have been successfully uploaded';

                $i++;
                }

                if($save){
                    return redirect()->to(base_url('admins/all-props'))->with('store-gallery', $msg);
               }
        }
       else{
            return redirect()->to(base_url('admins/all-props'))->with('store-gallery', $msg);
       }

    }

    public function deleteProps($id)
    {
        $session = session();
        $props = new Property();
        $singleProp = $props->find($id);
    
        // Check if property exists
        if ($singleProp !== null) {
            // Delete the property
            $props->delete($id);
    
            // Delete the associated image
            if (!empty($singleProp['image'])) {
                unlink('public/assets/images/' . $singleProp['image']);
            }
    
            // Delete related images
            $relatedImages = $this->db->query("SELECT * FROM images WHERE prop_id = ?", [$id])->getResult();
            foreach ($relatedImages as $image) {
                $this->db->query("DELETE FROM images WHERE id = ?", [$image->id]);
                if (!empty($image->image)) {
                    unlink('public/assets/gallery/' . $image->image);
                }
            }
    
            // Redirect with success message
            return redirect()->to(base_url('admins/all-props'))->with('delete', 'Property deleted successfully');
        } else {
            // Redirect with failure message
            return redirect()->to(base_url('admins/all-props'))->with('delete', 'Property delete failed');
        }
    }


    public function displayRequests(){
        $session = session();
        $requests = new Request();
       
        $allRequests = $requests->findAll();
        return view('admins/all-requests', compact('session', 'allRequests'));
    }

    

    
}
