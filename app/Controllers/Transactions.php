<?php

namespace App\Controllers;

use App\Models\PaymentModel;




class Transactions extends BaseController
{


	//View Properties Rented by a particular tenant
	public function tenantProperties($tenantID)
	{
		$db = db_connect();
		$model = new PaymentModel($db);

		$tenant = $model->isTenant($tenantID);

		if ($tenant == true) {
			$properties = $model->fetchProps($tenantID);

			echo "<pre>";
			print_r($properties);
			echo "<pre>";
		}
	}







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

/*	public function makePayment($tenantID)

	{

		$db = db_connect();
		$model = new PaymentModel($db);



		$property = $model->getProperty($tenantID);



		if ($this->request->getMethod() == 'post'){
			// code...
			$json = $this->request->getJSON();

			$data = [
				'propertyID' => $property->propertyID,
				'senderID' => $tenantID,
				'recipientID' => $property->ownerID,
				'paymentMethod' => "Rent",

				'paymentAmount' => $json->paymentAmount,

				'paymentDate' => date("Y-m-d")

			];


			if($model->makePayment($data))
			{
				return true;
			}else{
				return false;
			}

		}
	}*/


	public function makePayment($propertyID)
	{

		$db = db_connect();
		$model = new PaymentModel($db);



		$property = $model->getProperty($propertyID);

		echo "<pre>";
		print_r($property);
		echo "</pre>";

		if ($this->request->getMethod() == 'post'){
			// code...
			$json = $this->request->getJSON();
			$data = [
				'propertyID' => $property->propertyID,
				'senderID' => $property->tenantID,
				'recipientID' => $property->ownerID,
				'paymentMethod' => "Rent",
				'paymentAmount' => $json->paymentAmount,
				'paymentDate' => date("Y-m-d")

			];

			if($model->makePayment($data))
			{
				return true;
			}else{
				return false;
			}


		}
	}





}
