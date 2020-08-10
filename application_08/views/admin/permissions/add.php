<div class="container-fluid">
  <!-- ============================================================== -->
  <!-- Start Page Content -->
  <!-- ============================================================== -->
  <div class="row">
    <div class="col-md-6">
      <div class="card">
        <form action="<?php echo base_url('admin/permissions/assign') ?>" method="post">
        <div class="card-body">
          <h5 class="card-title">Form Elements</h5>
          <div class="form-group row">
            <label class="col-md-3" for="disabledTextInput">Role Name</label>
            <div class="col-md-9">
                <input type="text" class="form-control" disabled="" value="<?php echo $role->name ?>">
                <input type="hidden" class="form-control" name="role_id" value="<?php echo $role->id ?>">
            </div>
          </div>
          <div class="form-group row">
            <label class="col-md-3 m-t-15">Select Permissions</label>
            <div class="col-md-9">
              <select class="select2 form-control" name="permissions[]" multiple="multiple">
                <?php foreach ($permissions as $value): ?>
                  <?php if(in_array($value->id, $selected)): ?>
                    <option selected value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                  <?php else: ?>
                    <option value="<?php echo $value->id ?>"><?php echo $value->name ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>
        <div class="border-top">
          <div class="card-body">
            <input type="hidden" name="<?php echo $this->security->get_csrf_token_name();?>" value="<?php echo $this->security->get_csrf_hash();?>">
            <button type="submit" class="btn btn-primary">Submit</button>
          </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>
