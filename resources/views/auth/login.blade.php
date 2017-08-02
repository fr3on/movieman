<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>MovieMan - Auth</title>
    <link rel="stylesheet" href="<?php echo asset('public/assets/css/admin.css')?>">
</head>
<body>
    <div class="login--box">
        <div class="login--boxHead">
            <h1 class="title text--uppercase">Admin Login</h1>
        </div>

        <div class="login--boxBody">
            <div class="row">
                <form method="POST" action="{{ route('admin.login.post') }}">
                  {!! csrf_field() !!}
                  <div class="grid--12">
                      <label for="username" class="text--uppercase">Username</label>
                      <input type="text" name="username" class="input input--large input--fluid" id="username" />
                  </div>

                  <div class="grid--12">
                      <label for="password" class="text--uppercase">Password</label>
                      <input type="password" name="password" class="input input--large input--fluid" id="password" />
                  </div>

                  <div class="grid--4 center">
                      <button type="submit" class="button button--primary button--large button--fluid button--radius text--uppercase">Login</button>
                  </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>