 <?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Unit_model extends CI_Model {

	public function add($data)
	{
		$this->db->insert('unit', $data);
	}
	public function get()
	{
		$rec=$this->db->get('unit');
		return $rec->result();

	}
	public function edit($id,$data)
	{
		// print_r($data);
		// print_r($id);
		$this->db->where('id', $id);
		$this->db->update('unit', $data);
		return true;
	}
	public function delete($id)
	{
		$this->db->where('id', $id);
     	$this->db->delete('unit');
	}
	public function search($searchByCat,$searchValue)
	{
		$this->db->select('*');
		$this->db->from('unit');
		$this->db->like($searchByCat, $searchValue);
		$rec=$this->db->get();
		return $rec->result_array();
		// print_r($searchValue);
		// print_r($this->db->last_query());

	}

  public function getUnits(){
    $this->db->select('id ,unitSymbol');
		$this->db->from('unit');
		$rec = $this->db->get();
		return $rec->result();
  }


}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
 ?>
