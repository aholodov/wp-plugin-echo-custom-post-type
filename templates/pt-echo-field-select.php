<?php
/**
 * @var $label
 * @var $id
 * @var $name
 * @var $selected
 * @var $options
 */
?>

<p>
	<label><?php echo $label; ?>
		<select class="widefat" name="<?php echo $name; ?>"
		        id="<?php echo $id; ?>">
			<?php foreach ( $options as $type ) :
				$selected_attr = $type === $selected ? 'selected' : '';
				?>
				<option value="<?php echo $type ?>" <?php echo $selected_attr ?>><?php echo $type ?></option>
			<?php endforeach; ?>
		</select>
	</label>
</p>