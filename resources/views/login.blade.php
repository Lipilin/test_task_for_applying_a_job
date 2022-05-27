<!DOCTYPE html>
<html>
<head>
	<script src="js/jquery.js"></script>
	<title>Login Page</title>
	<meta charset="utf-8">
</head>

<body>
	<div class="container">
		<p>Авторизуйтесь</p>
		<form method="POST" action="#">
			@csrf
			<input type="text" name="username"required>
			<input type="password" name="password" required>
			<button type='submit'>Авторизоваться</button>
		</form>

		<p>Или зарегистрируйтесь</p>
		<a href="/registration">Регистрация</a>
</body>
</html>
