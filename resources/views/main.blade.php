<!DOCTYPE html>
<html>
<head>
	<script src="js/jquery.js"></script>
	<title>Main Page</title>
	<meta charset="utf-8">
</head>

<body>
	<div class="container">
		@cannot('login-user')
		<div class="login">
			<p>Авторизуйтесь или зарегистрирутесь,чтобы просматривать все записи</p>
			<a href="/login">Авторизация</a>
			<a href="/registration">Регистрация</a>
		</div>
		@endcannot

        @can ('login-user')
        <div class="personal_account" style="margin-left: 50%;width:30%;position:absolute;">
        	<p>Ваше имя: {!!$current_user->username!!}</p>
        	<p>Ваш id: {!!$current_user->id!!}</p>
        	<p>Ваш лого: <img src="{{asset('/storage/'.$current_user->logo)}}"></p>
         	<form method="POST" action='/change_my_logo' enctype="multipart/form-data">
         		@csrf
         		<input type="file" name="logo">
         		<button type="submit">Изменить мое лого</button>
         	</form>
        	<form method="POST" action='/logout'>
        	@csrf
        	<button type='submit'>Выйти из аккаунта</button>
        	</form>

        	@can ('login-user-is-admin')
        	<button class="open_admin_panel">Открыть Админ-Панель</button>
        	@endcan
        </div>
        @can ('login-user-is-admin')
        <div class="admin_container"style="display:none;">
            <div class="admin_panel" style="position:absolute;margin-top:66%;margin-left: 50%;">
        	<H3>Админ Панель</H3>
        	<div class="users">
            <H4>Пользователи:</H4>
        	@foreach($users as $user)
        	<div class="user" style="border:3px solid black;">
        		<p>Имя: {!!$user['username']!!}</p>
        		<p>id: {!!$user['id']!!}</p>
        		<p>Лого: <img src="{{asset('/storage/'.$user['logo'])}}"></p>
        		<form method="POST" action="/change_logo" enctype="multipart/form-data">
        			<h3>Изменить лого пользователя</h3>
        			@csrf
        			<input type="hidden" name="id" value = "{!!$user['id']!!}"required>
        			<input type="file" name="logo" required>
        			<button type="submit">Изменить лого</button>
        		</form>
        	</div>
        	@endforeach	
        </div>       	
        </div>
    </div>

        @endcan
        <form method="POST" action='/create_post' style="margin-top: 4%;display:flex;flex-direction: column;width:30%">
        	@csrf
        	<input type="text" name="title" required placeholder='Введите название'>
        	<textarea type="text" name="text" required placeholder='Введите текст статьи'></textarea>
        	<div style="display:flex">
        		Видеть всем?
        		<select name="visibility" required>
        			<option value="1">Да</option>
        			<option value="0">Нет</option>
        		</select>
        	</div>
        	<button class="create_post">Создать пост</button>
        </form>

        @endcan
		<div class="all_posts" style="position: absolute;">
			@foreach ($posts as $post)
			     <div class="post">
			     	<p class="title">{!!$post["title"]!!}</p>
			     	<p class="text">{!!$post["text"]!!}</p>
			     	@can ('login-user')
			     	@if($post['author']==$current_user->id || Gate::allows('login-user-is-admin'))
                    <form method="POST"action="/edit_post">
                        @csrf
                        <input type="hidden" name="id" value='{!!$post["id"]!!}' required>
                        <div style="display: flex;">
                            <p>Изменить заголовок</p>
                            <input type="text" name="title" value='{!!$post["title"]!!}' required>
                        </div>
                        <div style="display: flex;">
                            <p>Изменить текст</p>
                            <input type="text" name="text" value='{!!$post["text"]!!}' required>
                        </div>
                        <button type="submit">Изменить пост</button>
                    </form>
			     	<form method="POST"action="/change_visibility">
			     		@csrf
			     		<input type="hidden" name="visibility" value='{!!$post["visibility"]!!}'>
			     		<input type="hidden" name="id" value='{!!$post["id"]!!}'>
			     		<button type="submit">Менять видимость</button>
			     	</form>
			     	<form method="POST"action="/delete_post">
			     		@csrf
			     		<input type="hidden" name="id" value='{!!$post["id"]!!}' required>
			     		<button type="submit">Удалить пост</button>
			     	</form>
			     	@endif 
			     	@endcan
			     </div>
			@endforeach
		</div>

</body>
<script type="text/javascript">
	$(".open_admin_panel").on("click",function(){
		$(".admin_container").attr("style","");
	})
</script>
</html>

