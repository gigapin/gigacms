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
              <button type="submit" class="btn btn-app bg-success"><i class="fas fa-save"></i>Save</button>
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
                <input type="text" class="form-control" name="site_name">
              </div>
              <div class="form-check">
                <input type="checkbox" class="form-check-input" id="site-offline" name="site_offline" value="on">
                <label class="form-check-label" for="site-offline">Site Offline</label>
              </div>
              <hr>

              <h5>Default Access Level</h5>
              <div class="form-group mb-0">
                <div class="custom-control custom-radio">
                  <input 
                    class="custom-control-input" 
                    type="radio" 
                    name="post_access" 
                    id="default-access-public" 
                    value="public"
                  >
                  <label for="default-access-public" class="custom-control-label" style="font-weight: 400;">Public</label>
                </div>
              </div>
              <div class="form-group mb-0">
                <div class="custom-control custom-radio">
                  <input 
                    class="custom-control-input" 
                    type="radio" 
                    name="post_access" 
                    id="default-access-registered" 
                    value="registered"
                  >
                  <label for="default-access-registered" class="custom-control-label" style="font-weight: 400;">Registered</label>
                </div>
              </div>
              <div class="form-group mb-0">
                <div class="custom-control custom-radio">
                  <input 
                    class="custom-control-input" 
                    type="radio" 
                    name="post_access" 
                    id="default-access-admin" 
                    value="admin"
                  >
                  <label for="default-access-admin" class="custom-control-label" style="font-weight: 400;">Administrator</label>
                </div>
              </div>
              <hr>

              <h5>Default Status</h5>
              <div class="form-check">
                <input type="checkbox" name="status" id="status" class="form-check-input" value="on">
                <label for="status">Enabled</label>
              </div>
              <hr>

              <h5>Metadata</h5>
              <label>Site Meta Description</label>
              <textarea name="meta_description" id="" rows="3" class="form-control"></textarea>

              <div class="form-group">
                <label>Robots</label>
                <select name="robots" class="form-control">
                  <option value="index,follow">index,follow</option>
                  <option value="noindex,follow">noindex,follow</option>
                  <option value="index,nofollow">index,nofollow</option>
                  <option value="noindex,nofollow">noindex,nofollow</option>
                </select>
              </div>
              <div class="form-group">
                <label for="">Author</label>
                <input type="text" class="form-control" name="author">
              </div>
              <hr>

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-warning">
            <div class="card-header">
              <h3 class="card-title">Post Configuration</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">
              <h5>Categories</h5>
              <div class="form-check">
                <input type="checkbox" name="categories" id="categories" class="form-check-input" value="on">
                <label for="categories">Show Categories</label>
              </div>
              <hr>

              <!-- <h5>Tags</h5>
              <div class="form-check">
                <input type="checkbox" name="" id="tags" class="form-check-input">
                <label for="">Show Tags</label>
              </div>
              <hr> -->

              <h5>Comments</h5>
              <div class="form-check">
                <input type="checkbox" name="comments" id="comments" class="form-check-input" value="allow">
                <label for="comments">Allow Comments</label>
              </div>
              <hr>

              <h5>Post Access</h5>
              <?php foreach ($list_access as $access): ?>
                  <div class="form-group mb-0">
                    <div class="custom-control custom-radio">
                      <input 
                        class="custom-control-input" 
                        type="radio" 
                        name="post_access" 
                        id="post-access-<?= $access->alias_type_access; ?>" 
                        value="<?= $access->alias_type_access; ?>" 
                        <?php if ($access->default_access === 1): ?>
                          checked  
                        <?php endif; ?>
                      >
                      <label for="post-access-<?= $access->alias_type_access; ?>" class="custom-control-label" style="font-weight: 400;"><?= $access->type_access ?></label>
                    </div>
                  </div>
                <?php endforeach; ?>
              <hr>

              <h5>Post Status</h5>
              <?php foreach ($list_status as $status): ?>
                <div class="form-group mb-0">
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="post_status" 
                      id="post-status-<?= $status->alias_type_status; ?>" 
                      value="<?= $status->alias_type_status; ?>" 
                      <?php if ($status->default_status === 1): ?>
                        checked  
                      <?php endif; ?>
                    >
                    <label for="post-status-<?= $status->alias_type_status; ?>" class="custom-control-label" style="font-weight: 400;"><?= $status->type_status; ?></label>
                  </div>
                </div>
                <?php endforeach; ?>
              

            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="card card-info">
            <div class="card-header">
              <h3 class="card-title">User Configuration</h3>

              <div class="card-tools">
                <button type="button" class="btn btn-tool" data-card-widget="collapse"><i class="fas fa-minus"></i>
                </button>
              </div>
            </div>
            <div class="card-body">

              <h5>Registration</h5>
              <div class="form-check">
                <input type="checkbox" name="user_registration" id="user_registration" class="form-check-input" value="on">
                <label for="user_registration">Allow User Registration</label>
              </div>
              <hr>

              <!-- <h5>Send Email</h5>
              <div class="form-check">
                <input type="checkbox" name="" id="" class="form-check-input">
                <label for="">Send email to notify who user has been registrated</label>
              </div>
              <hr> -->

              <!-- <h5>Password</h5>
              <div class="form-check">
                <input type="checkbox" name="" id="" class="form-check-input">
                <label for="">Setting password automatically</label>
              </div> -->

            </div>
          </div>
        </div>

      </div>
    </div>
  </section>
  </form>

</div>

<?php include '../resources/views/templates/footer.php'; ?>