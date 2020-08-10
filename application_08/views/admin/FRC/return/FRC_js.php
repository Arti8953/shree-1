<script src="<?php echo base_url('jexcelmaster/') ?>asset/js/jquery.3.1.1.js"></script>
<script type="text/javascript">
  $(document).ready(function() {

        var fil = '';
        var table;
        getlist(fil);

        console.log($('#return').DataTable().page.info());
            function getlist(filter1){

            var csrf_name = $("#get_csrf_hash").attr('name');
            var csrf_val = $("#get_csrf_hash").val();
            table = $('#return').DataTable({
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
                url: "<?php echo base_url('admin/FRC/get_frc_return_list') ?>",
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

            $('#return').DataTable().destroy();
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

            $('#return').DataTable().destroy();
            getlist(filter);

          });
           $("#clearfilter").click(function(event) {
           $('#return').DataTable().destroy();
           getlist('');

          });

           $("#advancefilter").click(function(event) {
            event.preventDefault();
            var filter = {

              'search': 'advance',
              'subDeptName': $('#subDeptName').val(),
              'challan_no': $('#challan_no').val(),

              'fabric_type': $('#fabric_type').val(),
              'total_quantity': $('#total_quantity').val(),
              'total_amount': $('#total_amount').val(),
              'type': 'return',

            };
            $('#return').DataTable().destroy();
             getlist(filter);

          });







    var count = 0;
    var total = 0;
    var tqty = 0;
    var stotal = 0;
    var summary = [];
    $('#fresh_form').hide();
    $('#submit').hide();


    $('#master').on('click', function(e) {
      if ($(this).is(':checked', true)) {
        $(".sub_chk").prop('checked', true);
      } else {
        $(".sub_chk").prop('checked', false);
      }
    });
    $('#fromGodown ,#toGodown ').on('change', function() {
      var from = $('#fromGodown option:selected').val();
      var to = $('#toGodown option:selected').val();
      console.log('from= ' + from + 'to = ' + to);
      if (from != "" && to != "") {
        $('#fresh_form').show();
      } else {
        $('#fresh_form').hide();
      }

    });
    $('#add_more').on('click', function() {

      addmore();

    });
    $(document).on('keypress', function(e) {
      if (e.which == 13) {
        event.preventDefault();

        addmore();
        if (summary) {

          stotal = 0;
          tqty = 0;
          var html = '<table class=" table-bordered text-center remove_datatable"><caption>Summary</caption><thead class="bg-secondary text-white">';
          html += '<tr><th>fabric</th>';
          html += '<th>PCS</th>';
          html += '<th>Quantity</th>';

          html += '</tr>';
          html += '</thead>';
          html += '<tbody>';
          tqty = 0;
          stotal = 0;

          summary.forEach(myFunction);

          function myFunction(value, index, array) {
            stotal += array[index][2];
            tqty += array[index][1];
            html += ' <tr><td>' + array[index][0] + '</td>';
            html += '<td>' + array[index][1] + '</td>';
            html += '<td>' + array[index][2] + '</td></tr></tbody>';

          }
          html += '<tr><th>total</th><th>' + tqty + '</th><th>' + stotal + '</th></tr>';
          html += '</table>';

          $('#summary').html(html);
        }
      }
    });
    $(document).on('change', '.pbc', function(e) {
      var selected_option = $('#fromGodown option:selected').val();
      if (selected_option == '') {
        alert('Please select a Godown');
        $('#fromGodown ').focus();
      } else {

        var count = 0;
        var pbc = $(this).val();
        pbc = pbc.toUpperCase();
        $(this).val(pbc);
        $("input[name='pbc[]']").each(function(index, element) {
          current = $(this).val();
          if (current == pbc) {
            count += 1;
          }
        });
        if (count > 1) {
          alert('Already entered');
          $(this).focus();
          $(this).css("border-color", "red");
        } else {
          $(this).css("border-color", "");

          var id = $(this).parent().parent().attr("id");
          var from = $("#fromGodown").val();
          console.log(from);
          var csrf_name = $("#get_csrf_hash").attr('name');
          var csrf_val = $("#get_csrf_hash").val();
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/FRC/getPBC2') ?>",
            data: {

              'id': pbc,
              'from': from,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },

            success: function(data) {

              if (data != 0) {
                data = JSON.parse(data);

                $('#submit').show();
                $("#msg").html("");
                $('#fabric' + id + '').val(data[0]['fabricName']);
                $('#fabric_id' + id + '').val(data[0]['fabric_id']);
                $('#fabtype' + id + '').val(data[0]['fabric_type']);
                $('#qty' + id + '').val(data[0]['current_stock']);
                $('#hsn' + id + '').val(data[0]['fabHsnCode']);
                $('#challan' + id + '').val(data[0]['challan_no']);
                $('#adno' + id + '').val(data[0]['ad_no']);
                $('#pcode' + id + '').val(data[0]['purchase_code']);
                $('#unit' + id + '').val(data[0]['stock_unit']);
                $('#prate' + id + '').val(data[0]['purchase_rate']);
                if (summary == "") {

                  var fabric = $('#fabric' + id + '').val();
                  var pcs = 1;
                  var qty = Number($('#qty' + id + '').val());
                  var arr = [fabric, pcs, qty];
                  summary.push(arr);

                } else {
                  var found = 0;
                  summary.forEach(myFunction);

                  function myFunction(value, index, array) {
                    var fabric = $('#fabric' + id + '').val();
                    //  console.log('#fabric='+fabric);console.log('#value='+value);
                    if (fabric == array[index][0]) {
                      found = 1;
                      array[index][1] += 1;
                      array[index][2] += Number($('#qty' + id + '').val());
                      //  console.log('#fabric found'+summary);
                    }
                  }
                  
                  if (found == 0) {
                    fabric = $('#fabric' + id + '').val();
                    pcs = 1;
                    qty = Number($('#qty' + id + '').val());

                    arr = [fabric, pcs, qty];
                    summary.push(arr);


                    // console.log(summary);
                  }

                }

              } else {
                if (id == 0) {
                  $('#submit').hide();
                } else {
                  $('#submit').show();
                }

                toastr.error("PBC Not Found");
                $('#fabric' + id + '').val("");
                $('#fabtype' + id + '').val("");
                $('#qty' + id + '').val("");
                $('#hsn' + id + '').val("");
                $('#challan' + id + '').val("");
                $('#adno' + id + '').val("");
                $('#pcode' + id + '').val("");
                $('#unit' + id + '').val("");
                $('#prate' + id + '').val("");
              }

            }
          });
        }
      }
    });

    $(document).on('click', '.remove', function() {
      var id = $(this).parent().parent().attr("id");
      summary.forEach(myFunction);

      function myFunction(value, index, array) {
        var fabric = $('#fabric' + id + '').val();
        //  console.log('#fabric='+fabric);console.log('#value='+value);
        if (fabric == array[index][0]) {
          found = 1;
          array[index][1] -= 1;
          array[index][2] -= Number($('#qty' + id + '').val());

          //  console.log('#fabric found'+summary);
        }

      }
      $(this).parent().parent().remove();
    });

    $('.delete_all').on('click', function(e) {
      var allVals = [];
      $(".sub_chk:checked").each(function() {
        allVals.push($(this).attr('data-id'));
      });
      //alert(allVals.length); return false;
      if (allVals.length <= 0) {
        alert("Please select row.");
      } else {
        //$("#loading").show();
        WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
        var check = confirm(WRN_PROFILE_DELETE);
        if (check == true) {
          //for server side
          var join_selected_values = allVals.join(",");
          // alert (join_selected_values);exit;

          $.ajax({
            type: "POST",
            url: "<?= base_url() ?>admin/FRC/deleteReturn",
            cache: false,
            data: {
              'ids': join_selected_values,
              '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
            },
            success: function(response) {

              //referesh table
              $(".sub_chk:checked").each(function() {
                var id = $(this).attr('data-id');
                $('#tr_' + id).remove();
              });
            }
          });
        }
      }
    });

    $(document).on('click', '.btn_remove', function() {
      var button_id = $(this).attr("id");
      $('#row' + button_id + '').remove();
    });


    function addmore() {
      count = count + 1;
      var element = '<tr id=' + count + '>'
      element += '<td><input type="text" class="form-control sno" name="sno[]" value=' + (count + 1) + ' readonly></td>'
      element += '<td><input type="text" class="form-control pbc" name="pbc[]" value="" id=pbc' + count + '></td>'
      element += '<td><input type="text" name="fabric_name[]" class="form-control  " id=fabric' + count + ' readonly><input type="hidden" name="fabric_id[]" class="form-control  " id="fabric_id' + count + '"  > </td>'
      element += '<td><input type="text" class="form-control " name="hsn[]" id=hsn' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="fabType[]" id=fabtype' + count + ' value="" readonly></td>'
      element += '<td><input type="text" class="form-control" name="quantity[]" id=qty' + count + ' readonly></td>'
      element += '<td><input type="text" name="unit[]" class="form-control  " id=unit' + count + ' readonly></td>'
      element += '<td> <input type="text" class="form-control" name="ADNo[]" id=adno' + count + ' readonly></td>'
      element += '             <td> <input type="text" class="form-control" name="challan[]" id=challan' + count + ' readonly></td>'
      element += '<td><input type="text" class="form-control" name="pcode[]" id=pcode' + count + ' readonly></td><input type="hidden" class="form-control" name="prate[]" id=prate' + count + ' >'
      element += '<td> <button type="button" name="remove"  class="btn btn-danger btn-xs remove">-</button></td>'
      element += '</tr>';
      $('#fresh_data').append(element);
      $('#pbc' + count + '').focus();
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
