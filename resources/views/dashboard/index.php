<?php include '../resources/views/templates/base.php' ?>

<div class="content-wrapper">

  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Dashboard</h1>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->

  <section class="content">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h3>Latest posts</h3>
        </div>
      </div>
      <?php foreach ($posts as $post) : ?>
        <!-- Default box -->
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">
              <a href="/posts/edit/<?= $post->id ?>"><?= $post->post_title; ?></a>
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
              <div><b>Created By</b>:
                <?php foreach ($username as $user_name) : ?>
                  <?php if ($post->id === $user_name->id) : ?>
                    <?php echo $user_name->username ?>
                  <?php endif; ?>
                <?php endforeach; ?>
              </div>
              <div><b>Created at</b>: <?= $post->created_at ?></div>
            </div>
          </div>
          <!-- /.card-footer-->
        </div>
        <!-- /.card -->
      <?php endforeach; ?>
    </div>
  </section>

</div>

<?php include '../resources/views/templates/footer.php' ?>