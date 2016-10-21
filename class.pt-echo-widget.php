<?php
/**
 * Widget API: PT_Echo_Widget class
 *
 * @package PT_Echo
 */

/**
 * Class PT_Echo_Widget
 */
class PT_Echo_Widget extends WP_Widget {

	function __construct() {
		parent::__construct( 'pt_echo_widget', __( 'Post Type Widget', 'pt_echo' ),
			array( 'description' => __( 'Show post from any post type', 'pt_echo' ), )
		);
	}


	/**
	 *
	 * Update Widgets parameters
	 *
	 * @param array $new_instance
	 * @param array $old_instance
	 *
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$defaults = array(
			'title'      => '',
			'post_type'  => 'post',
			'order_by'   => 'date',
			'sort'       => 'ASC',
			'post_count' => 3,
			'columns'    => 3,
			'view_more'  => ''
		);

		$instance = wp_parse_args( $new_instance, $defaults );

		return $instance;

	}

	/**
	 *
	 * Show Widget form in Widget Admin menu
	 *
	 * @param $instance
	 */

	public function form( $instance ) {
		$defaults = array(
			'title'      => '',
			'post_type'  => 'post',
			'order_by'   => 'date',
			'sort'       => 'ASC',
			'post_count' => 3,
			'columns'    => 3,
			'view_more'  => ''
		);

		$instance = wp_parse_args( $instance, $defaults );

		$post_types = get_post_types( array(
			'public' => true
		) );
		$order_by_arr = apply_filters('pt_echo_order_by_array', array( 'date', 'title', 'rand' ));
		$sort_arr = apply_filters('pt_echo_sort_array', array( 'ASC', 'DESC' ));
		$columns_arr = array( '1', '2', '3', '4', '6', '12' );

		// Show Title field
		pt_eco_get_template_part( 'pt-echo-field-input',
			array(
				'label' => __( 'Title:', 'pt_echo' ),
				'id' => $this->get_field_id( 'title' ),
				'name' => $this->get_field_name( 'title' ),
				'value' => esc_attr( $instance['title'] )
			) );

		// Show Post Types Select
		pt_eco_get_template_part( 'pt-echo-field-select',
			array(
				'label' => __( 'Post Type:', 'pt_echo' ),
				'id' => $this->get_field_id( 'post_type' ),
				'name' => $this->get_field_name( 'post_type' ),
				'selected' => esc_attr( $instance['post_type'] ),
				'options' => $post_types                            // String array
			) );

		// Show Order By Select
		pt_eco_get_template_part( 'pt-echo-field-select',
			array(
				'label' => __( 'Order By:', 'pt_echo' ),
				'id' => $this->get_field_id( 'order_by' ),
				'name' => $this->get_field_name( 'order_by' ),
				'selected' => esc_attr( $instance['order_by'] ),
				'options' => $order_by_arr                            // String array
			) );

		// Show Sort Select
		pt_eco_get_template_part( 'pt-echo-field-select',
			array(
				'label' => __( 'Sort:', 'pt_echo' ),
				'id' => $this->get_field_id( 'sort' ),
				'name' => $this->get_field_name( 'sort' ),
				'selected' => esc_attr( $instance['sort'] ),
				'options' => $sort_arr                            // String array
			) );

		// Show Post Count field
		pt_eco_get_template_part( 'pt-echo-field-input',
			array(
				'label' => __( 'Post count:', 'pt_echo' ),
				'id' => $this->get_field_id( 'post_count' ),
				'name' => $this->get_field_name( 'post_count' ),
				'value' => esc_attr( $instance['post_count'] )
			) );

		// Show Sort Select
		pt_eco_get_template_part( 'pt-echo-field-select',
			array(
				'label' => __( 'Columns:', 'pt_echo' ),
				'id' => $this->get_field_id( 'columns' ),
				'name' => $this->get_field_name( 'columns' ),
				'selected' => esc_attr( $instance['columns'] ),
				'options' => $columns_arr
			) );
		// Show Sort Select
		pt_eco_get_template_part( 'pt-echo-field-checkbox',
			array(
				'label' => __( 'Columns:', 'pt_echo' ),
				'id' => $this->get_field_id( 'view_more' ),
				'name' => $this->get_field_name( 'view_more' ),
				'value' => 1,
				'checked' => $instance['view_more'] ? 'checked' : ''
			) );
		?>

		<?php
	}


	/**
	 *
	 * Echo Posts
	 *
	 * @param array $args
	 * @param array $instance
	 */

	public function widget( $args, $instance ) {
		$defaults = array(
			'title'      => '',
			'post_type'  => 'post',
			'order_by'   => 'date',
			'sort'       => 'ASC',
			'post_count' => 3,
			'columns'    => 3,
			'view_more'  => ''
		);

		$instance = wp_parse_args( $instance, $defaults );

		foreach ( $instance as $key => $single ) {
			$instance[ $key ] = apply_filters( 'pt_widget_' . $key, $single );
		}
		echo $args['before_widget'];

		if ( ! empty( $title ) ) {
			echo $args['before_title'] . $title . $args['after_title'];
		}

		$columns_final = intval( 12 / (int) $instance['columns'] );
		$columns_class = 'pt-eco-item pt-eco-col-' . $columns_final . ' pt-eco-' . $instance['post_type'];
		if ( $instance['columns'] == 1 ) {
			$columns_class .= ' pt-eco-item--full';
		}
		$posts = new WP_Query( array(
			'post_type'      => $instance['post_type'],
			'orderby'        => $instance['order_by'],
			'order'          => $instance['sort'],
			'posts_per_page' => (int) $instance['post_count']
		) );

		$columns_class = apply_filters( 'pt_echo_column_class', $columns_class );
		$view_more     = apply_filters( 'pt_echo_view_more_link', $instance['view_more'] );
		$list_class    = apply_filters( 'pt_echo_list_class', 'pt-eco-list' );
		$before_loop = apply_filters('pt_echo_before_loop', "<div class=\"$list_class\">");
		$after_loop = apply_filters('pt_echo_before_loop', '</div>');
		if ( $posts->have_posts() ) :

			echo $before_loop;

			do_action('pt_echo_loop_start');

			while ( $posts->have_posts() ): $posts->the_post();

				pt_eco_get_template_part( 'pt-echo-list-item',
					array(
						'columns_class' => $columns_class,
						'view_more'     => $view_more
					) );
			endwhile;

			do_action('pt_echo_loop_end');

			echo $after_loop;

		endif;

		wp_reset_query();

		echo $args['after_widget'];
	}
}

function register_pt_widget() {
	register_widget( 'pt_echo_widget' );
}

add_action( 'widgets_init', 'register_pt_widget' );