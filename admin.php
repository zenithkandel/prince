<?php
require_once 'auth.php'; // Ensure user logged in
require_login();

$json_file = 'data.json';
$data = json_decode(file_get_contents($json_file), true);

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Prince Neupane - Admin Panel</title>
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

<body class="bg-[#f0f0f0] min-h-screen font-sans flex flex-col md:flex-row">

    <!-- Sidebar Navigation -->
    <aside
        class="w-full md:w-64 bg-white border-r-4 border-b-4 md:border-b-0 border-black flex flex-col pt-8 brutal-shadow relative z-20">
        <div class="px-6 mb-10">
            <h1 class="text-3xl font-black uppercase tracking-tighter block break-words leading-none">Control<br>Center
            </h1>
            <p class="text-xs font-mono font-bold mt-2 text-gray-500 uppercase tracking-widest block">v2.0 Brutal</p>
        </div>

        <nav class="flex-grow flex flex-col px-4 gap-4">
            <a href="?tab=general"
                class="font-bold border-4 border-black p-3 brutal-shadow uppercase <?php echo $tab === 'general' ? 'bg-yellow-300' : 'bg-gray-50 hover:bg-yellow-100 hover:-translate-y-1 transition-transform'; ?>">🏠
                General Stats</a>
            <a href="?tab=music"
                class="font-bold border-4 border-black p-3 brutal-shadow uppercase <?php echo $tab === 'music' ? 'bg-cyan-400' : 'bg-gray-50 hover:bg-cyan-200 hover:-translate-y-1 transition-transform'; ?>">🎵
                Music Config</a>
            <a href="?tab=gallery"
                class="font-bold border-4 border-black p-3 brutal-shadow uppercase <?php echo $tab === 'gallery' ? 'bg-[#ff00ff] text-white' : 'bg-gray-50 hover:bg-pink-300 hover:-translate-y-1 transition-transform text-black'; ?>">📸
                Gallery Config</a>
        </nav>

        <div class="p-6 mt-8">
            <a href="index.php" target="_blank"
                class="block w-full text-center bg-black text-white font-black p-3 mb-4 uppercase border-4 border-black brutal-shadow hover:bg-gray-800">Visit
                Site ↗</a>
            <a href="?logout=1"
                class="block w-full text-center text-white bg-red-600 font-black p-3 uppercase border-4 border-black brutal-shadow hover:bg-red-700">Logout</a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-grow p-6 md:p-12 overflow-y-auto relative z-10 w-full max-w-6xl">

        <?php if ($success): ?>
            <div
                class="bg-green-400 border-[4px] border-black font-black p-4 mb-8 brutal-shadow text-xl uppercase transform -rotate-1 relative group w-full md:w-auto inline-block">
                ✅ <?php echo $success; ?>
                <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-300 rounded-full border-2 border-black"></div>
            </div>
        <?php endif; ?>

        <!-- TAB: GENERAL -->
        <?php if ($tab === 'general'): ?>
            <h2 class="text-4xl font-black uppercase tracking-tight mb-8">General Stats</h2>
            <form action="handler.php" method="POST" enctype="multipart/form-data" class="space-y-12">
                <input type="hidden" name="action" value="save_general">

                <!-- Hero Section -->
                <section class="bg-white border-4 border-black p-6 brutal-shadow-lg relative mt-4">
                    <div
                        class="absolute -top-4 -left-4 bg-yellow-300 border-4 border-black px-3 py-1 font-black transform rotate-[-5deg] uppercase">
                        Hero Settings</div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">Tagline</label>
                            <input type="text" name="hero[tag]"
                                value="<?php echo htmlspecialchars($data['hero']['tag']); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-yellow-50">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">First Name</label>
                            <input type="text" name="hero[title_first]"
                                value="<?php echo htmlspecialchars($data['hero']['title_first']); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-yellow-50">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">Last Name</label>
                            <input type="text" name="hero[title_last]"
                                value="<?php echo htmlspecialchars($data['hero']['title_last']); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-yellow-50">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">Subtitle</label>
                            <input type="text" name="hero[subtitle]"
                                value="<?php echo htmlspecialchars($data['hero']['subtitle']); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-yellow-50">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">Location Marker</label>
                            <input type="text" name="hero[location]"
                                value="<?php echo htmlspecialchars($data['hero']['location']); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-yellow-50">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">Hero CTA Text</label>
                            <input type="text" name="hero[cta]"
                                value="<?php echo htmlspecialchars($data['hero']['cta'] ?? ''); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-yellow-50">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">Hero Image Upload</label>
                            <div class="flex items-center gap-4">
                                <?php if (isset($data['hero']['img']) && $data['hero']['img']): ?>
                                    <img src="<?php echo htmlspecialchars($data['hero']['img']); ?>"
                                        class="w-16 h-16 border-2 border-black object-cover">
                                <?php endif; ?>
                                <input type="file" name="hero_img"
                                    class="border-4 border-black p-1 text-sm bg-white file:bg-black file:text-white file:border-0 file:px-2 file:cursor-pointer">
                            </div>
                        </div>
                    </div>
                </section>

                <!-- About Section -->
                <section class="bg-white border-4 border-black p-6 brutal-shadow-lg relative mt-16">
                    <div
                        class="absolute -top-4 -left-4 bg-cyan-400 border-4 border-black px-3 py-1 font-black transform rotate-[3deg] uppercase">
                        About Settings</div>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-4">
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">About Title</label>
                            <input type="text" name="about[title]"
                                value="<?php echo htmlspecialchars($data['about']['title']); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-cyan-50">
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">Badge Text</label>
                            <input type="text" name="about[badge_text]"
                                value="<?php echo htmlspecialchars($data['about']['badge_text']); ?>"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-cyan-50">
                        </div>
                        <div class="flex flex-col gap-2 col-span-full">
                            <label class="font-bold uppercase">Paragraph 1</label>
                            <textarea name="about[content_p1]" rows="3"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-cyan-50 resize-none"><?php echo htmlspecialchars($data['about']['content_p1']); ?></textarea>
                        </div>
                        <div class="flex flex-col gap-2 col-span-full">
                            <label class="font-bold uppercase">Paragraph 2</label>
                            <textarea name="about[content_p2]" rows="3"
                                class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-cyan-50 resize-none"><?php echo htmlspecialchars($data['about']['content_p2']); ?></textarea>
                        </div>
                        <div class="flex flex-col gap-2">
                            <label class="font-bold uppercase">About Image Upload</label>
                            <div class="flex items-center gap-4">
                                <?php if (isset($data['about']['img']) && $data['about']['img']): ?>
                                    <img src="<?php echo htmlspecialchars($data['about']['img']); ?>"
                                        class="w-16 h-16 border-2 border-black object-cover">
                                <?php endif; ?>
                                <input type="file" name="about_img"
                                    class="border-4 border-black p-1 text-sm bg-white file:bg-black file:text-white file:border-0 file:px-2 file:cursor-pointer">
                            </div>
                        </div>
                    </div>
                </section>

                <button type="submit"
                    class="w-full bg-black text-white font-black text-3xl p-6 uppercase tracking-widest border-[6px] border-black brutal-shadow-lg hover:bg-gray-800 transition-colors block text-center">Save
                    General Settings</button>
            </form>
        <?php endif; ?>


        <!-- TAB: MUSIC -->
        <?php if ($tab === 'music'): ?>
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <h2 class="text-4xl font-black uppercase tracking-tight">Music Config</h2>

                <form method="POST" action="handler.php" class="inline">
                    <input type="hidden" name="action" value="add_music_item">
                    <button type="submit"
                        class="bg-yellow-300 font-black border-4 border-black p-3 brutal-shadow hover:bg-yellow-400 hover:-translate-y-1 uppercase transition-transform">+
                        Add New Release</button>
                </form>
            </div>

            <form action="handler.php" method="POST" enctype="multipart/form-data" class="space-y-8">
                <input type="hidden" name="action" value="save_music">

                <?php if (empty($data['music']['releases'])): ?>
                    <p class="bg-white border-4 border-black p-6 font-bold uppercase text-center brutal-shadow">No releases
                        found. Click Add New Release above.</p>
                <?php else: ?>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <?php foreach ($data['music']['releases'] as $index => $item): ?>
                            <div class="bg-white border-[6px] border-black p-6 brutal-shadow flex flex-col gap-4 relative mt-4">
                                <div
                                    class="absolute -top-4 -left-4 bg-[#ff00ff] text-white border-4 border-black px-2 font-black transform rotate-[-2deg]">
                                    Release #<?php echo $index + 1; ?></div>

                                <div class="flex items-start gap-4 mb-2 mt-2">
                                    <div
                                        class="w-24 h-24 border-4 border-black bg-gray-100 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                        <?php if (!empty($item['img'])): ?>
                                            <img src="<?php echo htmlspecialchars($item['img']); ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <span
                                                class="text-xs font-bold text-gray-400 uppercase text-center p-2 block w-full relative">No
                                                Img</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow w-1/2">
                                        <label class="font-bold uppercase text-sm">Cover Upload</label>
                                        <input type="hidden" name="music_releases[<?php echo $index; ?>][existing_img]"
                                            value="<?php echo htmlspecialchars($item['img'] ?? ''); ?>">
                                        <input type="file" name="music_img_<?php echo $index; ?>"
                                            class="w-full border-4 border-black p-1 text-xs bg-white file:bg-black file:text-white file:border-0 file:px-2 file:cursor-pointer mt-1">
                                    </div>
                                </div>

                                <div class="flex flex-col gap-1">
                                    <label class="font-bold uppercase text-xs">Title</label>
                                    <input type="text" name="music_releases[<?php echo $index; ?>][title]"
                                        value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>"
                                        class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-[#00e5ff] transition-colors">
                                </div>

                                <div class="flex flex-col gap-1">
                                    <label class="font-bold uppercase text-xs">Description</label>
                                    <input type="text" name="music_releases[<?php echo $index; ?>][desc]"
                                        value="<?php echo htmlspecialchars($item['desc'] ?? ''); ?>"
                                        class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-[#00e5ff] transition-colors">
                                </div>

                                <div class="flex flex-col gap-1">
                                    <label class="font-bold uppercase text-xs">Link (URL)</label>
                                    <input type="text" name="music_releases[<?php echo $index; ?>][link]"
                                        value="<?php echo htmlspecialchars($item['link'] ?? ''); ?>"
                                        class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-[#00e5ff] transition-colors">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit"
                        class="w-full bg-cyan-400 text-black font-black text-3xl p-6 uppercase tracking-widest border-[6px] border-black brutal-shadow-lg hover:bg-cyan-500 transition-colors block text-center mt-12 !mt-12">💾
                        Save Music Config</button>
                <?php endif; ?>
            </form>

            <!-- Delete Items Area inside Music Tab -->
            <?php if (!empty($data['music']['releases'])): ?>
                <div class="mt-16 w-full pt-10 border-t-8 border-black border-dashed">
                    <h3 class="font-black text-2xl uppercase mb-6 text-red-600">Danger Zone</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($data['music']['releases'] as $index => $item): ?>
                            <form method="POST" action="handler.php"
                                onsubmit="return confirm('Are you sure you want to delete \'<?php echo htmlspecialchars(addslashes($item['title'])); ?>\'?');">
                                <input type="hidden" name="action" value="delete_music_item">
                                <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                                <button type="submit"
                                    class="w-full bg-white text-red-600 font-bold border-4 border-black p-3 brutal-shadow hover:bg-red-600 hover:text-white uppercase transition-colors text-sm break-all leading-tight text-left flex justify-between items-center group">
                                    <span>❌ Delete #<?php echo $index + 1; ?><br><span
                                            class="text-xs font-mono break-all inline-block max-w-[150px] truncate text-gray-500 group-hover:text-red-200"><?php echo htmlspecialchars($item['title'] ?? '-'); ?></span></span>
                                </button>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>


        <!-- TAB: GALLERY -->
        <?php if ($tab === 'gallery'): ?>
            <div class="flex flex-col md:flex-row md:items-center justify-between mb-8 gap-4">
                <h2 class="text-4xl font-black uppercase tracking-tight">Gallery Config</h2>

                <form method="POST" action="handler.php" class="inline">
                    <input type="hidden" name="action" value="add_gallery_item">
                    <button type="submit"
                        class="bg-[#ff00ff] text-white font-black border-4 border-black p-3 brutal-shadow hover:bg-pink-700 hover:-translate-y-1 uppercase transition-transform">+
                        Add New Photo</button>
                </form>
            </div>

            <form action="handler.php" method="POST" enctype="multipart/form-data" class="space-y-8">
                <input type="hidden" name="action" value="save_gallery">

                <?php if (empty($data['gallery']['images'])): ?>
                    <p class="bg-white border-4 border-black p-6 font-bold uppercase text-center brutal-shadow">No photos found.
                        Click Add New Photo above.</p>
                <?php else: ?>
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                        <?php foreach ($data['gallery']['images'] as $index => $item): ?>
                            <div class="bg-white border-[6px] border-black p-6 brutal-shadow flex flex-col gap-4 relative mt-4">
                                <div
                                    class="absolute -top-4 -left-4 bg-yellow-300 text-black border-4 border-black px-2 font-black transform rotate-[2deg]">
                                    Photo #<?php echo $index + 1; ?></div>

                                <div class="flex items-start gap-4 mb-2 mt-2">
                                    <div
                                        class="w-24 h-24 border-4 border-black bg-gray-100 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                        <?php if (!empty($item['img'])): ?>
                                            <img src="<?php echo htmlspecialchars($item['img']); ?>" class="w-full h-full object-cover">
                                        <?php else: ?>
                                            <span
                                                class="text-xs font-bold text-gray-400 uppercase text-center p-2 block w-full relative">No
                                                Img</span>
                                        <?php endif; ?>
                                    </div>
                                    <div class="flex-grow w-1/2">
                                        <label class="font-bold uppercase text-sm">Image Upload</label>
                                        <input type="hidden" name="gallery_images[<?php echo $index; ?>][existing_img]"
                                            value="<?php echo htmlspecialchars($item['img'] ?? ''); ?>">
                                        <input type="file" name="gallery_img_<?php echo $index; ?>"
                                            class="w-full border-4 border-black p-1 text-xs bg-white file:bg-black file:text-white file:border-0 file:px-2 file:cursor-pointer mt-1">
                                    </div>
                                </div>

                                <div class="flex flex-col gap-1">
                                    <label class="font-bold uppercase text-xs">Caption</label>
                                    <input type="text" name="gallery_images[<?php echo $index; ?>][caption]"
                                        value="<?php echo htmlspecialchars($item['caption'] ?? ''); ?>"
                                        class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-[#ff00ff] focus:text-white transition-colors">
                                </div>

                                <div class="flex flex-col gap-1">
                                    <label class="font-bold uppercase text-xs">Layout Classes (Optional)</label>
                                    <input type="text" name="gallery_images[<?php echo $index; ?>][classes]"
                                        value="<?php echo htmlspecialchars($item['classes'] ?? ''); ?>"
                                        class="border-4 border-black p-2 font-mono text-sm focus:outline-none focus:bg-[#ff00ff] focus:text-white transition-colors"
                                        placeholder="e.g. rotate-2 w-64">
                                </div>
                            </div>
                        <?php endforeach; ?>
                    </div>

                    <button type="submit"
                        class="w-full bg-[#ff00ff] text-white font-black text-3xl p-6 uppercase tracking-widest border-[6px] border-black brutal-shadow-lg hover:bg-pink-700 transition-colors block text-center mt-12 !mt-12">💾
                        Save Gallery Config</button>
                <?php endif; ?>
            </form>

            <!-- Delete Items Area inside Gallery Tab -->
            <?php if (!empty($data['gallery']['images'])): ?>
                <div class="mt-16 w-full pt-10 border-t-8 border-black border-dashed">
                    <h3 class="font-black text-2xl uppercase mb-6 text-red-600">Danger Zone</h3>
                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                        <?php foreach ($data['gallery']['images'] as $index => $item): ?>
                            <form method="POST" action="handler.php"
                                onsubmit="return confirm('Are you sure you want to delete Photo #<?php echo $index + 1; ?>?');">
                                <input type="hidden" name="action" value="delete_gallery_item">
                                <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                                <button type="submit"
                                    class="w-full bg-white text-red-600 font-bold border-4 border-black p-3 brutal-shadow hover:bg-red-600 hover:text-white uppercase transition-colors text-sm break-all leading-tight text-left flex justify-between items-center group">
                                    <span>❌ Delete #<?php echo $index + 1; ?><br><span
                                            class="text-xs font-mono break-all inline-block max-w-[150px] truncate text-gray-500 group-hover:text-red-200"><?php echo htmlspecialchars($item['caption'] ?? '-'); ?></span></span>
                                </button>
                            </form>
                        <?php endforeach; ?>
                    </div>
                </div>
            <?php endif; ?>
        <?php endif; ?>

    </main>

</body>

</html>