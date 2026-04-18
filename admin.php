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

    <body class="bg-[#f0f0f0] flex items-center justify-center h-screen">
        <div
            class="bg-white p-8 rounded border-4 border-black shadow-[8px_8px_0px_0px_rgba(0,0,0,1)] w-96 transform rotate-[-1deg]">
            <h2 class="text-3xl font-black mb-6 text-center uppercase tracking-wide">Admin Pass</h2>
            <?php if (isset($error))
                echo "<p class='text-white bg-red-500 font-bold p-2 mb-4 border-2 border-black'>$error</p>"; ?>
            <form method="POST">
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

if (!is_dir('images')) {
    mkdir('images', 0777, true);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['save_data'])) {
    $data = json_decode(file_get_contents($json_file), true);

    // Overwrite JSON content if valid
    if (isset($_POST['json_dump']) && !empty($_POST['json_dump'])) {
        $new_data = json_decode($_POST['json_dump'], true);
        if ($new_data !== null) {
            $data = $new_data;
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
            $success = "Data saved successfully!";
        } else {
            $error = "JSON syntax error! Please check your brackets or quotes.";
        }
    }

    // Process file uploads
    if (isset($_FILES) && count($_FILES) > 0 && $new_data !== null) {
        $upload_success = false;
        foreach ($_FILES as $input_name => $file_array) {
            if ($file_array['error'] == 0) {
                // Move logic
                $target_dir = "images/";
                $filename = time() . '_' . basename($file_array["name"]);
                $target_file = $target_dir . $filename;

                if (move_uploaded_file($file_array["tmp_name"], $target_file)) {
                    $upload_success = true;
                    // Directly write back to data array
                    if (preg_match('/upload_music_(\d+)/', $input_name, $matches)) {
                        $idx = $matches[1];
                        if (isset($data['music']['releases'][$idx])) {
                            $data['music']['releases'][$idx]['img'] = $target_file;
                        }
                    }
                    if (preg_match('/upload_gallery_(\d+)/', $input_name, $matches)) {
                        $idx = $matches[1];
                        if (isset($data['gallery']['images'][$idx])) {
                            $data['gallery']['images'][$idx]['img'] = $target_file;
                        }
                    }
                }
            }
        }
        if ($upload_success) {
            // Re-save with updated paths
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
            $success .= " + Images uploaded & linked!";
        }
    }
}

$raw_data = json_decode(file_get_contents($json_file), true);
$raw_json = json_encode($raw_data, JSON_PRETTY_PRINT);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Neo-Brutal Dashboard</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        .brutal-shadow {
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }

        .brutal-shadow-lg {
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
        }
    </style>
</head>

