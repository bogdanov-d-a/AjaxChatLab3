<?php
	session_start();
?>

<html>
<head>

<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script src="app.js"></script>

</head>
<body>

<table>
	<tr><td>
		<table><tr>
			<td>
				<input type="text" id="username">
				<input type="password" id="password">
				<button type="button" id="log_in">Log in</button> 
			</td>
			<td>
				<div id="login_status">Not logged in</div>
			</td>
			<td>
				<button type="button" id="log_out">Log out</button> 
			</td>
		</tr></table>
	</td></tr>
	<tr><td>
		<table>
			<tr><td>
				<div id="message_log"></div>
			</td></tr>
			<tr><td>
				<input type="text" id="message">
				<button type="button" id="send">Send</button> 
			</td></tr>
		</table>
	</td></tr>
</table>

</body>
</html>
