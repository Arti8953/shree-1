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
                url: "<?php echo base_url('admin/FRC/get_frc_PBClist') ?>",
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
                                      .column(8)
                                      .data()
                                      .reduce(function(a, b) {
                                          return intVal(a) + intVal(b);
                                      }, 0);

                                  // Total over this page
                                  pageTotal = api
                                      .column(8, {
                                          page: 'current'
                                      })
                                      .data()
                                      .reduce(function(a, b) {
                                          return intVal(a) + intVal(b);
                                      }, 0);

                                  // Update footer
                                  $(api.column(8).footer()).html(
                                      // +pageTotal + ' ( ' + total + ' total)'
                                      ' ( ' + total + ' )'
                                  );
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




    var count = 0;
    var total = 0;
    var color = '';
    var Pur_rate = 0;
    $('#fresh_form').hide();
    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    $(document).on('click', '#add_tc', function() {
      event.preventDefault();
      tc = $('#tcmain').val();
      pbc = $('#pbc').val();
      qty = $('#Cur_quantity').val();
      if (tc == "") {
        alert("please enter some value in tc");
      } else if (pbc == "") {
        alert("please enter some value in pbc");
      } else {
        var del = confirm("Do you want to Add this ?");
        if (del == true) {

          $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/FRC/update_tc",
            cache: false,
            data: {
              'pbc': pbc,
              'tc': tc,
              'qty': qty,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {
              location.reload();

            }
          });
        }
      }
    });

    $('#add_more2').on('click', function() {

      addmore();


    });
    $(document).on('keypress', function(e) {
      if (e.which == 13) {
        event.preventDefault();
        addmore();
      }
    });
    $(document).on('click', '.remove', function() {
      $(this).parent().parent().remove();
      count = count - 1;
    });



    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });

    $('#pbc').on('change', function(e) {
      var pbc = $(this).val();
      pbc = pbc.toUpperCase();
      $(this).val(pbc);
      var csrf_name = $("#get_csrf_hash").attr('name');
      var csrf_val = $("#get_csrf_hash").val();
      $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/FRC/getPBC') ?>",
        data: {

          'id': pbc,
          '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
        },

        success: function(data) {
          data = JSON.parse(data);
          if (data[0] != "") {
            $('#fresh_form').show();

            color = data[0][0]['color_name'];
            Pur_rate = data[0][0]['purchase_rate'];
            $("#msg").html("");
            $('#fabric_id').val(data[0][0]['fabric_id']);
            $('#fabric').val(data[0][0]['fabricName']);
            $('#Tquantity').val(data[0][0]['current_stock']);
            $('#date').val(data[0][0]['created_date']);
            $('#fabtype').val(data[0][0]['fabric_type']);
            $('#tcmain').val(data[0][0]['tc']);
            $('#challan_no').val(data[0][0]['challan_no']);
            $('#ad_no').val(data[0][0]['ad_no']);
            $('#Cur_quantity').val(data[0][0]['current_stock']);
            $('#unit').val(data[0][0]['stock_unit']);
            $('#pcode').val(data[0][0]['purchase_code']);
            $('.color').val(data[0][0]['color_name']);
            $('#hsn').val(data[0][0]['hsn']);
            $('.rate').val(data[0][0]['purchase_rate']);
          } else {
            $('#fresh_form').hide();
            toastr.error("PBC Not Found");
            $('#fabric_id').val("");
            $('#fabric').val("");
            $('#Tquantity').val("");
            $('#date').val("");
            $('#fabtype').val("");
            $('#tcmain').val("");
            $('#challan_no').val("");
            $('#ad_no').val("");
            $('#Cur_quantity').val("");
            $('#unit').val("");
            $('#pcode').val("");
            $('.color').val("");

            $('.rate').val("");
          }
          $('#details').html(data[1]);
        }
      });
    });



    $(document).on('change', "input[name='tc[]']", function() {

      total = Number($('#Tquantity').val());
      console.log("total=" + total);
      qty = get_current_quntity()
      $('#Cur_quantity').val(qty)
      console.log(qty);
      if (qty > total) {
        alert("enter value less than current qauntity");
        $(this).val("");
      } else {

        console.log(qty);
      }
    });

    $(document).on('change', "input[name='quantity[]']", function() {
      var id = $(this).parent().parent().attr("id");
      console.log("id=" + id);
      var q = Number($(this).val());
      console.log("q=" + q);
      var rate = Number($('#rate' + id + '').val());
      var val = rate * q;
      console.log("val=" + val);
      $('#value' + id + '').val(val);
    });

    function get_current_quntity() {
      var current = 0;
      $("input[name='quantity[]']").each(function() {
        current += Number($(this).val());
        console.log("Current=" + current);
      });
      $("input[name='tc[]']").each(function() {
        current += Number($(this).val());
        console.log("Current=" + current);
      });
      return Number(total - current);
    }

    function addmore() {
      count = count + 1;
      var element = ' <tr id=' + count + '>'
      element += '<td><input type="text" class="form-control sno" name="sno[]" value=' + (count + 1) + ' readonly></td>'
      element += '<td><input type="text" class="form-control qty" name="quantity[]" id="qty' + count + '"></td>'
      element += '<td><input type="text" name="tc[]" class="form-control " value="" id="tc' + count + '"></td>'
      element += '<td><input type="text" class="form-control " name="color[]" value=' + color + ' readonly></td>'
      element += '<td><input type="text" name="rate[]" class="form-control " value=' + Pur_rate + ' id="rate' + count + '" readonly></td>'
      element += '<td><input type="text" name="value[]" class="form-control " value="" id="value' + count + '" readonly></td>'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>'

      $('#fresh_data').append(element);
    }

  });
  <?php if ($this->session->flashdata('success')) { ?>
    toastr.success("<?php echo $this->session->flashdata('success'); ?>");
  <?php } else if ($this->session->flashdata('error')) {  ?>
    toastr.error("<?php echo $this->session->flashdata('error'); ?>");
  <?php } else if ($this->session->flashdata('warning')) {  ?>
    toastr.warning("<?php echo $this->session->flashdata('warning'); ?>");
  <?php } else if ($this->session->flashdata('info')) {  ?>
    toastr.info("<?php echo $this->session->flashdata('info'); ?>");
  <?php } ?>
</script>
