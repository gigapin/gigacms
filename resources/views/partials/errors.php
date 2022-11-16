<?php 
if(isset($_SESSION['errors'])): ?>
	
	<div class="alert alert-danger text-white">
		<ul>
			<?php foreach($_SESSION['errors'] as $error): ?>
				<li><?= $error ?></li>	
			<?php endforeach ?>
		</ul>
	</div>
<?php 
endif; ?>