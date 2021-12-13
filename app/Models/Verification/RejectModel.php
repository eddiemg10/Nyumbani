<?php
  namespace App\Models\Verification;

    use CodeIgniter\Model;
    class RejectModel extends Model{

        protected $table = 'tbl_verification';
        protected $allowedFields = [
            'requestStatus'
        ];

        function join()
        {
            $n = 'Rejected';
            return $this->db->table('tbl_verification')
                        ->select('*')
                        ->join('tbl_property', 'tbl_verification.propertyID = tbl_property.propertyID')
                        ->where('tbl_verification.requestStatus', $n)
                        ->get()
                        ->getResult();
        }
        
    }
 ?>