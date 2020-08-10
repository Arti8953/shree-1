<div class="container-fluid">
    <!-- ============================================================== -->
    <!-- Start Page Content -->
    <!-- ============================================================== -->
    <div class="row">

        <!-- **************** Product List *****************  -->
        <div class="col-md-12 bg-white">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Order List</h4>
                    <hr>
                    <?php
            if($this->session->tempdata('edit'))
            {
            ?>
                    <div class="alert alert-success p-2" role="alert">
                        <?php echo $this->session->tempdata('edit'); ?>
                    </div>
                    <?php
            }
            ?>
                    <div class="widget-box">
                        <div class="widget-content nopadding">
                            <table class="table table-bordered data-table text-center">
                                <thead class="thead-dark">
                                    <tr>
                                        <th>S/No</th>
                                        <th>Product Id</th>
                                        <th>Customer Name</th>
                                        <th>Email</th>
                                        <th>Quantity</th>
                                        <th>Price</th>
                                        <th>Payment Method</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                  if($all_Order>0)
                  {
                  $id=1;
                  foreach ($all_Order as $orders) { ?>
                                    <tr class="gradeX">
                                        <td><?php echo $id ?></td>
                                        <td><?php echo $orders->product_id; ?></td>
                                        <td><?php echo $orders->fname; ?></td>
                                        <td><?php echo $orders->email; ?></td>
                                        <td><?php echo $orders->quantity; ?></td>
                                        <td>₹<?php echo $orders->price; ?></td>
                                        <td> <?php if ($orders->paymentMethod=="Online Pay")
                                        echo "<span class='badge badge-primary'>$orders->paymentMethod</span>" ; 
                                        else 
                                         echo "<span class='badge badge-warning'>$orders->paymentMethod</span>" ;
                                        ?> 
                                         
                                        </td>
                                        

                                    </tr>
                                    <?php  $id=$id+1; } } ?>
                                </tbody>
                            </table>
                        </div>
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
