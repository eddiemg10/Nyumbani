<?php

namespace App\Controllers;

use App\Models\PaymentModel;



class Transactions extends BaseController
{

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



}