<script src="<?php echo base_url('jexcelmaster/') ?>asset/js/jquery.3.1.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {


          var fil = '';
          var table;
          var html='';
          var type='';
          getlist(fil);
          // console.log($('#frcstock').DataTable().page.info());
              function getlist(filter1){

              var csrf_name = $("#get_csrf_hash").attr('name');
              var csrf_val = $("#get_csrf_hash").val();
              table = $('#frcstock').DataTable({
                "processing": true,
                "serverSide": true,

                 // stateSave: true,
                "pageLength": 50,
                "lengthMenu": [
                  [50, 100, 150, -1],
                  [50, 100, 150, "All"]
                ],

                "destroy": true,
                scrollY: 500,
                paging: true,


                "ajax": {
                  url: "<?php echo base_url('admin/FRC/get_frc_stocklist') ?>",
                  type: "post",
                  data: {
                    filter: filter1,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                  },
                   datatype: 'json',
                   "dataSrc": function(json) {
                     if (json.caption && json.caption == true) {
                       $('#caption').text(json.caption);
                     } else {
                       $('#caption').text("FRC Recieve List");
                     }


                     if(json.type && json.type!=''){

                     window.html+= '<table class=" table-bordered  text-center  table-responsive " id="dt_summary"><tr>';

                     window.html+= '<caption class="text-center text-info" style="caption-side : top">Summary</caption>';
                          json.type.forEach(type);

                          function type(item, index, arr){
                            // console.log(arr[index].type);
                             type= arr[index].type;

                    window.html+= '<td class="align-top">';
                    window.html+= '<table class=" table-bordered  data-table text-center  table-responsive ">';
                    window.html+= '<caption class="text-center text-info" id="caption" style="caption-side : top"> '+arr[index].type+' </caption>';
                    window.html+= '<thead><th>Fabric</th> <th>Pcs</th>   <th>Quantity</th><th>Total</th></thead>  <tbody>';

                         var pcs = 0;
                         var qty = 0;
                         var total = 0;
                         json.summary.forEach(summary);
                         function summary(item, index,arr1){
                           if (arr1[index].fabric_type == type) {

                             pcs += Number(arr1[index].pcs);
                             qty += Number(arr1[index].qty);
                             total += Number(arr1[index].total);


                  window.html+= '<tr><td><button class="btn btn-link fabric"> '+arr1[index].fabricName+'</button>  </td>';
                  window.html+= '<td>'+arr1[index].pcs+'</td><td>  '+arr1[index].qty+'</td><td>  '+arr1[index].total+' </td> </tr>';

                                    } }

                 window.html+=  '</tbody> <tr>   <th>Total</th> <th>  '+pcs+'</th>   <th> '+qty+' </th> <th> '+total+'  </th> </tr>';

                   window.html+= '</table> </td>   <td></td>';

                            }
                      window.html+= '</tr> </table>';
                     // window.html=html;
                     }
                     else{
                       console.log('ok');
                     }
                     // console.log(html);
                   $('#summaryresult').html(window.html);

                    return json.data;
                  },
                },

              });
            }
            $("#dateFilter").click(function(event) {
              event.preventDefault();
              var filter = {
                'from': $('#date_from').val(),
                'to': $('#date_to').val(),
                'search': 'datefilter'
              };

              $('#frcstock').DataTable().destroy();
              getlist(filter);

            });

            $("#simplefilter").click(function(event) {
              event.preventDefault();
              var filter = {
                'searchByCat': $('#searchByCat').val(),
                'searchValue': $('#searchValue').val(),
                'from': $('#from').val(),
                'to': $('#to').val(),
                'type': $('#type').val(),
                'search': 'simple'
              };

              $('#frcstock').DataTable().destroy();
              getlist(filter);

            });
            $(document).on('click','.fabric',function(event) {
              // console.log("ok");
              var filter = {
                'searchByCat': 'fabricName',
                'searchValue': $(this).text(),
                'from': $('#date_from').val(),
                'to': $('#date_to').val(),
                'search': 'simple'

              };
              console.log(filter);
             $('#frcstock').DataTable().destroy();
              getlist(filter);

            });

             $("#clearfilter").click(function(event) {
             $('#frcstock').DataTable().destroy();
             getlist('');

            });

             $("#advancefilter").click(function(event) {
              event.preventDefault();
              var filter = {
                'from': $('#from_value').val(),
                'to': $('#to_value').val(),
                'search': 'advance',
                'challan_no': $('#challan_no').val(),
                'challan_to': $('#challan_to').val(),
                'parent_barcode': $('#parent_barcode').val(),
                'fabricName': $('#fabricName').val(),
                'hsn': $('#hsn').val(),
                'fabric_type': $('#fabric_type').val(),
                'color_name': $('#color_name').val(),
                'ad_no': $('#ad_no').val(),
                'stock_quantity': $('#stock_quantity').val(),
                'current_stock': $('#current_stock').val(),
                'stock_unit': $('#stock_unit').val(),
                'purchase_rate': $('#purchase_rate').val(),
                'total_value': $('#total_value').val(),
                'type': 'stock',

              };
              $('#frcstock').DataTable().destroy();
               getlist(filter);

            });
});
</script>
