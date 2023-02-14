<?php include '../resources/views/templates/base.php'; ?>

<div class="content-wrapper">
<form action="/settings" method="POST">
  <input type="hidden" name="_token" value="<?= isset($token) ? $token : ''; ?>">
  <!-- Content Header (Page header) -->
  <section class="content-header">
    <div class="container-fluid">
      <div class="row mb-2">
        <div class="col-sm-6">
          <h1>Settings</h1>
        </div>
        <div class="col-sm-6">
          <ol class="breadcrumb float-sm-right">
            <li class="breadcrumb-item">
              <button type="submit" class="btn btn-app bg-success" id="submit-setting"><i class="fas fa-save"></i>Save</button>
            </li>
          </ol>
        </div>
      </div>
    </div><!-- /.container-fluid -->
  </section>

  <!-- Main content -->

  
  <section class="content">
    <div class="container-fluid">
     
      <div class="row">

        <div class="col-md-4">
          <div class="card card-success">
            <div class="card-header">
              <h3 class="card-title">Global Configuration</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <h5>Website</h5>
              <div class="form-group">
                <label for="">Site Name</label>
                <input 
                  type="text" 
                  class="form-control" 
                  name="option_name[site_name]" 
                  value="<?= $settings->findWhere('option_name', 'site_name')->option_value; ?>"
                >
              </div>
              <div class="form-check">
                <input 
                  type="checkbox" 
                  class="form-check-input" 
                  id="site-offline" 
                  name="option_name[site_offline]" 
                  value="on"
                  <?php if ($settings->findWhere('option_name', 'site_offline')->option_value === "on") :?>
                  checked
                  <?php endif; ?>
                >
                <label class="form-check-label" for="site-offline">Site Offline</label>
              </div>
              <hr>

              <h5>Default Access Level</h5>
              <div class="form-group mb-0">
                <div class="custom-control custom-radio">
                  <input 
                    class="custom-control-input" 
                    type="radio" 
                    name="option_name[level_post_access]" 
                    id="default-access-public" 
                    value="public"
                    <?php if ($settings->findWhere('option_name', 'level_post_access')->option_value === 'public') :?>
                    checked
                    <?php endif; ?>
                  >
                  <label for="default-access-public" class="custom-control-label" style="font-weight: 400;">Public</label>
                </div>
              </div>
              <div class="form-group mb-0">
                <div class="custom-control custom-radio">
                  <input 
                    class="custom-control-input" 
                    type="radio" 
                    name="option_name[level_post_access]"
                    id="default-access-registered" 
                    value="registered"
                    <?php if ($settings->findWhere('option_name', 'level_post_access')->option_value === 'registered') :?>
                    checked
                    <?php endif; ?>
                  >
                  <label for="default-access-registered" class="custom-control-label" style="font-weight: 400;">Registered</label>
                </div>
              </div>
              <div class="form-group mb-0">
                <div class="custom-control custom-radio">
                  <input 
                    class="custom-control-input" 
                    type="radio" 
                    name="option_name[level_post_access]"
                    id="default-access-admin" 
                    value="admin"
                    <?php if ($settings->findWhere('option_name', 'level_post_access')->option_value === 'admin') :?>
                    checked
                    <?php endif; ?>
                  >
                  <label for="default-access-admin" class="custom-control-label" style="font-weight: 400;">Administrator</label>
                </div>
              </div>
              <hr>

              <h5>Metadata</h5>
              <label>Site Meta Description</label>
              <textarea name="option_name[meta_description]" id="" rows="3" class="form-control">
                <?= ltrim($settings->findWhere('option_name', 'meta_description')->option_value); ?>  
              </textarea>
             
              <div class="form-group">
                <label>Robots</label>
                <select name="option_name[robots]" class="form-control">
                  <option value="index,follow">index,follow</option>
                  <option value="noindex,follow">noindex,follow</option>
                  <option value="index,nofollow">index,nofollow</option>
                  <option value="noindex,nofollow">noindex,nofollow</option>
                </select>
                <input type="text" class="form-control mt-2" value="<?= $settings->findWhere('option_name', 'robots')->option_value; ?>" readonly>
              </div>

              <div class="form-group">
                <label for="">Author</label>
                <input 
                  type="text" 
                  class="form-control" 
                  name="option_name[author]" 
                  value="<?= $settings->findWhere('option_name', 'author')->option_value; ?>"
                >
              </div>
              
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Post Configuration</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <h5>Categories</h5>
              <div class="form-check">
                <input 
                  type="checkbox" 
                  name="option_name[categories]" 
                  id="categories" 
                  class="form-check-input" 
                  value="on"
                  <?php if ($settings->findWhere('option_name', 'categories')->option_value === 'on') : ?>
                  checked 
                  <?php endif; ?>
                >
                <label for="categories">Show Categories</label>
              </div>
              <hr>

              <h5>Comments</h5>
              <div class="form-check">
                <input 
                  type="checkbox" 
                  name="option_name[comments]" 
                  id="comments" 
                  class="form-check-input" 
                  value="on"
                  <?php if ($settings->findWhere('option_name', 'comments')->option_value === 'allow') : ?>
                  checked 
                  <?php endif; ?>
                >
                <label for="comments">Allow Comments</label>
              </div>
              <hr>

              <h5>Post Access</h5>
                <div class="form-group mb-0">
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="option_name[post_access]" 
                      id="post-access-public" 
                      value="public" 
                      <?php if ($settings->findWhere('option_name', 'post_access')->option_value === 'public'): ?>
                      checked
                      <?php endif; ?>
                    >
                    <label 
                      for="post-access-public" 
                      class="custom-control-label" 
                      style="font-weight: 400;"
                    >
                      Public
                    </label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="option_name[post_access]" 
                      id="post-access-registered" 
                      value="registered" 
                      <?php if ($settings->findWhere('option_name', 'post_access')->option_value === 'registered'): ?>
                      checked
                      <?php endif; ?>
                    >
                    <label 
                      for="post-access-registered" 
                      class="custom-control-label" 
                      style="font-weight: 400;"
                    >
                      Registered
                    </label>
                  </div>
                </div>
        
              <hr>

              <h5>Post Status</h5>
                <div class="form-group mb-0">
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="option_name[post_status]" 
                      id="post-status-trashed" 
                      value="trashed"
                      <?php if ($settings->findWhere('option_name', 'post_status')->option_value === 'trashed'): ?>
                      checked
                      <?php endif; ?>
                    >
                    <label 
                      for="post-status-trashed" 
                      class="custom-control-label" 
                      style="font-weight: 400;"
                    >
                      Trashed
                    </label>
                  </div>
                
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="option_name[post_status]" 
                      id="post-status-archived" 
                      value="archived"
                      <?php if ($settings->findWhere('option_name', 'post_status')->option_value === 'archived'): ?>
                      checked
                      <?php endif; ?>
                    >
                    <label 
                      for="post-status-archived" 
                      class="custom-control-label" 
                      style="font-weight: 400;"
                    >
                      Archived
                    </label>
                  </div>
                
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="option_name[post_status]" 
                      id="post-status-published" 
                      value="published"
                      <?php if ($settings->findWhere('option_name', 'post_status')->option_value === 'published'): ?>
                      checked
                      <?php endif; ?>
                    >
                    <label 
                      for="post-status-published" 
                      class="custom-control-label" 
                      style="font-weight: 400;"
                    >
                      Published
                    </label>
                  </div>
                </div>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">User Configuration</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                  <i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <h5>Registration</h5>
              <div class="form-check">
                <input 
                  type="checkbox" 
                  name="option_name[user_registration]" 
                  id="user_registration" 
                  class="form-check-input" 
                  value="on"
                  <?php if ($settings->findWhere('option_name', 'user_registration')->option_value === 'on') : ?>
                  checked
                  <?php endif; ?>
                >
                <label for="user_registration">Allow User Registration</label>
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