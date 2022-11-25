<?php include '../resources/views/templates/base.php'; ?>

<div class="modal fade" id="modal-add-role">
  <div class="modal-dialog">
    <div class="modal-content bg-primary">
      <div class="modal-header">
        <h4 class="modal-title">Add New Role</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form action="/roles" method="POST">
        <div class="modal-body">
          <input type="text" class="form-control" name="alias_name_role" placeholder="Enter name of new role">
        </div>

        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-dark">Save</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<!-- Content Wrapper. Contains page content -->

<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1>Role Permissions Board</h1>
      </div>
      <div class="col-sm-6 d-none d-sm-block">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="/role-permissions/restore" class="btn btn-app bg-secondary"><i class="fas fa-history"></i>Restore default</a>
          </li>
          <li>
            <button class="btn btn-app bg-primary" data-toggle="modal" data-target="#modal-add-role"><i class="fas fa-plus"></i>Add Role</button>
          </li>
        </ol>
      </div>
    </div>
  </div>
</section>

<section class="content pb-3">

  <?php include '../resources/views/partials/flash.php'; ?>
  <?php include '../resources/views/partials/errors.php'; ?>

  <div class="container h-100">

    <?php foreach ($permissions as $permission) : ?>

      <div class="modal fade" id="modal-edit-<?= $permission->id; ?>">
        <div class="modal-dialog">
          <div class="modal-content bg-info">
            <div class="modal-header">
              <h4 class="modal-title">Update role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action="/role-permissions/change/<?= $permission->id ?>" method="POST">
              <div class="modal-body">
                <input type="text" name="alias_name_role" placeholder="Enter new role name" class="form-control">
              </div>

              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-dark">Confirm Update</button>
              </div>
            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->



      <div class="modal fade" id="modal-danger-<?= $permission->id; ?>">
        <div class="modal-dialog">
          <div class="modal-content bg-danger">
            <div class="modal-header">
              <h4 class="modal-title">Delete Role</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <p>Are you sure to delete this role?</p>
            </div>

            <form action="/role-permissions/delete/<?= $permission->id ?>" method="POST">
              <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-outline-dark">Confirm delete</button>
              </div>
            </form>
          </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
      </div><!-- /.modal -->


      <div class="card card-row card-info">

        <form action="/role-permissions/<?= $permission->id ?>" method="POST">
          <input type="hidden" name="_token" value="<?= isset($token) ? $token : ''; ?>">

          <div class="card-header">
            <h3 class="card-title">
              <?php foreach ($roles as $role) : ?>
                <?php if ($role->id === $permission->role_id) : ?>
                  <?= $role->name_role; ?>
                <?php endif; ?>
              <?php endforeach; ?>
            </h3>
            <div class="card-tools">
              <a href="#" class="btn btn-tool" data-toggle="modal" data-target="#modal-edit-<?= $permission->id; ?>">
                <i class="fas fa-pen"></i>
              </a>
              <a href="#" class="btn btn-tool" data-toggle="modal" data-target="#modal-danger-<?= $permission->id; ?>">
                <i class="fas fa-times"></i>
              </a>
            </div>
          </div>

          <div class="card-body">

            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">Content</h5>
              </div>
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="content_write" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->content_write === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Write</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="content_read" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->content_read === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Read</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="content_update" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->content_update === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Update</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="content_delete" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->content_delete === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Delete</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="content_global" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->content_global === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Global</label>
                </div>
              </div>
            </div>

            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">Settings</h5>
              </div>
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="settings_write" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->settings_write === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Write</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="settings_write_global" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->settings_write_global === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Global</label>
                </div>
              </div>
            </div>

            <div class="card card-info card-outline">
              <div class="card-header">
                <h5 class="card-title">Users</h5>
              </div>
              <div class="card-body">
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="user_create" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->user_create === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Write</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="user_read" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->user_read === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Read</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="user_update" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->user_update === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Update</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="user_delete" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->user_delete === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Delete</label>
                </div>
                <div class="custom-control custom-checkbox">
                  <input class="custom-control-input" type="checkbox" name="user_global" id="customCheckbox<?= ++$index; ?>" value="" <?php if ($permission->user_global === 1) : ?> checked <?php endif; ?>>
                  <label for="customCheckbox<?= $index; ?>" class="custom-control-label">Global</label>
                </div>
              </div>
            </div>
            <div>
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item">
                  <button type="submit" class="btn btn-app bg-success"><i class="fas fa-save"></i>Save</button>
                </li>
              </ol>
            </div>
          </div>
        </form>
      </div><!-- /.card card-row -->
    <?php endforeach; ?>
  </div><!-- ./container-fluid -->
</section>


<?php include '../resources/views/templates/footer.php'; ?>