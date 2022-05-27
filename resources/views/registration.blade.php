<!DOCTYPE html>
<html>
<head>
	<script src="js/jquery.js"></script>
	<title>Login Page</title>
	<meta charset="utf-8">
</head>

<body>
	<div class="container">
		<p>Зарегистрируйтесь</p>
		<form method="POST" enctype="multipart/form-data" action="#">
			@csrf
			<input type="text" name="username"required placeholder="Введите имя пользователя">
			<input type="password" name="password" required placeholder="Введите пароль">
			<select class="verification_approach_select" name="verificationType" required>
				<option value="emailVerification">По Email</option>
				<option value="phoneVerification">По Номеру телефона</option>
			</select>
			<div class='verification_container'>
				<input type="email" name="contact_info" required class="emailVerification current-approach"placeholder="Введите свой email">	
			</div>
			<input type="file" name="logo" required>
			<button type='submit'>Зарегистрироваться</button>
		</form>
		<p>Или авторизуйтесь,если имеете аккаунт</p>
		<a href="/login">Авторизация</a>
</body>
<script type="text/javascript">
	const verification_types_blocks={
		'emailVerification':'<input type="email" name="contact_info" required class="emailVerification current-approach" placeholder="Введите свой email">',
		'phoneVerification':'<input type="tel" name="contact_info" required class="telVerification current-approach" placeholder="Введите свой номер телефона">',
	}
	$('.verification_approach_select').on('change',function(){
		$('.current-approach').remove();
		$('.verification_container').append(verification_types_blocks[$(this).val()]);
	})
</script>