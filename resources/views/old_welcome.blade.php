<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bulma@0.9.0/css/bulma.min.css">
  </head>
  <body>
		<section class="hero is-link is-bold" >
	    <div class="hero-body">
	      <div class="container">
	        <h1 class="title">Logar com SUAP</h1>
	      </div>
	    </div>
	  </section>
  	<section class="section">
		  <div class="container">
	  		<div class="is-anonymous content">
				<h2>Você não está autenticado</h2>	
				<a class="button is-success is-large" href="{{ config('suap.uri_login') }}">Login com SUAP</a>
		  	</div>
		  </div>
	  </section>
  </body>
</html>
