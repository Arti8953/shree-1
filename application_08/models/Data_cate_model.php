 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Data_cate_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('data_category', $data);	
	}
	public function get()
	{
		$rec=$this->db->get('data_category');
		return $rec->result();

	}
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('data_category', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('data_category');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('data_category');
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