<div id="content">
  <div id="content-header">
    <div class="container-fluid">

  <!-- add modal wind-->

  <div class="row">
    <div class="col-12">
      <div class="card">

      </div>
      <div class="row">
       <div class="col-12">

      <div class="card">
        <div class="card-body">
          <div class="widget-box">
            <div class="widget-title"> <span class="icon"><i class="icon-th"></i></span>
              <h5>Emb Worker List</h5>
            </div>
            <div class="row well">
              &nbsp;&nbsp;&nbsp;&nbsp;<a type="button" class="btn btn-info pull-left delete_all  btn-danger" style="color:#fff;"><i class="mdi mdi-delete red"></i></a>
              &nbsp;&nbsp;&nbsp;&nbsp;<a href="<?php echo base_url('admin/emb')?>" type="button" class="btn btn-info" style="color:#fff;">Go Back</a>

            </div>
            <div class="widget-content nopadding">
              <table class="table table-striped table-bordered data-table" id="jobWorktype">
                <thead>
                  <tr>
                    <th><input type="checkbox" class="sub_chk" id="master"></th>
                    <th>S/No</th>
                    <th>Design</th>
                    <th>Worker</th>
                    <th>Rate</th>

                  </tr>
                </thead>
                <tbody>
                  <?php
                        if($emb>0)
                        {
                        $id=1;
                        foreach ($worker as $value) { ?>
                  <tr class="gradeU" id="tr_<?php echo $value['metaid']?>">
                    <td><input type="checkbox" class="sub_chk" data-id="<?php echo $value['metaid'] ?>"></td>
                    <td><?php echo $id?></td>
                    <td><?php foreach ($erc as $row): ?>
                       <?php if($value['designName']==$row['id']) {echo $row['desName'];}?>
                        <?php endforeach; ?></td>
                    <td><?php foreach ($jobworker as $row): ?>
                           <?php if($value['workerName']==$row['id']) {echo $row['name'];}?>
                            <?php endforeach; ?></td>
                    <td><?php echo $value['rate']?></td>
                    <td>
                      <a href="<?php echo '#tr_'.$value['metaid']; ?>" class="text-center tip" data-toggle="modal" data-original-title="Edit">
                        <i class="fas fa-edit blue"></i>
                      </a>

                    </td>
                  </tr>
                  <div id="tr_<?php echo $value['metaid']?>" class="modal hide">
                    <div class="modal-dialog" role="document ">
                      <div class="modal-content">
                        <form class="form-horizontal" method="post" action="<?php echo base_url('admin/ERC/update/')  ?>" name="basic_validate" novalidate="novalidate">
                          <div class="modal-header">
                            <h5 class="modal-title">Edit Department</h5>
                            <button data-dismiss="modal" class="close" type="button">×</button>

                          </div>
                          <div class="modal-body">
                            <div class="widget-content nopadding">
                              <div class="row">
                                <label class="col-md-8">Job Worker</label><label class="col-md-4">Rate</label>
                                <?php foreach ($jobworker as $row): ?>
                                <div class="col-md-8">
                                  <select name="job[]" class="form-control" readonly>
                                    <option value="<?php if($value['workerName']==$row['id']) selected  ?>"><?php echo $row['name'] ?></option>
                                  </select>
                                </div>

                                <div class="col-md-4">
                                  <input type="text" class="form-control" name="rate[]" value="<?php echo $value['rate']?>">
                                </div>
                                     <div class="col-md-12" height="15px;"></div>

                                  <?php endforeach; ?>
                              </div>

                            </div>

                          </div>
                          <div class="modal-footer" id='update'>
                            <input type="hidden" name="<?= $this->security->get_csrf_token_name(); ?>" value="<?= $this->security->get_csrf_hash(); ?>" />
                            <input type="submit" value="Update" class="btn btn-primary">
                            <a data-dismiss="modal" class="btn" href="#">Cancel</a>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>

          <?php $id=$id+1;  } } ?>
          </tbody>
          </table>
        </div>
      </div>
    </div>
  </div>
</div>





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
        window.location = "<?php echo base_url()?>admin/EMB/deleteembmeta/" + id;
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
