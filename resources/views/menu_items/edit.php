<?php include '../resources/views/templates/base.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<div class="modal fade" id="modal-danger-category">
  <div class="modal-dialog">
    <div class="modal-content bg-danger">
      <div class="modal-header">
        <h4 class="modal-title">Delete Item of the Menu</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <p>Are you sure to delete this item menu?</p>
      </div>

      <form action="/menu-items/delete/<?= $menuItem->id ?>" method="POST">
        <div class="modal-footer justify-content-between">
          <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-outline-dark">Confirm delete</button>
        </div>
      </form>
    </div><!-- /.modal-content -->
  </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<form action="/menu-items/<?= $menuItem->id ?>" method="POST">
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
              <a href="/menu-items" class="btn btn-app bg-secondary"><i class="fas fa-th-list"></i>Menus</a>
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
                  <label>Title</label>
                  <input class="form-control form-control-lg" type="text" name="title" value="<?= $menuItem->title ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-sm-12">
                <div class="form-group">
                  <label>Link</label>
                  <?php if ($posts) : ?>
                    <select name="link" id="" class="form-control">
                      <?php foreach ($posts as $post) : ?>
                        <?php if ($menuItem->link === $post->guid) : ?>
                          <option value="<?= $post->guid ?>" selected><?= $post->post_title ?></option>
                        <?php endif; ?>
                        <option value="<?= $post->guid ?>"><?= $post->post_title ?></option>
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
                      <?php foreach ($menus as $menu) : ?>
                        <?php if ($menuItem->menu_id === $menu->id) : ?>
                          <option value="<?= $menu->id; ?>" selected><?= $menu->name; ?></option>
                        <?php endif; ?>
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
                      <?php foreach ($posts as $post) : ?>
                        <?php if ($post->id === $menu->parent_item) : ?>
                          <option value="<?= $post->id; ?>" selected><?= $post->post_title; ?></option>
                        <?php endif; ?>
                        <option value=""></option>
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
                  <?php if ($menuItem->status === $item->alias_type_status): ?>
                    <option value="<?= $item->alias_type_status; ?>" selected><?= $item->type_status; ?></option>
                  <?php else: ?>
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
                  <?php if ($menuItem->access === $access_value->alias_type_access): ?>
                  <option value="<?= $access_value->alias_type_access; ?>" selected><?= $access_value->type_access; ?></option>
                  <?php else: ?>
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
                    <?php if ($menuItem->default_page === 1) : ?>
                      <input type="checkbox" class="custom-control-input" id="customSwitch" name="default_page" value="1" checked>
                    <?php else : ?>
                      <input type="checkbox" class="custom-control-input" id="customSwitch" name="default_page" value="1">
                    <?php endif; ?>
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
                    <?php if ($menuItem->target_window === 1) : ?>
                      <input type="checkbox" class="custom-control-input" id="customSwitch1" name="target_window" value="1" checked>
                    <?php else : ?>
                      <input type="checkbox" class="custom-control-input" id="customSwitch1" name="target_window" value="1">
                    <?php endif; ?>
                    <label class="custom-control-label" for="customSwitch1">Link opened in new window</label>
                  </div>
                </div>
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