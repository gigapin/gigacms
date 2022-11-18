<?php include '../resources/views/templates/base.php' ?>

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

<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row mb-2">
			<div class="col-sm-6">
				<h1><?= $post->post_title ?></h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/posts" class="btn btn-app bg-secondary"><i class="fas fa-th-list"></i> Posts</a>
						<button type="button" class="btn btn-app bg-danger" data-toggle="modal" data-target="#modal-danger"><i class="fas fa-trash"></i>Delete</button>
						<a href="/posts/edit/<?= $post->post_name ?>" class="btn btn-app bg-success"><i class="fas fa-save"></i>Update</a>
					</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

	<!-- Default box -->
	<div class="card">

		<div class="card-body">
			<div class="row">
				<div class="col-12 col-md-12 col-lg-8 order-2 order-md-1">

					<div class="row">
						<div class="col-12">
							<div class="post">
								<div class="user-block">
									<img class="img-circle img-bordered-sm" src="/adminlte/dist/img/user1-128x128.jpg" alt="user image">
									<span class="username">
										<a href="#">
											<?php foreach ($users as $user) : ?>
												<?= $user ?>
											<?php endforeach ?>
										</a>
									</span>
									<span class="description">Shared publicly - <?= $post->updated_at ?></span>
								</div>
								<!-- /.user-block -->
								<div>
									<?= htmlspecialchars_decode($post->post_content) ?>
								</div>
							</div>

							<?php if ($comments !== false) : ?>
								<?php foreach ($comments as $comment) : ?>
									<h5>Comments</h5>
									<div class="post clearfix">
										<div class="user-block">
											<img class="img-circle img-bordered-sm" src="/adminlte/dist/img/avatar.png" alt="User Image">
											<span class="username">
												<a href="#"><?= $comment->comment_author ?></a>
											</span>
											<?php if ($comment->comment_date !== null) : ?>
												<span class="description">Sent you a message - <?= $comment->comment_date ?></span>
											<?php endif; ?>
										</div>
										<!-- /.user-block -->
										<p>
											<?= $comment->comment_content ?>
										</p>
										<p>
											<a href="#" class="link-black text-sm"><i class="fas fa-link mr-1"></i> <?= $comment->comment_approved ?></a>
										</p>
									</div>
								<?php endforeach; ?>
							<?php endif; ?>
						</div>
					</div>
				</div>
				<div class="col-12 col-md-12 col-lg-4 order-1 order-md-2">
					<?php if ($post->post_excerpt !== null) : ?>
						<h4 class="text-secondary">Excerpt</h4>
						<p class="text-muted"><?= $post->post_excerpt ?></p>
						<br>
					<?php endif; ?>

					<ul class="list-unstyled">
						<li>
							<a href="" class="btn-link text-secondary"><i class="fas fa-check"></i><b> Category</b>: <?= $category ?></a>
						</li>
						<li>
							<a href="" class="btn-link text-secondary"><i class="fas fa-check"></i></i> <b>Post Status</b>: <?= $post->post_status ?></a>
						</li>
						<?php if ($post->post_date !== null) : ?>
							<li>
								<a href="" class="btn-link text-secondary"><i class="fas fa-check"></i></i> <b>Post Date</b>: <?= $post->post_date ?></a>
							</li>
						<?php endif; ?>
						<li>
							<a href="" class="btn-link text-secondary"><i class="fas fa-check"></i> <b>Post Password</b>:
								<?php if ($post->post_password !== null) : ?>
									Yes
								<?php else : ?>
									No
								<?php endif; ?>
							</a>
						</li>
						<li>
							<?php if ($post->post_parent !== null) : ?>
								<a href="" class="btn-link text-secondary"><i class="fas fa-check"></i> <b>Post Parent: </b> <?= $post->post_parent ?></a>
							<?php endif; ?>
						</li>
					</ul>
				</div>
			</div>
		</div>
		<!-- /.card-body -->
	</div>
	<!-- /.card -->

</section>
<!-- /.content -->

<?php include '../resources/views/templates/footer.php' ?>