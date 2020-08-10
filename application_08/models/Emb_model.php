<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Emb_model extends CI_Model {

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
   $this->db->insert('fabric', $data);
 }

 public function get_emb()
 {
   $this->db->select('*');
   $this->db->from('emb');
   $this->db->order_by('id','desc');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }
  public function get_design_fresh_value()
 {
   $this->db->select('*');
   $this->db->from('design');
   $this->db->where('designCode IS NULL');
   $this->db->where('rate IS NULL');

   $query = $this->db->get();
//   echo $this->db->last_query();exit;
   $query = $query->result_array();
   return $query;
 }
public function get_design_name()
 {
   $this->db->select('distinct(designName),id');
   $this->db->from('design');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }

 public function update($id,$data)
 {
    // print_r($designName);
    // print_r($data);exit;
   $this->db->where('id', $id);
   $this->db->update('emb', $data);
   return true;
 }

 

 public function get_emb_name($designName,$workerName)
 {
   $this->db->select('designName,workerName');
   $this->db->from('emb');
   $this->db->where('designName', $designName);
   $this->db->where('workerName', $workerName);
   // $this->db->like($designName,$workerName);
   $query = $this->db->get();
   //echo $this->db->last_query();exit;
   if($query->num_rows()>=1) {
            return true;
        }else{
            return false;
        }
   //echo $this->db->last_query();exit;

 }

 public function get_design_value()
 {
   $this->db->select('desName');
   $this->db->from('erc');
   $this->db->order_by('updated_at','desc');
   $query = $this->db->get();
   $query = $query->row();
   return $query;
 }

  public function get_worker_name()
 {
   $this->db->select('distinct(name),id');
   $this->db->from('job_work_party');
   $query = $this->db->get();
   $query = $query->result_array();
   return $query;
 }

 public function delete($id)
 {
   $this->db->where('id', $id);
     $this->db->delete('emb');
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

}

/* End of file Branch_model.php */
/* Location: ./application/models/Branch_model.php */
?>
