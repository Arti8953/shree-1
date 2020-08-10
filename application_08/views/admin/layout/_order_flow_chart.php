<script src="<?php echo base_url('jexcelmaster/')?>asset/js/jquery.3.1.1.js"></script>
<script src="<?php echo base_url('jexcelmaster/')?>dist/jexcel.js"></script>
<script src="<?php echo base_url('jexcelmaster/')?>dist/jsuites.js"></script>
<link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jsuites.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>dist/jexcel.css" type="text/css" />
<link rel="stylesheet" href="<?php echo base_url('jexcelmaster/')?>src/css/jexcel.datatables.css" type="text/css" />
<script type="text/javascript">
  (function() {
    $.ajax({
      type: "GET",
      url: "<?php echo base_url('admin/ERC/getlist')?>",
      success: function(text) {
        data = jexcel(document.getElementById('order_flow_chart'), {
          data: text,
          search: true,
          pagination: 25,
          columns: [
            {
              type: 'dropdown',
              title: 'Design Name',
              width: 120
            },
            {
              type: 'text',
              title: 'Design Code',
              width: 120
            },
            {
              type: 'text',
              title: 'Emb Rate',
              width: 120
            },
          ],
          onchange: false,
          oninsertrow: false,
          allowInsertColumn: false
        });
      }
    });

  });
</script>
