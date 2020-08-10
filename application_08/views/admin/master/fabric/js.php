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
    console.log($('#fabric').DataTable().page.info());

      function getlist(filter1) {

        var csrf_name = $("#get_csrf_hash").attr('name');
        var csrf_val = $("#get_csrf_hash").val();
        table = $('#fabric').DataTable({
          "processing": true,
          "serverSide": true,
          // stateSave: true,
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
            url: "<?php echo base_url('admin/Fabric/get_fabric_list') ?>",
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
                $('#caption').text("Fabric List");
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

        $('#fabric').DataTable().destroy();
        getlist(filter);

      });
       $("#clearfilter").click(function(event) {
        event.preventDefault();
        $('#fabric').DataTable().destroy();
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
        $('#fabric').DataTable().destroy();
         getlist(filter);

      });



jQuery('#master').on('click', function(e){
 if($(this).is(':checked',true))
 {
   $(".sub_chk").prop('checked', true);
 }
 else
 {
   $(".sub_chk").prop('checked',false);
 }
});


jQuery('.delete_all').on('click', function(e){
var allVals = [];
   $(".sub_chk:checked").each(function() {
     allVals.push($(this).attr('data-id'));
   });
   //alert(allVals.length); return false;
   if(allVals.length <=0)
   {
     alert("Please select row.");
   }
   else {
     //$("#loading").show();
     WRN_PROFILE_DELETE = "Are you sure you want to delete this row?";
     var check = confirm(WRN_PROFILE_DELETE);
     if(check == true){
       //for server side
     var join_selected_values = allVals.join(",");
     // alert (join_selected_values);exit;

       $.ajax({
         type: "POST",
         url: "<?= base_url()?>admin/Fabric/deletefabric",
         cache:false,
         data: {'ids' : join_selected_values, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'},
         success: function(response)
         {

           //referesh table
           $(".sub_chk:checked").each(function() {
              var id = $(this).attr('data-id');
              $('#tr_'+id).remove();
           });


         }
       });
              //for client side

     }
   }
 });

     $("#fabric_name").on('focusout', function(){
          
          $("#fabric_name").css("border", "1px solid #DDDDDD");
          $("#fabric_btn").removeAttr("disabled", "TRUE");
          $("#fabric-error").html('');
          var fabricName = $(this).val();
         // alert(fabricName);
          $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/Fabric/fabricExist')?>",
            data: {'fabricName':fabricName, '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'},
            datatype: 'json',
            success: function(data){
              if(data == true){
                 $("#fabric_name").css("border", "2px solid #F47C72");
                 $("#fabric_btn").attr("disabled", "TRUE");
                 $("#fabric-error").html('Fabric Name Already Exist.');
               }
            }
          });
        });

   });

   </script>
