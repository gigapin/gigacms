<?php include '../resources/views/templates/base.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Post Versions</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <?php foreach ($revisions as $revision) : ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <a href="/revisions/preview/<?= $revision->id; ?>">
              <?= $revision->post_title; ?>
            </a>
          </h3>
          <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
              <i class="fas fa-minus"></i>
            </button>
            <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
              <i class="fas fa-times"></i>
            </button>
          </div>
        </div>
        <!-- /.card-body -->
        <div class="card-footer">
          <div class="post-footer">
            <div>
              <b>Revision Number</b>: <?= $revision->revision_number; ?>
            </div>
            <div><b>Created at</b>: <?= $revision->created_at ?></div>
          </div>
        </div>
        <!-- /.card-footer-->
      </div>
      <!-- /.card -->
    <?php endforeach; ?>

  </section>
  <!-- /.content -->

</div>

<?php include '../resources/views/templates/footer.php' ?>