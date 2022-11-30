<?php include '../resources/views/templates/base.php' ?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

<div class="modal fade" id="modal-leave-page">
    <div class="modal-dialog">
        <div class="modal-content bg-info">
            <div class="modal-header">
                <h4 class="modal-title">Leave page</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want leave this page?</p>
            </div>
            <div class="modal-footer justify-content-between">
                <button type="button" class="btn btn-outline-dark" data-dismiss="modal">Close</button>
                <a href="/categories" class="btn btn-outline-dark">Leave page</a>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->


<form action="/categories" method="POST">
	<input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>"> 
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-6">
                    <h1>Create a new category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item">
                            <button type="button" class="btn btn-app bg-secondary" id="leave-page" data-toggle="modal" data-target="#modal-leave-page"><i class="fas fa-th-list"></i> Categories</button>
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
			
			<div class="col-md-12">
				<div class="card card-info">
					<div class="card-header">
						<h3 class="card-title">Content</h3>
					</div>

					<div class="card-body">

						<div class="row">
							<div class="col-md-12 mb-2">
								<div class="form-group">
									<label>Name</label>
									<input class="form-control form-control-lg" type="text" name="category_name" value="<?= isset($old['category_name']) ? $old['category_name'] : ''?>">
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<label>Description</label>
									<textarea class="form-control" name="category_description" rows="5" placeholder="Enter ...">
										<?= isset($old['category_description']) ? $old['category_description'] : ''; ?>
									</textarea>
								</div>
							</div>
						</div>
					
					</div><!-- /.card-body --> 
				</div>
			</div><!-- /.col-md-12 --> 

		</div><!-- /.row -->

	 </section>

</form>
	
</div>
<?php include '../resources/views/templates/footer.php' ?>