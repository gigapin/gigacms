<?php include '../resources/views/templates/base.php' ?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<!-- Content Header (Page header) -->
<section class="content-header">
	<div class="container-fluid">
		<div class="row">
			<div class="col-sm-6">
				<h1>Posts</h1>
			</div>
			<div class="col-sm-6">
				<ol class="breadcrumb float-sm-right">
					<li class="breadcrumb-item">
						<a href="/posts/create" class="btn btn-block btn-outline-primary btn-lg"><i class="fas fa-solid fa-plus mr-2"></i>Add post</a>
					</li>
				</ol>
			</div>
		</div>
	</div><!-- /.container-fluid -->
</section>

<!-- Main content -->
<section class="content">

	<?php include '../resources/views/partials/flash.php' ?>

	<?php if (! $posts) : ?>
		<?php include '../resources/views/partials/callout.php'; ?>
	<?php else : ?>

		<?php foreach ($posts as $post) : ?>
			<!-- Default box -->
			<div class="card collapsed-card">
				<div class="card-header">
					<h3 class="card-title">
						<a href="/posts/edit/<?= $post->post_name ?>" class="link-card-title"><?= $post->post_title ?></a>
					</h3>

					<div class="card-tools">
						<a href="/posts/<?= $post->post_name ?>" class="btn btn-tool"><i class="fas fa-eye"></i></a>
						<button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
							<i class="fas fa-minus"></i>
						</button>
						<button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
							<i class="fas fa-times"></i>
						</button>
					</div>
				</div>
				<div class="card-body card-body-collapsed">
					<?php foreach ($images as $image) : ?>
						<?php if ($image->post_id  === $post->id) : ?>
							<img src="<?= $image->url ?>" alt="<?= $image->name ?>" class="featured-img">
						<?php endif ?>
					<?php endforeach ?>
					<?= htmlspecialchars_decode($post->post_content) ?>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<div class="post-footer">
						<div><b>Author</b>:
							<?php foreach ($username as $user_name) : ?>
								<?php if ($post->id === $user_name->id) : ?>
									<?php echo $user_name->username ?>
								<?php endif; ?>
							<?php endforeach; ?>
						</div>
						<!-- <div>Comments: <?= $post->comment_count ?></div> -->
						<div><b>Created at</b>: <?= $post->created_at ?></div>
					</div>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
		<?php endforeach ?>

	<?php endif; ?>

</section>
<!-- /.content -->

</div>

<?php include '../resources/views/templates/footer.php' ?>