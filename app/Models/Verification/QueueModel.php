<?php
  namespace App\Models\Verification;

    use CodeIgniter\Model;
    class QueueModel extends Model{

        protected $table = 'tbl_verification';
        protected $allowedFields = [
            'requestStatus'
        ];

        function join()
        {
            $n = 'Pending';
            return $this->db->table('tbl_verification')
                        ->select('*')
                        ->join('tbl_property', 'tbl_verification.propertyID = tbl_property.propertyID')
                        ->where('tbl_verification.requestStatus', $n)
                        ->get()
                        ->getResult();
        }

        // function update($id)
        // {
        //     $n = 'Pending';
        //     $data = array(
        //         'requestStatus' => $n
        //     );
            
        //     $this->db->where('id', $id);
        //     $this->db->update('requests', $data);
        // }

        
    }
 ?>