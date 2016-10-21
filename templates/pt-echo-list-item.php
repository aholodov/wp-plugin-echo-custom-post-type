<?php
/**
 * @var $columns_class;
 * @var $view_more;
 */
?>

<div class="<?php echo $columns_class ?>">
	<?php if ( $img = get_attached_img_url( get_the_ID() ) ) : ?>
		<div class="pt-eco-item__thumbnail">
			<img src="<?php echo $img ?>" alt="<?php the_title() ?>">
		</div>
	<?php endif; ?>
	<div class="pt-eco-item__description">
		<h3><?php the_title() ?></h3>
		<?php if ( has_excerpt() ) : ?>
			<?php the_excerpt() ?>
		<?php else : ?>
			<?php the_content() ?>
		<?php endif; ?>
		<?php if ( $view_more ) : ?>
			<a href="<?php the_permalink( get_the_ID() ) ?>" class="pt-eco-item__learn-more button">
				<?php _e( 'Learn more', 'pt_echo' ) ?>
			</a>
		<?php endif; ?>
	</div>
</div>
