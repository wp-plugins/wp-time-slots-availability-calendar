<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */

$calendarData = (get_option('tsa-calendar-data'));

if(!empty($calendarData) && count(unserialize($calendarData))>0) die();

$calendarData = unserialize($calendarData);

if($calendarData)
    $lastId = array_pop(array_keys($calendarData));
else
    $lastId = 0;

$timeSteps = filter_input(INPUT_POST,'tsa_time_steps',FILTER_SANITIZE_NUMBER_INT);
$startTime = filter_input(INPUT_POST,'tsa_start_time',FILTER_SANITIZE_NUMBER_INT);
$endTime = filter_input(INPUT_POST,'tsa_end_time',FILTER_SANITIZE_NUMBER_INT);
$timeNotation = filter_input(INPUT_POST,'tsa_notation',FILTER_SANITIZE_NUMBER_INT);
$calendarName = strip_tags(htmlspecialchars($_POST['tsa_calendar_name']));

if(!$calendarName){
    $status = 3;
} elseif($startTime >= $endTime){
    $status = 1;
} elseif(empty($_POST['tsa_days'])){
    $status = 2;
} else {
    $calendarData[$lastId+1] = array(
                                'calendarId' => $lastId+1,
                                'calendarName' => $calendarName,
                                'timeSteps' => '60',
                                'startTime' => $startTime,
                                'endTime' => $endTime,
                                'timeNotation' => $timeNotation,
                                'days' => $_POST['tsa_days'],
                                'calendarData' => array()
                              );
    

    update_option('tsa-calendar-data',serialize($calendarData));
    
    $status = 'OK';
}
?>