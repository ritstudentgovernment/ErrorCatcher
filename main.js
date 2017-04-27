/**
 * filename: main.js
 * description: Executes the 
 */
$(document).ready(function(){
	$.ajax({
		url: "/notify.php",
		type: "POST"
	});
});