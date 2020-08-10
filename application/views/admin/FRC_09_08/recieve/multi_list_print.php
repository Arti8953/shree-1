
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
          <hr>
<table border="1">
  <?php //echo print_r($data); ?>
  <thead class="">
                                    <tr class="odd" role="row">
                                        
                                        <th>Date</th>
                                        
                                        <th>Party name</th> 
                                        <th>Challan no</th>
                                        <th>Fabric Type</th>
                                        <th>Quantity</th>
                                       
                                        <th>Total amount</th> 
                                        
                                        
                                    </tr>
                                </thead>
  <?php   $id=1; 
  foreach ($data as $value): ?>
   <tr >

                                        
                                          <td><?php echo $value[0]['challan_date'];?></td>

                                          <td><?php echo $value[0]['subDeptName'];?></td>
                                         <td><?php echo $value[0]['challan_no'];?></td>
                                           <td><?php echo $value[0]['fabric_type'];?></td>
                                          
                                          <td><?php echo $value[0]['total_quantity']?></td>
                                         
                                          <td><?php echo $value[0]['total_amount']?></td>
                                          
       </tr>
  <?php $id=$id+1;  endforeach; ?>
