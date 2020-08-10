 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Hsn_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('hsn', $data);
	}
	public function get()
	{
		$rec=$this->db->get('hsn');
		return $rec->result();

	}
	public function edit($id,$data)
	{
		// print_r($data);exit;
		// print_r($id);
		$this->db->where('id', $id);
		$v=$this->db->update('hsn', $data);
	//	print $this->db->last_query();exit;


		//$this->db->last_query();
	//	echo print_r($v);exit;
		return true;

	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('hsn');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('hsn');
		$this->db->like($searchByCat, $searchValue);
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}
  public function hsn()
	{
		$this->db->select('*');
		$rec=$this->db->get('hsn');
		return $rec->result();
	}

}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
