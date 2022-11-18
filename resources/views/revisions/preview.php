<?php include '../resources/views/templates/base.php' ?>

  <div class="modal fade" id="modal-danger">
    <div class="modal-dialog">
      <div class="modal-content bg-danger">
        <div class="modal-header">
          <h4 class="modal-title">Delete Revision Post</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Are you sure to delete this old version of the post?</p>
        </div>

        <form action="/revisions/delete/<?= $revision->id ?>" method="POST">
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-outline-dark">Confirm delete</button>
          </div>
        </form>
      </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
  </div><!-- /.modal -->

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Revision # <?= $revision->revision_number; ?></h1>
          </div>
          <div class="col-sm-6">
          <form action="/posts/restore/<?= $revision->id; ?>" method="POST">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item">
                <a href="/posts" class="btn btn-app bg-secondary"><i class="fas fa-th-list"></i>Posts</a>
                <a href="/revisions/<?= $revision->post_id; ?>" class="btn btn-app bg-info"><i class="fas fa-history"></i>Revision</a>
                <button type="button" class="btn btn-app bg-danger" data-toggle="modal" data-target="#modal-danger"><i class="fas fa-trash"></i>Delete</button>
                <button type="submit" class="btn btn-app bg-success"><i class="fas fa-save"></i>Restore</button>
              </li>
            </ol>
            </form>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">

    <?php if ($revision): ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title"><?= $revision->post_title; ?></h3>

          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <div class="card-body">
          <?= htmlspecialchars_decode($revision->post_content); ?>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="post-footer">
						<div>
              <b>Author: </b> <?= $user->username; ?> 
						</div>
						<div><b>Created at</b>: <?= $revision->created_at; ?></div>
					</div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
      <?php endif; ?>

    </section>
    <!-- /.content -->

<?php include '../resources/views/templates/footer.php' ?>