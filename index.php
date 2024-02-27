<?php
$title = "Register";
$css_link = "./css/register.css";

require_once __DIR__ . '/header.php';
session_start();

if (isset($_SESSION['id'])) {
  header("Location: dashboard.php");
}
?>

<body>
  <main>
    <div class="container">
      <h1>Make an account</h1>
      <form id="form" enctype="multipart/form-data" method="POST">
        <div class="form-control">
          <label for="username">Username</label>
          <div class="input-icon-wrapper">
            <input type="text" id="username" name="username" placeholder="Enter username" /><i
              class="fa-solid fa-user"></i>
          </div>
        </div>
        <div class="form-control">
          <label for="email">Email</label>
          <div class="input-icon-wrapper">
            <input type="email" id="email" name="email" placeholder="Enter email" /><i class="fa-solid fa-envelope"></i>
          </div>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <div class="input-icon-wrapper">
            <input type="password" id="password" name="password" placeholder="Enter password" /><i
              class="fa-solid fa-lock"></i>
          </div>
        </div>
        <div class="form-control">
          <label for="password2">Confirm Password</label>
          <div class="input-icon-wrapper">
            <input type="password" id="password2" name="password2" placeholder="Enter password again" /><i
              class="fa-solid fa-eye pointer"></i>
          </div>
        </div>
        <div class="form-control">
          <label for="photo-profile">Photo Profile</label>
          <div class="input-icon-wrapper">
            <input type="file" id="photo-profile" name="photo-profile" />
          </div>
        </div>
        <div class="error">
        </div>
        <button type="submit" class="btn">Register</button>
      </form>
      <p>Already have an account? <a href="login.php">Login</a></p>
    </div>
  </main>
  <script src="./javascript/pass-show.js"></script>
  <script src="./javascript/register.js"></script>
</body>

</html>