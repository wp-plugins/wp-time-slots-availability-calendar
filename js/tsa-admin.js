/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */

var tsa = jQuery.noConflict();

tsa(document).ready(function(){
    tsa(document).on('click','a.tsa-calendar-next',function(){
        tsa('.tsa-ajax-loader').css('display','block');
        var data = {
    		action: 'changeDayAdmin',
    		direction: 'next',
            id: tsa('.tsa-calendarId').html(),
            timestamp: tsa('.tsa-timestamp').html(),
            tsaCalendarString : tsa("#tsaCalendarString").attr('value')
    	};
    	tsa.post(ajaxurl, data, function(response) {
    		tsa('.tsa-calendar-container').html(response);
            tsa('.tsa-ajax-loader').css('display','none');
    	});
    });
    
    tsa(document).on('click','a.tsa-calendar-prev',function(){
        tsa('.tsa-ajax-loader').css('display','block');
        var data = {
    		action: 'changeDayAdmin',
    		direction: 'prev',
            id: tsa('.tsa-calendarId').html(),
            timestamp: tsa('.tsa-timestamp').html(),
            tsaCalendarString : tsa("#tsaCalendarString").attr('value')
    	};
    	tsa.post(ajaxurl, data, function(response) {
    		tsa('.tsa-calendar-container').html(response);
            tsa('.tsa-ajax-loader').css('display','none');
            
    	});
    });
    
    tsa(document).on('change','select.tsa-dropdown-select',function(e){
        tsa('.tsa-ajax-loader').css('display','block');
        var data = {
    		action: 'changeDayAdmin',
    		direction: 'dropdown',
            id: tsa('.tsa-calendarId').html(),
            timestamp: tsa(this).find('option:selected').attr('value'),
            tsaCalendarString : tsa("#tsaCalendarString").attr('value')
    	};
    	tsa.post(ajaxurl, data, function(response) {
    		tsa('.tsa-calendar-container').html(response);
            tsa('.tsa-ajax-loader').css('display','none');
            
    	});
        
    });
    
    
    
    tsaCalendarString = {};
    if(tsa("#tsaCalendarString").length)
        if(tsa("#tsaCalendarString").attr('value')!='[]')
            tsaCalendarString = JSON.parse(tsa("#tsaCalendarString").attr('value'));
        
    tsa(document).on('change',".tsa-status",function(){
        currentYear = tsa(".tsa-year").html();
        currentMonth = tsa(".tsa-month").html();
        currentDay = tsa(".tsa-day").html();
        currentHour = tsa(this).attr('name');
        
        
        if (!(currentYear in tsaCalendarString)) {
			tsaCalendarString[currentYear] = {};
		}
		
		if (!(currentMonth in tsaCalendarString[currentYear])) {
			tsaCalendarString[currentYear][currentMonth] = {};
		}
        
        if (!(currentDay in tsaCalendarString[currentYear][currentMonth])) {
			tsaCalendarString[currentYear][currentMonth][currentDay] = {};
		}
		
		tsaCalendarString[currentYear][currentMonth][currentDay][currentHour] = tsa(this).attr('value');
        tsa("#tsaCalendarString").attr('value',JSON.stringify(tsaCalendarString));
        
        if(tsa(this).attr('value')=='Booked')
            tsa('ul.tsa-calendar-days li.' + tsa(this).attr('id')).addClass('booked');
        else
            tsa('ul.tsa-calendar-days li.' + tsa(this).attr('id')).removeClass('booked');
        
        
        
    })
    
    
    tsa(".delete-tsa-calendar").click(function () {
        if (confirm('Are you sure you want to delete this calendar?')) {
            return true;
        }
        return false;
    });
    
    

	
	var $container = tsa('#tsa-metabox');
	$container.find('p.submit input[type=button]').bind('click', function(event) {
		event.preventDefault();
		var attributes = '';
		$container.find('table.form-table td').find(':input').each(function() {
			var $this = tsa(this);
			
			var name = $this.attr('name');
			name = name.substring('tsaMetabox'.length + 1, name.length - 1);
			
			var value = tsa.trim($this.val().replace(/"/g, '{quot}').replace(/</g, '&lt;').replace(/>/g, '&gt;'));
			if (value != '' && value != 'default') {
				attributes += ' ' + name + '="' + value + '"';
			}
		});
		
		send_to_editor('[tsa' + attributes + '] ');
	});
	
            
    
})
