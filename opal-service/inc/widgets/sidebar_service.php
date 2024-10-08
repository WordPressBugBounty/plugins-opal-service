<?php
/**
 * $Desc
 *
 * @version    $Id$
 * @package    wpbase
 * @author      Team <opalwordpressl@gmail.com >
 * @copyright  Copyright (C) 2015  prestabrain.com. All Rights Reserved.
 * @license    GNU/GPL v2 or later http://www.gnu.org/licenses/gpl-2.0.html
 *
 * @website  http://www.wpopal.com
 * @support  http://www.wpopal.com/questions/
 */

class Opalservice_Sidebar_Service_Widget extends WP_Widget{

    public function __construct() {
         parent::__construct(
            // Base ID of your widget
            'opalservice_sidebar_service_widget',
            // Widget name will appear in UI
            __('Opal Sidebar Services', 'opal-service'),
            // Widget description
            array( 'description' => __( 'Sidebar Services widget.', 'opal-service' ), )
        );
    }

    public function widget( $args, $instance ) {

        
        extract( $args );
	    extract( $instance );
        //Our variables from the widget settings.
//        $title  = apply_filters('widget_title', esc_attr($instance['title']));
//
//        $show_icon = $instance[ 'show_icon' ] ? 'true' : 'false';

        //Check

        $tpl = OPALSERVICE_THEMER_TEMPLATES_DIR .'widgets/sidebar_service/default.php'; 
        $tpl_default = OPALSERVICE_PLUGIN_DIR .'templates/widgets/sidebar_service/default.php';
  
        if(  is_file($tpl) ) { 
            $tpl_default = $tpl;
        }
        require $tpl_default;
    }

    //Update the widget

    public function update( $new_instance, $old_instance ) {
        $instance = $old_instance;
        //Strip tags from title and name to remove HTML
        $instance['title']              = strip_tags( $new_instance['title'] );
        $instance['num']                = $new_instance['num'];
        $instance['show_icon'] = isset( $new_instance['show_icon'] ) ? (bool) $new_instance['show_icon'] : false;

        return $instance;
    }

    // Form

    public function form( $instance ) {
        //Set up some default widget settings.
        $defaults = array( 
            'title' => __('Sidebar Services', 'opal-service'),
            'num' => '5',
            'show_icon' => 'true',
        );              
        $instance = wp_parse_args( (array) $instance, $defaults ); 

        $show_icon = isset( $instance['show_icon'] ) ? (bool) $instance['show_icon'] : false;
        ?>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id( 'title' )); ?>"><?php _e('Title:', 'opal-service'); ?></label>
            <input type="text" id="<?php echo esc_attr($this->get_field_id( 'title' )); ?>" name="<?php echo esc_attr($this->get_field_name( 'title' )); ?>" value="<?php echo esc_attr($instance['title']); ?>" style="width:100%;" />
        </p>

        <p>
            <label for="<?php echo esc_attr($this->get_field_id('num')); ?>"><?php _e('Limit:', 'opal-service'); ?></label>
            <br>
            <input id="<?php echo esc_attr($this->get_field_id('num')); ?>" name="<?php echo esc_attr($this->get_field_name('num')); ?>" type="text" value="<?php echo esc_attr( $instance['num'] ); ?>" />
        </p>
        <p>
            <label for="<?php echo esc_attr($this->get_field_id('show_icon')); ?>"><?php _e('Show icon', 'opal-service'); ?></label>
            <input id="<?php echo esc_attr($this->get_field_id('show_icon')); ?>" name="<?php echo esc_attr($this->get_field_name('show_icon')); ?>" type="checkbox" <?php checked( $show_icon ); ?> />
        </p>
    <?php
    }
    
}

register_widget( 'Opalservice_Sidebar_Service_Widget' );

?>