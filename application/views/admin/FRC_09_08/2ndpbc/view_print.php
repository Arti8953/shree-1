
  <style>
  .PrintThis table {
      width:100%;
  }

  .PrintThis table tr td {
      text-align: center;
      padding: 0px 5px;
      vertical-align: top;
  }

  .PrintThis table td {
      font-size: 12px;
      font-weight: 700;
  }

  .PrintThis table table {
      width: 300px;
  }
  
  .PrintThis table table td {
      border: none;
      text-align: left;
  }

  

  </style>
       <h4 class="card-title"><?php echo $title;?></h4>                  
                            <table >
                                <thead >
                                    <tr class="odd" role="row">
                                       
                                        <th>Date</th>
                                        <th>PBC</th>
                                        <th>Fabric</th> 
                                       
                                        <th>Quantity</th>
                                        <th>Current quantity</th>  
                                        <th>Unit</th>
                                        <th>TC</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                  <?php
                                        $c=1;$total_qty=0.00;$total_val=0.00;
                                        
                                        foreach ($frc_data as $value) { 
                                          $total_qty+=$value->stock_quantity;
                                        $total_val+=$value->tc;?>
                                        <tr class="gradeU" >

                                         
                                          <td><?php echo $value->created_date;?></td>

                                          <td><?php echo $value->parent_barcode;?></td>
                                         <td><?php echo $value->fabricName;?></td>
                                         
                                          
                                          <td><?php echo $value->stock_quantity?></td>
                                         
                                          <td><?php echo $value->current_stock?></td>
                                        
                                         <td><?php echo $value->stock_unit;?></td>
                                           <td><?php echo $value->tc;?></td>
                                         
                                        </tr>

                                <?php $c=$c+1; } ?>
                                </tbody>
                                <tr > <th></th>
                  <th></th>
                   <th>Total</th>
                  <th id="th_qty"><?php echo $total_qty ?></th>
                  <th></th>  
                  
                 
                  <th>Total</th>
                  <th id="th_total" ><?php echo $total_val ?></th>
                  </tr>
                            </table>
                        


