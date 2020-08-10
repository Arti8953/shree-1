<div id="content">
<div id="content-header">
<div class="container-fluid">
 <div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-body">
              <div id="overlay">
              </div>
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                 <h5>SRC List</h5>
                </div><hr>
                <h4 style="color:red"><?php echo $this->session->flashdata('msg'); ?></h4>
              <div id="spreadsheet"></div>
              <p><button id='download'>Download as CSV</button></p>

            </div>

          </div>
     </div>
         <div class="col-md-4">
        <div class="card">
            <div class="card-body">
                <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
                 <h5>New Fabric List</h5>
                </div><hr>
                <table class="table" >
                   <thead>
                     <tr>
                        <th>Fabric Name</th>
                        <th>Purchase</th>
                        <th>Sale Rate</th>
                     </tr>
                   </thead>
              <tbody>
                <?php  foreach ($fresh_fabricname as $value) { ?>
                        <tr class="gradeU order_row" id="">

                        <td><?php echo $value['fabricName'];?></td>
                        <td><?php echo $value['purchase'];?></td>
                        <td><?php echo $value['sale_rate'];?></td>

                    </tr>

                <?php }?>


            </tbody>
        </table>
    </div>
        </div>
     </div>

</div>



</div>
</div>
</div>
<style>
    #DataTables_Table_0_filter{
        display:none;
    }
</style>
<?php include('src_js.php');?>
