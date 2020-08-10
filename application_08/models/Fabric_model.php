 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Fabric_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('fabric', $data);
	}
	public function get()
	{
		$this->db->from('fabric');

		$rec=$this->db->get();
		return $rec->result();

	}
  public function get_count($table) {
        return $this->db->count_all($table);
    }
    public function get_single_value_by_id($id)
    {
      $this->db->select('*');
      $this->db->from('fabric');
      // $this->db->like($searchByCat, $searchValue);
      $this->db->where('id',$id);

      $rec=$this->db->get();
       //print_r($this->db->last_query());exit;
      return $rec->row();
      // print_r($searchValue);
    }



	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('fabric', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('fabric');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('id,fabricName,fabHsnCode,fabricType,fabricCode,purchase');
		$this->db->from('fabric');
		$this->db->like($searchByCat, $searchValue);
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}

  function get_fabric_exist($fabricName){
        $this->db->select('fabricName');
        $this->db->from('fabric');
        $this->db->where('fabricName',$fabricName);
        $query = $this->db->get();
        //echo $this->db->last_query();exit;
        if($query->num_rows()>=1) {
            return true;
        }else{
            return false;
        }
    }



}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
