<?php include '../resources/views/templates/base.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<div class="modal fade" id="modal-danger">
	<div class="modal-dialog">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h4 class="modal-title">Delete post</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure to delete this post?</p>
			</div>

			<form action="/posts/delete/<?= $post->id ?>" method="POST">
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-outline-dark">Confirm delete</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="modal-danger-media">
	<div class="modal-dialog">
		<div class="modal-content bg-danger">
			<div class="modal-header">
				<h4 class="modal-title">Delete featured image</h4>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">
				<p>Are you sure to delete the featured image?</p>
			</div>

			<form action="/media/<?= $media->id ?>" method="POST">
				<input type="hidden" name="media-post" value="<?= $post->post_name ?>">
				<div class="modal-footer justify-content-between">
					<button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
					<button type="submit" class="btn btn-outline-dark">Confirm delete</button>
				</div>
			</form>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<form action="/posts/<?= $post->id ?>" method="POST" enctype="multipart/form-data">
	<input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>">
	<!-- Content Header (Page header) -->
	<section class="content-header">	
		<div class="container-fluid">
			<div class="row">
				<div class="col-sm-6">
					<h1>Update post</h1>
				</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="/posts" class="btn btn-app bg-secondary"><i class="fas fa-th-list"></i>Posts</a>
							<a href="/revisions/<?= $post->id; ?>" class="btn btn-app bg-info"><i class="fas fa-history"></i>Revision</a>
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
											<input class="form-control form-control-lg" type="text" name="post_title" value="<?= $post->post_title ?>">
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label>Content</label>
											<textarea id="editor" class="form-control editor" name="post_content">
												<?= htmlspecialchars_decode($post->post_content) ?>
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
										<?php if ($postCategory->post_id === $post->id) : ?>
											<option value="<?= $postCategory->id ?>" selected><?= $postCategory->category_name ?></option>
										<?php endif; ?>

										<?php foreach ($categories as $category) : ?>
											<?php if ($category->id !== $postCategory->id) : ?>
												<option value="<?= $category->id ?>"><?= $category->category_name ?></option>
											<?php endif; ?>
										<?php endforeach ?>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Post Parent</label>
									<select class="custom-select" name="post_parent">
										<?php if (count($posts) > 0) : ?>
											<?php if ($post->post_parent === 0) : ?>
												<option value="0" selected></option>
											<?php else : ?>
												<option value="0"></option>
											<?php endif; ?>
											<?php foreach ($posts as $posted) : ?>
												<?php if ($post->post_parent === $posted->id) : ?>
													<option value="<?= $posted->id ?>" selected><?= $posted->post_title ?></option>
												<?php endif; ?>
												<?php if ($post->post_title !== $posted->post_title && $post->post_parent !== $posted->id) : ?>
													<option value="<?= $posted->id ?>"><?= $posted->post_title ?></option>
												<?php endif; ?>
											<?php endforeach ?>

										<?php else : ?>
											<option value="0" selected>Select post parent</option>
											<?php foreach ($posts as $posted) : ?>
												<option value="<?= $posted->id ?>"><?= $posted->post_title ?></option>
											<?php endforeach ?>
										<?php endif; ?>
									</select>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<!-- Date -->
								<div class="form-group">
									<label>Post Date:</label>
									<div class="input-group date" id="reservationdate" data-target-input="nearest">
										<input type="text" name="post_date" class="form-control datetimepicker-input" data-target="#reservationdate" value="<?= $post->post_date ?>" />
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
									<input class="form-control" type="password" name="post_password" value="<?= $post->post_password ?>">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Post Access</label>
									<?php if ($post->post_access === 'public') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="public" checked>&nbsp;Public
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="registered">&nbsp;Registered
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="admin">&nbsp;Administrator
									</div>
								<?php endif ?>
								<?php if ($post->post_access === 'registered') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="public">&nbsp;Public
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="registered" checked>&nbsp;Registered
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="admin">&nbsp;Administrator
									</div>
								<?php endif ?>
								<?php if ($post->post_access === 'admin') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="public">&nbsp;Public
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="registered">&nbsp;Registered
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_access" value="admin" checked>&nbsp;Administrator
									</div>
								<?php endif ?>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label>Post Status</label>
								<?php if ($post->post_status === 'published') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="published" checked>&nbsp;Published
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="drafted">&nbsp;Drafted
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="trashed">&nbsp;Trashed
									</div>
									<div class="form-group">
										<input type="radio" name="post_status" value="archived">&nbsp;Archived
									</div>
								<?php endif ?>
								<?php if ($post->post_status === 'drafted') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="published">&nbsp;Published
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="drafted" checked>&nbsp;Drafted
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="trashed">&nbsp;Trashed
									</div>
									<div class="form-group">
										<input type="radio" name="post_status" value="archived">&nbsp;Archived
									</div>
								<?php endif ?>
								<?php if ($post->post_status === 'trashed') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="published">&nbsp;published
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="drafted">&nbsp;Drafted
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="trashed" checked>&nbsp;trashed
									</div>
									<div class="form-group">
										<input type="radio" name="post_status" value="archived">&nbsp;Archived
									</div>
								<?php endif ?>
								<?php if ($post->post_status === 'archived') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="published">&nbsp;Published
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="drafted">&nbsp;Drafted
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="post_status" value="trashed">&nbsp;Trashed
									</div>
									<div class="form-group">
										<input type="radio" name="post_status" value="archived" checked>&nbsp;Archived
									</div>
								<?php endif ?>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<label>Comments Status</label>
								<?php if ($post->comment_status === 'open') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="comment_status" value="open" checked>&nbsp;Open
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="comment_status" value="closed">&nbsp;Closed
									</div>
								<?php endif ?>
								<?php if ($post->comment_status === 'closed') : ?>
									<div class="form-group mb-0">
										<input type="radio" name="comment_status" value="open">&nbsp;Open
									</div>
									<div class="form-group mb-0">
										<input type="radio" name="comment_status" value="closed" checked>&nbsp;Closed
									</div>
								<?php endif ?>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12 mt-3">
								<label for="customFile">Featured Image</label>
								<div class="form-group mb-0">
									<div class="custom-file">
										<input type="file" class="custom-file-input" id="customFile" name="featured">
										<label class="custom-file-label" for="customFile">Choose file</label>
									</div>
								</div>
								<?php if ($media) : ?>
									<img src="<?= $media->url ?>" alt="<?= $media->name ?>" class="media-thumbnail">
									<button type="button" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#modal-danger-media"><i class="fas fa-trash"></i></button>
								<?php endif ?>
							</div>
						</div>

					</div><!-- /.card-body -->
				</div><!-- /.card -->
			</div><!-- /.col-md-4 -->

		</div><!-- ./row -->
	</section><!-- /.content -->
</form>

</div>

<?php include '../resources/views/templates/footer.php' ?>