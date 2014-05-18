<?php global $brander_options; ?>



<?php if (empty($brander_options['h02_revolution_shortcode'])): ?>
    <?php $shorty = 'home_02' ?>
<?php else: ?>
    <?php $shorty = $brander_options['h02_revolution_shortcode']; ?>
<?php endif ?> 

<?php echo do_shortcode( '[rev_slider ' . $shorty . ']"'); ?>      

