<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
 
$calendarString = json_decode(str_replace('\"','"',$_POST['calendarString']),true);
$calendarData = unserialize(get_option('tsa-calendar-data'));
$calendarData[$_POST['calendarId']]['calendarData'] = $calendarString;
update_option('tsa-calendar-data',serialize($calendarData));
$status = 1;
include ( TSA_DIR_PATH . '/views/calendar-list.php');
?>