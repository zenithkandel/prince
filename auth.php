<?php
session_start();

$password = 'admin'; // Hardcoded simple auth

if (isset($_POST['login'])) {
    if ($_POST['password'] === $password) {
        $_SESSION['admin_logged_in'] = true;
        header("Location: admin.php");
        exit;
    } else {
        $login_error = "Invalid password!";
    }
}

if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

function require_login()
{
    if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
        global $login_error;
        ?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <title>Admin Login</title>
            <script src="https://cdn.tailwindcss.com"></script>
        </head>

        <body class="bg-gray-100 flex items-center justify-center h-screen font-sans">
            <div class="bg-white p-8 border-[6px] border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] w-96 transform -rotate-1">
                <h2 class="text-3xl font-black mb-6 text-center uppercase">Admin Login</h2>
                <?php if (isset($login_error))
                    echo "<p class='text-white bg-red-500 font-bold p-2 mb-4 border-2 border-black'>$login_error</p>"; ?>
                <form method="POST" action="admin.php">
                    <input type="password" name="password" placeholder="PASSWORD"
                        class="w-full border-4 border-black p-3 mb-6 shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] focus:outline-none focus:bg-yellow-50 font-bold text-center tracking-widest"
                        required>
                    <button type="submit" name="login"
                        class="w-full bg-[#ff00ff] text-white p-4 font-black text-xl border-4 border-black shadow-[4px_4px_0px_0px_rgba(0,0,0,1)] hover:-translate-y-1 hover:shadow-[6px_6px_0px_0px_rgba(0,0,0,1)] transition-all uppercase">ENTER</button>
                </form>
            </div>
        </body>

        </html>
        <?php
        exit;
    }
}
?>