<?php include '../resources/views/templates/base.php' ?>

<?php include '../resources/views/partials/leave_page.php'; ?>

<form action="/posts" method="POST" enctype="multipart/form-data">
  <input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row">
        <div class="col-sm-6">
          <h1>Create a new post</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <button type="button" class="btn btn-app bg-secondary" id="leave-page" data-toggle="modal" data-target="#modal-leave-page"><i class="fas fa-th-list"></i> Posts</button>
              <button type="submit" class="btn btn-app bg-success"><i class="fas fa-save"></i>Save</button>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->
  <section class="content">

    <?php include '../resources/views/partials/errors.php' ?>

    <div class="row">

      <div class="col-md-8">
        <div class="card card-info card-tabs">

          <div class="card-header p-0 pt-1">
            <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
              <li class="nav-item">
                <a 
                  class="nav-link active" 
                  id="custom-tabs-one-home-tab" 
                  data-toggle="pill" 
                  href="#custom-tabs-one-home" 
                  role="tab" 
                  aria-controls="custom-tabs-one-home" 
                  aria-selected="true">
                  Content
                </a>
              </li>
              <li class="nav-item">
                <a 
                  class="nav-link" 
                  id="custom-tabs-one-profile-tab" 
                  data-toggle="pill" 
                  href="#custom-tabs-one-profile" 
                  role="tab" 
                  aria-controls="custom-tabs-one-profile" 
                  aria-selected="false">
                  Metadata
                </a>
              </li>
              <!-- <li class="nav-item">
                <a 
                  class="nav-link" 
                  id="custom-tabs-one-messages-tab" 
                  data-toggle="pill" 
                  href="#custom-tabs-one-messages" 
                  role="tab" 
                  aria-controls="custom-tabs-one-messages" 
                  aria-selected="false">
                  Permissions
                </a>
              </li> -->
            </ul>
          </div>

          <div class="card-body">
            <div class="tab-content" id="custom-tabs-one-tabContent">
              <div class="tab-pane fade show active" id="custom-tabs-one-home" role="tabpanel" aria-labelledby="custom-tabs-one-home-tab">

                <div class="row">
                  <div class="col-md-12 mb-2">
                    <div class="form-group">
                      <label>Title</label>
                      <input class="form-control form-control-lg" type="text" name="post_title" value="<?= isset($old['post_title']) ? $old['post_title'] : '' ?>">
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>Content</label>
                      <textarea id="editor" class="form-control editor" name="post_content">
                        <?= isset($old['post_content']) ? $old['post_content'] : '' ?>
                      </textarea>
                    </div>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12 mb-2">
                    <div class="form-group">
                      <label>Excerpt</label>
                      <textarea class="form-control" name="post_excerpt" placeholder="Enter ...">
                        <?= isset($old['post_excerpt']) ? $old['post_excerpt'] : null; ?>
                      </textarea>
                    </div>
                  </div>
                </div>
              </div><!-- /. tab-pane-active -->
              <?php include '../resources/views/partials/metadata.php' ?>
 
            </div>
          </div><!-- /.card-body -->
        </div>
      </div><!-- /.col-md-8 -->

      <div class="col-md-4">
        <div class="card card-secondary">
          <div class="card-header">
            <h3 class="card-title">Options</h3>
          </div>

          <div class="card-body">
            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Categories</label>
                  <select class="custom-select" name="category_id">
                    <?php if (isset($old['category_id'])) : ?>
                      <?php foreach ($categories as $category) : ?>
                        <?php if ($category->id == $old['category_id']) : ?>
                          <option value="<?= $category->id ?>" selected><?= $category->category_name ?></option>
                        <?php endif; ?>
                        <option value="<?= $category->id ?>"><?= $category->category_name ?></option>
                      <?php endforeach ?>  
                    <?php else : ?>
                      <option value="1" selected>Open this select menu</option>
                      <?php foreach ($categories as $category) : ?>
                        <option value="<?= $category->id ?>"><?= $category->category_name ?></option>
                      <?php endforeach ?>
                    <?php endif; ?>
                  </select>
                </div>
              </div>
            </div>

            <?php if (count($posts) > 0) : ?>
              <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Post Parent</label>
                    <select class="custom-select" name="post_parent">
                      <?php if (isset($old['post_parent'])) : ?>
                        <?php foreach ($posts as $post) : ?>
                          <?php if ($post->id == $old['post_parent']) : ?>
                            <option value="<?= $post->id ?>" selected><?= $post->post_title ?></option>
                          <?php endif; ?>
                          <?php foreach ($posts as $post) : ?>
                            <option value="<?= $post->id ?>"><?= $post->post_title ?></option>
                          <?php endforeach ?>
                        <?php endforeach ?>
                      <?php else : ?>
                        <option value="0" selected></option>
                        <?php foreach ($posts as $post) : ?>
                          <option value="<?= $post->id ?>"><?= $post->post_title ?></option>
                        <?php endforeach ?>
                      <?php endif; ?>
                    </select>
                  </div>
                </div>
              </div>
            <?php endif; ?>

            <div class="row">
              <div class="col-md-12">
                <!-- Date -->
                <div class="form-group">
                  <label>Post Date:</label>
                  <div class="input-group date" id="reservationdate" data-target-input="nearest">
                    <input type="text" name="post_date" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?= isset($old['post_date']) ? $old['post_date'] : ''; ?>" />
                    <div class="input-group-append" data-target="#reservationdate" data-toggle="datetimepicker">
                      <div class="input-group-text"><i class="fa fa-calendar"></i></div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Post Password</label>
                  <input class="form-control" type="password" name="post_password" value="<?= isset($old['post_password']) ? $old['post_password'] : ''; ?>">
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label>Post Access</label>
                <?php foreach ($list_access as $access): ?>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-radio">
                      <input 
                        class="custom-control-input" 
                        type="radio" 
                        name="post_access" 
                        id="post-access-<?= $access->alias_type_access; ?>" 
                        value="<?= $access->alias_type_access; ?>" 
                        <?php if (isset($old['post_access']) && $old['post_access'] === $access->alias_type_access) : ?> checked
                        <?php else: ?> 
                          <?php if ($access->default_access === 1): ?>
                            checked  
                          <?php endif; ?>
                        <?php endif; ?>
                      >
                      <label for="post-access-<?= $access->alias_type_access; ?>" class="custom-control-label" style="font-weight: 400;"><?= $access->type_access ?></label>
                    </div>
                  </div>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label>Post Status</label>
                <?php foreach ($list_status as $status): ?>
                <div class="form-group mb-0">
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="post_status" 
                      id="post-status-<?= $status->alias_type_status; ?>" 
                      value="<?= $status->alias_type_status; ?>" 
                      <?php if (isset($old['post_status']) && $old['post_status'] === $status->alias_type_status) : ?> checked 
                      <?php else: ?> 
                        <?php if ($status->default_status === 1): ?>
                        checked  
                        <?php endif; ?>
                      <?php endif; ?>
                    >
                    <label for="post-status-<?= $status->alias_type_status; ?>" class="custom-control-label" style="font-weight: 400;"><?= $status->type_status; ?></label>
                  </div>
                </div>
                <?php endforeach; ?>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <label>Comments Status</label>
                <div class="form-group mb-0">
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="comment_status" 
                      id="comment-statut-open" 
                      value="open" 
                      <?php if (isset($old['comment_status']) && $old['comment_status'] === 'open') : ?> checked <?php endif; ?>
                    >
                    <label for="comment-statut-open" class="custom-control-label" style="font-weight: 400;">Open</label>
                  </div>
                </div>
                <div class="form-group">
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="comment_status" 
                      id="comment-statut-closed" 
                      value="closed" 
                      <?php if (isset($old['comment_status']) && $old['comment_status'] === 'closed') : ?> checked <?php endif; ?>
                    >
                    <label for="comment-statut-closed" class="custom-control-label" style="font-weight: 400;">Closed</label>
                  </div>
                </div>
              </div>
            </div>

            <div class="row mt-3">
              <div class="col-md-12">
                <label for="customFile">Featured Image</label>
                <div class="form-group mb-0">
                  <div class="custom-file">
                    <input type="file" class="custom-file-input" id="customFile" name="featured">
                    <label class="custom-file-label" for="customFile">Choose file</label>
                  </div>
                </div>
              </div>
            </div>

          </div><!-- /.card-body -->
        </div><!-- /.card -->
      </div><!-- /.col-md-4 -->

    </div><!-- ./row -->
  </section><!-- /.content -->
</form>

<?php include '../resources/views/templates/footer.php' ?>