/**
 * filename: main.js
 * description: Executes the 
 */
$(document).ready(function(){
	$.ajax({
		url: "/ErrorCatcher/notify.php",
		type: "POST"
	});
});