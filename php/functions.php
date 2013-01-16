<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */

function number_pad($number,$n) {
    return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}

function pr($var){
	echo "<pre>";
	print_r($var);
	echo "</pre>";
}

function timeFormat($time,$format){
    if($format == 1){
        return date('g:i a',strtotime($time));
    } elseif($format == 2){
        return date('g:i A',strtotime($time));
    } elseif($format == 3){
        return date('H:i',strtotime($time));
    }
    return false;
}

function checkDays($calendarDays,$timestamp,$direction, $count = false){
    $currentDay = date('N',$timestamp);    
    if(in_array($currentDay,$calendarDays)){
        if(!empty($count))
            return array('timestamp' => $timestamp, 'count' => ($count-1));
        return $timestamp;
    } else {
        if($direction == 'next')
            return checkDays($calendarDays,$timestamp+86400,$direction,++$count);
        else
            return checkDays($calendarDays,$timestamp-86400,$direction,++$count);    
    }    
    
}


add_action('wp_ajax_changeDayAdmin', 'changeDayAdmin_callback');
function changeDayAdmin_callback() {
    
    $calendarData = unserialize(get_option('tsa-calendar-data'));
    $calendarData = $calendarData[$_POST['id']];
    
    if($_POST['direction'] == 'next')
        $currentTimestamp = $_POST['timestamp']+86400;
    elseif($_POST['direction'] == 'prev')
        $currentTimestamp = $_POST['timestamp']-86400;
    else
        $currentTimestamp = $_POST['timestamp'];
    
    $currentTimestamp = checkDays($calendarData['days'],$currentTimestamp,$_POST['direction']);
    
    $currentDay = date('D d-m-y',$currentTimestamp);

    
    $tsaCalendarString = $_POST['tsaCalendarString'];
    $tsaCalendarArray = json_decode(str_replace('\"','"',$_POST['tsaCalendarString']),true);
    $includeEditor = true;    
    
	include ( TSA_DIR_PATH . '/php/show-calendar.php');
    
	die();
}

add_action('wp_ajax_changeDay', 'changeDay_callback');
add_action('wp_ajax_nopriv_changeDay', 'changeDay_callback');

function changeDay_callback() {
    
    $calendarData = unserialize(get_option('tsa-calendar-data'));
    $calendarData = $calendarData[$_POST['id']];
    
    if($_POST['direction'] == 'next')
        $currentTimestamp = $_POST['timestamp']+86400;
    elseif($_POST['direction'] == 'prev')
        $currentTimestamp = $_POST['timestamp']-86400;
    else
        $currentTimestamp = $_POST['timestamp'];

    $currentTimestamp = checkDays($calendarData['days'],$currentTimestamp,$_POST['direction']);
    
    $currentDay = date('D d-m-y',$currentTimestamp);
    
    
    $tsaCalendarArray = $calendarData['calendarData'];
    
    $daysToShow = $_POST['view'];
    $title = $_POST['title']; 
    $legend = $_POST['legend'];
    $dropdown = $_POST['dropdown'];
    
	include ( TSA_DIR_PATH . '/php/show-calendar.php');
    
	die(); 
}


?>