<?php
  namespace App\Models\Verification;

    use CodeIgniter\Model;
    class ConfirmedModel extends Model{

        protected $table = 'tbl_verification';
        protected $allowedFields = [
            'requestStatus'
        ];

        function join()
        {
            $n = 'Approved';
            return $this->db->table('tbl_verification')
                        ->select('*')
                        ->join('tbl_property', 'tbl_verification.propertyID = tbl_property.propertyID')
                        ->where('tbl_verification.requestStatus', $n)
                        ->get()
                        ->getResult();
        }
        
    }
 ?>