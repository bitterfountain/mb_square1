<!doctype html>

<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Ejercicio Square1">
    <meta name="author" content="Antonio Sanchez">
    <title>MicroBlog</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">

    <!-- Favicons -->



<!-- Custom styles for this template -->
<link href="signin.css" rel="stylesheet">
</head>
<body class="text-center">

    <form class="form-signin" >

        <h1 class="h3 mb-3 font-weight-normal">Register in our Blog</h1>
        
        <label for="inputEmail" class="sr-only">Name </label>
        <input type="text" id="inputName" class="form-control" placeholder="Yor name" required autofocus>
        
        <label for="inputEmail" class="sr-only">Email address</label>
        <input type="email" id="inputEmail" class="form-control" placeholder="Email address" required>
        
        <label for="inputPassword" class="sr-only">Password</label>
        <input type="password" id="inputPassword" class="form-control" placeholder="Password" required>

        <label for="inputPassword" class="sr-only">Password Repeat</label>
        <input type="password" id="inputPassword_confirmation" class="form-control" placeholder="Password Repeat" required>

        <button class="btn btn-lg btn-primary btn-block" type="submit">Register</button>        
    </form>
</body>
</html>



