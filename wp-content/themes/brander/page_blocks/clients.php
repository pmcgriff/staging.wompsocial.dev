<?php global $brander_options; ?>

<div class="projectsRow">

    <?php if (empty($brander_options['project_slides'])): ?>

    <?php else: ?>
        <?php foreach ($brander_options['project_slides'] as $key => $value): ?>
            <div class="project">
                <img src="<?php echo $value['image']; ?>" alt="">
            </div>
        <?php endforeach ?>
    <?php endif ?>
</div>