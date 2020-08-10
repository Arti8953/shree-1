
 <?php include(dirname(__FILE__).'/../../layout/css.php') ?>
  

<div class="container-fluid">
       <h4 class="card-title"><?php echo $title;?></h4>                  
                            <table >
                                <thead class="bg-dark text-white">
                                    <tr class="odd" role="row">
                                       
                                       <th>Date</th> 
                                        <th>Challan No</th> 
                                        <th>Pbc</th> 
                                        <th>Fabric </th>
                                        
                                        <th>Hsn </th>
                                        <th>FAb Type</th> 
                                        <th>color</th>
                                        <th>ad_no</th> 
                                        <th>Quantity</th> 
                                        <th>current qty</th> 
                                        <th>Unit </th>
                                        <th>rate </th>
                                        <th>total</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                        $c=1;$total_qty=0.00;$total_val=0.00;
                                        
                                        foreach ($frc_data as $value) { 
                                          $total_qty+=$value->stock_quantity;
                                        $total_val+=$value->total_value;?>
                                        <tr class="gradeU" >

                                         
                                         <td><?php $date=date_create($value->created_date);
echo date_format($date,"d-m-y "); ?></td>
                                          <td><?php echo $value->challan_no?></td>
                                          <td><?php echo $value->parent_barcode;?></td>
                                         <td><?php echo $value->fabricName;?></td>
                                           <td><?php echo $value->hsn;?></td>
                                            <td><?php echo $value->fabric_type?></td>
                                            <td ><span class="label label-danger"><?php echo $value->color_name?></span></td>
                                             <td><?php echo $value->ad_no;?></td>
                                             <td><?php echo $value->stock_quantity?></td>
                                          <td ><span class="label label-danger"><?php echo $value->current_stock?></span></td>
                                          <td><?php echo $value->stock_unit?></td>
                                          
                                         <td><?php echo $value->purchase_rate;?></td>
                                           <td><?php echo $value->total_value;?></td>
                                         
                                        </tr>

                                <?php $c=$c+1; 
                              } ?>
                                </tbody><tfoot>
                                <tr class="bg-dark text-white"> <th></th><th></th> <th></th><th></th> <th></th> <th></th> <th></th>
                   <th>Total</th>
                  <th id="th_qty"><?php echo $total_qty ?></th>
                  <th></th>
             
                  <th></th>
                  <th>Total</th>
                  <th id="th_total" ><?php echo $total_val ?></th>
                  </tr>
                    </tfoot>        </table>
                        
</div>
<?php include(dirname(__FILE__).'/../../layout/footer.php') ?>
