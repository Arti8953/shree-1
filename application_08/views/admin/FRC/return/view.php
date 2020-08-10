<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->



  <!-- **************** Product List *****************  -->
  <div class="col-md-12 bg-white">
    <div class="card">
      <div class="card-body">
        <h4 class="card-title">Challan Return Detail</h4>
        <hr>

        <div class="widget-box">
          <div class="widget-content nopadding">


            <table class="table-bordered  text-center table-responsive" id="frcview">
              <caption style='caption-side : top' class=" text-info ">
                <div class="row well container">
                  <div class="col-4">
                    <h6> Challan No - <span class="label label-primary"> <?php echo $frc_data[0]['challan_no']?></span>
                    </h6>
                  </div>
                  <div class="col-4">
                    <h6> Challan From - <span class="label label-primary"> <?php echo $pbc[0]['sub1']?></span>
                    </h6>
                  </div>
                  <div class="col-4">
                    <h6> Challan To - <span class="label label-primary"> <?php echo $pbc[0]['sub2']?></span>
                    </h6>
                  </div>
                </div>
              </caption>
              <thead class="bg-dark text-white">
                <tr class="odd" role="row">
                  <th><input type="checkbox" class="sub_chk" id="master"></th>
                  <th>Date</th>
                  <th>PBC</th>
                  <th>Fabric </th>
                  <th>Hsn </th>
                  <th>Total qty</th>
                  <th>Color</th>
                  <th>curr qty</th>
                  <th>Ad_no</th>
                  <th>P _code </th>
                  <th>T_value</th>
                </tr>
              </thead>


            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

</div>
</div>

<script type="text/javascript">

$(document).ready(function() {
  var fil = '';
  var table;
  getlist(fil);
  console.log($('#frcview').DataTable().page.info());
      function getlist(filter1){

      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      table = $('#frcview').DataTable({
        "processing": true,
        "serverSide": true,

         stateSave: true,
        "pageLength": 50,
        "lengthMenu": [
          [50, 100, 150, -1],
          [50, 100, 150, "All"]
        ],

        "destroy": true,
        scrollY: 500,
        paging: true,


        "ajax": {
          url: "<?php echo base_url('admin/FRC/getView/').$id ?>",
          type: "post",
          data: {
            filter: filter1,
            '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
          },
           datatype: 'json',
           "dataSrc": function(json) {
             // if (json.caption && json.caption == true) {
             //   $('#caption').text(json.caption);
             // } else {
             //   $('#caption').text("FRC Recieve List");
             // }
            return json.data;
          },
        },
        "footerCallback": function(row, data, start, end, display) {
                            var api = this.api(),
                                data;

                            // Remove the formatting to get integer data for summation
                            var intVal = function(i) {
                                return typeof i === 'string' ?
                                    i.replace(/[\$,]/g, '') * 1 :
                                    typeof i === 'number' ?
                                    i : 0;
                            };

                            // Total over all pages
                            total = api
                                .column(10)
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Total over this page
                            pageTotal = api
                                .column(10, {
                                    page: 'current'
                                })
                                .data()
                                .reduce(function(a, b) {
                                    return intVal(a) + intVal(b);
                                }, 0);

                            // Update footer
                            $(api.column(10).footer()).html(
                                // +pageTotal + ' ( ' + total + ' total)'
                                ' ( ' + total + ' total)'
                            );
                        },
      });
    }


});

</script>
<?php include('FRC_js.php');?>
