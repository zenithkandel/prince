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
    <script src="https://zenithkandel.com.np/fontawesome/zenith-icons.js"></script>
    <style>
        .brutal-shadow {
            box-shadow: 4px 4px 0px 0px rgba(0, 0, 0, 1);
        }

        .brutal-shadow-lg {
            box-shadow: 8px 8px 0px 0px rgba(0, 0, 0, 1);
        }

        /* Smooth scrolling for anchor links */
        html {
            scroll-behavior: smooth;
        }

        /* Hide scrollbar for sidebar but allow scroll */
        .no-scrollbar::-webkit-scrollbar {
            display: none;
        }

        .no-scrollbar {
            -ms-overflow-style: none;
            scrollbar-width: none;
        }
    </style>
</head>

<body class="bg-[#f0f0f0] font-sans flex flex-col md:flex-row min-h-screen selection:bg-yellow-300">

    <!-- Sidebar Navigation (Sticky on Desktop) -->
    <aside
        class="w-full md:w-64 bg-white border-r-4 border-b-4 md:border-b-0 border-black flex flex-col pt-8 brutal-shadow relative z-20 md:sticky md:top-0 md:h-screen overflow-y-auto no-scrollbar flex-shrink-0">
        <div class="px-6 mb-10">
            <a href="?tab=general" class="block hover:-translate-y-1 transition-transform">
                <h1 class="text-3xl font-black uppercase tracking-tighter block break-words leading-none">
                    Control<br>Center</h1>
            </a>
            <p
                class="text-xs font-mono font-bold mt-3 text-gray-500 uppercase tracking-widest block bg-gray-100 inline-block px-2 py-1 border-2 border-dashed border-gray-300">
                v2.1 Brutal UX</p>
        </div>

        <nav class="flex-grow flex flex-col px-4 gap-4 pb-4">
            <a href="?tab=general"
                class="font-bold border-4 border-black p-3 brutal-shadow uppercase flex justify-between items-center <?php echo $tab === 'general' ? 'bg-yellow-300 transform translate-x-2 scale-[1.02]' : 'bg-gray-50 hover:bg-yellow-100 hover:translate-x-1 transition-all'; ?>">
                <span>General Stats</span> <span class="text-xl"><i class="fa-solid fa-house"></i></span>
            </a>
            <a href="?tab=music"
                class="font-bold border-4 border-black p-3 brutal-shadow uppercase flex justify-between items-center <?php echo $tab === 'music' ? 'bg-[#00e5ff] transform translate-x-2 scale-[1.02]' : 'bg-gray-50 hover:bg-cyan-100 hover:translate-x-1 transition-all'; ?>">
                <span>Music Config</span> <span class="text-xl"><i class="fa-solid fa-music"></i></span>
            </a>
            <a href="?tab=gallery"
                class="font-bold border-4 border-black p-3 brutal-shadow uppercase flex justify-between items-center <?php echo $tab === 'gallery' ? 'bg-[#ff00ff] text-white transform translate-x-2 scale-[1.02]' : 'bg-gray-50 hover:bg-pink-100 hover:translate-x-1 transition-all text-black'; ?>">
                <span>Gallery Config</span> <span class="text-xl"><i class="fa-solid fa-camera"></i></span>
            </a>
        </nav>

        <div class="p-6 mt-8 flex flex-col gap-3 pt-6 border-t-4 border-black border-dashed">
            <a href="index.php" target="_blank"
                class="block w-full text-center bg-black text-white font-black p-3 uppercase border-4 border-black brutal-shadow hover:bg-gray-800 hover:-translate-y-1 transition-transform flex justify-center items-center gap-2">
                <span>Visit Site</span> <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
            </a>
            <a href="?logout=1"
                class="block w-full text-center text-black bg-white font-black p-3 uppercase border-4 border-black brutal-shadow hover:bg-red-600 hover:text-white hover:-translate-y-1 transition-colors group">
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Main Content Area -->
    <main class="flex-grow p-6 md:p-10 lg:p-14 overflow-y-auto relative z-10 w-full">

        <div class="max-w-5xl mx-auto">
            <?php if ($success): ?>
                <div class="bg-green-400 border-[4px] border-black font-black p-4 mb-10 brutal-shadow text-xl uppercase transform -rotate-1 relative group w-full md:w-auto inline-flex items-center gap-3 animate-pulse cursor-pointer"
                    onclick="this.remove()">
                    <span><i class="fa-solid fa-check-circle"></i></span> <span><?php echo $success; ?></span>
                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-300 rounded-full border-2 border-black"></div>
                </div>
            <?php endif; ?>

            <!-- TAB: GENERAL -->
            <?php if ($tab === 'general'): ?>
                <div class="mb-10 border-b-8 border-black border-dashed pb-8">
                    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight">General Stats</h2>
                    <p
                        class="text-gray-600 font-mono mt-3 text-sm md:text-base bg-yellow-100 inline-block px-2 border-2 border-black border-dashed">
                        Manage the static information displayed on your homepage.</p>
                </div>

                <form action="handler.php" method="POST" enctype="multipart/form-data" class="space-y-16">
                    <input type="hidden" name="action" value="save_general">

                    <!-- Hero Section -->
                    <section
                        class="bg-white border-4 border-black p-6 md:p-10 brutal-shadow-lg relative mt-4 group hover:border-[#ff00ff] transition-colors focus-within:border-[#ff00ff]">
                        <div
                            class="absolute -top-5 -left-5 bg-yellow-300 border-4 border-black px-4 py-2 font-black transform -rotate-3 uppercase text-xl group-hover:rotate-0 transition-transform shadow-[4px_4px_0px_rgba(0,0,0,1)] z-10">
                            Hero Area <i class="fa-solid fa-bolt"></i></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mt-8 relative z-0">
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center justify-between">
                                    Tagline <span class="text-gray-400 font-mono text-[10px]">Short text above name</span>
                                </label>
                                <input type="text" name="hero[tag]"
                                    value="<?php echo htmlspecialchars($data['hero']['tag']); ?>"
                                    class="border-[3px] border-black p-4 font-mono text-base focus:outline-none focus:ring-[4px] focus:ring-yellow-300 transition-all bg-gray-50 focus:bg-white placeholder-gray-400">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center justify-between">
                                    Location Marker <span class="text-gray-400 font-mono text-[10px]">City/Country</span>
                                </label>
                                <input type="text" name="hero[location]"
                                    value="<?php echo htmlspecialchars($data['hero']['location']); ?>"
                                    class="border-[3px] border-black p-4 font-mono text-base focus:outline-none focus:ring-[4px] focus:ring-yellow-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">First Name</label>
                                <input type="text" name="hero[title_first]"
                                    value="<?php echo htmlspecialchars($data['hero']['title_first']); ?>"
                                    class="border-[3px] border-black p-4 font-black text-2xl focus:outline-none focus:ring-[4px] focus:ring-yellow-300 transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Last Name</label>
                                <input type="text" name="hero[title_last]"
                                    value="<?php echo htmlspecialchars($data['hero']['title_last']); ?>"
                                    class="border-[3px] border-black p-4 font-black text-2xl focus:outline-none focus:ring-[4px] focus:ring-yellow-300 transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">Subtitle</label>
                                <input type="text" name="hero[subtitle]"
                                    value="<?php echo htmlspecialchars($data['hero']['subtitle']); ?>"
                                    class="border-[3px] border-black p-4 font-mono text-base focus:outline-none focus:ring-[4px] focus:ring-yellow-300 transition-all bg-gray-50 focus:bg-white">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex justify-between items-center">
                                    Hero CTA Text <span
                                        class="bg-black text-white px-2 py-0.5 text-[10px] uppercase">Button</span>
                                </label>
                                <input type="text" name="hero[cta]"
                                    value="<?php echo htmlspecialchars($data['hero']['cta'] ?? ''); ?>"
                                    class="border-[3px] border-black p-4 font-black tracking-widest uppercase text-sm focus:outline-none focus:ring-[4px] focus:ring-yellow-300 transition-all bg-yellow-50 focus:bg-yellow-300 text-center">
                            </div>

                            <!-- Image Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Hero Image</label>
                                <div
                                    class="flex items-center gap-4 bg-gray-50 border-[3px] border-black p-3 hover:bg-yellow-50 transition-colors">
                                    <div
                                        class="w-16 h-16 md:w-20 md:h-20 border-2 border-black flex-shrink-0 bg-white overflow-hidden flex items-center justify-center brutal-shadow-sm">
                                        <?php if (isset($data['hero']['img']) && $data['hero']['img']): ?>
                                            <img src="<?php echo htmlspecialchars($data['hero']['img']); ?>"
                                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-300">
                                        <?php else: ?>
                                            <span class="text-[10px] uppercase font-bold text-gray-400">None</span>
                                        <?php endif; ?>
                                    </div>
                                    <input type="file" name="hero_img"
                                        class="w-full text-xs font-mono file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:bg-yellow-300 file:text-black file:font-bold file:uppercase file:cursor-pointer file:hover:bg-black file:hover:text-white file:transition-colors focus:outline-none bg-transparent">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- About Section -->
                    <section
                        class="bg-white border-4 border-black p-6 md:p-10 brutal-shadow-lg relative group hover:border-[#00e5ff] transition-colors focus-within:border-[#00e5ff] mt-20">
                        <div
                            class="absolute -top-5 -left-5 bg-cyan-400 border-4 border-black px-4 py-2 font-black transform rotate-2 uppercase text-xl group-hover:rotate-0 transition-transform shadow-[4px_4px_0px_rgba(0,0,0,1)] z-10">
                            About Area <i class="fa-solid fa-file-signature"></i></div>

                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mt-8 relative z-0">
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">About Title</label>
                                <input type="text" name="about[title]"
                                    value="<?php echo htmlspecialchars($data['about']['title']); ?>"
                                    class="border-[3px] border-black p-4 font-black text-xl focus:outline-none focus:ring-[4px] focus:ring-cyan-400 transition-all bg-transparent focus:bg-white border-b-8">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex justify-between">
                                    Badge Text <span
                                        class="bg-black text-white px-2 py-0.5 text-[10px] uppercase">Sticker</span>
                                </label>
                                <input type="text" name="about[badge_text]"
                                    value="<?php echo htmlspecialchars($data['about']['badge_text']); ?>"
                                    class="border-[3px] border-black p-4 font-black tracking-wider text-sm focus:outline-none focus:ring-[4px] focus:ring-cyan-400 transition-all bg-cyan-50 focus:bg-cyan-200">
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm flex items-center justify-between">
                                    Paragraph 1 <span class="text-gray-400 font-mono text-[10px]">Main bio</span>
                                </label>
                                <textarea name="about[content_p1]" rows="5"
                                    class="border-[3px] border-black p-5 font-sans leading-relaxed text-base focus:outline-none focus:ring-[4px] focus:ring-cyan-400 transition-all bg-gray-50 focus:bg-white resize-y"><?php echo htmlspecialchars($data['about']['content_p1']); ?></textarea>
                            </div>
                            <!-- Input Block -->
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm flex items-center justify-between">
                                    Paragraph 2 <span class="text-gray-400 font-mono text-[10px]">Secondary text</span>
                                </label>
                                <textarea name="about[content_p2]" rows="5"
                                    class="border-[3px] border-black p-5 font-sans leading-relaxed text-base focus:outline-none focus:ring-[4px] focus:ring-cyan-400 transition-all bg-gray-50 focus:bg-white resize-y"><?php echo htmlspecialchars($data['about']['content_p2']); ?></textarea>
                            </div>
                            <!-- Image Block -->
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">About Image</label>
                                <div
                                    class="flex items-center gap-4 bg-gray-50 border-[3px] border-black p-3 md:w-2/3 hover:bg-cyan-50 transition-colors">
                                    <div
                                        class="w-16 h-16 md:w-20 md:h-20 border-2 border-black flex-shrink-0 bg-white overflow-hidden flex items-center justify-center brutal-shadow-sm">
                                        <?php if (isset($data['about']['img']) && $data['about']['img']): ?>
                                            <img src="<?php echo htmlspecialchars($data['about']['img']); ?>"
                                                class="w-full h-full object-cover grayscale hover:grayscale-0 transition-all duration-300">
                                        <?php else: ?>
                                            <span class="text-[10px] uppercase font-bold text-gray-400">None</span>
                                        <?php endif; ?>
                                    </div>
                                    <input type="file" name="about_img"
                                        class="w-full text-xs font-mono file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:bg-cyan-400 file:text-black file:font-bold file:uppercase file:cursor-pointer file:hover:bg-black file:hover:text-white file:transition-colors focus:outline-none bg-transparent">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- Sticky Save Action Footer -->
                    <div class="sticky bottom-6 mt-16 z-30 pt-4">
                        <button type="submit"
                            class="w-full bg-black text-white font-black text-2xl md:text-3xl p-6 uppercase tracking-widest border-[6px] border-black brutal-shadow-lg hover:bg-gray-800 hover:scale-[1.01] hover:-translate-y-1 transition-all block text-center focus:outline-none focus:ring-[8px] focus:ring-yellow-300">
                            <i class="fa-solid fa-floppy-disk"></i> Save General Settings
                        </button>
                    </div>
                </form>
            <?php endif; ?>


            <!-- TAB: MUSIC -->
            <?php if ($tab === 'music'): ?>
                <div
                    class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6 border-b-8 border-black border-dashed pb-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-[#00c2d8]">Music Config
                        </h2>
                        <p
                            class="text-gray-600 font-mono mt-3 text-sm md:text-base bg-cyan-100 inline-block px-2 border-2 border-black border-dashed">
                            Manage your releases. Edit inline & save instantly.</p>
                    </div>

                    <form method="POST" action="handler.php" class="inline-block mt-2 md:mt-0 flex-shrink-0">
                        <input type="hidden" name="action" value="add_music_item">
                        <button type="submit"
                            class="bg-yellow-300 font-black flex items-center justify-center gap-3 border-[4px] border-black px-8 py-5 brutal-shadow hover:bg-yellow-400 hover:-translate-y-1 uppercase transition-all w-full text-xl md:text-2xl hover:scale-105 active:scale-95">
                            <span class="text-3xl leading-none block align-middle mt-[-4px]">+</span> Add Release
                        </button>
                    </form>
                </div>

                <form action="handler.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <input type="hidden" name="action" value="save_music">

                    <?php if (empty($data['music']['releases'])): ?>
                        <div
                            class="bg-white border-[6px] border-dashed border-black p-16 flex flex-col items-center justify-center gap-6 brutal-shadow hover:bg-yellow-50 transition-colors">
                            <span class="text-7xl animate-bounce"><i class="fa-solid fa-compact-disc"></i></span>
                            <p class="font-black uppercase text-3xl md:text-4xl text-center">Your catalog is empty.</p>
                            <p
                                class="text-gray-600 font-mono text-base text-center bg-white px-4 border-2 border-black border-dashed py-2">
                                Click the yellow button above to drop your first track.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-14">
                            <?php foreach ($data['music']['releases'] as $index => $item): ?>
                                <div
                                    class="bg-white border-[6px] border-black p-6 md:p-8 pt-8 brutal-shadow flex flex-col gap-6 relative mt-4 focus-within:ring-4 ring-cyan-200 transition-all hover:bg-gray-50 focus-within:bg-white group">
                                    <!-- Card Header -->
                                    <div
                                        class="absolute -top-5 -left-5 bg-black text-[#00e5ff] border-4 border-black px-4 py-1.5 font-black transform -rotate-3 text-lg shadow-[4px_4px_0px_#00e5ff] group-hover:rotate-0 transition-transform z-10 flex items-center gap-2">
                                        <span><i class="fa-solid fa-compact-disc"></i></span> Release #<?php echo $index + 1; ?>
                                    </div>

                                    <!-- File Upload Row -->
                                    <div
                                        class="flex flex-col xl:flex-row xl:items-center gap-5 mt-4 bg-white border-[3px] border-black p-4 brutal-shadow-sm">
                                        <div
                                            class="w-full xl:w-24 h-48 xl:h-24 border-4 border-black bg-gray-100 flex-shrink-0 flex items-center justify-center overflow-hidden relative group/img">
                                            <?php if (!empty($item['img'])): ?>
                                                <img src="<?php echo htmlspecialchars($item['img']); ?>"
                                                    class="w-full h-full object-cover relative z-10 grayscale group-hover/img:grayscale-0 transition-all duration-500">
                                            <?php else: ?>
                                                <span
                                                    class="text-xs font-black text-gray-300 uppercase tracking-widest z-10">Empty</span>
                                            <?php endif; ?>
                                            <!-- Decorative lines behind empty state -->
                                            <div
                                                class="absolute inset-0 bg-[url('data:image/svg+xml;base64,PHN2ZyB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHdpZHRoPSI4IiBoZWlnaHQ9IjgiPgo8cmVjdCB3aWR0aD0iOCIgaGVpZ2h0PSI4IiBmaWxsPSIjZmZmZmZmIiAvPgo8cGF0aCBkPSJNMCAwTDggOFoiIHN0cm9rZT0iI2U1ZTdlYiIgc3Ryb2tlLXdpZHRoPSIxIiAvPgo8L3N2Zz4=')] opacity-50 z-0">
                                            </div>
                                        </div>
                                        <div class="flex-grow w-full overflow-hidden">
                                            <label
                                                class="font-bold uppercase text-xs mb-2 block text-gray-600 bg-gray-100 pl-2 border-l-4 border-cyan-400">Cover
                                                Source</label>
                                            <input type="hidden" name="music_releases[<?php echo $index; ?>][existing_img]"
                                                value="<?php echo htmlspecialchars($item['img'] ?? ''); ?>">
                                            <input type="file" name="music_img_<?php echo $index; ?>"
                                                class="w-full text-xs font-mono file:mr-3 file:py-1.5 file:px-3 file:border-2 file:border-black file:bg-[transparent] file:text-black file:hover:bg-black file:hover:text-white file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none truncate bg-white border-2 border-dashed border-gray-300 hover:border-black p-1 transition-colors">
                                        </div>
                                    </div>

                                    <!-- Inputs Row -->
                                    <div class="flex flex-col gap-5 mt-2">
                                        <div class="flex flex-col gap-1.5 peer">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Release
                                                Title</label>
                                            <input type="text" name="music_releases[<?php echo $index; ?>][title]"
                                                value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>"
                                                placeholder="Enter Title..."
                                                class="border-b-[4px] border-black pb-2 font-black text-2xl md:text-3xl focus:outline-none focus:border-cyan-400 transition-colors bg-transparent placeholder-gray-200">
                                        </div>

                                        <div class="flex flex-col gap-1.5">
                                            <label
                                                class="font-bold uppercase text-[10px] text-gray-400 tracking-widest flex items-center justify-between">
                                                Description
                                            </label>
                                            <input type="text" name="music_releases[<?php echo $index; ?>][desc]"
                                                value="<?php echo htmlspecialchars($item['desc'] ?? ''); ?>"
                                                placeholder="A brief description..."
                                                class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-cyan-200 bg-white transition-all">
                                        </div>

                                        <div class="flex flex-col gap-1.5">
                                            <label
                                                class="font-bold uppercase text-[10px] text-gray-400 tracking-widest flex items-center gap-2">
                                                <span>Listen Link</span> <span
                                                    class="bg-gray-200 text-gray-500 px-1 py-0.5 rounded-sm">URL</span>
                                            </label>
                                            <input type="url" name="music_releases[<?php echo $index; ?>][link]"
                                                value="<?php echo htmlspecialchars($item['link'] ?? ''); ?>"
                                                placeholder="https://open.spotify.com/..."
                                                class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-cyan-200 bg-white transition-all focus:text-cyan-700">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="sticky bottom-6 mt-16 z-30 pt-4">
                            <button type="submit"
                                class="w-full bg-[#00e5ff] text-black font-black text-2xl md:text-3xl p-6 uppercase tracking-widest border-[6px] border-black brutal-shadow-lg hover:bg-cyan-300 hover:scale-[1.01] hover:-translate-y-1 transition-all block text-center focus:outline-none focus:ring-[8px] focus:ring-yellow-300">
                                <i class="fa-solid fa-floppy-disk"></i> Save Music Configuration
                            </button>
                        </div>
                    <?php endif; ?>
                </form>

                <!-- Dedicated Delete Zone (Cleaner UX) -->
                <?php if (!empty($data['music']['releases'])): ?>
                    <div class="mt-24 w-full pt-12 border-t-[8px] border-black border-dashed relative">
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-white px-6">
                            <span class="text-4xl">?</span>
                        </div>
                        <div class="flex flex-col items-center justify-center text-center gap-2 mb-10">
                            <h3
                                class="font-black text-3xl uppercase leading-none text-red-600 bg-red-100 px-4 py-2 border-4 border-black inline-block transform -rotate-1 brutal-shadow">
                                Danger Zone</h3>
                            <p class="font-mono text-sm text-gray-600 border-b-2 border-red-200 pb-1">Click below to irrevocably
                                delete an item.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                            <?php foreach ($data['music']['releases'] as $index => $item): ?>
                                <form method="POST" action="handler.php"
                                    onsubmit="return confirm('WARNING: Are you sure you want to permanently delete \'<?php echo htmlspecialchars(addslashes($item['title'] ?: 'Item #' . ($index + 1))); ?>\'?');"
                                    class="h-full">
                                    <input type="hidden" name="action" value="delete_music_item">
                                    <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                                    <button type="submit"
                                        class="w-full h-full bg-white text-black font-bold border-4 border-black border-b-[6px] p-5 hover:-translate-y-1 active:translate-y-1 active:border-b-4 hover:bg-red-600 hover:text-white uppercase transition-all text-sm text-left flex justify-between items-center group relative overflow-hidden">
                                        <div
                                            class="absolute top-0 bottom-0 left-0 w-2 bg-red-600 group-hover:w-0 transition-all duration-300">
                                        </div>
                                        <div class="flex flex-col gap-1.5 overflow-hidden pl-4 pr-2 relative z-10 w-[80%]">
                                            <span
                                                class="truncate w-full font-black text-lg group-hover:text-white break-all"><?php echo htmlspecialchars($item['title'] ?: 'Unnamed Release'); ?></span>
                                            <span
                                                class="text-[10px] font-mono text-red-600 group-hover:text-white group-hover:opacity-80 uppercase tracking-widest bg-red-50 group-hover:bg-red-500 inline-block px-2 py-1 self-start border border-red-200 group-hover:border-red-400">Release
                                                #<?php echo $index + 1; ?></span>
                                        </div>
                                        <span
                                            class="text-3xl group-hover:scale-125 group-hover:rotate-12 transition-transform opacity-30 group-hover:opacity-100 flex-shrink-0 pr-2"><i class="fa-solid fa-trash-can"></i></span>
                                    </button>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>


            <!-- TAB: GALLERY -->
            <?php if ($tab === 'gallery'): ?>
                <div
                    class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6 border-b-8 border-black border-dashed pb-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-[#d900d9]">Gallery Config
                        </h2>
                        <p
                            class="text-gray-600 font-mono mt-3 text-sm md:text-base bg-pink-100 inline-block px-2 border-2 border-black border-dashed">
                            Manage your digital scrapbook. Layout classes use Tailwind.</p>
                    </div>

                    <form method="POST" action="handler.php" class="inline-block mt-2 md:mt-0 flex-shrink-0">
                        <input type="hidden" name="action" value="add_gallery_item">
                        <button type="submit"
                            class="bg-[#ff00ff] text-white font-black flex items-center justify-center gap-3 border-[4px] border-black px-8 py-5 brutal-shadow hover:bg-pink-600 hover:-translate-y-1 uppercase transition-all w-full text-xl md:text-2xl hover:scale-105 active:scale-95 shadow-[8px_8px_0px_#000]">
                            <span class="text-3xl leading-none block align-middle mt-[-4px]">+</span> Add Photo
                        </button>
                    </form>
                </div>

                <form action="handler.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <input type="hidden" name="action" value="save_gallery">

                    <?php if (empty($data['gallery']['images'])): ?>
                        <div
                            class="bg-white border-[6px] border-dashed border-black p-16 flex flex-col items-center justify-center gap-6 brutal-shadow hover:bg-pink-50 transition-colors">
                            <span class="text-7xl"><i class="fa-solid fa-camera"></i></span>
                            <p class="font-black uppercase text-3xl md:text-4xl text-center">Your scrapbook is empty.</p>
                            <p
                                class="text-gray-600 font-mono text-base text-center bg-white px-4 border-2 border-black border-dashed py-2">
                                Click the pink button above to insert a new polaroid frame.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 gap-y-14">
                            <?php foreach ($data['gallery']['images'] as $index => $item): ?>
                                <div
                                    class="bg-white border-[6px] border-black p-6 md:p-8 pt-8 brutal-shadow flex flex-col gap-6 relative mt-4 focus-within:ring-4 ring-pink-300 transition-all hover:bg-gray-50 focus-within:bg-white group">
                                    <!-- Card Header -->
                                    <div
                                        class="absolute -top-5 -left-5 bg-[#ff00ff] text-white border-4 border-black px-4 py-1.5 font-black transform rotate-2 text-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] group-hover:rotate-0 transition-transform z-10 flex items-center gap-2">
                                        <span><i class="fa-solid fa-camera"></i></span> Frame #<?php echo $index + 1; ?>
                                    </div>

                                    <!-- File Upload Row -->
                                    <div
                                        class="flex flex-col xl:flex-row xl:items-center gap-5 mt-4 bg-white border-[3px] border-black p-4 brutal-shadow-sm">
                                        <div
                                            class="w-full xl:w-28 h-48 xl:h-28 flex-shrink-0 flex items-center justify-center relative group/img transform -rotate-2 hover:rotate-1 transition-transform">
                                            <?php if (!empty($item['img'])): ?>
                                                <!-- Visual Preview matching frontend scrapbook style -->
                                                <div
                                                    class="p-2 pb-6 bg-white border-2 border-gray-300 shadow-[2px_4px_10px_rgba(0,0,0,0.1)] w-full h-full relative">
                                                    <img src="<?php echo htmlspecialchars($item['img']); ?>"
                                                        class="w-full h-full object-cover sepia-[0.3] contrast-[1.1] grayscale-[0.2]">
                                                    <div class="absolute bottom-1 w-full text-center inset-x-0">
                                                        <span
                                                            class="text-[8px] font-handwriting text-gray-500 block truncate px-2">Preview</span>
                                                    </div>
                                                </div>
                                            <?php else: ?>
                                                <div
                                                    class="p-2 bg-gray-100 border-2 border-dashed border-gray-300 w-full h-full flex items-center justify-center">
                                                    <span
                                                        class="text-[10px] font-black text-gray-400 uppercase tracking-widest text-center">No
                                                        Image<br>Selected</span>
                                                </div>
                                            <?php endif; ?>
                                        </div>

                                        <div class="flex-grow w-full overflow-hidden mt-2 xl:mt-0 pl-1">
                                            <label
                                                class="font-bold uppercase text-xs mb-2 block text-gray-600 bg-gray-100 pl-2 border-l-4 border-[#ff00ff]">Image
                                                Source</label>
                                            <input type="hidden" name="gallery_images[<?php echo $index; ?>][existing_img]"
                                                value="<?php echo htmlspecialchars($item['img'] ?? ''); ?>">
                                            <input type="file" name="gallery_img_<?php echo $index; ?>"
                                                class="w-full text-xs font-mono file:mr-3 file:py-1.5 file:px-3 file:border-2 file:border-black file:bg-[transparent] file:text-black file:hover:bg-black file:hover:text-white file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none truncate bg-white border-2 border-dashed border-gray-300 hover:border-black p-1 transition-colors">
                                        </div>
                                    </div>

                                    <!-- Inputs Row -->
                                    <div class="flex flex-col gap-5 mt-2">
                                        <div
                                            class="flex flex-col gap-1.5 peer border-b-[4px] border-black focus-within:border-[#ff00ff] pb-2 transition-colors">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Photo
                                                Caption</label>
                                            <input type="text" name="gallery_images[<?php echo $index; ?>][caption]"
                                                value="<?php echo htmlspecialchars($item['caption'] ?? ''); ?>"
                                                placeholder="e.g. A cool memory"
                                                class="font-black text-2xl md:text-3xl focus:outline-none bg-transparent placeholder-gray-200 text-black">
                                        </div>

                                        <div
                                            class="flex flex-col gap-1.5 bg-gray-50 border-[3px] border-black p-4 focus-within:bg-white focus-within:ring-[4px] ring-pink-200 transition-all">
                                            <div class="flex justify-between items-center mb-2">
                                                <label
                                                    class="font-bold uppercase text-[11px] text-gray-600 tracking-wider">Scrapbook
                                                    Layout Classes</label>
                                                <span
                                                    class="text-[9px] font-mono font-bold text-white bg-black px-2 py-0.5 uppercase tracking-widest">Tailwind
                                                    CSS</span>
                                            </div>
                                            <input type="text" name="gallery_images[<?php echo $index; ?>][classes]"
                                                value="<?php echo htmlspecialchars($item['classes'] ?? ''); ?>"
                                                placeholder="e.g. rotate-3 w-64 md:right-10"
                                                class="border-b-[3px] border-black pb-2 font-mono text-sm focus:outline-none bg-transparent text-[#d900d9] font-bold tracking-wide placeholder-gray-300">
                                            <div
                                                class="text-[10px] font-mono text-gray-500 mt-2 flex gap-2 overflow-x-auto no-scrollbar py-1">
                                                <span
                                                    class="bg-gray-200 px-1 cursor-pointer border border-gray-300 hover:border-black shrink-0"
                                                    onclick="this.parentElement.previousElementSibling.value+=' rotate-2'">rotate-2</span>
                                                <span
                                                    class="bg-gray-200 px-1 cursor-pointer border border-gray-300 hover:border-black shrink-0"
                                                    onclick="this.parentElement.previousElementSibling.value+=' -rotate-3'">-rotate-3</span>
                                                <span
                                                    class="bg-gray-200 px-1 cursor-pointer border border-gray-300 hover:border-black shrink-0"
                                                    onclick="this.parentElement.previousElementSibling.value+=' w-64'">w-64</span>
                                                <span
                                                    class="bg-gray-200 px-1 cursor-pointer border border-gray-300 hover:border-black shrink-0"
                                                    onclick="this.parentElement.previousElementSibling.value+=' md:left-20'">md:left-20</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>

                        <div class="sticky bottom-6 mt-16 z-30 pt-4">
                            <button type="submit"
                                class="w-full bg-[#ff00ff] text-white font-black text-2xl md:text-3xl p-6 uppercase tracking-widest border-[6px] border-black brutal-shadow-lg hover:bg-pink-600 hover:scale-[1.01] hover:-translate-y-1 transition-all block text-center focus:outline-none focus:ring-[8px] focus:ring-pink-300 shadow-[8px_8px_0px_#000]">
                                <i class="fa-solid fa-floppy-disk"></i> Save Gallery Configuration
                            </button>
                        </div>
                    <?php endif; ?>
                </form>

                <!-- Dedicated Delete Zone (Cleaner UX) -->
                <?php if (!empty($data['gallery']['images'])): ?>
                    <div class="mt-24 w-full pt-12 border-t-[8px] border-black border-dashed relative">
                        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 bg-white px-6">
                            <span class="text-4xl text-[#ff00ff]"><i class="fa-solid fa-fire"></i></span>
                        </div>
                        <div class="flex flex-col items-center justify-center text-center gap-2 mb-10">
                            <h3
                                class="font-black text-3xl uppercase leading-none text-red-600 bg-red-100 px-4 py-2 border-4 border-black inline-block transform rotate-1 brutal-shadow">
                                Danger Zone</h3>
                            <p class="font-mono text-sm text-gray-600 border-b-2 border-red-200 pb-1">Click below to irrevocably
                                delete a photo frame.</p>
                        </div>

                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 max-w-6xl mx-auto">
                            <?php foreach ($data['gallery']['images'] as $index => $item): ?>
                                <form method="POST" action="handler.php"
                                    onsubmit="return confirm('WARNING: Are you sure you want to permanently delete Frame #<?php echo $index + 1; ?>?');"
                                    class="h-full">
                                    <input type="hidden" name="action" value="delete_gallery_item">
                                    <input type="hidden" name="delete_index" value="<?php echo $index; ?>">
                                    <button type="submit"
                                        class="w-full h-full bg-white text-black font-bold border-4 border-black border-b-[6px] p-5 hover:-translate-y-1 active:translate-y-1 active:border-b-4 hover:bg-red-600 hover:text-white uppercase transition-all text-sm text-left flex justify-between items-center group relative overflow-hidden">
                                        <div
                                            class="absolute top-0 bottom-0 left-0 w-2 bg-red-600 group-hover:w-0 transition-all duration-300">
                                        </div>
                                        <div class="flex flex-col gap-1.5 overflow-hidden pl-4 pr-2 relative z-10 w-[80%]">
                                            <span
                                                class="truncate w-full font-black text-lg group-hover:text-white break-all"><?php echo htmlspecialchars($item['caption'] ?: 'Unnamed Frame'); ?></span>
                                            <span
                                                class="text-[10px] font-mono text-red-600 group-hover:text-white group-hover:opacity-80 uppercase tracking-widest bg-red-50 group-hover:bg-red-500 inline-block px-2 py-1 self-start border border-red-200 group-hover:border-red-400">Delete
                                                Photo #<?php echo $index + 1; ?></span>
                                        </div>
                                        <span
                                            class="text-3xl group-hover:scale-125 group-hover:-rotate-12 transition-transform opacity-30 group-hover:opacity-100 flex-shrink-0 pr-2">??</span>
                                    </button>
                                </form>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endif; ?>
            <?php endif; ?>

        </div>
    </main>

</body>

</html>