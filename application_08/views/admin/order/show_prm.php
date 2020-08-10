<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">

    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white">
      <div class="card">
        <div class="card-body">
          <div class="card-title">
            <h4>PRM ORDER NUMBER:  <b class="text-right"><?php echo $old_order_number; ?></b></h4>
          </div>
          <hr>
          <div class="widget-box">
            <div class="widget-content nopadding">
              <form method="post" action="<?php echo base_url('admin/Orders/add_new_order')?>">
                  <div class="row">
                    <div class="col-md-3">
                      <label>NEW ORDER NUMBER</label>
                      <input type="text" class="form-control" name="order_number" id="order_number">
                      <div id="msg"></div>
                      <input type="hidden" class="form-control" name="session" value="<?php echo $session?>">
                      <input type="hidden" class="form-control" name="category" value="<?php echo $category?>">
                      <input type="hidden" class="form-control" name="order_type" value="<?php echo $order_type?>">
                      <input type="hidden" class="form-control" name="old_order_number" value="<?php echo $old_order_number; ?>">
                    </div>
                    <div class="col-md-3">
                      <label>CUSTOMER NAME</label>
                      <input type="text" class="form-control" name="customer_name">
                    </div>
                  </div>
                  <hr>
                  <div class="text-right">
                    <label>ADD MORE </label>
                    <button type="button" name="add_more" id="add_more2" class="btn btn-success btn-sm">+</button>
                  </div>
                  <table class="table-responsive remove_datatable">
                    <thead class="">
                      <tr class="odd" role="row">
                        <th>#</th>
                        <th>Unit</th>
                        <th>Quantity</th>
                        <th>priority</th>
                        <th>Order Barcode</th>
                        <th>Remark</th>
                        <th>Fabric Name</th>
                        <th>Hsn</th>
                        <th>Design Name</th>
                        <th>Design Code</th>
                        <th>Stitch</th>
                        <th>Dye</th>
                        <th>Matching</th>
                        <th>Option</th>
                      </tr>
                    </thead>
                    <tbody id="fresh_data2">
                      <?php  $id=1;
                      foreach ($order_data as $value) { ?>
                      <tr class="gradeU" id="tr_<?php echo $value['order_id']?>">
                        <td><input type="text" class="form-control" name="serial_number[]" value="<?php echo $value['series_number']?>" required></td>
                        <td><input type="text" name="unit[]" class="form-control" value="<?php echo $value['unit']?>" required></td>
                        <td><input type="text" class="form-control" name="quantity[]" value="<?php echo $value['quantity']?>" required></td>
                        <td><input type="text" class="form-control" name="priority[]" value="<?php echo $value['priority']?>" required></td>
                        <td> <input type="text" class="form-control" name="order_barcode[]" value="<?php echo $value['order_barcode']?>" required>
                        </td>
                        <td><input type="text" class="form-control" name="remark[]" value="<?php echo $value['remark']?>" required></td>
                        <td><input type="text" name="fabric_name[]" class="form-control" value="<?php echo $value['fabric_name'];?>" required></td>
                        <td><input type="text" class="form-control" name="hsn[]" value="<?php echo $value['hsn'];?>"></td>

                        <td><input type="text" name="design_name[]" class="form-control" value="<?php echo $value['design_name']?>" required></td>
                        <td><input type="text" name="design_code[]" class="form-control" value="<?php echo $value['design_code']?>" required></td>
                        <td><input type="text" class="form-control" name="stitch[]" value="<?php echo $value['stitch']?>" required></td>
                        <td><input type="text" class="form-control" name="dye[]" value="<?php echo $value['dye']?>"></td>
                        <td><input type="text" class="form-control" name="matching[]" value="<?php echo $value['matching']?>" required></td>
                        <td>
                          <button type="button" name="remove" class="btn btn-danger btn-xs remove">-</button>
                        </td>
                      </tr>

                      <?php $id=$id+1; } ?>
                    </tbody>
                  </table>
                  <div class="col-md-3 align-center"><br>
                    <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="submit" name="submit" class="btn btn-info btn-block" value="ORDER" />
                  </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>

  </div>
</div>


<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      window.location = "<?php echo base_url()?>admin/Orders/deleteOrders/" + id;
    }
  }
</script>

<?php include('order_js.php');?>
