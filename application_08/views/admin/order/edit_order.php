
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Start Page Content -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form class="form-horizontal" action="<?php echo base_url('admin/orders/update_orderdata/').$data->order_id ?>"   method="post" enctype="multipart/form-data">
                        <div class="card-body">
                            <h4 class="card-title">Edit order</h4><hr>
                         <div class="modal-body">
                         <div class="row" id="">
                         <div class="col-md-3">
									<label>Sr.No.</label>

								<input type="text" class="form-control" name="serial_number" value="<?php echo $data->series_number;?>" id="" >
							</div>

							<div class="col-md-3">
									<label>Fabric Name</label>
									<input type="text" class="form-control" name="fabric_name" value="<?php echo $data->fabric_name;?>">
							</div>

							<div class="col-md-3">
									<label>Hsn</label>
									<input type="text" class="form-control" name="hsn" value="<?php echo $data->hsn;?>">
							</div>

							<div class="col-md-3">
									<label>Order Number</label>
									<input type="text" class="form-control" name="order_number"  value="<?php echo $data->order_number?>">
							</div>

							<div class="col-md-3">
									<label>Customer Name</label>
									<input type="text" class="form-control" name="customer_name" value="<?php echo $data->customer_name?>">
							</div>
							<!-- <div class="col-md-3">
									<label>Design Barcode</label>
									<input type="text" class="form-control" name="dbc" value="<?php echo $data->dbc?>">
							</div> -->
							<div class="col-md-3">
									<label>Design Name</label>
									<input type="text" class="form-control" name="design_name" value="<?php echo$data->design_name?>">
							</div>
							<div class="col-md-3">
									<label>Design Code</label>
									<input type="text" class="form-control" name="design_code" value="<?php echo $data->design_code?>">
							</div>

							<div class="col-md-3">
									<label>Stitch</label>
									<input type="text" class="form-control" name="stitch" value="<?php echo $data->stitch?>">
							</div>
							<div class="col-md-3">
									<label>Dye</label>
									<input type="text" class="form-control" name="dye" value="<?php echo $data->dye?>">
							</div>

							<div class="col-md-3">
									<label>Matching</label>
									<input type="text" class="form-control" name="matching" value="<?php echo $data->matching?>">
							</div>

							<div class="col-md-3">
									<label>Remark</label>
									<input type="text" class="form-control" name="remark" value="<?php echo $data->remark?>">
							</div>

							<div class="col-md-3">
									<label>Quntity</label>
									<input type="text" class="form-control" name="quantity" value="<?php echo $data->quantity?>">
							</div>
							<div class="col-md-3">
									<label>Unit</label>
									<input type="text" class="form-control" name="unit" value="<?php echo $data->unit?>">
							</div>

							<div class="col-md-3">
									<label>Order Barcode</label>
									<input type="text" class="form-control" name="order_barcode" value="<?php echo $data->order_barcode?>">
							</div>

							<div class="col-md-3">
									<label>priority</label>
									<input type="text" class="form-control" name="priority"  value="<?php echo $data->priority?>">
							</div>

							<div class="col-md-3 align-center" ><br>
                          <input type="hidden" id="get_csrf_hash" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
						   <input type="submit" name="action" id="order_btn" class="btn btn-info btn-block"
											value=" Edit Order" />
							</div>


                         </div>
                         </div>
                    </div>
                    </form>


                </div>
            </div>
        </div>
    </div>
