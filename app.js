(function(){

$(document).ready(function(){
	$.ajax({
		url: 'ajax.php?command=loggedin',
		dataType: 'json',
		success: function(response) {
			if (response['username'] != '')
				document.getElementById("login_status").innerHTML = "Logged in as " + response['username'];
		}
	});

	document.getElementById("log_in").onclick = function(){
		$.ajax({
			url: 'ajax.php?command=login',
			type: 'POST',
			data: {
				username: document.getElementById('username').value,
				password: document.getElementById('password').value
			},
			dataType: 'json',
			success: function(response) {
				if (response['error'] != '')
					alert(response['error']);
			}
		});
	};

	document.getElementById("log_out").onclick = function(){
		$.ajax({
			url: 'ajax.php?command=logout',
			dataType: 'json',
			success: function(response) {
				if (response['error'] != '')
					alert(response['error']);
			}
		});
	};
});

})();
