<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
?>
<table class="form-table" id="tsa-metabox">
    <tbody>
        <tr>
            <th scope="row">
                <label for="tsaMetabox_id"><?php echo __('Select Calendar:','tsa')?></label>
            </th>
            <td>
                <select name="tsaMetabox[id]" id="tsaMetabox_id">
                <?php $calendarData = unserialize(get_option('tsa-calendar-data'));?>
                <?php foreach($calendarData as $singleCalendar):?>
                    <option value="<?php echo $singleCalendar['calendarId'];?>"><?php echo $singleCalendar['calendarName'];?></option>
                <?php endforeach;?>
                </select>
            </td>
        </tr> 
        
        <tr>
            <th scope="row">
                <label for="tsaMetabox_title"><?php echo __('Show Title:','tsa')?></label>
            </th>
            <td>
                <select name="tsaMetabox[title]" id="tsaMetabox_title">
                    <option value="yes"><?php echo __('Yes','tsa')?></option>
                    <option value="no"><?php echo __('No','tsa')?></option>
                </select>
            </td>
        </tr> 
        
       
    </tbody>
</table>
<p class="submit">
    <input type="button" value="<?php echo __('Send Token to Editor','tsa')?> &raquo;" />
</p>

<div class="clear"></div>