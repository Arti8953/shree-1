<div id="content">
  <div id="content-header">
    <div class="container-fluid">
      <div class="row-fluid">

      </div>
    </div>
  </div>
  <div class="container-fluid">
    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-body">
            <div class="d-md-flex">
              <div>
                <h4 class="card-title"> All Role List</h4>
                <h5 class="card-subtitle">Overview of all Role User Type</h5>
              </div>
              <div class="ml-auto text-right">
                <a href="#addnew" class="btn btn-primary addNewbtn" data-toggle="modal">Add New Role</a>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th>#</th>
                  <th>NAME</th>
                  <th>DISPLAY NAME</th>
                  <th>DESCRIPTION</th>
                  <th>PERMISSIONS</th>
                  <th>STATUS</th>
                  <th>ACTION</th>
                </tr>
              </thead>
              <tbody>
                <?php foreach ($roles as $value): ?>
                <tr>
                  <td><?php echo get_increment(0, $inc);  ?></td>
                  <td><?php echo $value['name'] ?></td>
                  <td><?php echo $value['display_name'] ?></td>
                  <td><?php echo $value['description'] ?></td>
                  <td>
                    <?php echo get_badge($value['permissions']); ?>
                  </td>
                  <td>
                    <?php if ($value['status']): ?>
                    <span class="badge badge-pill badge-success">Active</span>
                    <?php else: ?>
                    <span class="badge badge-pill badge-danger">Deactive</span>
                    <?php endif; ?>
                  </td>
                  <td>
                    <a href="<?php echo base_url('admin/roles/edit/').$value['id']; ?>"><button type="button" class="btn btn-outline-info"><i class="mdi mdi-lead-pencil w-30px"></i></button></a>
                    <a href="<?php echo base_url('admin/permissions/assign/').$value['id']; ?>"><button type="button" class="btn btn-outline-success">Add Permissions</button></a>
                  </td>
                </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>
<!-- add modal wind-->
<div id="addnew" class="modal hide">
  <div class="modal-dialog" role="document ">
    <div class="modal-content">
      <form class="form-horizontal" method="post" action="<?php echo base_url('admin/roles/add') ?>" name="basic_validate">
        <div class="modal-header">
          <h5 class="modal-title">Add Role</h5>
          <button data-dismiss="modal" class="close" type="button">×</button>
        </div>
        <div class="modal-body">
          <div class="widget-content nopadding">
            <span id="design-error" class="error" style="color:red;"></span>
            <div class="form-group row">
              <label class="control-label col-sm-3">Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="role_name" value="" id="role_name">
              </div>
            </div>
          </div>
          <div class="widget-content nopadding">
            <span id="design-error" class="error" style="color:red;"></span>
            <div class="form-group row">
              <label class="control-label col-sm-3">Display Name</label>
              <div class="col-sm-9">
                <input type="text" class="form-control" name="display_name" value="" id="display_name">
              </div>
            </div>
          </div>
          <div class="widget-content nopadding">
            <span id="design-error" class="error" style="color:red;"></span>
            <div class="form-group row">
              <label class="control-label col-sm-3">Description (optional)</label>
              <div class="col-sm-9">
                <textarea class="form-control" name="description" value="" id="description"></textarea>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <input type="submit" class="btn btn-primary" value="submit">
            <a data-dismiss="modal" class="btn" href="#">Cancel</a>
          </div>
      </form>
    </div>
  </div>
</div>

<script>
  function delete_detail(id) {
    var del = confirm("Do you want to Delete");
    if (del == true) {
      var sureDel = confirm("Are you sure want to delete");
      if (sureDel == true) {
        window.location = "<?php echo base_url()?>admin/roles/delete/" + id;
      }

    }
  }
</script>
