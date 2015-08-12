<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */

class tsa_widget extends WP_Widget {
    function tsa_widget() {
        parent::__construct(false, $name = 'WP Time Slot Availability Calendar', array(
            'description' => 'Use this widget to add the time slot availability calendar to the sidebar '
        ));
    }
    function widget($args, $instance) {
        global $post;
        extract( $args );   
        $calendarData = unserialize(get_option('tsa-calendar-data'));     
        $calendarId = 0; if(!empty($instance['tsa_select_calendar'])) 
            $calendarId = $instance['tsa_select_calendar'];
        if(empty($calendarData[$calendarId])):
            echo __("Wrong calendar ID",'tsa');
        else:    
        $showLegend = 'yes'; if(!empty($instance['tsa_show_legend'])) 
            $showLegend = $instance['tsa_show_legend'];
            
        $showTitle = 'yes'; if(!empty($instance['tsa_show_title'])) 
            $showTitle = $instance['tsa_show_title'];

        echo do_shortcode('[tsa id="'.$instance['tsa_select_calendar'].'" legend="'.$instance['tsa_show_legend'].'" title="'.$instance['tsa_show_title'].'" ]');
        endif;

    }
    function update($new_instance, $old_instance) {
        return $new_instance;
    }
    function form($instance) {
        $calendarData = unserialize(get_option('tsa-calendar-data'));
        
        $calendarId = 0; if(!empty($instance['tsa_select_calendar'])) 
            $calendarId = $instance['tsa_select_calendar'];
        
            
        $showLegend = 'yes'; if(!empty($instance['tsa_show_legend'])) 
            $showLegend = $instance['tsa_show_legend'];
            
        $showTitle = 'yes'; if(!empty($instance['tsa_show_title'])) 
            $showTitle = $instance['tsa_show_title'];
      
        
        
        ?>
        
        <p>
            <label for="<?php echo $this->get_field_id('tsa_select_calendar'); ?>"><?php echo __('Select Calendar');?></label>
            <select name="<?php echo $this->get_field_name('tsa_select_calendar'); ?>" id="<?php echo $this->get_field_id('tsa_select_calendar'); ?>" class="widefat">
            <?php foreach($calendarData as $singleCalendar):?>
                <option<?php if($singleCalendar['calendarId']==$calendarId) echo ' selected="selected"';?> value="<?php echo $singleCalendar['calendarId'];?>"><?php echo $singleCalendar['calendarName'];?></option>
            <?php endforeach;?>   
            </select>
            
            <label for="<?php echo $this->get_field_id('tsa_show_legend'); ?>"><?php echo __('Show Legend');?></label>
            <select name="<?php echo $this->get_field_name('tsa_show_legend'); ?>" id="<?php echo $this->get_field_id('tsa_show_legend'); ?>" class="widefat">
                <option value="yes">Yes</option>
                <option value="no"<?php if($showLegend=='no'):?> selected="selected"<?php endif;?>>No</option>
            </select>
            
            <label for="<?php echo $this->get_field_id('tsa_show_title'); ?>"><?php echo __('Show Title');?></label>
            <select name="<?php echo $this->get_field_name('tsa_show_title'); ?>" id="<?php echo $this->get_field_id('tsa_show_title'); ?>" class="widefat">
                <option value="yes">Yes</option>
                <option value="no"<?php if($showTitle=='no'):?> selected="selected"<?php endif;?>>No</option>
            </select>
        
        </p>
        <?php
    }
}

?>
