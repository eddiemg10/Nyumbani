<?php


namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\Property;
use App\Models\PropertyModel;
use App\Models\PropertyDetails;
use App\Models\PropertyMedia;
use App\Models\Verification\RequestModel;
use App\Models\Verification\QueueModel;




class POwners extends BaseController{


    public function index() {

        $data = [
            'title'=> "Owner",
        ];
        return view('owners/properties', $data);


    }

    public function verification($id){
      
        $queue = new QueueModel();
        $request = new RequestModel();
        $data = [
            'title'=> "verification",
            'requests' =>  $request->join(),
            'queues' => $queue->join($id)

        ];
        

        return view('admin/verification', $data);
    }

}