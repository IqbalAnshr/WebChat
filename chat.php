<?php
$title = "Chat";
$css_link = "./css/chat.css";
session_start();

require_once __DIR__ . '/header.php';

if (!isset($_SESSION['id'])) {
    header("Location: login.php");
}
?>

<body>
    <main>
        <div class="container">
            <?php
            require_once __DIR__ . '/php/config.php';
            $user_id = $_GET['id'];
            $query = "SELECT * FROM users WHERE id = " . $user_id;
            $result = mysqli_query($conn, $query);

            if (mysqli_num_rows($result) > 0) {
                $user = mysqli_fetch_assoc($result);
            }
            ?>
            <header class="header">
                <a href="index.php"><i class="fa-solid fa-arrow-left"></i></a>
                <img src="<?php echo $user['photo_profile']; ?>" alt="photo-profile-user">
                <div class="user-info">
                    <h2>
                        <?php echo $user['username']; ?>
                    </h2>
                    <p>
                        <?php echo $user['status']; ?>
                    </p>
                </div>

            </header>
            <section class="chat-box">
            </section>
            <form class="input-message" method="POST">
                <input type="hidden" name="outgoing_id" value="<?php echo $_SESSION['id']; ?>">
                <input type="hidden" name="incoming_id" id="incoming_id" value="<?php echo $user_id; ?>">
                <input type="text" name="message" id="message" placeholder="Type a message...">
                <button class="send-btn"><i class="fa-solid fa-paper-plane"></i></button>
            </form>
        </div>
    </main>
    <script src="./javascript/chat.js"></script>
</body>

</html>