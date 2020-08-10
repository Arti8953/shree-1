 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Branch_model extends CI_Model {


  public function insert($data,$table){
    $this->db->insert($table,$data);
    return $this->db->insert_id();
    }
	public function get()
	{
		$rec=$this->db->get('branch_detail');
		return $rec->result();

	}

	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('branch_detail', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('branch_detail');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('branch_detail');
		$this->db->like($searchByCat, $searchValue);
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}


}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
