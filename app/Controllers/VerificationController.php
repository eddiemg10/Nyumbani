<?php

namespace App\Controllers;
use App\Models\Verification\RequestModel;
use App\Models\Verification\QueueModel;
use App\Models\Verification\ConfirmedModel;
use App\Models\Verification\RejectModel;
use App\Models\Property;
use CodeIgniter\API\ResponseTrait;


class VerificationController extends BaseController
{
    use ResponseTrait;

/*    public function index() // retrieving The home page
    {
        return view('index');
    }*/

    // ******************** Request Starts here ***************************
    public function Requestindex() // retrieving all request
    {
        $request = new RequestModel();
        $data['request'] = $request->join();
        

        //  return json_encode($data['request']);
        //return view('requests', $data);

         return $this->respond($data['request']);

    }

    public function Requestdetails($id) // to see details of each request on request side
    {
        $details = new RequestModel();
        $data['details'] = $details->join2($id);


        return $this->respond($data['details']);


        //return view('details', $data);
    }

/*    public function Requestdetails2($id) // to see details of each request on queue side
    {
        $details = new RequestModel();
        $data['details'] = $details->join2($id);
        
        //return view('details2', $data);
    }*/

    // End of Rquest ******************

// -------------------------------------------------------------------------------------------------------------------

    // Queue Starts Here ********************************************************


    public function Queueindex($id) // Retrieve all queued Request
    {
        $queue = new QueueModel();
        $data['queue'] = $queue->join($id);

        return $this->respond($data['queue']);

        //return view('queue', $data);
    }


    //Function for beginning verification by changing the request Status to Pending

    public function QueuebeginVerification() 
    {
        if($this->request->getMethod() == 'post'){

            $model = new QueueModel();

            $json = $this->request->getJSON();
            $id = $json->id;
            $data = [
                'requestStatus' => "Pending",
                'updated_by' => $json->admin
            ];

            $result = $model->where([
                'requestID' => $id
            ])->set($data)->update();

            return $result;
            
        }
    }


    //Function for Approving a Request 
    public function Queueconfirm($id)
    {
        $model = new QueueModel();

        $prod = new Property();


        
        $data = [
            'requestStatus' => "Approved"
        ];
        
        $reqID = $id;


        $property = $model->select("propertyID")->where("requestID", $reqID)->get()->getResult()[0]->propertyID;
        $prod->verifyProperty($property);
        
        $result = $model->where([
            'requestID' => $reqID
        ])->set($data)->update();

        return $result;


    }

    //Function for Rejecting a Request
    public function Queuereject($id) // here we reject it(the request)
    {
        $model = new QueueModel();

        $prod = new Property();

        
        $data = [
            'requestStatus' => "Rejected"
        ];
        
        $reqID = $id;

        $property = $model->select("propertyID")->where("requestID", $reqID)->get()->getResult()[0]->propertyID;
        $prod->unverifyProperty($property);


        $result = $model->where([
            'requestID' => $reqID
        ])->set($data)->update();

        return $result;

    }

    // end of Queue *************

    //-------------------------------------------------------------------------------------------------------------------------------


    // Retrieve Approved Request***************************************************

    public function Approvedindex() // Retrieve Approved requests
    {
        $confirmed = new ConfirmedModel();

        $data['confirmed'] = $confirmed->join();



        return $this->respond($data['confirmed']);


        
        /*return view('confirmed', $data);*/
    }
    // end of retrieving approved request*************

    //----------------------------------------------------------------------------------------------------------------------------------------



    // retrieve Rejected Request ***************************************************

    public function rejectedindex() // retrieve rejected Requests
    {
        $rejected = new RejectModel();

        $data['rejected'] = $rejected->join();



        return $this->respond($data['rejected']);


        
        /*return view('Reject', $data);*/
    }

    // end of retrieving rejected requests *********

