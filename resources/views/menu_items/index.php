<?php include '../resources/views/templates/base.php'; ?>

<!-- Content Header (Page header) -->
<section class="content-header">
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-6">
        <h1>All Menu Items</h1>
      </div>
      <div class="col-sm-6">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item">
            <a href="/menu-items/create" class="btn btn-block btn-outline-primary btn-lg"><i class="fas fa-solid fa-plus mr-2"></i>Add Menu Item</a>
          </li>
        </ol>
      </div>
    </div>
  </div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">
  <?php include '../resources/views/partials/flash.php' ?>
  
  <?php if ($menus) : ?>
    <?php foreach ($menus as $menu) : ?>
      <!-- Default box -->
      <div class="card">
        <div class="card-header">
          <h3 class="card-title">
            <a href="/menu-items/edit/<?= $menu->id ?>"><?= $menu->title; ?></a>
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
        <div class="card-body card-body-collapsed">
          <div class="flex-wrapper">
            <div>
              <h5>Status</h5>
              <?= ucfirst($menu->status); ?>
            </div>
            <div>
              <h5>Main Menu</h5>
              <?= $menu->menu_id; ?>
            </div>
            <div>
              <h5>Access</h5>
              <?= ucfirst($menu->access); ?>
            </div>
            <div>
              <h5>Home</h5>
              <?= $menu->default_page; ?>
            </div>
          </div>
        </div>
        <!-- /.card-body -->
       
      </div>
      <!-- /.card -->
    <?php endforeach; ?>
  <?php else : ?>
    <?php include '../resources/views/partials/callout.php'; ?>
  <?php endif; ?>
</section>
<!-- /.content -->
<?php include '../resources/views/templates/footer.php'; ?>