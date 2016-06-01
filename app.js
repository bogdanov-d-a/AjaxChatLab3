(function(){

lastMessageId = 0;

function updateLoggedInState()
{
	$.ajax({
		url: 'ajax.php?command=loggedin',
		dataType: 'json',
		success: function(response) {
			if (response['username'] != '')
				document.getElementById("login_status").innerHTML = "Logged in as " + response['username'];
			else
				document.getElementById("login_status").innerHTML = "Not logged in";
		}
	});
}

function pullMessages()
{
	$.ajax({
		url: 'ajax.php?command=pullmsglog',
		type: 'POST',
		data: {
			lastId: lastMessageId,
		},
		dataType: 'json',
		success: function(response) {
			if (response['error'] == '')
			{
				result = response['result'];
				lastMessageId = result['lastId'];
				result['log'].forEach(function(element, index, array) {
					document.getElementById("message_log").innerHTML += element['sender'] + ": " + element['text'] + "<br>";
				});
			}
		}
	});
}

$(document).ready(function(){
	updateLoggedInState();

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
				updateLoggedInState();
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
				updateLoggedInState();
			}
		});
	};

	document.getElementById("send").onclick = function(){
		$.ajax({
			url: 'ajax.php?command=sendmsg',
			type: 'POST',
			data: {
				text: document.getElementById('message').value,
			},
			dataType: 'json',
			success: function(response) {
				document.getElementById('message').value = "";
				if (response['error'] != '')
					alert(response['error']);
				pullMessages();
			}
		});
	}
});

})();
