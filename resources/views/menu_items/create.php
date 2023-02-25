<?php include '../resources/views/templates/base.php'; ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<?php if ($alert) : ?>
  <div class="alert alert-warning alert-dismissible" style="margin: 20px;">
    <h5><i class="icon fas fa-exclamation-triangle"></i> Alert!</h5>
    You needed create your first menu before!
    <br>
    <a href="/menus/create" class="btn btn-primary">Add Menu</a> 
  </div>
<?php exit(); endif; ?>

<div class="modal fade" id="modal-leave-page">
  <div class="modal-dialog">
    <div class="modal-content bg-info">
      <div class="modal-header">
        <h4 class="modal-title">Leave page</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure you want leave this page?</p>
      </div>
      <div class="modal-footer justify-content-between">
        <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
        <a href="/menu-items" class="btn btn-outline-dark">Leave page</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form action="/menu-items" method="POST">
  <input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Add a item at the menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <button type="button" class="btn btn-app bg-secondary" id="leave-page" data-toggle="modal" data-target="#modal-leave-page"><i class="fas fa-th-list"></i> Menu Items</button>
              <button type="submit" class="btn btn-app bg-success"><i class="fas fa-save"></i>Save</button>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>
  <!-- Main content -->
  <section class="content">

    <div class="card card-warning">
      <div class="card-header">
        <h3 class="card-title">Menu Item</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">

        <div class="row">
          <div class="col-sm-12">
            <!-- text input -->
            <div class="form-group">
              <label>Title</label>
              <input type="text" class="form-control" name="title">
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Link</label>
              <?php if ($posts) : ?>
                <select name="link" id="" class="form-control">
                  <option value=""></option>
                  <?php foreach ($posts as $post) : ?>
                    <option value="<?= $post->post_name ?>"><?= $post->post_title ?></option>
                  <?php endforeach; ?>
                </select>
              <?php else : ?>
                <select name="" id="" disabled></select>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Menu</label>
              <?php if ($menus) : ?>
                <select name="menu_id" id="" class="form-control">
                  <option value=""></option>
                  <?php foreach ($menus as $menu) : ?>
                    <option value="<?= $menu->id; ?>"><?= $menu->name; ?></option>
                  <?php endforeach; ?>
                </select>
              <?php else : ?>
                <select name="" id="" disabled></select>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Parent Item</label>
              <?php if ($posts) : ?>
                <select name="parent_item" id="" class="form-control">
                  <option value=""></option>
                  <?php foreach ($posts as $post) : ?>
                    <option value="<?= $post->id; ?>"><?= $post->post_title; ?></option>
                  <?php endforeach; ?>
                </select>
              <?php else : ?>
                <select name="" id="" disabled></select>
              <?php endif; ?>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Status</label>
              <select name="status" id="" class="form-control">
                <?php foreach ($status as $item) : ?>
                  <?php if ($item->default_status === 1) : ?>
                    <option value="<?= $item->alias_type_status; ?>" selected><?= $item->type_status; ?></option>
                  <?php elseif ($item->default_status !== 1) : ?>

                    <option value="<?= $item->alias_type_status; ?>"><?= $item->type_status; ?></option>
                  <?php endif; ?>
                <?php endforeach; ?>
              </select>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Access</label>
              <select name="access" id="" class="form-control">
                <?php foreach ($access as $access_value) : ?>
                  <?php if ($access_value->default_access === 1) : ?>
                    <option value="<?= $access_value->alias_type_access; ?>" selected><?= $access_value->type_access; ?></option>
                  <?php else : ?>
                    <option value="<?= $access_value->alias_type_access; ?>"><?= $access_value->type_access; ?></option>
                  <?php endif; ?>

                <?php endforeach; ?>
              </select>

            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Default Page</label>
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" id="customSwitch" name="default_page" value="1">
                <label class="custom-control-label" for="customSwitch">Default Page</label>
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-sm-12">
            <div class="form-group">
              <label>Target Window</label>
              <div class="custom-control custom-switch custom-switch-off-danger custom-switch-on-success">
                <input type="checkbox" class="custom-control-input" id="customSwitch1" name="target_window" value="1">
                <label class="custom-control-label" for="customSwitch1">Link opened in new window</label>
              </div>
            </div>
          </div>
        </div>


      </div>
    </div>

  </section>
</form>

</div>
<?php include '../resources/views/templates/footer.php'; ?>