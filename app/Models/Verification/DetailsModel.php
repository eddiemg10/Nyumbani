<?php
  namespace App\Models\Verification;

    use CodeIgniter\Model;
    class DetailsModel extends Model{

        function join()
        {
            $n = 15;
            return $this->db->table('tbl_verification')
                        
                        ->select('*')
                        ->join('tbl_property', 'tbl_verification.propertyID = tbl_property.propertyID')
                        ->where('tbl_verification.propertyID', $n)
                        ->get()
                        ->getResult();
        }

        
    }
 ?>