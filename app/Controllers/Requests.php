<?php

namespace App\Controllers;
use CodeIgniter\API\ResponseTrait;
use App\Models\RequestsModel;

class Requests extends BaseController{

    use ResponseTrait;

    public function index($id){
        $request = new RequestsModel(); 
        $results = $request->getRequests($id); 

        return $this->respond($results);
        
        #For Testing Purporse
        // echo "<pre>";
        // print_r($results);
        // echo "</pre>"; 

        // $data = ['ViewRequests'=>json_encode($results)];

        // return view('ViewRequests', $data);
    }

    public function tenantRequests($id){
        $request = new RequestsModel(); 
        $results = $request->getTenantRequests($id); 

        return $this->respond($results);
    }

    public function addRequest() {
        return view('addrequest');
    }

    public function store () {
        $request = new RequestsModel();

        if($this->request->getMethod() == 'post'){
            $json = $this->request->getJSON();
            $data = [
                'propertyID' => $json->propertyID,
                'requestMessage' => $json->requestMessage,
            ];
    
            if($request->insert($data)){
                return true;
            }
            else{
                return false;
            }
        }

        
    }

    public function viewRequests() {

        $request = new RequestsModel();
        
        $data['request'] = $request->findAll();

        return view('tenantviewrequest',$data);
    }

    public function edit($id) {
        $request = new RequestsModel();

        $data['request'] = $role->find($id);
        return view('editrequest',$data);
    }

}