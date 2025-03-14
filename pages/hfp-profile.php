<?php 
require "../config/config.php";
$userID = $_SESSION['userID'];
$error = "";
$success = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['action']) && $_POST['action'] == 'change_password') {
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];
    $confirm_password = $_POST['confirm_password'];

    $stmt = $conn->prepare("SELECT password FROM users WHERE userID = ?");
    $stmt->bind_param("i", $userID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($row_pwd = $result->fetch_assoc()) {
        $hashed_password = $row_pwd['password'];
        if (password_verify($current_password, $hashed_password)) {
            if ($new_password === $confirm_password) {
                $new_hashed = password_hash($new_password, PASSWORD_DEFAULT);
                $update_stmt = $conn->prepare("UPDATE users SET password = ? WHERE userID = ?");
                $update_stmt->bind_param("si", $new_hashed, $userID);
                if ($update_stmt->execute()) {
                    $success = "Password updated successfully!";
                } else {
                    $error = "Failed to update password.";
                }
                $update_stmt->close();
            } else {
                $error = "New passwords do not match.";
            }
        } else {
            $error = "Current password is incorrect.";
        }
    } else {
        $error = "User not found.";
    }
    $stmt->close();
} else if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $emailAddress = $_POST['email'];
    $mobileNumber = $_POST['mobileNumber'];

    $sql = "UPDATE users SET firstName = ?, lastName = ?, emailAddress = ?, mobileNumber = ? WHERE userID = ?";
    $stmt = mysqli_prepare($conn, $sql);
    if ($stmt) {
        mysqli_stmt_bind_param($stmt, "ssssi", $firstName, $lastName, $emailAddress, $mobileNumber, $userID);

        if (mysqli_stmt_execute($stmt)) {
            $success = "Profile updated successfully!";
        } else {
            $error = "Error updating record: " . mysqli_stmt_error($stmt);
        }
    }

}

$sql = "SELECT * FROM users WHERE userID = '$userID'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Profile | Holy Family Parish</title>
    <link href="../styling/styling-profile.css" rel="stylesheet" type="text/css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Figtree:wght@300..900&family=Oranienbaum&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar">
        <ul class="list">
            <li><a href="hfp-dashboard.php"><i class="fa-solid fa-house"></i> Dashboard</a></li>
            <li><a href="../pages/hfp-reservation.php"><i class="fa-solid fa-calendar-days"></i> Reservation</a></li>
            <li><a href="../markdown-blog"><i class="fa-solid fa-newspaper"></i> Newsletter</a></li>
           
            <li><a href="hfp-landing.php" onclick="return confirmLogout('Are you sure you want to logout?');"> <i class="fa-solid fa-door-open"></i> Exit</a></li>
            </ul>
    </nav>
    <br><br>
    <div class="container">
        <?php if ($error) {
            echo "<p class='error'>$error</p>";
        }
        $error = "";
        ?>
        <?php if ($success) { echo "<p class='success'>$success</p>"; }
        $success = "";
        ?>
        <h3>My Profile</h3>
        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="firstName">First name</label>
                    <input type="text" class="form-control" id="firstName" name="firstName" value="<?php echo $row['firstName'];?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="lastName">Last name</label>
                    <input type="text" class="form-control" id="lastName" name="lastName" value="<?php echo $row['lastName'];?>" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">Email address</label>
                    <input type="email" class="form-control" id="email" name="email" value="<?php echo $row['emailAddress'];?>" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="mobileNumber">Mobile number:</label>
                    <input type="text" class="form-control" id="mobileNumber" name="mobileNumber" value="<?php echo $row['mobileNumber'];?>" required>
                </div>
            </div>
            <div class="mb-3">
                <label>Password</label>
                <!-- Button triggers the password change modal -->
                <button type="button" class="btn btn-primary" id="changePasswordBtn">Change Password</button>
            </div>
            <!-- Other profile fields and update button here -->
            <input type="hidden" name="form_type" value="register">
            <input type="submit" class="btn btn-success" value="Update Profile">
        </form>
    </div>

    <!-- Modal for Changing Password -->
    <div id="passwordModal" class="modal">
        <div class="modal-content">
            <span class="modal-close" id="closeModal">&times;</span>
            <h2>Change Password</h2>
            <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>" method="post">
                <!-- Hidden input to indicate this is a password change request -->
                <input type="hidden" name="action" value="change_password">
                <label for="current_password">Current Password:</label>
                <input type="password" name="current_password" required>
                <label for="new_password">New Password:</label>
                <input type="password" name="new_password" required>
                <label for="confirm_password">Confirm New Password:</label>
                <input type="password" name="confirm_password" required>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>

    <script>
        // Show the password change modal
        var modal = document.getElementById("passwordModal");
        var btn = document.getElementById("changePasswordBtn");
        var closeBtn = document.getElementById("closeModal");

        btn.onclick = function() {
            modal.style.display = "block";
        }
        closeBtn.onclick = function() {
            modal.style.display = "none";
        }
        window.onclick = function(event) {
            if (event.target == modal) {
                modal.style.display = "none";
            }
        }

        function confirmLogout(message) {
                return confirm(message);
            }
    </script>
</body>
</html>
