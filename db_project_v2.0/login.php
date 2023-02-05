<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/login.css" />
  <title>login or create account</title>
</head>

<body>
  <img src="./logo/strawberry_login.png">
  <div class="container" id="container">

    <!-- Create Account -->
    <div style=overflow:scroll class="form-container sign-up-container">
      <br>
      <h1>&nbsp; &nbsp; &nbsp; Create Account</h1>
      <br> <br>
      <form action="register_logic.php" , method="post" enctype="multipart/form-data">
        <input type="text" name="account" placeholder="account" required />
        <input type="password" name="password" placeholder="password" required />
        <input type="password" name="password_confirm" placeholder="password confirm" required />
        <input type="text" name="name" placeholder="name" required />
        <input type="text" name="nickname" placeholder="nickname" required />
        <input type="email" name="email" placeholder="email" required>
        <input type="text" name="sex" placeholder="sex" required>
        <input type="number" name="phonenumber" placeholder="phonenumber" required>
        <input type="text" name="birthday" placeholder="birthday" required>
        <br>
        <button>Sign Up</button>
      </form>
      <br> <br> <br>
    </div>

    <!-- login -->
    <div class="form-container sign-in-container">
      <form action="login_logic.php", method="post">
        <h1>Sign in</h1>
        <input type="text" name="account" placeholder="account" required/>
        <input type="password" name="password" placeholder="password" required/>
        <a href="#">Forgot your password?</a>
        <button>Sign In</button on>
      </form>
    </div>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h1>Welcome Back!</h1>
          <p>
            To keep connected with us please login with your personal info
          </p>
          <button class="ghost" id="signIn">Sign In</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h1>Hello, <br> Strawberry Market!</h1>
          <p>Enter your personal details and start the Strawberry Market</p>
          <button class="ghost" id="signUp">Sign Up</button>
        </div>
      </div>
    </div>
  </div>

  <!-- Scripts -->
  <script src="./js/login.js"></script>
</body>

</html>