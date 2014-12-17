<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
?>
<div class="wrap">
    <div id="icon-themes" class="icon32"></div><h2>WP Time Slots Availability Calendar</h2>
    
    <?php 
    if(empty($status)){
        $calendarData = unserialize(get_option('tsa-calendar-data'));
        $ID = $_GET['id'];
    } else {
        $ID = $lastId+1;
    }
    if(!empty($calendarData[$ID])):
        
        
    
    $calendarData = $calendarData[$ID];
    $currentTimestamp = time();
    $currentDay = date('D d-m-y',$currentTimestamp);
    $tsaDay = date('d',$currentTimestamp);
    $tsaMonth = date('m',$currentTimestamp);
    $tsaYear = date('Y',$currentTimestamp);
    $tsaCalendarString = json_encode($calendarData['calendarData']);
    $tsaCalendarArray = $calendarData['calendarData'];  
    $includeEditor = true;      
    ?>
    <h3><?php echo $calendarData['calendarName']?></h3>
    
    <div class="tsa-calendar-admin-container">
        <?php include ( TSA_DIR_PATH . '/php/show-calendar.php');?>
    </div>

    <?php else:?>
        <p><?php echo __('Wrong calendar ID','tsa')?></p>
    <?php endif;?>
</div>