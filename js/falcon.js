Action = {
	toggleLight : function(light, state, cb){
		$.ajax({
			  url: "/falcon/api/controller.php?op=LightToggle",
			  data: {
			    id: light,
			    action: state
			  },
			  success: function( result ) {
			    if(cb != null){
			    	cb(result);
			    }
			  }
		});
	},
	restartVoice : function(cb){
		$.ajax({
			  url: "/falcon/api/controller.php?op=VoiceState",
			  data: {},
			  success: function( result ) {
			    if(cb != null){
			    	cb(result);
			    }
			  }
		});
	},
	updateConsoleImage : function(light,state){
		
		var c_state = (light == '3') ? state : $('#C').data('state');
		var lu_state = (light == '2') ? state: $('#LU').data('state');
		var ru_state = (light == '1') ? state: $('#RU').data('state');
		
		if( ru_state == 'off' && lu_state == 'off' && c_state == 'off'){
			$('#console').attr("src",'/falcon/image/ALL_OFF.png');
		}else if( ru_state == 'on' && lu_state == 'on' && c_state == 'on'){
			$('#console').attr("src",'/falcon/image/ALL_ON.png');
		}else if( ru_state == 'on' && lu_state == 'on'){
			$('#console').attr("src",'/falcon/image/C_OFF.png');
		}else if( ru_state == 'on' && c_state == 'on'){
			$('#console').attr("src",'/falcon/image/LU_OFF.png');
		}else if( lu_state == 'on' && c_state == 'on'){
			$('#console').attr("src",'/falcon/image/RU_OFF.png');
		}else if( lu_state == 'on'){
			$('#console').attr("src",'/falcon/image/LU_ON.png');
		}else if( c_state == 'on'){
			$('#console').attr("src",'/falcon/image/C_ON.png');
		}else if( ru_state == 'on'){
			$('#console').attr("src",'/falcon/image/RU_ON.png');
		}
	}
}

$(document).ready(function() {
	$( ".light-button" ).on( "click", function( event ) {
		event.preventDefault();
		
		var light = $(this).data('t-light-id');
		var state = $(this).data('action');
		
		$('.light-button[data-t-light-id="'+light+'"]').removeClass('button-clicked');
		$(this).addClass('button-clicked');

		$('.location[data-light-id="'+light+'"]').data('state',state);
		
		Action.toggleLight( light, state );
		Action.updateConsoleImage( light, state );
	});
	
	$( ".all-button" ).on( "click", function( event ) {
		event.preventDefault();
		
		var light = $(this).data('t-light-id');
		var state = $(this).data('action');
		
		if( state == 'on'){
			$('.light-button[data-action="on"]').addClass('button-clicked');
			$('.light-button[data-action="off"]').removeClass('button-clicked');
		}else{
			$('.light-button[data-action="off"]').addClass('button-clicked');
			$('.light-button[data-action="on"]').removeClass('button-clicked');
		}
		
		Action.toggleLight( light, state );
	});
	
	$( ".voice-button" ).on( "click", function( event ) {
		event.preventDefault();
		Action.restartVoice();
	});

	
	$( ".location" ).on( "click", function( event ) {
		event.preventDefault();
		
		var state = $(this).data('state') == 'on' ? 'off' : 'on';
		var light = $(this).data('light-id');
		
		$(this).data('state',state);
		
		$('.light-button[data-t-light-id="'+light+'"]').removeClass('button-clicked');
		$('.light-button[data-t-light-id="'+light+'"][data-action="'+state+'"]').addClass('button-clicked');

		Action.toggleLight( light, state );
		Action.updateConsoleImage( light, state );
	});
	
	$('#PANEL').on( "click", function( event ) {
		event.preventDefault();
		$('#control-panel-buttons').toggle();
	});
})

