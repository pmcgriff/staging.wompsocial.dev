<?php global $brander_options; ?>

    <?php if (empty($brander_options['project_slides'])): ?>

    <?php else: ?>

		<div class="projectsRow">    

	        <?php foreach ($brander_options['project_slides'] as $key => $value): ?>

	            <div class="project">

	                <img src="<?php echo $value['image']; ?>" alt="">

	            </div>

	        <?php endforeach ?>
	   

		</div>

 <?php endif ?>