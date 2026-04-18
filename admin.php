<?php
session_start();

$password = 'admin'; // Basic auth
$json_file = 'data.json';

// Handle login
if (isset($_POST['login'])) {
    if ($_POST['password'] === $password) {
        $_SESSION['admin_logged_in'] = true;
    } else {
        $error = "Invalid password!";
    }
}

// Handle logout
if (isset($_GET['logout'])) {
    session_destroy();
    header("Location: admin.php");
    exit;
}

if (!isset($_SESSION['admin_logged_in'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <title>Admin Login - Prince Neupane</title>
        <script src="https://cdn.tailwindcss.com"></script>
    </head>

    <body class="bg-gray-100 flex items-center justify-center h-screen">
        <div class="bg-white p-8 rounded shadow-md w-96">
            <h2 class="text-2xl font-bold mb-6 text-center">Admin Access</h2>
            <?php if (isset($error))
                echo "<p class='text-red-500 mb-4'>$error</p>"; ?>
            <form method="POST">
                <input type="password" name="password" placeholder="Password" class="w-full border p-2 rounded mb-4"
                    required>
                <button type="submit" name="login"
                    class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">Login</button>
            </form>
        </div>
    </body>

    </html>
    <?php
    exit;
}

// Handle Save
if (isset($_POST['save_data'])) {
    $data = json_decode(file_get_contents($json_file), true);

    // Very simple bulk update logic for strings (in a real app, bind fields deeply)
    if (isset($_POST['json_dump'])) {
        $new_data = json_decode($_POST['json_dump'], true);
        if ($new_data) {
            file_put_contents($json_file, json_encode($new_data, JSON_PRETTY_PRINT));
            $success = "Data saved successfully!";
        } else {
            $error = "Invalid JSON format!";
        }
    }
}

$raw_json = file_get_contents($json_file);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Dashboard - Prince Neupane</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>

<body class="bg-gray-50 p-8">
    <div class="max-w-4xl mx-auto bg-white rounded shadow-md p-8">
        <div class="flex justify-between items-center mb-6">
            <h1 class="text-3xl font-bold">Manage Content 🎸</h1>
            <a href="?logout=1" class="text-red-500 underline">Logout</a>
        </div>

        <?php if (isset($success))
            echo "<p class='bg-green-100 text-green-700 p-3 rounded mb-4'>$success</p>"; ?>
        <?php if (isset($error))
            echo "<p class='bg-red-100 text-red-700 p-3 rounded mb-4'>$error</p>"; ?>

        <p class="mb-4 text-gray-600">Currently, edit your data directly via this JSON editor. All fields correlate
            directly to the front-end layout.</p>

        <form method="POST">
            <textarea name="json_dump"
                class="w-full h-[600px] font-mono text-sm border p-4 rounded mb-4 bg-gray-50 focus:outline-none focus:ring-2 focus:ring-blue-500"><?php echo htmlspecialchars($raw_json); ?></textarea>
            <button type="submit" name="save_data"
                class="bg-indigo-600 text-white px-6 py-3 rounded font-bold hover:bg-indigo-700 transition">Save
                Changes</button>
        </form>
    </div>
</body>

</html>