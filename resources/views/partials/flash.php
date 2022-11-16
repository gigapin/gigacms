<?php if(isset($_COOKIE['FLASH_MESSAGE'])): ?>
	<div class="alert alert-success alert-dismissible">
        <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
        <h5><i class="icon fas fa-check"></i> <?= $_COOKIE['FLASH_MESSAGE']; ?></h5>
    </div>
<?php endif ?> 