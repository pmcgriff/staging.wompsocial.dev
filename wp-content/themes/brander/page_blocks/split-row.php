<?php global $brander_options; ?>

<style>
	.large-6_image_side img {
		height: 100%;
		width: auto;
		max-width: none;
	}
</style>

<div class="splitRow">

    <div class="large-6 columns large-6_image_side">

        



        <?php if (empty($brander_options['split_image']['url'])): ?>

            <img src="<?php echo get_template_directory_uri(); ?>/img/about_split.jpg" height="868" width="853" alt="">

        <?php else: ?>

            <img src="<?php echo $brander_options['split_image']['url']; ?>" alt="">

        <?php endif ?> 







    </div>

    <div class="large-6 columns large-6_post_item">

        <div class="paleSeperator"></div>

        <?php if (empty($brander_options['split_text'])): ?>

            About Me

         <?php else: ?>

            <?php echo $brander_options['split_text']; ?>

         <?php endif ?>

    </div>

</div>