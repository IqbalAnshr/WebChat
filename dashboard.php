<?php
$title = "Dashboard";
$css_link = "./css/dashboard.css";
session_start();

require_once __DIR__ . '/header.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>

<body>
    <main>
        <div class="container">
            <header class="header">
                <?php
                require_once __DIR__ . '/php/config.php';
                $query = "SELECT * FROM users WHERE id = " . $_SESSION['id'];
                $result = mysqli_query($conn, $query);

                if (mysqli_num_rows($result) > 0) {
                    $user = mysqli_fetch_assoc($result);
                }
                ?>
                <img src="<?php echo $user['photo_profile']; ?>" alt="photo-profile-user">
                <h2>
                    <?php echo $user['username']; ?>
                </h2>
                <a href="./php/logout.php?logout_id=<?php echo $_SESSION['id']; ?>"><i
                        class="fa-solid fa-right-from-bracket"></i></a>
            </header>
            <div class="search">
                <form action="#" method="get" class="search-form">
                    <input type="search" name="search" id="search" placeholder="Search username">
                    <button type="submit" class="search-btn"><i class="fa-solid fa-magnifying-glass"></i></button>
                </form>
            </div>
            <div class="user-list"></div>
        </div>
    </main>
    <script src="./javascript/users.js"></script>
</body>

</html>


<!-- <div class="user">
                    <div class="user-wrapper">
                        <img src="https://o-cdn-cas.sirclocdn.com/parenting/images/317644742_674759567540812_5927132.width-800.format-webp.webp"
                            alt="user">
                        <div class="user-info">
                            <p class="name">Iqbal Ganteng</p>
                            <p class="message">Lorem ipsum</p>
                        </div>

                    </div>
                    <p class="status">Active</p>
                </div> -->