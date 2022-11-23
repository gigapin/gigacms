<?php include '../resources/views/templates/base.php'; ?>

<div class="modal fade" id="modal-danger">
	<div class="modal-dialog">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h4 class="modal-title">Delete User</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure to delete this user?</p>
			</div>

			<form action="/users/delete/<?= $user->id; ?>" method="POST">
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-outline-dark">Confirm delete</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<form action="/users/<?= $user->id; ?>" method="POST">
	<input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Manage User</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="/users" class="btn btn-app bg-secondary"><i class="fas fa-th-list"></i>Users</a>
              <button type="button" class="btn btn-app bg-danger" data-toggle="modal" data-target="#modal-danger"><i class="fas fa-trash"></i>Delete</button>
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

      <div class="col-md-8">
        <div class="card card-info card-tabs">
          <div class="card-header">
            <h3 class="card-title">Options</h3>
          </div>
          <div class="card-body">
            
            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Username</label>
                  <input 
                    class="form-control" 
                    type="text" 
                    name="username" 
                    value="<?= isset($old['username']) ? $old['username'] : $user->username; ?>"
                  >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Name</label>
                  <input 
                    class="form-control" 
                    type="text" 
                    name="name" 
                    value="<?= isset($old['name']) ? $old['name'] : $user->name; ?>"
                  >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Email</label>
                  <input 
                    class="form-control" 
                    type="text" 
                    name="email" 
                    value="<?= isset($old['email']) ? $old['email'] : $user->email; ?>"
                  >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Password</label>
                  <input 
                    class="form-control" 
                    type="password" 
                    name="password" 
                    value=""
                  >
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <label>Confirm Password</label>
                  <input 
                    class="form-control" 
                    type="password" 
                    name="confirm-password" 
                    value=""
                  >
                </div>
              </div>
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
                  <h5>User Role</h5>
                  <select name="role" class="custom-select">
                  <?php foreach ($roles as $role): ?>
                    <?php if ($role->alias_name_role === $user->role): ?>
                      <option value="<?= $role->alias_name_role; ?>" selected><?= $role->name_role; ?></option>  
                    <?php elseif ($role->alias_name_role === $old['role']): ?>
                      <option value="<?= $role->alias_name_role; ?>" selected><?= $role->name_role; ?></option>  
                    <?php else: ?>
                      <option value="<?= $role->alias_name_role; ?>"><?= $role->name_role; ?></option>
                    <?php endif; ?>
                  <?php endforeach; ?>
                  </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12 mb-2">
                <div class="form-group">
                  <h5>User Status</h5>
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="status" 
                      id="post-status-enabled" 
                      value="1" 
                      <?php if (isset($old['status']) && $old['status'] === 1) : ?> checked <?php endif; ?>
                      <?php if ($user->status === 1): ?> checked <?php endif; ?>
                    >
                    <label for="post-status-enabled" class="custom-control-label" style="font-weight: 400;">Enabled</label>
                  </div>
                  <div class="custom-control custom-radio">
                    <input 
                      class="custom-control-input" 
                      type="radio" 
                      name="status" 
                      id="post-status-disabled" 
                      value="0" 
                      <?php if (isset($old['status']) && $old['status'] === 0) : ?> checked <?php endif; ?>
                        <?php if ($user->status === 0): ?> checked <?php endif; ?>
                    >
                    <label for="post-status-disabled" class="custom-control-label" style="font-weight: 400;">Disabled</label>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>

  </section><!-- /.content -->
</form>


<?php include '../resources/views/templates/footer.php'; ?>