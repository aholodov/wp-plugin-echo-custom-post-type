<?php
/**
 * @var $label
 * @var $id
 * @var $name
 * @var $value
 * @var $checked
 */
?>

<p>
	<label><?php echo $label; ?>
		<input class="widefat" id="<?php echo $id; ?>"
		       name="<?php echo $name; ?>" type="checkbox"
		       value="<?php echo $value; ?>" <?php echo $checked ?>/>
	</label>
</p>
