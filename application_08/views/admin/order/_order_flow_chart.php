<script src="<?php echo base_url('jexcelmaster/')?>asset/js/jquery.3.1.1.js"></script>
<script src="<?php echo base_url('jexcelmaster/')?>dist/jexcel.js"></script>
<script src="<?php echo base_url('jexcelmaster/')?>dist/jsuites.js"></script>
<link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jsuites.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jexcel.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>src/css/jexcel.datatables.css" type="text/css" />
<script type="text/javascript">
  $(document).ready(function(){
    var text = '';
      order_flow_chart();

      function order_flow_chart(){
      $.ajax({
        type: "GET",
        url: "<?php echo base_url('admin/dashboard/order_flow_chart')?>",
        success: function(data) {
          jexcel(document.getElementById('order_flow_chart'), {
            data: data,
            search: true,
            pagination: 25,
            columns: [
              {
              type: 'text',
              title: 'OD DATE',
              width: 100
              },
              {
              type: 'text',
              title: 'ORDER NO',
              width: 100
              },
              {
              type: 'text',
              title: 'TOTAL THAN',
              width: 80
              },
              {
              type: 'text',
              title: 'BALANCE',
              width: 80
              },
              {
              type: 'text',
              title: 'PENDING',
              width: 80
              },
              {
              type: 'text',
              title: 'CANCEL',
              width: 80
              },
              {
              type: 'text',
              title: 'PLAIN G',
              width: 80
              },
              {
              type: 'text',
              title: 'SNA',
              width: 80
              },
              {
              type: 'text',
              title: 'S.S',
              width: 80
              },
              {
              type: 'text',
              title: 'SC',
              width: 80
              },
              {
              type: 'text',
              title: 'PROCESS',
              width: 80
              },
              {
              type: 'text',
              title: 'CHECK',
              width: 80
              },
              {
              type: 'text',
              title: 'FINISH',
              width: 80
              },
              {
              type: 'text',
              title: 'POLISH',
              width: 80
              },
              {
              type: 'text',
              title: 'DISPATCH',
              width: 80
              },
            ],
            onchange: false,
            oninsertrow: false,
            allowInsertColumn: false
          });
        }
      });
      }
  });
</script>
