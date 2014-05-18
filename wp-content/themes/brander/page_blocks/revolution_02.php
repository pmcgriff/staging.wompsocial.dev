<?php global $brander_options; ?>



<?php if (empty($brander_options['h05_revolution_shortcode'])): ?>
    <?php $shorty = 'home_05' ?>
<?php else: ?>
    <?php $shorty = $brander_options['h05_revolution_shortcode']; ?>
<?php endif ?> 

<?php echo do_shortcode( '[rev_slider ' . $shorty . ']"'); ?>      

