<?php  include '../resources/views/templates/base.php' ?>

<div class="col-md-12">

    <?php include '../resources/views/partials/errors.php' ?>

    <div class="card">
    
        <form action="/library" method="POST" enctype="multipart/form-data">
            <input type="hidden" name="_token" value="<?= isset($token) ? $token : "" ?>"> 

            <div class="card-header pb-2">
                <div class="d-flex align-items-center">
                    <h3 class="mb-0">Library</h3>
                    <input type="file" name="media" class="btn bg-gradient-dark ms-auto" id="submitbtn">Upload new media</button>
                    <input type="submit" value="Confirm">
                </div>
            </div>
            <div class="card-body" id="body-content">
                <div class="col-md-12 mb-2">
                    <?php if ($images !== null): ?>
                        <?php foreach($images as $image): ?>
                            <div class="box-image">
                                <img src="http://<?= $image->url ?>" alt="">
                            </div>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </div>
            </div>

        </form>
    </div>
</div>

<?php  include '../resources/views/templates/footer.php' ?>