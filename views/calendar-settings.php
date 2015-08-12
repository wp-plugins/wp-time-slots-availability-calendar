<?php
/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */
?>
<?php 
if(!empty($_GET['action']) && $_GET['action'] == 'save'):
    if(!empty($_POST['tsa-powered-by']))
        update_option('tsa-powered-by',1);
    else
        update_option('tsa-powered-by',0);
    $status = 1;
endif;
?>
<div class="wrap">
    <div id="icon-themes" class="icon32"></div><h2>WP Time Slots Availability Calendar</h2>
    <?php if(!empty($status) && $status == 1):?>
    <div id="message" class="updated">
        <p><?php echo __('Settings saved.','tsa')?></p>
    </div>
    <?php endif;?>
    
    <h3><?php echo __('Settings','tsa')?></h3>
    
    <form method="post" action="<?php echo admin_url( 'admin.php?page=wp-time-slots-settings&action=save');?>">
    <table class="form-table" style="width: 400px;">
       
        
        
        <tr valign="top">
            <th scope="row"><?php echo __('Hide powered by text?','tsa')?></th>
            <td>
                <label>
                    <input type="checkbox" name="tsa-powered-by" value="1"<?php if(get_option('tsa-powered-by') == 1) echo ' checked="checked"';?> />
                </label><br />
                
            </td>
        </tr>
    </table>
    
    <p class="submit">
    <input type="submit" class="button-primary" value="<?php _e('Save Changes') ?>" />
    </p>
    </form>
    
</div>