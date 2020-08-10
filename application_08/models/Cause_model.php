 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cause_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('cause_list', $data);
	}
	public function get()
	{
		$rec=$this->db->get('cause_list');
		return $rec->result();

	}
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('cause_list', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('cause_list');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('cause_list');
		$this->db->like($searchByCat, $searchValue);
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}

  public function getCause(){
    $this->db->select('id ,name');
		$this->db->from('cause_list');
		$rec = $this->db->get();
		return $rec->result();
  }


}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
