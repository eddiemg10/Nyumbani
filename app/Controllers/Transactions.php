<?php

namespace App\Controllers;

use App\Models\PaymentModel;




class Transactions extends BaseController
{
//Function to view tenant's payment history
	public function tenantHistory($tenantID)
	{
		$db = db_connect();
		$model = new PaymentModel($db);

		$tenant = $model->isTenant($tenantID);
		
		if ($tenant == true) {
			
	
			$result = $model->getTenantHistory($tenantID);


			$data = ['data' => $result];
		

		}
		else{
			$data = ['data' => 'User not a Tenant'];
		}


		return json_encode($data);

	}

//Function to make payments
	public function makePayment($tenantID)
	{

		$db = db_connect();
		$model = new PaymentModel($db);



		$property = $model->getProperty($tenantID);

/*		echo "<pre>";
		print_r($property);
		echo "</pre>";*/


		

		if (isset($_POST["Submit"])){
			// code...
		
			print_r($_POST);
			$data = [
				'propertyID' => $property->propertyID,
				'senderID' => $tenantID,
				'recipientID' => $property->ownerID,
				'paymentMethod' => "Rent",
				'paymentAmount' => $_POST['paymentAmount'],
				'paymentDate' => date("Y-m-d")

			];


/*			echo "<pre>";
			print_r($data);
			echo "</pre>";*/




		$status = $model->makePayment($data);



		}
	}


	/*public function Dummy()
	{
	
		return view('DummyPayment');
	}*/



}
