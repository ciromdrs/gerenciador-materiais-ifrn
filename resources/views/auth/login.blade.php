<!DOCTYPE html>
<html>

<head>
	<title>Login </title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

	<link rel="stylesheet" href="{{asset('/login/css/login.css')}}">
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" integrity="sha384-gfdkjb5BdAXd+lj+gudLWI+BXq4IuLW5IT+brZEZsLFm++aCMlF1V92rMkPaX4PP" crossorigin="anonymous">
</head>

<!--Coded with love by Mutiullah Samim-->


<body>
	<div class="container h-100">
		<div class="d-flex justify-content-center h-100">
			<div class="user_card">
				<div class="d-flex justify-content-center">
					<div class="brand_logo_container">
						<img src="{{asset('/login/img/Sloganifrnlogin.jpg')}}" class="brand_logo" alt="Logo" >
					</div>
				</div>
				<div class="d-flex justify-content-center form_container ">
					<form method="POST" action="{{url('logar')}}">
						@csrf
						<div class="input-group mb-3">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
							<input type="number" name="matricula" required class="form-control input_user" placeholder="Matrícula">
						</div>
						<div class="pt-3"></div>
						<div class="input-group mb-2">
							<div class="input-group-append">
								<span class="input-group-text"><i class="fas fa-key"></i></span>
							</div>
							<input type="password" name="senha" required class="form-control input_pass" style="width: 220px;" placeholder="Senha">
						</div>
						<div class="form-group">

						</div>
							<div class="d-flex justify-content-center mt-3 login_container pt-4">
				 		<button class="btn login_btn">Login</button>
					</div>

					<div class="row">
						<div class="col mt-4 d-flex align-items-center justify-content-center">
							@error('email')
							<span class="badge bg-warning">{{$message}}</span>
							@enderror
						</div>
					</div>

					</form>
				</div>

				<div class="mt-4">
					<div class="d-flex justify-content-center links">
						Não tem uma conta? <a href="/register" class="ml-2">Cadastra-se</a>
					</div>
					<div class="d-flex justify-content-center links ">
						<a href="/inproduction">Esqueceu sua senha?</a>
					</div>
				</div>
			</div>
		</div>
	</div>

</body>

</html>