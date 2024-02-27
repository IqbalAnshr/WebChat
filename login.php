<?php
$title = "Login";
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
      <h1>Login</h1>
      <form id="form" method="POST">
        <div class="form-control">
          <label for="email">Email</label>
          <div class="input-icon-wrapper">
            <input type="email" id="email" name="email" placeholder="Enter email" required /><i
              class="fa-solid fa-envelope"></i>
          </div>
        </div>
        <div class="form-control">
          <label for="password">Password</label>
          <div class="input-icon-wrapper">
            <input type="password" id="password2" name="password" placeholder="Enter password" required /><i
              class="fa-solid fa-eye pointer"></i>
          </div>
        </div>
        <div class="error">
        </div>
        <button type="submit" class="btn">Login</button>
      </form>
      <p>Don't have an account? <a href="index.php">Register</a></p>
    </div>
  </main>
  <script src="./javascript/pass-show.js"></script>
  <script src="./javascript/login.js"></script>
</body>

</html>