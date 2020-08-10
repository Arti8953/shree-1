<script src="<?php echo base_url('jexcelmaster/') ?>asset/js/jquery.3.1.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {


        var fil = '';
        var table;
        getlist(fil);

        console.log($('#frc').DataTable().page.info());
        function getlist(filter1){

            var csrf_name = $("#get_csrf_hash").attr('name');
            var csrf_val = $("#get_csrf_hash").val();
            table = $('#frc').DataTable({
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
                url: "<?php echo base_url('admin/FRC/get_tc_list') ?>",
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
                     $('#caption').text("PBC List");
                   }
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

            $('#frc').DataTable().destroy();
            getlist(filter);

          });

          $("#simplefilter").click(function(event) {
            event.preventDefault();
            var filter = {
              'searchByCat': $('#searchByCat').val(),
              'searchValue': $('#searchValue').val(),
              'challan_from': $('#challan_from').val(),
              'challan_to': $('#challan_to').val(),
              'type': $('#type').val(),
              'search': 'simple'
            };

            $('#frc').DataTable().destroy();
            getlist(filter);

          });
           $("#clearfilter").click(function(event) {
           $('#frc').DataTable().destroy();
           getlist('');

          });

           $("#advancefilter").click(function(event) {
            event.preventDefault();
            var filter = {
              // 'challan_from': $('#challan_from').val(),
              // 'challan_to': $('#challan_to').val(),
              'search': 'advance',
              'parent_barcode': $('#parent_barcode').val(),
              'fabricName': $('#fabricName').val(),
              'color_name': $('#color_name').val(),
              'stock_quantity': $('#stock_quantity').val(),
              'current_stock': $('#current_stock').val(),
              'tc': $('#tc').val(),
              'type': 'pbc',

            };
            $('#frc').DataTable().destroy();
             getlist(filter);

          });
        });

</script>
