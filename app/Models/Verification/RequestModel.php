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
                        ->join('tbl_users', 'tbl_property.ownerID = tbl_users.userID')
                        ->where('tbl_verification.requestStatus', $n)
                        ->where('tbl_verification.is_deleted', 0)
                        ->get()
                        ->getResult();
        }

        function join2($id)
        {
            $n = $id;
            return $this->db->table('tbl_verification')
                        ->select('*')
                        ->join('tbl_property', 'tbl_verification.propertyID = tbl_property.propertyID')

                        ->where('tbl_verification.requestID', $n)
                        ->where('tbl_verification.is_deleted', 0)
                        ->get()
                        ->getResult();
        }
        

    }
 ?>