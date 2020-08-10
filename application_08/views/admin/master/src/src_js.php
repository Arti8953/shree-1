    <script src="<?php echo base_url('jexcelmaster/')?>asset/js/jquery.3.1.1.js"></script>
    <script src="<?php echo base_url('jexcelmaster/')?>dist/jexcel.js"></script>
    <script src="<?php echo base_url('jexcelmaster/')?>dist/jsuites.js"></script>
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jsuites.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jexcel.css" type="text/css" />
    <link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>src/css/jexcel.datatables.css" type="text/css" />

<script type="text/javascript">
$(document).ready(function() {
        var response = '';
        $.ajax({
          type: "GET",
          url: "<?php echo base_url('admin/SRC/getlist')?>",
          success: function(text) {
            data= jexcel(document.getElementById('spreadsheet'), {
            data:text,
            search:true,
            pagination:30,
            columns: [
              { type: 'hidden', title:'id',width:120 },
              { type: 'dropdown', title:'Fabric Name' ,autocomplete:true, width:120,url:"<?php echo base_url('admin/SRC/getfabricName')?>" },
              { type: 'text', title:'Purchase' , width:120 },
              { type: 'dropdown', title:'Code'  , autocomplete:true, width:120, url:"<?php echo base_url('admin/SRC/getErcCode')?>" },
              { type: 'text', title:'Sale Rate' , width:120 },
            ],
            onchange: changed,
            oninsertrow:insertrow,
            allowInsertColumn:false
          });
          }
        });
        var changed = function(instance, cell, x, y, value) {
            var cellName = jexcel.getColumnNameFromId([x,y]);
            var cell1 = data.getValueFromCoords(0,y);
            var temp = data.getRowData(y);
            var dat=[];
            if (x==2 || x==4) {
              if(x==2){
                dat={
                  purchase: value,
                  id : cell1,
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                }
                $.ajax({
                  url: "<?php echo base_url('admin/SRC/update')?>",
                  type: "POST",
                  data:dat,
                });
              }else if (x==4){
                dat={
                  srate: value,
                  id : cell1,
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                }
                $.ajax({
                  url: "<?php echo base_url('admin/SRC/update')?>",
                  type: "POST",
                  data:dat,
                });
              }
            }else{
              $.ajax({
                url: "<?php echo base_url('admin/SRC/checkAvailable')?>",
                type: "POST",
                data:{
                  fabName: temp[1],
                  fabCode: temp[3],
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                },
                beforeSend: function() {
                  var temp = "<img src='<?php echo base_url("optimum/preloader.gif"); ?>' />";
                  $('#overlay').show().html(temp).delay(200).fadeOut();
                },
                success: function(dataResult){
                  if(dataResult == 1) {
                    $("[data-y="+y+"]").css('background', 'rgb(254, 57, 84)');
                    $(cell).html('');
                    return false;
                  }else{
                    $("[data-y="+y+"]").css('background', '#fff');
                    if(x==1){
                dat={
                  fName: value,
                  id : cell1,
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                }
                $.ajax({
                  url: "<?php echo base_url('admin/SRC/update')?>",
                  type: "POST",
                  data:dat,
                });
              }else if(x==3) {
                dat={
                  fcode: value,
                  id : cell1,
                  '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                }
                $.ajax({
                  url: "<?php echo base_url('admin/SRC/update')?>",
                  type: "POST",
                  data:dat,
                });
              }
                  }
                }
              });
            }
        }
        var insertrow  = function(instance,x,y) {
         dat={

                      '<?php echo $this->security->get_csrf_token_name(); ?>' : '<?php  echo $this->security->get_csrf_hash(); ?>'
                    }

          $.ajax({
              url: "<?php echo base_url('admin/SRC/add_src')?>",
              type: "POST",
               data: dat,
              success: function(id){
               var cellName = jexcel.getColumnNameFromId([0,x+1]);

                    data.setValue(cellName,id);
                    var cell1 = data.getValueFromCoords(0,x+1);
              }
            });

          }
         $('#download').on('click', function () {
          $('#spreadsheet').jexcel('download');
         });

        });

   </script>
