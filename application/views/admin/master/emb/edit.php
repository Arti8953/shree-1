<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row">
  <!-- add modal wind-->

     <div class="card container">

          <div class="card-body">
            <form class="form-horizontal" method="post" action="<?php echo base_url('admin/EMB/update_embmeta/').$id ?>" name="basic_validate" novalidate="novalidate">
              <div class="card-header">
                <h5 class="card-title">Edit Detail</h5>
              </div>

                  <div class="row">
                    <label class="col-md-8">Job Worker</label><label class="col-md-4">Rate</label>
                  <?php  $id=1; foreach ($worker as $value) {  ?>
                    <div class="col-md-8">
                      <select name="job[]" class="form-control" readonly>
                        <?php foreach ($jobworker as $row): ?>
                        <option value="<?php echo $value['workerName'] ?>" <?php if($value['workerName']==$row['id']){echo "selected";}?> > <?php echo $row['name'] ?> </option>
                      <?php endforeach;?>
                      </select>
                    </div>

                    <div class="col-md-4">
                      <input type="text" class="form-control" name="rate[]" value="<?php echo $value['rate'] ?>">

                    </div>
                   <input type="hidden" name="inId" value="<?php echo $id; ?>"> 
                         <div class="col-md-12" height="15px;"></div>
                    <?php $id++;} ?>

                  </div>




                  <div class="card-footer float-right">
                    <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
                    <input type="submit" class="btn btn-primary" value="Update">
                  </div>

            </form>
          </div>
        </div>
  </div>
</div>
</div>
</div>


<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url()?>admin/EMB/delete/" + id;
      }

    }
  }
</script>
<style>
  #DataTables_Table_0_previous {
    display: none;
  }

  #DataTables_Table_0_paginate {
    display: none;
  }

  select {
    width: 120px;
    height: 35px;
    box-sizing: border-box;
    border-color: #e9ecef;
  }
</style>

<?php include('emb_js.php');?>
