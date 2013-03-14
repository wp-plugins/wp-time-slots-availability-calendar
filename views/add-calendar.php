<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
?>
<div class="wrap" >
    <div id="icon-themes" class="icon32"></div><h2>WP Time Slots Availability Calendar</h2>
    <?php if(!empty($status) && $status == 1):?>
    <div id="message" class="error">
        <p><?php echo __('Error: The end time must be greater than the start time.','tsa')?></p>
    </div>
    <?php elseif(!empty($status) && $status == 2):?>
    <div id="message" class="error">
        <p><?php echo __('Error: You must select at lease one day.','tsa')?></p>
    </div>
    <?php elseif(!empty($status) && $status == 3):?>
    <div id="message" class="error">
        <p><?php echo __('Error: You must enter a calendar name.','tsa')?></p>
    </div>
    <?php endif;?>
    
    <h3><?php echo __('Add new calendar','tsa')?></h3>
    <?php $calendarData = get_option('tsa-calendar-data'); ?>
    <?php if(!empty($calendarData) && count(unserialize($calendarData))>0):?>
    <div class="error">
        <p>You can only add one calendar.</p>
    </div>    
    <div class="updated">
        <h3>Get the full version!</h3>
        <ul>
            <li>- Custom time slot steps! Like 12:00 - 12:05 (every 5 minutes) or every 10 minutes and so on.</li>
            <li>- Show multiple days</li>
            <li>- Show a legend near the calendar</li>
            <li>- Create an unlimited number of calendars</li>
            <li>- Show or hide the days in a drop down menu</li>
            <li>- No copyright texts</li>
            <li>- Only $25 (no yearly costs!)</li>
            <li>- Download directly without registration</li>
            <li>- Not satisfied? Money back guarantee!</li>
        </ul>
        <p><a class="button-secondary" href="http://www.wptimeslots.com/download/" title="" target="_blank">Buy the full version</a></p>
    </div>
    <?php else:?>
    <p><?php echo __('Choose the settings for your new calendar. Please note that these cannot be changed later.','tsa')?></p>
    <form method="post" action="<?php echo admin_url( 'admin.php?page=wp-time-slots-add-new&action=add');?>">
    <table class="form-table" style="width: 400px;">
       
        <tr valign="top">
            <th scope="row"><?php echo __('Calendar Name:','tsa')?></th>
            <td>
                <input type="text" class="widefat" name="tsa_calendar_name" value="<?php if(!empty($_POST['tsa_calendar_name'])) echo $_POST['tsa_calendar_name'];?>" />
            </td>
        </tr>
       
      
        
        <tr valign="top">
            <th scope="row"><?php echo __('Start Time:','tsa')?></th>
            <td>
                <select class="widefat" name="tsa_start_time">
                    <?php for($i=00; $i<=23; $i++):?>
                        <option value="<?php echo $i;?>"<?php if(!empty($_POST['tsa_start_time']) && $_POST['tsa_start_time']==$i) echo ' selected="selected"';?>><?php echo number_pad($i,2);?>:00</option>
                    <?php endfor;?>
                </select>
            </td>
        </tr>
        
        <tr valign="top">
            <th scope="row"><?php echo __('End Time:','tsa')?></th>
            <td>
                <select class="widefat" name="tsa_end_time">
                    <?php for($i=00; $i<=23; $i++):?>
                        <option value="<?php echo $i;?>"<?php if(!empty($_POST['tsa_end_time']) && $_POST['tsa_end_time']==$i) echo ' selected="selected"';?>><?php echo number_pad($i,2);?>:00</option>
                    <?php endfor;?>                        
                    
                </select>
            </td>
        </tr>
        
        <tr valign="top">
            <th scope="row"><?php echo __('Time Notation:','tsa')?></th>
            <td>
                <select class="widefat" name="tsa_notation">
                    <option value="1">2:15 pm</option>
                    <option value="2">2:15 PM</option>
                    <option value="3">14:15</option>
                </select>
            </td>
        </tr>
        
        <tr valign="top">
            <th scope="row"><?php echo __('Days:','tsa')?></th>
            <td>
                <label>
                    <input type="checkbox" name="tsa_days[1]" value="1"<?php if(!empty($_POST['tsa_days'][1])) echo ' checked="checked"';?> /> <?php echo __('Monday','tsa')?>
                </label><br />
                <label>
                    <input type="checkbox" name="tsa_days[2]" value="2"<?php if(!empty($_POST['tsa_days'][2])) echo ' checked="checked"';?> /> <?php echo __('Tuesday','tsa')?>
                </label><br />
                <label>
                    <input type="checkbox" name="tsa_days[3]" value="3"<?php if(!empty($_POST['tsa_days'][3])) echo ' checked="checked"';?> /> <?php echo __('Wednesday','tsa')?>
                </label><br />
                <label>
                    <input type="checkbox" name="tsa_days[4]" value="4"<?php if(!empty($_POST['tsa_days'][4])) echo ' checked="checked"';?> /> <?php echo __('Thursday','tsa')?>
                </label><br />
                <label>
                    <input type="checkbox" name="tsa_days[5]" value="5"<?php if(!empty($_POST['tsa_days'][5])) echo ' checked="checked"';?> /> <?php echo __('Friday','tsa')?>
                </label><br />
                <label>
                    <input type="checkbox" name="tsa_days[6]" value="6"<?php if(!empty($_POST['tsa_days'][6])) echo ' checked="checked"';?> /> <?php echo __('Saturday','tsa')?>
                </label><br />
                <label>
                    <input type="checkbox" name="tsa_days[7]" value="7"<?php if(!empty($_POST['tsa_days'][7])) echo ' checked="checked"';?> /> <?php echo __('Sunday','tsa')?>
                </label>
            </td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
    </form>
    <?php endif;?>
</div>