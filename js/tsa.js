/**
 * @package WP Time Slots Availability Calendar
 *
 * Copyright (c) 2012 Bryght
 */

var tsa = jQuery.noConflict();

tsa(document).ready(function(){
    tsa('.tsa-calendar-container').each(function(){
        var $instance = tsa(this);
        
        $instance.on('click','a.tsa-calendar-next',function(e){
            $instance.find('.tsa-ajax-loader').css('display','block');
            e.preventDefault();
            var data = {
        		action: 'changeDay',
        		direction: 'next',
                id: $instance.find('.tsa-calendarId').html(),
                timestamp: $instance.find('.tsa-timestamp').html(),
                view: $instance.find('.tsa-view').html(),
                title: $instance.find('.tsa-title').html(),
                legend: $instance.find('.tsa-legend').html(),
                dropdown: $instance.find('.tsa-dropdown').html()
        	};
        	tsa.post(ajaxurl, data, function(response) {
        		$instance.html(response);
                $instance.find('.tsa-ajax-loader').css('display','none');
        	});
        });
        
        $instance.on('click','a.tsa-calendar-prev',function(e){
            $instance.find('.tsa-ajax-loader').css('display','block');
            e.preventDefault();
            var data = {
        		action: 'changeDay',
        		direction: 'prev',
                id: $instance.find('.tsa-calendarId').html(),
                timestamp: $instance.find('.tsa-timestamp').html(),
                view: $instance.find('.tsa-view').html(),
                title: $instance.find('.tsa-title').html()   ,
                legend: $instance.find('.tsa-legend').html(),
                dropdown: $instance.find('.tsa-dropdown').html()        
        	};
        	tsa.post(ajaxurl, data, function(response) {
        		$instance.html(response);
                $instance.find('.tsa-ajax-loader').css('display','none');
                
        	});
        });
        
        
        $instance.on('change','select.tsa-dropdown-select',function(e){
            $instance.find('.tsa-ajax-loader').css('display','block');
            var data = {
        		action: 'changeDay',
        		direction: 'dropdown',
                id: $instance.find('.tsa-calendarId').html(),
                timestamp: $instance.find('select.tsa-dropdown-select option:selected').attr('value'),
                view: $instance.find('.tsa-view').html(),
                title: $instance.find('.tsa-title').html()   ,
                legend: $instance.find('.tsa-legend').html(),
                dropdown: $instance.find('.tsa-dropdown').html()        
        	};
        	tsa.post(ajaxurl, data, function(response) {
        		$instance.html(response);
                $instance.find('.tsa-ajax-loader').css('display','none');
                
        	});
            
        });
        
    })
    
    
    
    
    
   
    
})
