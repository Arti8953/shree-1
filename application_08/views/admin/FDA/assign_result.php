
  <div class="card"><div class="card-header">
  <p>Type something in the input field to search the list for specific items:</p>  
  <input class="form-control" id="myInput" type="text" placeholder="Search.."></div>
    <div class="card-body">
      <div class="col-sm-12">
        <!-- accoridan part -->
        <div class="list-group" id="search">
          <?php $i=1;
          foreach ($data_value as $value): ?>
          <a href="<?php echo base_url('admin/FDA/get_fda_details/').serve_url($value['fabric_name']) ?> " class="list-group-item list-group-item-action">
            <div class="float-left">
              <div class="container"><b>Fabric name : </b><?php echo $value['fabric_name']; ?></div>
              <div class="container"><b>Designs : </b><?php echo $value['dcount']; ?></div>
            </div>
            <div class="float-right">
              <div><b>Fabric type : </b><?php echo $value['fabric_type']; ?></div>
              <div><b>Assign Date : </b><?php echo my_date_show_time($value['asign_date']); ?></div>
            </div>
          </a>
          <?php endforeach; ?>
        </div>
      </div>

    </div>
  </div>
<script>
$(document).ready(function(){
  $("#myInput").on("keyup", function() {
    var value = $(this).val().toLowerCase();
    $("#search *").filter(function() {
      $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
    });
  });
});
</script>