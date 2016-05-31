(function(){

$(document).ready(function(){
	$.ajax({
		url: 'ajax.php?command=loggedin',
		success: function(responseStr) {
			var response = JSON.parse(responseStr);
			if (response['username'] != '')
				document.getElementById("login_status").innerHTML = "Logged in as " + response['username'];
		}
	});
});

})();
