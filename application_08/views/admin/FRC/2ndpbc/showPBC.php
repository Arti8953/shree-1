<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-md-12 ">
      <div class="card">
        <div class="card-body">
          <div id="accordion">

            <div class="modal-content">
              <div class="modal-header">
                <a class="card-link" data-toggle="collapse" href="#collapseOne">
                  Simple filter
                </a>
              </div>
              <div id="collapseOne" class="collapse show" data-parent="#accordion">
                <div class="modal-body">
                  <form  method="post">
                    <div class="form-row">

                      <div class="col-2">

                        <select id="searchByCat" name="searchByCat" id="searchByCat" class="form-control form-control-sm" required>
                          <option value="">-- Select Category --</option>
                          <option value="parent_barcode">PBC</option>
                          <option value="fabricName">fabricName</option>
                          <option value="color_name">Color </option>
                          <option value="stock_quantity">Quantity</option>
                          <option value="current_stock">Curr. Qty</option>
                          <option value="stock_unit">Unit</option>
                          <option value="tc">TC</option>
                        </select>
                      </div>
                      <div class="col-2">

                        <input type="text" name="searchValue" id="searchValue" class="form-control form-control-sm" value="" placeholder="Search" required>
                      </div>
                      <input type="hidden" name="type" id='type' value="pbc">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <button type="submit" name="search" value="simple" id="simplefilter"  class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>
                    </div>
                  </form>
                </div>
              </div>
            </div>

            <div class="modal-content">
              <div class="modal-header">
                <a class="collapsed card-link" data-toggle="collapse" href="#collapseTwo">
                  Advance filter
                </a>
              </div>
              <div id="collapseTwo" class="collapse" data-parent="#accordion">
                <div class="modal-body">
                  <form  method="post">
                    <table class=" remove_datatable">
                      <caption>Advance Filter</caption>
                      <thead>
                        <tr>
                          <!-- <th>Date_from</th>
                          <th>Date_to</th> -->
                          <th>PbC</th>
                          <th>Fabric_name</th>
                          <th>Color</th>
                          <th>Quantity</th>
                          <th>Curr Qty</th>
                          <th>Unit</th>
                          <th>TC</th>
                        </tr>
                      </thead>
                      <tr>
                        <!-- <td>
                          <input type="date" name="date_from"  class="form-control form-control-sm" value="<?php echo date('Y-04-01') ?>"></td>

                        <td>
                          <input type="date" name="date_to" class="form-control form-control-sm" value="<?php echo date('Y-m-d') ?>"></td>
                           -->
                        <td>
                          <input type="text" name="parent_barcode" id="parent_barcode" class="form-control form-control-sm" value="" placeholder="PBC"></td>

                        <td><input type="text" name="fabricName" id="fabricName" class="form-control form-control-sm" value="" placeholder="Fabric Name"></td>

                        <td>
                          <input type="text" name="Color" id="color_name" class="form-control form-control-sm" value="" placeholder="Color"></td>
                          <td>
                            <input type="text" name="stock_quantity" id="stock_quantity" class="form-control form-control-sm" value="" placeholder=" Qty"></td>
                          <td>
                            <input type="text" name="current_stock" id="current_stock" class="form-control form-control-sm" value="" placeholder="Curr Qty"></td>

                          <td>
                            <input type="text" name="unit" id="unit" class="form-control form-control-sm" value="" placeholder="Unit"></td>
                          <td>
                            <input type="text" name="tc" id="tc" class="form-control form-control-sm" value="" placeholder="TC"></td>

                      </tr>




                    </table>
                    <input type="hidden" name="type"  value="pbc">
                    <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                    <button type="submit" name="search" value="advance" id="advancefilter" class="btn btn-info btn-xs"> <i class="fas fa-search"></i> Search</button>

                  </form>
                </div>
              </div>
            </div>



          </div>

        </div>
      </div>
    </div>
    <!-- **************** Product List *****************  -->
    <div class="col-md-12 bg-white">
      <div class="card">
        <div class="card-body">
          <h4 class="card-title">2nd PBC List</h4>
          <hr>

          <div class="widget-box">
            <div class="row well">
              <div class="col-6">
                <a type="button" class="btn btn-info   btn-success" href='<?php echo base_url('/admin/FRC/Show_PBC'); ?>' style="color:#fff;">Clear filter</a>
              </div>
              <div class="col-6">

                <form  method="post">

                  <div class="form-row ">
                    <div class="col-5">
                      <label>Date From</label>
                      <input type="date" name="date_from"  id="date_from" class="form-control form-control-sm" >
                    </div>
                    <div class="col-5">
                      <label>Date To</label>
                      <input type="date" name="date_to"  id="date_to" class="form-control form-control-sm" >
                    </div>
                    <div class="col-2">
                      <label>Search</label>
                      <input type="hidden" name="type" value="pbc">
                      <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                      <button type="submit" class="btn btn-info btn-xs" id="dateFilter"> <i class="fas fa-search"></i> Search</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
            <hr>
            <table class="table table-bordered  text-center table-responsive" id="frc">
              <caption style='caption-side : top' class=" text-info">
                 <h6 class="text-center" id="captaion"> </h6>
              </caption>
              <thead class="bg-dark text-white">
                 <tr>
                    <th>Sno</th>
                    <th>Date</th>
                    <th>PBC</th>
                    <th>Fabric</th>
                    <th>Color</th>
                    <th>Quantity</th>
                    <th>Current quantity</th>
                    <th>Unit</th>
                    <th>TC</th>


                 </tr>
              </thead>
            </thead>
      <tfoot>
        <tr>

            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th></th>
            <th>Total</th>
            <th></th>

        </tr>
    </tfoot>
            </table>
            <hr><?php
                if ($summary) {

                ?>
              <table class=" table-bordered text-center remove_datatable">
                <caption>Summary</caption>
                <thead class="bg-secondary text-white">
                  <tr>

                    <th>Fabric</th>
                    <th>Pcs</th>
                    <th>Quantity</th>
                    <th>Total tc</th>
                  </tr>
                </thead>
                <tbody><?php
                        $pcs = 0;
                        $qty = 0;
                        $tc = 0;
                        foreach ($summary as $value) {
                          $pcs += $value['pcs'];
                          $qty += $value['qty'];
                          $tc += $value['tc'];
                        ?><tr>

                      <td><?php echo $value['fabricName']; ?></td>
                      <td><?php echo $value['pcs']; ?></td>
                      <td><?php echo $value['qty']; ?></td>
                      <td><?php echo $value['tc']; ?></td>
                    </tr>
                  <?php } ?>
                </tbody>
                <tr>


                  <th>total</th>
                  <th><?php echo $pcs  ?></th>
                  <th><?php echo $qty  ?></th>
                  <th><?php echo $tc  ?></th>
                </tr>
              </table>
            <?php } ?>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>


<script>

</script>

<?php include('FRC_js.php'); ?>
