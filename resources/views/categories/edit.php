<?php include '../resources/views/templates/base.php' ?>

<div class="modal fade" id="modal-danger-category">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Delete category</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this category?</p>
      </div>

      <form action="/categories/delete/<?= $category->id ?>" method="POST">
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-dark">Confirm delete</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form action="/categories/<?= $category->id ?>" method="POST">
  <input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Update category</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <a href="/categories" class="btn btn-app bg-secondary"><i class="fas fa-th-list"></i>Categories</a>
              <?php if ($category->category_name !== 'Uncategorised') : ?>
                <button type="button" class="btn btn-app bg-danger" data-toggle="modal" data-target="#modal-danger-category"><i class="fas fa-trash"></i>Delete</button>
                <button type="submit" class="btn btn-app bg-success"><i class="fas fa-save"></i>Update</button>
              <?php endif; ?>
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
            <h3 class="card-title">Content</h3>
          </div>

          <div class="card-body">

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Name</label>
                  <input class="form-control form-control-lg" type="text" name="category_name" value="<?= $category->category_name ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Description</label>
                  <textarea class="form-control form-control-lg" rows="5" name="category_description">
                    <?= $category->category_description ?>
                  </textarea>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label>Category Status</label>
                <?php if ($category->category_status === 'published') : ?>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="published" checked>&nbsp;Published
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="drafted">&nbsp;Drafted
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="trashed">&nbsp;Trashed
                  </div>
                  <div class="form-group">
                    <input type="radio" name="category_status" value="archived">&nbsp;Archived
                  </div>
                <?php endif ?>
                <?php if ($category->category_status === 'drafted') : ?>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="published">&nbsp;Published
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="drafted" checked>&nbsp;Drafted
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="trashed">&nbsp;Trashed
                  </div>
                  <div class="form-group">
                    <input type="radio" name="category_status" value="archived">&nbsp;Archived
                  </div>
                <?php endif ?>
                <?php if ($category->category_status === 'trashed') : ?>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="published">&nbsp;Published
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="drafted">&nbsp;Drafted
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="trashed" checked>&nbsp;trashed
                  </div>
                  <div class="form-group">
                    <input type="radio" name="category_status" value="archived">&nbsp;Archived
                  </div>
                <?php endif ?>
                <?php if ($category->category_status === 'archived') : ?>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="published">&nbsp;Published
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="drafted">&nbsp;Drafted
                  </div>
                  <div class="form-group mb-0">
                    <input type="radio" name="category_status" value="trashed">&nbsp;Trashed
                  </div>
                  <div class="form-group">
                    <input type="radio" name="category_status" value="archived" checked>&nbsp;Archived
                  </div>
                <?php endif ?>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>
  </section>

</form>

<?php include '../resources/views/templates/footer.php' ?>