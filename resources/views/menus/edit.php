<?php include '../resources/views/templates/base.php' ?>

<div class="modal fade" id="modal-danger-category">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Delete Menu</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this menu?</p>
      </div>

      <form action="/menus/delete/<?= $menu->id ?>" method="POST">
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-dark">Confirm delete</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form action="/menus/<?= $menu->id ?>" method="POST">
  <input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Update Menu</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="/menus" class="btn btn-app bg-secondary"><i class="fas fa-th-list"></i>Menus</a>
              <button type="button" class="btn btn-app bg-danger" data-toggle="modal" data-target="#modal-danger-category"><i class="fas fa-trash"></i>Delete</button>
              <button type="submit" class="btn btn-app bg-success"><i class="fas fa-save"></i>Update</button>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">
    <?php include '../resources/views/partials/flash.php' ?>
    <?php include '../resources/views/partials/errors.php' ?>

    <div class="row">

      <div class="col-md-12">
        <div class="card card-info">
          <div class="card-header">
            <h3 class="card-title">Menu</h3>
          </div>

          <div class="card-body">

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control form-control-lg" type="text" name="name" value="<?= $menu->name ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control form-control-lg" rows="5" name="description">
                    <?= $menu->description ?>
                  </textarea>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>


<?php include '../resources/views/templates/footer.php'; ?>