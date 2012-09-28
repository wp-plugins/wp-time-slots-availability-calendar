<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
 
$calendarData = unserialize(get_option('tsa-calendar-data'));
unset($calendarData[$_GET['id']]);
update_option('tsa-calendar-data',serialize($calendarData));
$status = 'OK';
?>