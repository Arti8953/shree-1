<script type="text/javascript">
  $(document).ready(function() {
        var fil = '';
        var table;
        getlist(fil);
        jQuery('#master').on('click', function(e) {
          if ($(this).is(':checked', true)) {
            $(".sub_chk").prop('checked', true);
          } else {
            $(".sub_chk").prop('checked', false);
          }
        });
        console.log($('#design').DataTable().page.info());

          function getlist(filter1) {

            var csrf_name = $("#get_csrf_hash").attr('name');
            var csrf_val = $("#get_csrf_hash").val();
            table = $('#design').DataTable({
              "processing": true,
              "serverSide": true,
              stateSave: true,
              "order": [],
              "pageLength": 50,
              "lengthMenu": [
                [50, 100, 150, -1],
                [50, 100, 150, "All"]
              ],


              "destroy": true,
              scrollY: 500,
              paging: true,


              "ajax": {
                url: "<?php echo base_url('admin/design/get_design_list') ?>",
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
                    $('#caption').text("Design List");
                  }

                  return json.data;
                },
              },

            });
          }

          $("#simplefilter").click(function(event) {
            event.preventDefault();
            var filter = {
              'searchByCat': $('#searchByCat').val(),
              'searchValue': $('#searchValue').val(),
              'search': 'simple'
            };

            $('#design').DataTable().destroy();
            getlist(filter);

          });
           $("#clearfilter").click(function(event) {
            event.preventDefault();
            $('#design').DataTable().destroy();
            getlist("");

          });
           $("#advancefilter").click(function(event) {
            event.preventDefault();
            var filter = {
              'designOn': $('#fdesignOn').val(),
              'barCode': $('#fbarCode').val(),
              'search': 'advance',
              'fabricName': $('#ffabricName').val(),
              'htCattingRate': $('#fhtCattingRate').val(),
              'sale_rate': $('#fsale_rate').val(),
              'matching': $('#fmatching').val(),
              'dye': $('#fdye').val(),
              'stitch': $('#fstitch').val(),
              'rate': $('#frate').val(),
              'desCode': $('#fdesCoe').val(),
              'designSeries': $('#fdesignSeries').val(),
              'designName': $('#fdesignName').val()
            };
            $('#design').DataTable().destroy();
             getlist(filter);

          });
          jQuery('.delete_all').on('click', function(e) {
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
                  url: "<?= base_url() ?>admin/design/deleteUser",
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
                //for client side

              }
            }
          });

          jQuery('.select_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
              allVals.push($(this).attr('data-id'));
            });
            //alert(allVals.length); return false;
            if (allVals.length <= 0) {
              alert("Please select row.");
            } else {
              //$("#loading").show();
              WRN_PROFILE_DELETE = "Are you sure you want to show this  row?";
              var check = confirm(WRN_PROFILE_DELETE);
              if (check == true) {
                //for server side
                var join_selected_values = allVals.join(",");
                // alert (join_selected_values);exit;

                $.ajax({
                  type: "POST",
                  url: "<?= base_url() ?>admin/design/get_data",
                  cache: false,
                  data: {
                    'ids': join_selected_values,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                  },
                  success: function(response) {

                    //referesh table
                    //  $(".sub_chk:checked").each(function() {
                    //    var id = $(this).attr('data-id');
                    //    $('#tr_'+id).remove();
                    // });


                  }
                });
                //for client side

              }
            }
          });

          jQuery('.print_all').on('click', function(e) {
            var allVals = [];
            $(".sub_chk:checked").each(function() {
              allVals.push($(this).attr('data-id'));
            });
            //alert(allVals.length); return false;
            if (allVals.length <= 0) {
              alert("Please select row.");
            } else {
              //$("#loading").show();
              WRN_PROFILE_DELETE = "Are you sure you want to Print this rows?";
              var check = confirm(WRN_PROFILE_DELETE);
              if (check == true) {
                //for server side
                var join_selected_values = allVals.join(",");
                // alert (join_selected_values);exit;
                var ids = join_selected_values.split(",");
                var data = [];
                $.each(ids, function(index, value) {
                  if (value != "") {
                    data[index] = value;
                  }
                });
                $.ajax({
                  type: "POST",
                  url: "<?= base_url() ?>admin/PrintThis/designmultiprint",
                  cache: false,
                  data: {
                    'ids': data,
                    '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
                  },
                  success: function(response) {
                    $("body").html(response);
                  }
                });
                //for client side

              }
            }
          });

          $('#fabricName').on('change', function() {
            var fabricName = $(this).val();
            $.ajax({
              type: "POST",
              url: "<?= base_url() ?>admin/design/fabricOn",
              cache: false,
              data: {
                'fabricName': fabricName,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
              },
              success: function(response) {
                $('#designOn').val(response);
              }
            });
          });


          $("#addDesign").on("submit", function(event) {
            event.preventDefault();
            var design_name = $("#design_name").val();
            var designSeries = $("#designSeries").val();
            var fabricName = $("#fabricName").val();
            var formData = $(this).serialize();
            $.ajax({
              type: "POST",
              url: "<?php echo base_url('admin/Design/designExist') ?>",
              data: {
                design_name: design_name,
                designSeries: designSeries,
                fabricName: fabricName,
                '<?php echo $this->security->get_csrf_token_name(); ?>': '<?php echo $this->security->get_csrf_hash(); ?>'
              },
              datatype: 'JSON',
              success: function(data) {
                if (data == 1) {
                  $('#design-error').html('Design Already Exist');
                } else {
                  $('#addDesign').get(0).submit();
                }
              }
            })
          });


        }); <?php if ($this->session->flashdata('success')) { ?> toastr.success("<?php echo $this->session->flashdata('success'); ?>"); <?php } else if ($this->session->flashdata('error')) {  ?> toastr.error("<?php echo $this->session->flashdata('error'); ?>"); <?php } else if ($this->session->flashdata('warning')) {  ?> toastr.warning("<?php echo $this->session->flashdata('warning'); ?>"); <?php } else if ($this->session->flashdata('info')) {  ?> toastr.info("<?php echo $this->session->flashdata('info'); ?>"); <?php } ?>
</script>
