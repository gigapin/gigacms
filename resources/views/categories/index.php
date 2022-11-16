<?php include '../resources/views/templates/base.php' ?>

	<!-- Content Header (Page header) -->
	<section class="content-header">
      	<div class="container-fluid">
        	<div class="row">
          		<div class="col-sm-6">
            		<h1>Categories</h1>
          		</div>
				<div class="col-sm-6">
					<ol class="breadcrumb float-sm-right">
						<li class="breadcrumb-item">
							<a href="/categories/create" class="btn btn-block btn-outline-primary btn-lg"><i class="fas fa-solid fa-plus mr-2"></i>Add Category</a>
						</li>
					</ol>
				</div>
			</div>
      	</div><!-- /.container-fluid -->
    </section>

	<!-- Main content -->
	<section class="content">
	
	<?php include '../resources/views/partials/flash.php' ?>
		
	<?php if(count($categories) === 0): ?>
		<div class="callout callout-info">
            <h5>No category created yet</h5>
			<p>Click on the button above and create your first category!</p>
        </div>

	<?php else: ?>

		<?php foreach ($categories as $category) : ?>
			<!-- Default box -->
			<div class="card collapsed-card">
				<div class="card-header">
					<h3 class="card-title">
						<a href="/categories/edit/<?= $category->category_slug ?>" class="link-card-title"><?= $category->category_name ?></a>
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
					<?= htmlspecialchars_decode($category->category_description) ?>
				</div>
				<!-- /.card-body -->
				<div class="card-footer">
					<div class="post-footer">
						<div><b>Created at</b>: <?= $category->created_at ?></div>
					</div>
				</div>
				<!-- /.card-footer-->
			</div>
			<!-- /.card -->
		<?php endforeach ?>

	<?php endif; ?>
	
	</section>
    <!-- /.content -->

<?php include '../resources/views/templates/footer.php' ?>