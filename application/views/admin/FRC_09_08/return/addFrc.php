<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-body">
        <form method="post" action="<?php echo base_url('admin/FRC/addFrc')?>">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title"><i class="fa fa-plus"></i> Create Return Challan</h5>
            </div>
            <div class="modal-body">
           <?php echo $this->session->flashdata('msg'); ?>
              <div class="row">
               

                <div class="col-md-3">
                  <label>From Godown</label>
                  <select name="fromGodown" class="form-control" id='fromGodown' required>
                    <option value=''>Select Godown</option>
                    <?php foreach ($sub_dept_data as $value): ?>
                    <option value="<?php echo $value->id;?>"> <?php echo $value->subDeptName;?></option>
                    <?php endforeach;?>
                  </select>
                </div>

                <div class="col-md-3">
                  <label>To Godown</label>
                  <select name="toGodown" class="form-control" id="toGodown" required>
                    <option value=''>Select Godown </option>
                    <?php foreach ($sub_dept_data as $value): ?>
                    <option value="<?php echo $value->id?>"> <?php echo $value->subDeptName;?></option>
                    <?php endforeach;?>
                  </select>
                </div>
              
               
              </div> <hr>
              <div class='container-fluid' id="fresh_form">
               <table  class=" remove_datatable">
                <thead>
                  <th>S no</th>
                  <th>PBC</th>
                  <th>Fabric_Name</th>
                  <th>Hsn</th> 
                   <th>Fabric_Type</th>
                  <th>Quantity</th>
                  <th>Unit     </th>  
                  <th>AD NO</th>
                  <th>DOC. Chalan No</th>
                  <th>Purchase code</th>
                 <th>Option</th>
                </thead>
                <tbody id="fresh_data">
                  <tr id="0">
                    <td><input type="text" class="form-control sno" name="sno[]" value="1" readonly></td>
                    <td><input type="text" class="form-control pbc" name="pbc[]" value="" id="pbc0" required></td>
                    <td><input type="text" name="fabric_name[]" class="form-control  " id="fabric0" readonly > 
                    <input type="hidden" name="fabric_id[]" class="form-control  " id="fabric_id0"  ></td>
                    <td><input type="text" class="form-control " name="hsn[]" id="hsn0" readonly></td>
                    <td><input type="text" class="form-control" name="fabType[]" id="fabtype0" readonly></td>
                    <td><input type="text" class="form-control" name="quantity[]" id="qty0" readonly></td>
                    <td><input type="text" name="unit[]" class="form-control  " id="unit0" readonly></td>
                   <td> <input type="text" class="form-control" name="ADNo[]" id="adno0" readonly></td>
                    <td> <input type="text" class="form-control" name="challan[]" id="challan0" readonly></td>
                    <td><input type="text" class="form-control" name="pcode[]" id="pcode0" readonly>
                    <input type="hidden" class="form-control" name="prate[]" id="prate0" >
                    </td>
                    <td> <button type="button" name="add_more" id="add_more" class="btn btn-success">+</button></td>
                  </tr>
                </tbody>
              </table>
              <hr>
              
              <div class="row">
              <div class="col-md-3">
                </div>
                <div class="col-md-6 text-center" id='submit'> 
                <input type="hidden" name="<?=$this->security->get_csrf_token_name();?>" value="<?=$this->security->get_csrf_hash();?>" />
                  <button type="submit" name="submit"  class="btn btn-success btn-md">Submit</button>
                </div>
                <div class="col-md-3" id='msg'> 
                
                </div>
            </div>
            </div>
          </div>
          <br>
           
          <div class="col-md-6" id="summary"> </div>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include('FRC_js.php');?>
