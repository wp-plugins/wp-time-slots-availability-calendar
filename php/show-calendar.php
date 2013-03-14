<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
?>
<div class="tsa-calendar-container">
    <?php if(!empty($title) && $title == 'yes'):?><h1><?php echo $calendarData['calendarName'];?></h1><?php endif;?>
<div class="tsa-calendar-wrapper">    
<?php
$freeDayOffset = 0;
$thisDay = strtotime("+" . $freeDayOffset . " days", $currentTimestamp);
$checkDays = checkDays($calendarData['days'],$thisDay,'next', 1);
$currentTimestamp = $thisDay = $checkDays['timestamp'];
$freeDayOffset = $freeDayOffset + $checkDays['count'];
$currentDay = date_i18n('D d-m-y',$thisDay);
$tsaDay = date('d',$thisDay);
$tsaMonth = date('m',$thisDay);
$tsaYear = date('Y',$thisDay);
$freeDayOffset++;
?>
<div class="tsa-calendar">
    <div class="tsa-ajax-loader"><img src="<?php echo TSA_PATH; ?>/images/tsa-ajax-loader.gif" /></div>
    <div class="tsa-calendar-heading">
        <a class="tsa-calendar-prev" href="#"><img src="<?php echo TSA_PATH; ?>/images/tsa-left.png" /></a>
        <span class="tsa-calendar-date">
                <?php echo $currentDay;?>
        </span>
        <a class="tsa-calendar-next" href="#"><img src="<?php echo TSA_PATH; ?>/images/tsa-right.png" /></a>
    </div>
    <ul class="tsa-calendar-days">
        <?php for($i = 0; $i <= ($calendarData['endTime'] - $calendarData['startTime'])*60 - $calendarData['timeSteps']; $i = $i + $calendarData['timeSteps']):?>
        <?php $booked = false; if(!empty($tsaCalendarArray[$tsaYear][$tsaMonth][$tsaDay][date('Hi', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes'))]) && $tsaCalendarArray[$tsaYear][$tsaMonth][$tsaDay][date('Hi', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes'))] == 'Booked') $booked = true;?>
            <li class="hour-<?php echo date('Hi', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes'));?> <?php if($booked == true):?>booked<?php endif;?>">
                <?php echo timeFormat(date('H:i', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes')),$calendarData['timeNotation']) . ' - ' . timeFormat(date('H:i', strtotime($calendarData['startTime'] . ':00 + ' . ($i + $calendarData['timeSteps']) . ' minutes')),$calendarData['timeNotation']);?>
            </li>
        <?php endfor;?>
    </ul>
</div>
</div>

<?php if(empty($includeEditor) && get_option('tsa-powered-by') == 0):?>
<div class="tsa-clear"><!-- --></div>
<div class="tsa-copyright">&copy; <a href="http://www.wptimeslots.com/" target="_blank" title="WP Time Slots Availability Calendar">WP Time Slots Availability Calendar</a></div>
<?php endif;?>
<?php if(!empty($includeEditor)):?>
<form method="post" action="<?php echo admin_url( 'admin.php?page=wp-time-slots&action=save');?>">
<input type="hidden" name="calendarId" value="<?php echo $calendarData['calendarId'];?>" />
<input type="hidden" name="calendarString" id="tsaCalendarString" value='<?php echo str_replace('\"','"',$tsaCalendarString);?>' />
<div class="tsa-calendar-settings">    
    <table class="widefat">
        <thead>
            <tr>
                <th><?php echo __('Hour','tsa')?></th>
                <th><?php echo __('Status','tsa')?></th>
            </tr>
        </thead>
        <tbody>
            <?php for($i = 0; $i <= ($calendarData['endTime'] - $calendarData['startTime'])*60 - $calendarData['timeSteps']; $i = $i + $calendarData['timeSteps']):?>
            <?php $booked = false; if(!empty($tsaCalendarArray[$tsaYear][$tsaMonth][$tsaDay][date('Hi', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes'))]) && $tsaCalendarArray[$tsaYear][$tsaMonth][$tsaDay][date('Hi', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes'))] == 'Booked') $booked = true;?>
            <tr>
                <td><?php echo timeFormat(date('H:i', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes')),$calendarData['timeNotation']) . ' - ' . timeFormat(date('H:i', strtotime($calendarData['startTime'] . ':00 + ' . ($i + $calendarData['timeSteps']) . ' minutes')),$calendarData['timeNotation']);?></td>
                <td>
                    <select class="tsa-status" name="<?php echo date('Hi', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes'));?>" id="hour-<?php echo date('Hi', strtotime($calendarData['startTime'] . ':00 + ' . $i . ' minutes'));?>">
                        <option value="Free" class="tsa-option-free"><?php echo __('Free','tsa')?></option>
                        <option value="Booked" class="tsa-option-booked"<?php if($booked == true):?> selected="selected"<?php endif;?>><?php echo __('Booked','tsa')?></option>
                    </select>
                </td>
            </tr>
            <?php endfor;?>
        </tbody>
    </table>
</div>
<div class="tsa-clear"><!-- --></div>
<p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
</p>
</form>
<?php endif;?>
    <div class="hidden tsa-hidden">
        <span class="tsa-calendarId"><?php echo $calendarData['calendarId'];?></span>
        <span class="tsa-timestamp"><?php echo $currentTimestamp;?></span>
        <span class="tsa-day"><?php echo $tsaDay;?></span>
        <span class="tsa-month"><?php echo $tsaMonth;?></span>
        <span class="tsa-year"><?php echo $tsaYear;?></span>
        <?php if(empty($includeEditor)):?>
            <span class="tsa-view"><?php echo $daysToShow;?></span>
            <span class="tsa-title"><?php echo $title;?></span>
            <span class="tsa-dropdown"><?php echo $dropdown;?></span>
            <span class="tsa-legend"><?php echo $legend;?></span>
        <?php endif;?>
    </div>
<div class="tsa-clear"><!-- --></div>
</div>