<body
    class="bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSIyMCIgaGVpZ2h0PSIyMCI+PGNpcmNsZSBjeD0iMSIgY3k9IjEiIHI9IjEiIGZpbGw9IiNjY2MiLz48L3N2Zz4=')] p-4 md:p-8 min-h-screen font-sans">

    <div class="max-w-[1400px] mx-auto bg-white border-[6px] border-black brutal-shadow-lg p-6 md:p-10 mb-20 relative">
        <div
            class="absolute -top-4 -right-4 bg-yellow-300 border-4 border-black px-4 py-2 font-bold transform rotate-[5deg] brutal-shadow uppercase text-xl z-10">
            ADMIN/01</div>
        <div
            class="flex flex-col md:flex-row justify-between items-start md:items-center mb-10 border-b-[6px] border-black pb-6 gap-4">
            <h1 class="text-4xl md:text-5xl font-black uppercase tracking-tighter">Control Center ⚙️</h1>
            <div class="flex gap-4">
                <a href="index.php" target="_blank"
                    class="bg-cyan-400 text-black font-black px-6 py-3 border-4 border-black brutal-shadow hover:bg-cyan-300 hover:translate-y-1 transition-all uppercase">Live
                    Site</a>
                <a href="?logout=1"
                    class="text-white bg-red-600 font-black px-6 py-3 border-4 border-black brutal-shadow hover:bg-red-700 hover:translate-y-1 transition-all uppercase">Logout</a>
            </div>
        </div>

        <?php if (isset($success))
            echo "<p class='bg-green-400 border-[4px] border-black font-black p-4 mb-8 brutal-shadow text-xl uppercase'>✅ $success</p>"; ?>
        <?php if (isset($error))
            echo "<p class='bg-red-500 text-white border-[4px] border-black font-black p-4 mb-8 brutal-shadow text-xl uppercase'>❌ $error</p>"; ?>

        <form method="POST" enctype="multipart/form-data" class="grid grid-cols-1 xl:grid-cols-2 gap-10">

            <!-- Left Column: Uploaders -->
            <div class="flex flex-col gap-10">
                <!-- Music Section File Uploader -->
                <div
                    class="border-[4px] border-black p-6 bg-[#ff00ff] text-white brutal-shadow relative transform rotate-[-0.5deg]">
                    <div class="absolute -top-3 -left-3 w-8 h-8 rounded-full bg-yellow-400 border-4 border-black z-10">
                    </div>
                    <h2 class="text-3xl font-black uppercase mb-6 drop-shadow-md">🎵 Album Covers</h2>
                    <p class="mb-4 font-bold opacity-90">Upload new images to override existing "img" paths below.</p>
                    <div class="space-y-4">
                        <?php foreach ($raw_data['music']['releases'] as $i => $rel): ?>
                            <div
                                class="p-4 bg-white text-black border-4 border-black flex flex-col md:flex-row items-center gap-4 group">
                                <img src="<?php echo htmlspecialchars($rel['img']); ?>"
                                    class="w-16 h-16 object-cover border-2 border-black group-hover:scale-110 transition-transform">
                                <div class="w-full">
                                    <label
                                        class="font-bold text-xl block mb-1 uppercase leading-none"><?php echo htmlspecialchars($rel['title']); ?></label>
                                    <input type="file" name="upload_music_<?php echo $i; ?>"
                                        class="file:bg-yellow-400 file:text-black file:border-2 file:border-black file:px-3 file:font-bold file:cursor-pointer hover:file:bg-yellow-500 file:mr-4 w-full">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>

                <!-- Gallery Section File Uploader -->
                <div
                    class="border-[4px] border-black p-6 bg-[#00e5ff] text-black brutal-shadow relative transform rotate-[0.5deg]">
                    <div class="absolute -top-3 -right-3 w-8 h-8 rounded-full bg-red-400 border-4 border-black z-10">
                    </div>
                    <h2 class="text-3xl font-black uppercase mb-6">📸 Gallery Photos</h2>
                    <div class="space-y-4">
                        <?php foreach ($raw_data['gallery']['images'] as $i => $g): ?>
                            <div
                                class="p-4 bg-white border-4 border-black flex flex-col md:flex-row items-center gap-4 group">
                                <img src="<?php echo htmlspecialchars($g['img']); ?>"
                                    class="w-16 h-16 object-cover border-2 border-black group-hover:scale-110 transition-transform">
                                <div class="w-full overflow-hidden">
                                    <label
                                        class="font-bold block mb-1 truncate text-lg leading-tight uppercase"><?php echo htmlspecialchars($g['caption']); ?></label>
                                    <input type="file" name="upload_gallery_<?php echo $i; ?>"
                                        class="file:bg-pink-400 file:text-black file:border-2 file:border-black file:px-3 file:font-bold file:cursor-pointer hover:file:bg-pink-500 w-full text-sm">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>

            <!-- Right Column: JSON Config -->
            <div class="flex flex-col h-full">
                <div
                    class="border-[4px] border-black p-6 bg-yellow-300 brutal-shadow flex-grow flex flex-col relative h-[800px] xl:h-auto">
                    <div class="absolute top-2 right-2 flex gap-1">
                        <div class="w-4 h-4 bg-red-500 border-2 border-black rounded-full"></div>
                        <div class="w-4 h-4 bg-white border-2 border-black rounded-full"></div>
                        <div class="w-4 h-4 bg-white border-2 border-black rounded-full"></div>
                    </div>
                    <h2 class="text-3xl font-black uppercase mb-2">⚡ Data Source (JSON)</h2>
                    <p class="text-black font-bold mb-6 bg-white border-2 border-black inline-block px-3 py-1">Add,
                        edit, or remove objects below.</p>

                    <textarea name="json_dump"
                        class="w-full flex-grow font-mono text-xs md:text-sm border-[4px] border-black p-6 focus:outline-none focus:ring-0 leading-relaxed bg-white/95 font-medium resize-none shadow-inner brutal-shadow-lg mb-6 whitespace-pre"
                        spellcheck="false"><?php echo htmlspecialchars($raw_json); ?></textarea>

                    <button type="submit" name="save_data"
                        class="w-full bg-black text-white text-3xl py-6 border-[4px] border-white font-black uppercase tracking-widest hover:bg-[#ff00ff] hover:text-black hover:border-black hover:tracking-[0.3em] transition-all brutal-shadow">
                        !!! Save All Changes !!!
                    </button>
                </div>
            </div>

        </form>
    </div>
</body>

</html>