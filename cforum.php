<?php
session_start(); // Start session to read notification

$conn = new mysqli('localhost', 'root', '', 'women_safety');
if ($conn->connect_error) {
    die('Connection Failed: ' . $conn->connect_error);
} else {
    $query = "SELECT * FROM complaint_forum";
    $result = mysqli_query($conn, $query);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WOMEN SAFETY</title>
    <link rel='stylesheet' href='css/style.css'>
    <script src="jquery-3.5.1.min.js"></script>
    <style>
        .notification {
            background-color: #4CAF50;
            /* Green */
            color: white;
            padding: 15px;
            text-align: center;
            border-radius: 5px;
            position: fixed;
            top: 20px;
            width: 100%;
            z-index: 1000;
            display: none;
        }

        .close-btn {
            margin-left: 15px;
            color: white;
            font-size: 20px;
            font-weight: bold;
            cursor: pointer;
        }

        .close-btn:hover {
            color: #ddd;
        }

        .end {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
        }
    </style>
</head>

<body>

    <header>
        <nav class="navbar navbar-inverse">
            <div class="container">
                <div class="navbar-header">
                    <a href="" class="navbar-brand">
                        <img src="img/banner.png" class="logo" width="80px">
                    </a>
                </div>
                <ul class="nav navbar-nav navbar-right">
                    <li><a href='index.php'>Logout</a></li>
                    <li><a href='safetytips.php'>Safety Tips</a></li>
                    <li><a href='homepage.php'>Home</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <div class="forum">
        <h2 class="contain">Post your complaints</h2>
        <form action="complaint.php" method="post">
            <label class="nam">Name :<br><input type="text" name="name" required=""><br></label>
            <label class="mes">Message :<br><textarea id="mess" cols="50" rows="10" name="complaint" required=""></textarea></label><br>
            <button class="btn-login">Post</button>
        </form>
    </div>

    <?php if (isset($_SESSION['complaint_success'])): ?>
        <div class="notification" id="successNotification">
            <?php echo $_SESSION['complaint_success']; ?>
            <span class="close-btn" onclick="closeNotification()">×</span>
        </div>
        <?php unset($_SESSION['complaint_success']); ?>
    <?php endif; ?>

    <footer align='center' class="end">
        <font color="#3498db">
            <p>Emergency Contacts :</p>
            <p>AMBULANCE : 102</p>
            <p>POLICE : 100</p>
            <p>Press SOS button for HELP</p>
        </font>
    </footer>

    <script>
        // Show the success notification if it's set
        $(document).ready(function() {
            if ($('#successNotification').length) {
                $('#successNotification').fadeIn();
            }
        });

        // Function to close the notification
        function closeNotification() {
            $('#successNotification').fadeOut();
        }
    </script>

</body>

</html>