<?php
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    require_once 'classes/User.php';

    $username = $_POST['username'];
    $password = $_POST['password'];

    if (User::authenticate($username, $password)) {
        $_SESSION['username'] = $username;
        header('Location: index.php');
        exit();
    } else {
        $error = 'Invalid credentials';
    }
}
?>

<form method="post">
    <label>Username: </label>
    <input type="text" name="username" required>
    <br>
    <label>Password: </label>
    <input type="password" name="password" required>
    <br>
    <button type="submit">Login</button>
    <?php if (isset($error)) echo '<p>' . $error . '</p>'; ?>
</form>
