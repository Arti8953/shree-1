                                       <caption style='caption-side : top' class=" text-info">
                                          <h6 class="text-center"> <?php echo $caption; ?></h6>
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
                                       <tbody><?php
                                                $id = 1;
                                                $t = 0.0;
                                                $q = 0.0;
                                                $cq = 0;
                                                foreach ($frc_data as $value) {
                                                   $t += $value['tc'];
                                                   $cq += $value['current_stock']
                                                ?>
                                             <tr class="<?php if ($value['parent'] == '') {
                                                            echo 'font-weight-bold text-primary';
                                                            $q += $value['stock_quantity'];
                                                         } ?>" id="tr_<?php echo $value['fsr_id'] ?>">

                                                <td> <span class="label label-info"><?php echo $id ?></span></td>
                                                <td><?php $date = date_create($value['created_date']);
                                                      echo date_format($date, "d-m-y "); ?></td>


                                                <td><?php echo $value['parent_barcode']; ?></td>
                                                <td><?php echo $value['fabricName']; ?></td>
                                                <td><span class="label label-danger"><?php echo $value['color_name']; ?></span></td>


                                                <td><b><?php echo $value['stock_quantity'] ?></b></td>
                                                <td><b><span class="label label-danger"><?php echo $value['current_stock'] ?></span></b></td>
                                                <td><b><?php echo $value['stock_unit'] ?></b></td>
                                                <td><?php echo $value['tc'] ?></td>


                                             </tr>

                                          <?php
                                                   $id = $id + 1;
                                                }
                                          ?> </tbody>
                                       <tfoot class="bg-dark text-white">
                                          <tr>
                                             <th>Total</th>
                                             <th></th>
                                             <th></th>
                                             <th></th>
                                             <th></th>
                                             <th><?php
                                                   echo $q;
                                                   ?></th>
                                             <th><?php
                                                   echo $cq;
                                                   ?></th>
                                             <th></th>
                                             <th><?php
                                                   echo $t;
                                                   ?></th>


                                          </tr>
                                       </tfoot>