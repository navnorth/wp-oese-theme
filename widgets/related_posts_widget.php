<?php

/**
 *
 * Related Posts Widget
 *
 **/
class Related_Posts_Widget extends WP_Widget {
    //Initialized Widget and passing widget parameters
    function __construct() {
        $widget_ops = array( 'classname' => 'related-posts', 'description' => __('A widget that displays latest posts according to category of a post/page ', 'OII') );
        $control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'related-posts-widget' );
        parent::__construct( 'related-posts-widget', __('Related Posts', 'OII'), $widget_ops, $control_ops );
    }

    //Display Widget Function
    function widget( $args, $instance ) {
        global $post;
        extract( $args );

        $title = apply_filters('widget_title', $instance['title'] );
        $show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;
        $show_thumbnail = isset( $instance['show_thumbnail'] ) ? $instance['show_thumbnail'] : false;
        $posts_count  = $instance['posts_count'];

        echo $before_widget;

        // Display the widget title
        if ( $title )
            echo $before_title . $title . $after_title;

        // Get Posts by Category
        //Code Goes here

        //Display the Date
        if ( $show_date )
            printf( $show_date );

        //Display the Thumbnail
        if ( $show_thumbnail )
            printf( $show_thumbnail );

        echo $after_widget;
    }

    //Update Widget Settings Function
    function update( $new_instance, $old_instance ) {
         $instance = array();

        //Strip tags from title and name to remove HTML
        $instance['title'] = strip_tags( $new_instance['title'] );
        $instance['show_date'] = $new_instance['show_date'];
        $instance['show_thumbnail'] = $new_instance['show_thumbnail'];
        $instance['posts_count'] = $new_instance['posts_count'];

        return $instance;
    }

    //Display The Widget Form For User Defined Settings
    function form( $instance ){
        //Set up some default widget settings.
        $defaults = array( 'title' => __('Latest Posts', 'OII'), 'show_date' => 'off', 'show_thumbnail' => 'on', 'posts_count' => 1 );
        $instance = wp_parse_args( (array) $instance, $defaults );

        // Widget Title: Text Input ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Title:', 'example'); ?></label>
            <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php echo $instance['title']; ?>" style="width:100%;" />
        </p>
        <?php // Show  Date Checkbox ?>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_date'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e('Display post date?', 'OII'); ?></label>
        </p>
         <?php // Show Thumbnail Checkbox ?>
        <p>
            <input class="checkbox" type="checkbox" <?php checked( $instance['show_thumbnail'], 'on' ); ?> id="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>" name="<?php echo $this->get_field_name( 'show_thumbnail' ); ?>" />
            <label for="<?php echo $this->get_field_id( 'show_thumbnail' ); ?>"><?php _e('Display thumbnail?', 'OII'); ?></label>
        </p>
        <?php
        //Post Count Text Input
        ?>
        <p>
            <label for="<?php echo $this->get_field_id( 'posts_count' ); ?>"><?php _e('Number of posts to display?', 'OII'); ?></label>
            <input id="<?php echo $this->get_field_id( 'posts_count' ); ?>" name="<?php echo $this->get_field_name( 'posts_count' ); ?>" value="<?php echo $instance['posts_count']; ?>" size="3" />
        </p>
        <?php
    }
}