/* VARIABLES -------------------------------------------------------------------------- */
	var ua = navigator.userAgent, 
		INS_event = ( ua.match( /iPad/i ) )? "touchstart" : "click",
		INS_eventEnd = ( ua.match( /iPad/i ) )? "touchend" : "click",
		DEVONA_content = document.getElementById('content'),
		INS_touts = document.querySelectorAll('aside p'),
		form_select = document.getElementById('insurance_type');

/* FUNCTIONS -------------------------------------------------------------------------- */

	function INS_rotate_touts(){
		var active_tout,
			total_touts = INS_touts.length;
		
		//get the active tout
		INS_touts.forEach(function (tout,index) {
			if(tout.classList.contains('active')){
				active_tout = index;
			}
		});
		
		//remove active
		INS_touts[active_tout].className= '';
		
		//increment active
		active_tout = (active_tout == (total_touts-1))?0:active_tout+1;
		
		//apply new active
		INS_touts[active_tout].className= 'active';
	}
	
	//did the user select home insurance
	function INS_add_ownershipClass(){
		var select_value = form_select.options[form_select.selectedIndex].value;
		if(select_value == 'home'){
		   document.body.classList.add('home_insurance');
		}else{
			document.body.classList.remove('home_insurance');
		}
	}

/* BIND ------------------------------------------------------------------------------- */

setInterval(INS_rotate_touts, 7*1000);
form_select.addEventListener("change", INS_add_ownershipClass);