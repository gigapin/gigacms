<?php include '../resources/views/templates/base.php'; ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

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
        <a href="/menus" class="btn btn-outline-dark">Leave page</a>
      </div>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form action="/menus" method="POST">
  <input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Create a new menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <button type="button" class="btn btn-app bg-secondary" id="leave-page" data-toggle="modal" data-target="#modal-leave-page"><i class="fas fa-th-list"></i> Menus</button>
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
        <h3 class="card-title">Menu</h3>
      </div>
      <!-- /.card-header -->
      <div class="card-body">
        <div class="row">
          <div class="col-sm-12">
            <!-- text input -->
            <div class="form-group">
              <label>Name</label>
              <input type="text" class="form-control" name="name">
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-sm-12">
            <!-- textarea -->
            <div class="form-group">
              <label>Description</label>
              <textarea class="form-control" rows="3" name="description" placeholder="Enter ..."></textarea>
            </div>
          </div>
        </div>

      </div>
    </div>

  </section>
</form>

</div>
<?php include '../resources/views/templates/footer.php'; ?>