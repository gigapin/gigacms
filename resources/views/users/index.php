<?php include '../resources/views/templates/base.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-sm-6">
        <h1>Users</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="/users/create" class="btn btn-app bg-primary"><i class="fas fa-plus"></i>Add User</a>
          </li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <?php include '../resources/views/partials/flash.php' ?>
  <?php foreach ($users as $user) : ?>
    <!-- Default box -->
    <div class="card">
      <div class="card-header">
        <h3 class="card-title">
          <a href="/users/edit/<?= $user->id; ?>"><?= $user->username; ?></a>
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
      <div class="card-body">
        <div class="flex-wrapper">
          <div>
            <p>Status</p>
            <?= $user->status === 1 ? 'enabled' : 'disabled'; ?>
          </div>
          <div>
            <p>Email</p>
            <?= $user->email; ?>
          </div>
          <div>
            <p>Role</p>
            <?= $user->role === '1' ? 'Root' : $user->role; ?>
          </div>
          <div>
            <p>Created At</p>
            <?= $user->created_at; ?>
          </div>
        </div>
      </div>
      <!-- /.card-body -->
    </div>
    <!-- /.card -->
  <?php endforeach; ?>

</section>
<!-- /.content -->

<?php include '../resources/views/templates/footer.php'; ?>