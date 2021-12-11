<?php
 namespace App\Models\Verification;

    use CodeIgniter\Model;
    class RequestModel extends Model{

        function join()
        {
            $n = 'Request';
            return $this->db->table('tbl_verification')
                        ->select('*')
                        ->join('tbl_property', 'tbl_verification.propertyID = tbl_property.propertyID')
                        ->where('tbl_verification.requestStatus', $n)
                        ->get()
                        ->getResult();
        }

        function join2($id)
        {
            $n = $id;
            return $this->db->table('tbl_verification')
                        ->select('*')
                        ->join('tbl_property', 'tbl_verification.propertyID = tbl_property.propertyID')
                        ->where('tbl_verification.propertyID', $n)
                        ->get()
                        ->getResult();
        }
        

    }
 ?>