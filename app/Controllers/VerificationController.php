<?php

namespace App\Controllers;
use App\Models\Verification\RequestModel;
use App\Models\Verification\QueueModel;
use App\Models\Verification\ConfirmedModel;
use App\Models\Verification\RejectModel;

class VerificationController extends BaseController
{
/*    public function index() // retrieving The home page
    {
        return view('index');
    }*/

    // ******************** Request Starts here ***************************
    public function Requestindex() // retrieving all request
    {
        $request = new RequestModel();
        $data['request'] = $request->join();
        
 
         return json_encode($data['request']);
        //return view('requests', $data);
    }

    public function Requestdetails($id) // to see details of each request on request side
    {
        $details = new RequestModel();
        $data['details'] = $details->join2($id);



        
        return json_encode($data['details']);
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

    public function Queueindex() // Retrieve all queued Request
    {
        $queue = new QueueModel();
        $data['queue'] = $queue->join();

        return json_encode($data['queue']);
        //return view('queue', $data);
    }


    //Function for beginning verification by changing the request Status to Pending
    public function QueuebeginVerification($id) 
    {
        $model = new QueueModel();
        
        
        
        $data = [
            'requestStatus' => "Pending"
        ];
        
       

        $model->where([
            'requestID' => $id
        ])->set($data)->update();

        /*return redirect()->to('queue');*/
    }


    //Function for Approving a Request 
    public function Queueconfirm($id)
    {
        $model = new QueueModel();
        
        
        
        $data = [
            'requestStatus' => "Approved"
        ];
        
        $reqID = $id;

        $model->where([
            'requestID' => $reqID
        ])->set($data)->update();

       /* return redirect()->to('queue');*/
    }

    //Function for Rejecting a Request
    public function Queuereject($id) // here we reject it(the request)
    {
        $model = new QueueModel();
        
        
        
        $data = [
            'requestStatus' => "Rejected"
        ];
        
        $reqID = $id;

        $model->where([
            'requestID' => $reqID
        ])->set($data)->update();

        /*return redirect()->to('queue');*/
    }

    // end of Queue *************

    //-------------------------------------------------------------------------------------------------------------------------------


    // Retrieve Approved Request***************************************************

    public function Approvedindex() // Retrieve Approved requests
    {
        $confirmed = new ConfirmedModel();

        $data['confirmed'] = $confirmed->join();


        return json_encode($data['confirmed']);
        
        /*return view('confirmed', $data);*/
    }
    // end of retrieving approved request*************

    //----------------------------------------------------------------------------------------------------------------------------------------



    // retrieve Rejected Request ***************************************************

    public function rejectedindex() // retrieve rejected Requests
    {
        $rejected = new RejectModel();

        $data['rejected'] = $rejected->join();


        return json_encode($data['rejected']);
        
        /*return view('Reject', $data);*/
    }

    // end of retrieving rejected requests *********
}
