<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
?>
<div class="wrap">
        <div id="icon-themes" class="icon32"></div><h2>WP Time Slots Availability Calendar</h2>
        <?php if(!empty($status) && $status == 1):?>
        <div id="message" class="updated">
            <p><?php echo __('The calendar was updated','tsa')?></p>
        </div>
        <?php endif;?>
        
        <h3><?php echo __('Calendars','tsa')?></h3>
        
        <?php if(empty($status)) $calendarData = unserialize(get_option('tsa-calendar-data'));?>
        <?php if($calendarData):?>
        <table class="widefat tsa-table">
            <thead>
                <tr>
                    <th><?php echo __('ID','tsa')?></th>
                    <th><?php echo __('Calendar Name','tsa')?></th>
                    <th><?php echo __('Time Steps','tsa')?></th>
                    <th><?php echo __('Start Time','tsa')?></th>       
                    <th><?php echo __('End Time','tsa')?></th>
                    <th></th>
                </tr>
            </thead>
            
            <tbody>                
                <?php foreach($calendarData as $singleCalendar):?>
                <tr>
                    <td><?php echo $singleCalendar['calendarId']; ?></td>
                    <td><a href="<?php echo admin_url( 'admin.php?page=wp-time-slots&id=' . $singleCalendar['calendarId']);?>"><?php echo $singleCalendar['calendarName']; ?></a></td>
                    <td><?php echo $singleCalendar['timeSteps']; ?> <?php echo __('minutes','tsa')?></td>
                    <td><?php echo timeFormat($singleCalendar['startTime'] . ':00',$singleCalendar['timeNotation']) ?></td>
                    <td><?php echo timeFormat($singleCalendar['endTime'] . ':00',$singleCalendar['timeNotation']) ?></td>
                    <td><a href="<?php echo admin_url( 'admin.php?page=wp-time-slots&id=' . $singleCalendar['calendarId']);?>"><?php echo __('edit calendar','tsa')?></a> | <a class="delete delete-tsa-calendar" href="<?php echo admin_url( 'admin.php?page=wp-time-slots&action=delete&id=' . $singleCalendar['calendarId']);?>"><?php echo __('delete','tsa')?></a></td>
                </tr>
                <?php endforeach;?>
            </tbody>
        </table>
        
        <?php else:?>
            <?php echo __('No calendars found.','tsa')?>
        <?php endif;?>
        <div class="updated">
            <h3>Get the full version!</h3>
            <ul>
                <li>- Custom time slot steps! Like 12:00 - 12:05 (every 5 minutes) or every 10 minutes and so on.</li>
                <li>- Show multiple days</li>
                <li>- Show a legend near the calendar</li>
                <li>- Create an unlimited number of calendars</li>
                <li>- Show or hide the days in a drop down menu</li>
                <li>- No copyright texts</li>
                <li>- Only $15 (no yearly costs!)</li>
                <li>- Download directly without registration</li>
                <li>- Not satisfied? Money back guarantee!</li>
            </ul>
            <p><a class="button-secondary" href="http://www.wptimeslots.com/download/" title="" target="_blank">Buy the full version</a></p>
        </div>
    </div>