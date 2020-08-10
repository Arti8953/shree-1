<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Src_model extends CI_Model {

      public function insert($data,$table){
      $this->db->insert($table,$data);
      return $this->db->insert_id();
    }

    function edit_option($action, $id, $table){
        $this->db->where('id',$id);
        $this->db->update($table,$action);
        return;
    }

 public function add($data)
 {
   $query=$this->db->insert('fabric', $data);
   return $query->insert_id();
 }

public function update($id,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('id', $id);
   $this->db->update('src', $data);
   return true;
 }
public function Update_fabric($fabName,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('fabricName', $fabName);
   $this->db->update('fabric', $data);
   //echo $this->db->last_query();exit;
   return true;
 }
 public function Update_design($fabName,$fabCode,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('fabricName', $fabName);
   $this->db->where('designCode', $fabCode);
   $this->db->update('design', $data);
   //echo $this->db->last_query();exit;
   return true;
 }

 public function get_fabric_fresh_value()
 {
   $this->db->select('*');
   $this->db->from('fabric');
   $this->db->where('purchase IS NULL');
   $this->db->where('Code IS NULL');
   $this->db->where('sale_rate IS NULL');

   $query = $this->db->get();
//   echo $this->db->last_query();exit;
   $query = $query->result_array();
   return $query;
 }

 public function get_src_name($fabName)
 {
   $this->db->select('fabName');
   $this->db->from('src');
   $this->db->where('fabName', $fabName);
   $query = $this->db->get();
   if($query->num_rows()>=1) {
            return true;
        }else{
            return false;
        }
 }

 public function get_fabric()
 {
   $this->db->select('id,fabName,purchase,fabCode,sale_rate');
   $this->db->from('src');
   // $this->db->order_by('id','asc');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
public function get_fabric_name()
 {
   $this->db->select('distinct(fabricName)');
   $this->db->from('fabric');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
public function get_Erc_Code()
 {
   $this->db->select('distinct(desCode)');
   $this->db->from('erc');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
public function get_fab_name_value()
 {
   $this->db->select('fabName,fabCode');
   $this->db->from('src');
   $this->db->order_by('updated_at','desc');
   $query = $this->db->get();
   $query = $query->row();
   return $query;
 }

 public function delete($id)
 {
   $this->db->where('id', $id);
     $this->db->delete('fabric');
 }
 public function search($searchByCat,$searchValue)
 {
   $this->db->select('*');
   $this->db->from('fabric');
   $this->db->like($searchByCat, $searchValue);
   $rec=$this->db->get();
   return $rec->result_array();
   // print_r($searchValue);
   // print_r($this->db->last_query());
 }
 public function get_SRC_set_exist($data)
 {
   $this->db->select('id');
   $this->db->from('src');
   $this->db->where('fabName',$data['fabName']);
   $this->db->where('fabCode',$data['fabCode']);
   $query = $this->db->get();
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
