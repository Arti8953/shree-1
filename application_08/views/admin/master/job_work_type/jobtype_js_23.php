    <script src="<?php echo base_url('jexcelmaster/')?>asset/js/jquery.3.1.1.js"></script>
    <script src="<?php echo base_url('jexcelmaster/')?>dist/jexcel.js"></script>
    <script src="<?php echo base_url('jexcelmaster/')?>dist/jsuites.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jexcel.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>src/css/jexcel.datatables.css" type="text/css" />

<script type="text/javascript">
  $(document).ready(function() {


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
             url: "<?= base_url()?>admin/Job_work_type/deletejob",
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

  var data = [
        ['','' ],

      ];
      var insertrow  = function(instance,x,y) {
              var val = $('#table').jexcel('getData', false);
          $('#tabledata').val(val);
          }
          
          var changed = function(instance, cell, x, y, value) {
          var val = $('#table').jexcel('getData', false);
          $('#tabledata').val(val);
        }
            
            var loaded = function(instance) {
            var val = $('#table').jexcel('getData', false);
            $('#tabledata').val(val);
        }

        var wid =$('#table').parent().outerWidth()/3;
        console.log(wid);
        jexcel(document.getElementById('table'), {
        data:data, search:false,
        columns: [
          { type: 'text', title:'Job',width:120},
          { type: 'text', title:'Rate', width:120 },
          { type: 'dropdown', title:'Choose Unit', width:100,autocomplete:true,source:["pcs","Mtrs"] },


         ],
         onload: loaded,
         onchange: changed,
         oninsertrow: insertrow,
      });

 });



   </script>
