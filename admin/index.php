<?php
require_once '../api/auth.php';
require_login();

$json_file = '../api/data.json';
$data = json_decode(file_get_contents($json_file), true);

$tab = isset($_GET['tab']) ? $_GET['tab'] : 'general';
$success = isset($_GET['success']) ? htmlspecialchars($_GET['success']) : null;

// Icon options for dropdown (no FA class typing needed)
$icon_options = [
    'guitar' => 'Guitar',
    'microphone' => 'Microphone',
    'music' => 'Music Note',
    'star' => 'Star',
    'heart' => 'Heart',
    'fire' => 'Fire',
    'bolt' => 'Lightning',
    'headphones' => 'Headphones',
];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Prince Neupane - Admin Panel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://zenithkandel.com.np/fontawesome/zenith-icons.js"></script>
    <style>
        .brutal-shadow { box-shadow: 4px 4px 0px 0px rgba(0,0,0,1); }
        .brutal-shadow-lg { box-shadow: 8px 8px 0px 0px rgba(0,0,0,1); }
        html { scroll-behavior: smooth; }
        .no-scrollbar::-webkit-scrollbar { display: none; }
        .no-scrollbar { -ms-overflow-style: none; scrollbar-width: none; }
    </style>
</head>
<body class="bg-[#f0f0f0] font-sans flex flex-col md:flex-row min-h-screen selection:bg-yellow-300 pb-24 md:pb-0">

    <!-- Mobile Header -->
    <header class="md:hidden bg-white border-b-4 border-black p-4 flex justify-between items-center z-30 sticky top-0">
        <div>
            <h1 class="text-2xl font-black uppercase tracking-tighter block leading-none">Control Center</h1>
            <p class="text-[10px] font-mono font-bold mt-1 text-gray-500 uppercase tracking-widest inline-block bg-gray-100 px-1 border-2 border-dashed border-gray-300">v3.0 Full Control</p>
        </div>
        <div class="flex gap-3">
            <a href="../index.php" target="_blank" class="bg-black text-white w-10 h-10 flex items-center justify-center border-2 border-black brutal-shadow"><i class="fa-solid fa-arrow-up-right-from-square"></i></a>
            <a href="?logout=1" class="bg-white text-black w-10 h-10 flex items-center justify-center border-2 border-black brutal-shadow hover:bg-red-600 hover:text-white"><i class="fa-solid fa-right-from-bracket"></i></a>
        </div>
    </header>

    <!-- Desktop Sidebar -->
    <aside class="hidden md:flex w-64 bg-white border-r-4 border-black flex-col pt-8 brutal-shadow relative z-20 sticky top-0 h-screen overflow-y-auto no-scrollbar flex-shrink-0">
        <div class="px-6 mb-10">
            <a href="?tab=general" class="block hover:-translate-y-1 transition-transform">
                <h1 class="text-3xl font-black uppercase tracking-tighter block break-words leading-none">Control<br>Center</h1>
            </a>
            <p class="text-xs font-mono font-bold mt-3 text-gray-500 uppercase tracking-widest block bg-gray-100 inline-block px-2 py-1 border-2 border-dashed border-gray-300">v3.0 Full Control</p>
        </div>
        <nav class="flex-grow flex flex-col px-4 gap-4 pb-4">
            <a href="?tab=general" class="font-bold border-4 border-black p-3 brutal-shadow uppercase flex justify-between items-center <?php echo $tab === 'general' ? 'bg-yellow-300 transform translate-x-2 scale-[1.02]' : 'bg-gray-50 hover:bg-yellow-100 hover:translate-x-1 transition-all'; ?>">
                <span>General</span> <span class="text-xl"><i class="fa-solid fa-house"></i></span>
            </a>
            <a href="?tab=music" class="font-bold border-4 border-black p-3 brutal-shadow uppercase flex justify-between items-center <?php echo $tab === 'music' ? 'bg-[#00e5ff] transform translate-x-2 scale-[1.02]' : 'bg-gray-50 hover:bg-cyan-100 hover:translate-x-1 transition-all'; ?>">
                <span>Music</span> <span class="text-xl"><i class="fa-solid fa-music"></i></span>
            </a>
            <a href="?tab=viral" class="font-bold border-4 border-black p-3 brutal-shadow uppercase flex justify-between items-center <?php echo $tab === 'viral' ? 'bg-[#ff00ff] text-white transform translate-x-2 scale-[1.02]' : 'bg-gray-50 hover:bg-pink-100 hover:translate-x-1 transition-all text-black'; ?>">
                <span>Viral</span> <span class="text-xl"><i class="fa-solid fa-fire"></i></span>
            </a>
            <a href="?tab=gallery" class="font-bold border-4 border-black p-3 brutal-shadow uppercase flex justify-between items-center <?php echo $tab === 'gallery' ? 'bg-[#ff00ff] text-white transform translate-x-2 scale-[1.02]' : 'bg-gray-50 hover:bg-pink-100 hover:translate-x-1 transition-all text-black'; ?>">
                <span>Gallery</span> <span class="text-xl"><i class="fa-solid fa-camera"></i></span>
            </a>
        </nav>
        <div class="p-6 mt-8 flex flex-col gap-3 pt-6 border-t-4 border-black border-dashed">
            <a href="../index.php" target="_blank" class="block w-full text-center bg-black text-white font-black p-3 uppercase border-4 border-black brutal-shadow hover:bg-gray-800 hover:-translate-y-1 transition-transform flex justify-center items-center gap-2">
                <span>Visit Site</span> <span><i class="fa-solid fa-arrow-up-right-from-square"></i></span>
            </a>
            <a href="?logout=1" class="block w-full text-center text-black bg-white font-black p-3 uppercase border-4 border-black brutal-shadow hover:bg-red-600 hover:text-white hover:-translate-y-1 transition-colors group">
                <span>Logout</span>
            </a>
        </div>
    </aside>

    <!-- Mobile Bottom Nav -->
    <nav class="md:hidden fixed bottom-4 left-0 w-full z-50 px-4">
        <div class="flex justify-center">
            <ul class="flex items-center justify-between w-full max-w-md bg-yellow-300 px-4 py-3 border-[3px] border-black brutal-shadow rotate-1">
                <li class="text-center w-1/4">
                    <a href="?tab=general" class="font-mono font-bold text-[10px] uppercase flex flex-col items-center <?php echo $tab === 'general' ? 'text-black scale-110' : 'text-gray-800 opacity-80'; ?>">
                        <i class="fa-solid fa-house mb-1 text-xl"></i><span>General</span>
                    </a>
                </li>
                <li class="text-center w-1/4">
                    <a href="?tab=music" class="font-mono font-bold text-[10px] uppercase flex flex-col items-center <?php echo $tab === 'music' ? 'text-black scale-110' : 'text-gray-800 opacity-80'; ?>">
                        <i class="fa-solid fa-music mb-1 text-xl"></i><span>Music</span>
                    </a>
                </li>
                <li class="text-center w-1/4">
                    <a href="?tab=viral" class="font-mono font-bold text-[10px] uppercase flex flex-col items-center <?php echo $tab === 'viral' ? 'text-black scale-110' : 'text-gray-800 opacity-80'; ?>">
                        <i class="fa-solid fa-fire mb-1 text-xl"></i><span>Viral</span>
                    </a>
                </li>
                <li class="text-center w-1/4">
                    <a href="?tab=gallery" class="font-mono font-bold text-[10px] uppercase flex flex-col items-center <?php echo $tab === 'gallery' ? 'text-black scale-110' : 'text-gray-800 opacity-80'; ?>">
                        <i class="fa-solid fa-camera mb-1 text-xl"></i><span>Gallery</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="flex-grow p-6 md:p-10 lg:p-14 overflow-y-auto relative z-10 w-full">
        <div class="max-w-5xl mx-auto">
            <?php if ($success): ?>
                <div class="bg-green-400 border-[4px] border-black font-black p-4 mb-10 brutal-shadow text-xl uppercase transform -rotate-1 relative group w-full md:w-auto inline-flex items-center gap-3 animate-pulse cursor-pointer" onclick="this.remove()">
                    <span><i class="fa-solid fa-check-circle"></i></span> <span><?php echo $success; ?></span>
                    <div class="absolute -top-2 -right-2 w-4 h-4 bg-yellow-300 rounded-full border-2 border-black"></div>
                </div>
            <?php endif; ?>

            <!-- TAB: GENERAL -->
            <?php if ($tab === 'general'): ?>
                <div class="mb-10 border-b-8 border-black border-dashed pb-8">
                    <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight">General Settings</h2>
                    <p class="text-gray-600 font-mono mt-3 text-sm md:text-base bg-yellow-100 inline-block px-2 border-2 border-black border-dashed">Full control over every piece of content on your site.</p>
                </div>
                <form action="../api/update.php" method="POST" enctype="multipart/form-data" class="space-y-16">
                    <input type="hidden" name="action" value="save_general">

                    <!-- HERO -->
                    <section class="bg-white border-4 border-black p-6 md:p-10 brutal-shadow-lg relative mt-4 group hover:border-[#ff00ff] transition-colors focus-within:border-[#ff00ff]">
                        <div class="absolute -top-5 -left-5 bg-yellow-300 border-4 border-black px-4 py-2 font-black transform -rotate-3 uppercase text-xl group-hover:rotate-0 transition-transform shadow-[4px_4px_0px_rgba(0,0,0,1)] z-10">Hero <i class="fa-solid fa-bolt"></i></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mt-8">
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center justify-between">Tagline <span class="text-gray-400 font-mono text-[10px]">e.g. @Prince_on_guitar</span></label>
                                <input type="text" name="hero[tag]" value="<?php echo htmlspecialchars($data['hero']['tag'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono text-base focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Location</label>
                                <input type="text" name="hero[location]" value="<?php echo htmlspecialchars($data['hero']['location'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono text-base focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">First Name</label>
                                <input type="text" name="hero[title_first]" value="<?php echo htmlspecialchars($data['hero']['title_first'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black text-2xl focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Last Name</label>
                                <input type="text" name="hero[title_last]" value="<?php echo htmlspecialchars($data['hero']['title_last'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black text-2xl focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">Subtitle</label>
                                <input type="text" name="hero[subtitle]" value="<?php echo htmlspecialchars($data['hero']['subtitle'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">CTA Button Text</label>
                                <input type="text" name="hero[cta]" value="<?php echo htmlspecialchars($data['hero']['cta'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black tracking-widest uppercase text-sm focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-yellow-50 focus:bg-yellow-300 text-center">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex justify-between">Image Caption <span class="text-gray-400 font-mono text-[10px]">Below hero photo</span></label>
                                <input type="text" name="hero[img_caption]" value="<?php echo htmlspecialchars($data['hero']['img_caption'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex justify-between">Badge Text <span class="text-gray-400 font-mono text-[10px]">Circle badge (use newline for 2 lines)</span></label>
                                <textarea name="hero[img_badge]" rows="2" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-gray-50 focus:bg-white resize-none"><?php echo htmlspecialchars($data['hero']['img_badge'] ?? ''); ?></textarea>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Hero Image</label>
                                <div class="flex items-center gap-4 bg-gray-50 border-[3px] border-black p-3 hover:bg-yellow-50 transition-colors">
                                    <div class="w-16 h-16 md:w-20 md:h-20 border-2 border-black flex-shrink-0 bg-white overflow-hidden flex items-center justify-center">
                                        <?php if (!empty($data['hero']['img'])): ?>
                                            <img src="../<?php echo htmlspecialchars($data['hero']['img']); ?>" class="w-full h-full object-cover">
                                        <?php else: ?><span class="text-[10px] uppercase font-bold text-gray-400">None</span><?php endif; ?>
                                    </div>
                                    <input type="file" name="hero_img" class="w-full text-xs font-mono file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:bg-yellow-300 file:text-black file:font-bold file:uppercase file:cursor-pointer file:hover:bg-black file:hover:text-white file:transition-colors focus:outline-none bg-transparent">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- ABOUT -->
                    <section class="bg-white border-4 border-black p-6 md:p-10 brutal-shadow-lg relative group hover:border-[#00e5ff] transition-colors focus-within:border-[#00e5ff] mt-20">
                        <div class="absolute -top-5 -left-5 bg-cyan-400 border-4 border-black px-4 py-2 font-black transform rotate-2 uppercase text-xl group-hover:rotate-0 transition-transform shadow-[4px_4px_0px_rgba(0,0,0,1)] z-10">About <i class="fa-solid fa-file-signature"></i></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mt-8">
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Section Title</label>
                                <input type="text" name="about[title]" value="<?php echo htmlspecialchars($data['about']['title'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black text-xl focus:outline-none focus:ring-[4px] focus:ring-cyan-400 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Image Caption</label>
                                <input type="text" name="about[img_caption]" value="<?php echo htmlspecialchars($data['about']['img_caption'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-cyan-400 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">Paragraph 1 <span class="text-gray-400 font-mono text-[10px]">Main intro text</span></label>
                                <textarea name="about[content_p1]" rows="3" class="border-[3px] border-black p-5 font-sans leading-relaxed focus:outline-none focus:ring-[4px] focus:ring-cyan-400 bg-gray-50 focus:bg-white resize-y"><?php echo htmlspecialchars($data['about']['content_p1'] ?? ''); ?></textarea>
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm flex justify-between">Highlighted Text <span class="bg-yellow-300 px-2 text-[10px] border border-black">Gets yellow highlight</span></label>
                                <input type="text" name="about[content_highlight]" value="<?php echo htmlspecialchars($data['about']['content_highlight'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-yellow-50 focus:bg-yellow-100">
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">Paragraph 2 <span class="text-gray-400 font-mono text-[10px]">Secondary text</span></label>
                                <textarea name="about[content_p2]" rows="4" class="border-[3px] border-black p-5 font-sans leading-relaxed focus:outline-none focus:ring-[4px] focus:ring-cyan-400 bg-gray-50 focus:bg-white resize-y"><?php echo htmlspecialchars($data['about']['content_p2'] ?? ''); ?></textarea>
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm flex justify-between">Keyword to Highlight in P2 <span class="bg-[#00e5ff] text-white px-2 text-[10px] border border-black">Gets blue highlight automatically</span></label>
                                <input type="text" name="about[content_p2_highlight]" value="<?php echo htmlspecialchars($data['about']['content_p2_highlight'] ?? ''); ?>" placeholder="e.g. Voice of Nepal Kids" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-cyan-400 bg-cyan-50 focus:bg-cyan-100">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Badge Icon</label>
                                <select name="about[badge_icon]" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-cyan-400 bg-white cursor-pointer">
                                    <?php foreach ($icon_options as $key => $label): ?>
                                        <option value="<?php echo $key; ?>" <?php echo ($data['about']['badge_icon'] ?? 'guitar') === $key ? 'selected' : ''; ?>><?php echo $label; ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Badge Text</label>
                                <input type="text" name="about[badge_text]" value="<?php echo htmlspecialchars($data['about']['badge_text'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black tracking-wider text-sm focus:outline-none focus:ring-[4px] focus:ring-cyan-400 bg-cyan-50 focus:bg-cyan-200">
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">About Image</label>
                                <div class="flex items-center gap-4 bg-gray-50 border-[3px] border-black p-3 md:w-2/3 hover:bg-cyan-50 transition-colors">
                                    <div class="w-16 h-16 md:w-20 md:h-20 border-2 border-black flex-shrink-0 bg-white overflow-hidden flex items-center justify-center">
                                        <?php if (!empty($data['about']['img'])): ?>
                                            <img src="../<?php echo htmlspecialchars($data['about']['img']); ?>" class="w-full h-full object-cover">
                                        <?php else: ?><span class="text-[10px] uppercase font-bold text-gray-400">None</span><?php endif; ?>
                                    </div>
                                    <input type="file" name="about_img" class="w-full text-xs font-mono file:mr-4 file:py-2 file:px-4 file:border-2 file:border-black file:bg-cyan-400 file:text-black file:font-bold file:uppercase file:cursor-pointer file:hover:bg-black file:hover:text-white file:transition-colors focus:outline-none bg-transparent">
                                </div>
                            </div>
                        </div>
                    </section>

                    <!-- CONTACT -->
                    <section class="bg-white border-4 border-black p-6 md:p-10 brutal-shadow-lg relative group hover:border-[#1DB954] transition-colors focus-within:border-[#1DB954] mt-20">
                        <div class="absolute -top-5 -left-5 bg-[#1DB954] border-4 border-black px-4 py-2 font-black transform -rotate-2 uppercase text-xl group-hover:rotate-0 transition-transform shadow-[4px_4px_0px_rgba(0,0,0,1)] z-10 text-white">Contact <i class="fa-solid fa-address-book"></i></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mt-8">
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Section Title</label>
                                <input type="text" name="contact[title]" value="<?php echo htmlspecialchars($data['contact']['title'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black text-xl focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Signature</label>
                                <input type="text" name="contact[signature]" value="<?php echo htmlspecialchars($data['contact']['signature'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Description Line 1</label>
                                <input type="text" name="contact[desc_p1]" value="<?php echo htmlspecialchars($data['contact']['desc_p1'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Description Line 2</label>
                                <input type="text" name="contact[desc_p2]" value="<?php echo htmlspecialchars($data['contact']['desc_p2'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-solid fa-envelope text-lg"></i> Email</label>
                                <input type="email" name="contact[email]" value="<?php echo htmlspecialchars($data['contact']['email'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-youtube text-red-500 text-lg"></i> YouTube</label>
                                <input type="url" name="contact[youtube]" value="<?php echo htmlspecialchars($data['contact']['youtube'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-red-400 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-instagram text-pink-500 text-lg"></i> Instagram</label>
                                <input type="url" name="contact[instagram]" value="<?php echo htmlspecialchars($data['contact']['instagram'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#ff00ff] bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-tiktok text-lg"></i> TikTok</label>
                                <input type="url" name="contact[tiktok]" value="<?php echo htmlspecialchars($data['contact']['tiktok'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-gray-400 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-spotify text-green-500 text-lg"></i> Spotify</label>
                                <input type="url" name="contact[spotify]" value="<?php echo htmlspecialchars($data['contact']['spotify'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-[#1DB954] bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Footer Text</label>
                                <input type="text" name="contact[footer]" value="<?php echo htmlspecialchars($data['contact']['footer'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-yellow-300 bg-gray-50 focus:bg-white">
                            </div>
                        </div>
                    </section>

                    <!-- SECTION TITLES -->
                    <section class="bg-white border-4 border-black p-6 md:p-10 brutal-shadow-lg relative group hover:border-orange-400 transition-colors mt-20">
                        <div class="absolute -top-5 -left-5 bg-orange-400 border-4 border-black px-4 py-2 font-black transform rotate-1 uppercase text-xl group-hover:rotate-0 transition-transform shadow-[4px_4px_0px_rgba(0,0,0,1)] z-10">Section Titles <i class="fa-solid fa-heading"></i></div>
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-x-10 gap-y-8 mt-8">
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Music Section Title</label>
                                <input type="text" name="music_section[title]" value="<?php echo htmlspecialchars($data['music']['title'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black text-xl focus:outline-none focus:ring-[4px] focus:ring-orange-300 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Music CTA Button Text</label>
                                <input type="text" name="music_section[cta]" value="<?php echo htmlspecialchars($data['music']['cta'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-orange-300 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2 md:col-span-2">
                                <label class="font-bold uppercase text-sm">Music CTA Link</label>
                                <input type="url" name="music_section[cta_link]" value="<?php echo htmlspecialchars($data['music']['cta_link'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-orange-300 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Gallery Section Title</label>
                                <input type="text" name="gallery_section[title]" value="<?php echo htmlspecialchars($data['gallery']['title'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black text-xl focus:outline-none focus:ring-[4px] focus:ring-orange-300 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Gallery Badge Text</label>
                                <input type="text" name="gallery_section[badge]" value="<?php echo htmlspecialchars($data['gallery']['badge'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-orange-300 bg-gray-50 focus:bg-white">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Viral Section Title</label>
                                <input type="text" name="viral_section[title]" value="<?php echo htmlspecialchars($data['viral']['title'] ?? ''); ?>" class="border-[3px] border-black p-4 font-black text-xl focus:outline-none focus:ring-[4px] focus:ring-orange-300 bg-transparent focus:bg-white border-b-8">
                            </div>
                            <div class="flex flex-col gap-2">
                                <label class="font-bold uppercase text-sm">Viral Section Subtitle</label>
                                <input type="text" name="viral_section[subtitle]" value="<?php echo htmlspecialchars($data['viral']['subtitle'] ?? ''); ?>" class="border-[3px] border-black p-4 font-mono focus:outline-none focus:ring-[4px] focus:ring-orange-300 bg-gray-50 focus:bg-white">
                            </div>
                        </div>
                    </section>

                    <div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-black text-white font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-gray-800 hover:scale-105 active:scale-95 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save All</button></div>
                </form>
            <?php endif; ?>

            <!-- TAB: MUSIC -->
            <?php if ($tab === 'music'): ?>
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6 border-b-8 border-black border-dashed pb-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-[#00c2d8]">Music Config</h2>
                        <p class="text-gray-600 font-mono mt-3 text-sm bg-cyan-100 inline-block px-2 border-2 border-black border-dashed">Manage your releases.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('music-modal').classList.remove('hidden')" class="bg-yellow-300 font-black flex items-center justify-center gap-3 border-[4px] border-black px-8 py-5 brutal-shadow hover:bg-yellow-400 hover:-translate-y-1 uppercase transition-all w-full text-xl md:text-2xl hover:scale-105 active:scale-95">
                        <span class="text-3xl leading-none block align-middle mt-[-4px]">+</span> Add Release
                    </button>
                </div>
                <form action="../api/update.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <input type="hidden" name="action" value="save_music">
                    <?php if (empty($data['music']['releases'])): ?>
                        <div class="bg-white border-[6px] border-dashed border-black p-16 flex flex-col items-center justify-center gap-6 brutal-shadow">
                            <span class="text-7xl animate-bounce"><i class="fa-solid fa-compact-disc"></i></span>
                            <p class="font-black uppercase text-3xl text-center">Your catalog is empty.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-14">
                            <?php foreach ($data['music']['releases'] as $index => $item): ?>
                                <div class="bg-white border-[6px] border-black p-6 md:p-8 pt-8 brutal-shadow flex flex-col gap-6 relative mt-4 group">
                                    <button type="button" onclick="confirmDelete('del-music-<?php echo $index; ?>', '<?php echo htmlspecialchars(addslashes($item['title'] ?: 'Item #' . ($index + 1))); ?>')" class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 rounded-full border-4 border-black brutal-shadow flex items-center justify-center hover:bg-red-700 hover:scale-110 active:scale-95 transition-all z-50" title="Delete"><i class="fa-solid fa-trash text-sm"></i></button>
                                    <div class="absolute -top-5 -left-5 bg-black text-[#00e5ff] border-4 border-black px-4 py-1.5 font-black transform -rotate-3 text-lg shadow-[4px_4px_0px_#00e5ff] group-hover:rotate-0 transition-transform z-10 flex items-center gap-2"><i class="fa-solid fa-compact-disc"></i> Release #<?php echo $index + 1; ?></div>
                                    <div class="flex flex-col xl:flex-row xl:items-center gap-5 mt-4 bg-white border-[3px] border-black p-4">
                                        <div class="w-full xl:w-24 h-48 xl:h-24 border-4 border-black bg-gray-100 flex-shrink-0 flex items-center justify-center overflow-hidden">
                                            <?php if (!empty($item['img'])): ?>
                                                <img src="../<?php echo htmlspecialchars($item['img']); ?>" class="w-full h-full object-cover">
                                            <?php else: ?><span class="text-xs font-black text-gray-300 uppercase">Empty</span><?php endif; ?>
                                        </div>
                                        <div class="flex-grow w-full overflow-hidden">
                                            <label class="font-bold uppercase text-xs mb-2 block text-gray-600 bg-gray-100 pl-2 border-l-4 border-cyan-400">Cover</label>
                                            <input type="hidden" name="music_releases[<?php echo $index; ?>][existing_img]" value="<?php echo htmlspecialchars($item['img'] ?? ''); ?>">
                                            <input type="file" name="music_img_<?php echo $index; ?>" class="w-full text-xs font-mono file:mr-3 file:py-1.5 file:px-3 file:border-2 file:border-black file:bg-[transparent] file:text-black file:hover:bg-black file:hover:text-white file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none truncate bg-white border-2 border-dashed border-gray-300 hover:border-black p-1">
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-5 mt-2">
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Title</label>
                                            <input type="text" name="music_releases[<?php echo $index; ?>][title]" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" placeholder="Enter Title..." class="border-b-[4px] border-black pb-2 font-black text-2xl md:text-3xl focus:outline-none focus:border-cyan-400 bg-transparent placeholder-gray-200">
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Description</label>
                                            <input type="text" name="music_releases[<?php echo $index; ?>][desc]" value="<?php echo htmlspecialchars($item['desc'] ?? ''); ?>" class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-cyan-200 bg-white">
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Listen Link</label>
                                            <input type="url" name="music_releases[<?php echo $index; ?>][link]" value="<?php echo htmlspecialchars($item['link'] ?? ''); ?>" class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-cyan-200 bg-white">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-[#00e5ff] text-black font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-cyan-300 hover:scale-105 active:scale-95 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Music</button></div>
                    <?php endif; ?>
                </form>
            <?php endif; ?>

            <!-- TAB: VIRAL -->
            <?php if ($tab === 'viral'): ?>
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6 border-b-8 border-black border-dashed pb-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-[#ff00ff]">Viral Content</h2>
                        <p class="text-gray-600 font-mono mt-3 text-sm bg-pink-100 inline-block px-2 border-2 border-black border-dashed">Showcase your viral short-form content.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('viral-modal').classList.remove('hidden')" class="bg-[#ff00ff] text-white font-black flex items-center justify-center gap-3 border-[4px] border-black px-8 py-5 brutal-shadow hover:bg-pink-600 hover:-translate-y-1 uppercase transition-all w-full text-xl md:text-2xl hover:scale-105 active:scale-95">
                        <span class="text-3xl leading-none block align-middle mt-[-4px]">+</span> Add Content
                    </button>
                </div>
                <form action="../api/update.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <input type="hidden" name="action" value="save_viral">
                    <?php if (empty($data['viral']['items'])): ?>
                        <div class="bg-white border-[6px] border-dashed border-black p-16 flex flex-col items-center justify-center gap-6 brutal-shadow">
                            <span class="text-7xl animate-bounce"><i class="fa-solid fa-fire"></i></span>
                            <p class="font-black uppercase text-3xl text-center">No viral content yet.</p>
                            <p class="text-gray-600 font-mono text-base text-center">Click the pink button above to add your first viral hit.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-x-8 gap-y-14">
                            <?php
                            $platform_labels = ['tiktok'=>'TikTok','instagram'=>'Instagram','youtube'=>'YouTube','facebook'=>'Facebook','twitter'=>'X/Twitter','other'=>'Other'];
                            foreach ($data['viral']['items'] as $index => $item): ?>
                                <div class="bg-white border-[6px] border-black p-6 md:p-8 pt-8 brutal-shadow flex flex-col gap-6 relative mt-4 group">
                                    <button type="button" onclick="confirmDelete('del-viral-<?php echo $index; ?>', '<?php echo htmlspecialchars(addslashes($item['title'] ?: 'Item #' . ($index + 1))); ?>')" class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 rounded-full border-4 border-black brutal-shadow flex items-center justify-center hover:bg-red-700 hover:scale-110 active:scale-95 transition-all z-50"><i class="fa-solid fa-trash text-sm"></i></button>
                                    <div class="absolute -top-5 -left-5 bg-[#ff00ff] text-white border-4 border-black px-4 py-1.5 font-black transform rotate-2 text-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] group-hover:rotate-0 transition-transform z-10 flex items-center gap-2"><i class="fa-solid fa-fire"></i> #<?php echo $index + 1; ?></div>
                                    <div class="flex flex-col gap-5 mt-4">
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Title</label>
                                            <input type="text" name="viral_items[<?php echo $index; ?>][title]" value="<?php echo htmlspecialchars($item['title'] ?? ''); ?>" class="border-b-[4px] border-black pb-2 font-black text-2xl focus:outline-none focus:border-[#ff00ff] bg-transparent placeholder-gray-200">
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Content URL</label>
                                            <input type="url" name="viral_items[<?php echo $index; ?>][url]" value="<?php echo htmlspecialchars($item['url'] ?? ''); ?>" class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-pink-200 bg-white" oninput="validateViralUrl(this)">
                                            <div class="url-validation-error text-red-600 text-xs font-bold hidden"><i class="fa-solid fa-exclamation-circle"></i> Unsupported platform</div>
                                        </div>
                                        <div class="grid grid-cols-2 gap-4">
                                            <div class="flex flex-col gap-1.5">
                                                <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Platform</label>
                                                <select name="viral_items[<?php echo $index; ?>][platform]" class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-pink-200 bg-white cursor-pointer">
                                                    <?php foreach ($platform_labels as $pk => $pl): ?>
                                                        <option value="<?php echo $pk; ?>" <?php echo ($item['platform'] ?? '') === $pk ? 'selected' : ''; ?>><?php echo $pl; ?></option>
                                                    <?php endforeach; ?>
                                                </select>
                                            </div>
                                            <div class="flex flex-col gap-1.5">
                                                <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Views</label>
                                                <input type="text" name="viral_items[<?php echo $index; ?>][views]" value="<?php echo htmlspecialchars($item['views'] ?? ''); ?>" placeholder="e.g. 2.5M" class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-pink-200 bg-white">
                                            </div>
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Thumbnail <span class="text-[9px] bg-gray-200 px-1">Optional - upload or leave for platform logo</span></label>
                                            <input type="hidden" name="viral_items[<?php echo $index; ?>][existing_thumbnail]" value="<?php echo htmlspecialchars($item['thumbnail'] ?? ''); ?>">
                                            <input type="file" name="viral_thumb_<?php echo $index; ?>" class="w-full text-xs font-mono file:mr-3 file:py-1.5 file:px-3 file:border-2 file:border-black file:bg-[transparent] file:text-black file:hover:bg-black file:hover:text-white file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none bg-white border-2 border-dashed border-gray-300 hover:border-black p-1">
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-[#ff00ff] text-white font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-pink-600 hover:scale-105 active:scale-95 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Viral</button></div>
                    <?php endif; ?>
                </form>
            <?php endif; ?>

            <!-- TAB: GALLERY -->
            <?php if ($tab === 'gallery'): ?>
                <div class="flex flex-col md:flex-row md:items-end justify-between mb-10 gap-6 border-b-8 border-black border-dashed pb-8">
                    <div>
                        <h2 class="text-4xl md:text-6xl font-black uppercase tracking-tight text-[#d900d9]">Gallery Config</h2>
                        <p class="text-gray-600 font-mono mt-3 text-sm bg-pink-100 inline-block px-2 border-2 border-black border-dashed">Manage your digital scrapbook.</p>
                    </div>
                    <button type="button" onclick="document.getElementById('gallery-modal').classList.remove('hidden')" class="bg-[#ff00ff] text-white font-black flex items-center justify-center gap-3 border-[4px] border-black px-8 py-5 brutal-shadow hover:bg-pink-600 hover:-translate-y-1 uppercase transition-all w-full text-xl md:text-2xl hover:scale-105 active:scale-95">
                        <span class="text-3xl leading-none block align-middle mt-[-4px]">+</span> Add Photo
                    </button>
                </div>
                <form action="../api/update.php" method="POST" enctype="multipart/form-data" class="space-y-10">
                    <input type="hidden" name="action" value="save_gallery">
                    <?php if (empty($data['gallery']['images'])): ?>
                        <div class="bg-white border-[6px] border-dashed border-black p-16 flex flex-col items-center justify-center gap-6 brutal-shadow">
                            <span class="text-7xl"><i class="fa-solid fa-camera"></i></span>
                            <p class="font-black uppercase text-3xl text-center">Your scrapbook is empty.</p>
                        </div>
                    <?php else: ?>
                        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8 gap-y-14">
                            <?php foreach ($data['gallery']['images'] as $index => $item): ?>
                                <div class="bg-white border-[6px] border-black p-6 md:p-8 pt-8 brutal-shadow flex flex-col gap-6 relative mt-4 group">
                                    <button type="button" onclick="confirmDelete('del-gallery-<?php echo $index; ?>', 'Photo #<?php echo $index + 1; ?>')" class="absolute -top-4 -right-4 bg-red-500 text-white w-10 h-10 rounded-full border-4 border-black brutal-shadow flex items-center justify-center hover:bg-red-700 hover:scale-110 active:scale-95 transition-all z-50"><i class="fa-solid fa-trash text-sm"></i></button>
                                    <div class="absolute -top-5 -left-5 bg-[#ff00ff] text-white border-4 border-black px-4 py-1.5 font-black transform rotate-2 text-lg shadow-[4px_4px_0px_rgba(0,0,0,1)] group-hover:rotate-0 transition-transform z-10 flex items-center gap-2"><i class="fa-solid fa-camera"></i> Frame #<?php echo $index + 1; ?></div>
                                    <div class="flex flex-col xl:flex-row xl:items-center gap-5 mt-4 bg-white border-[3px] border-black p-4">
                                        <div class="w-full xl:w-28 h-48 xl:h-28 flex-shrink-0 overflow-hidden border-2 border-gray-300 bg-gray-100">
                                            <?php if (!empty($item['img'])): ?>
                                                <img src="../<?php echo htmlspecialchars($item['img']); ?>" class="w-full h-full object-cover">
                                            <?php else: ?><div class="w-full h-full flex items-center justify-center"><span class="text-[10px] font-black text-gray-400 uppercase">No Image</span></div><?php endif; ?>
                                        </div>
                                        <div class="flex-grow w-full overflow-hidden">
                                            <label class="font-bold uppercase text-xs mb-2 block text-gray-600 bg-gray-100 pl-2 border-l-4 border-[#ff00ff]">Image</label>
                                            <input type="hidden" name="gallery_images[<?php echo $index; ?>][existing_img]" value="<?php echo htmlspecialchars($item['img'] ?? ''); ?>">
                                            <input type="file" name="gallery_img_<?php echo $index; ?>" class="w-full text-xs font-mono file:mr-3 file:py-1.5 file:px-3 file:border-2 file:border-black file:bg-[transparent] file:text-black file:hover:bg-black file:hover:text-white file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none truncate bg-white border-2 border-dashed border-gray-300 hover:border-black p-1">
                                        </div>
                                    </div>
                                    <div class="flex flex-col gap-5 mt-2">
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Caption</label>
                                            <input type="text" name="gallery_images[<?php echo $index; ?>][caption]" value="<?php echo htmlspecialchars($item['caption'] ?? ''); ?>" class="border-b-[4px] border-black pb-2 font-black text-2xl focus:outline-none focus:border-[#ff00ff] bg-transparent placeholder-gray-200">
                                        </div>
                                        <div class="flex flex-col gap-1.5">
                                            <label class="font-bold uppercase text-[10px] text-gray-400 tracking-widest">Photo Size</label>
                                            <select name="gallery_images[<?php echo $index; ?>][size]" class="border-[3px] border-black p-3 font-mono text-sm focus:outline-none focus:ring-[4px] focus:ring-pink-200 bg-white cursor-pointer">
                                                <option value="small" <?php echo ($item['size'] ?? 'medium') === 'small' ? 'selected' : ''; ?>>Small</option>
                                                <option value="medium" <?php echo ($item['size'] ?? 'medium') === 'medium' ? 'selected' : ''; ?>>Medium</option>
                                                <option value="large" <?php echo ($item['size'] ?? 'medium') === 'large' ? 'selected' : ''; ?>>Large</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach; ?>
                        </div>
                        <div class="fixed bottom-24 md:bottom-10 right-6 z-[90]"><button type="submit" class="bg-[#ff00ff] text-white font-black text-xl md:text-2xl px-8 py-4 uppercase tracking-widest border-[4px] border-black brutal-shadow-lg hover:bg-pink-600 hover:scale-105 active:scale-95 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Gallery</button></div>
                    <?php endif; ?>
                </form>
            <?php endif; ?>

        </div>
    </main>

    <!-- Hidden Delete Forms -->
    <?php if (!empty($data['music']['releases'])): foreach ($data['music']['releases'] as $index => $item): ?>
        <form id="del-music-<?php echo $index; ?>" method="POST" action="../api/update.php" class="hidden"><input type="hidden" name="action" value="delete_music_item"><input type="hidden" name="delete_index" value="<?php echo $index; ?>"></form>
    <?php endforeach; endif; ?>
    <?php if (!empty($data['gallery']['images'])): foreach ($data['gallery']['images'] as $index => $item): ?>
        <form id="del-gallery-<?php echo $index; ?>" method="POST" action="../api/update.php" class="hidden"><input type="hidden" name="action" value="delete_gallery_item"><input type="hidden" name="delete_index" value="<?php echo $index; ?>"></form>
    <?php endforeach; endif; ?>
    <?php if (!empty($data['viral']['items'])): foreach ($data['viral']['items'] as $index => $item): ?>
        <form id="del-viral-<?php echo $index; ?>" method="POST" action="../api/update.php" class="hidden"><input type="hidden" name="action" value="delete_viral_item"><input type="hidden" name="delete_index" value="<?php echo $index; ?>"></form>
    <?php endforeach; endif; ?>

    <!-- Music Modal -->
    <div id="music-modal" class="hidden fixed inset-0 z-[100] bg-black bg-opacity-70 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white border-[6px] border-black brutal-shadow-lg w-full max-w-lg overflow-hidden transform -rotate-1">
            <div class="bg-yellow-300 border-b-4 border-black p-4 flex justify-between items-center">
                <h2 class="font-black text-2xl uppercase tracking-widest"><i class="fa-solid fa-music"></i> Add Track</h2>
                <button type="button" onclick="document.getElementById('music-modal').classList.add('hidden')" class="text-3xl font-black hover:text-red-600">&times;</button>
            </div>
            <form action="../api/update.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                <input type="hidden" name="action" value="add_music_item_with_data">
                <div><label class="block font-bold mb-2 uppercase text-sm">Cover Image</label><input type="file" name="music_img_new" class="w-full text-sm font-mono file:mr-3 file:py-2 file:px-4 file:border-4 file:border-black file:bg-[transparent] file:text-black file:hover:bg-yellow-300 file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none bg-gray-50 border-[3px] border-black p-2 h-14"></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Track Title</label><input type="text" name="music_meta[title]" required placeholder="E.g. Summer Vibes" class="w-full border-[3px] border-black p-3 font-black text-xl focus:outline-none focus:ring-4 focus:ring-cyan-200 bg-white"></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Description</label><input type="text" name="music_meta[desc]" placeholder="Small description..." class="w-full border-[3px] border-black p-3 font-mono focus:outline-none focus:ring-4 focus:ring-cyan-200 bg-white"></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Link</label><input type="url" name="music_meta[link]" placeholder="https://..." class="w-full border-[3px] border-black p-3 font-mono focus:outline-none focus:ring-4 focus:ring-cyan-200 bg-white"></div>
                <button type="submit" class="w-full bg-black text-white font-black text-xl p-4 uppercase border-[4px] border-black brutal-shadow hover:bg-gray-800 hover:-translate-y-1"><i class="fa-solid fa-plus"></i> Create Release</button>
            </form>
        </div>
    </div>

    <!-- Gallery Modal -->
    <div id="gallery-modal" class="hidden fixed inset-0 z-[100] bg-black bg-opacity-70 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white border-[6px] border-black brutal-shadow-lg w-full max-w-lg overflow-hidden transform rotate-1">
            <div class="bg-[#ff00ff] text-white border-b-4 border-black p-4 flex justify-between items-center">
                <h2 class="font-black text-2xl uppercase tracking-widest"><i class="fa-solid fa-camera"></i> Add Photo</h2>
                <button type="button" onclick="document.getElementById('gallery-modal').classList.add('hidden')" class="text-3xl font-black hover:text-black">&times;</button>
            </div>
            <form action="../api/update.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                <input type="hidden" name="action" value="add_gallery_item_with_data">
                <div><label class="block font-bold mb-2 uppercase text-sm">Upload Image</label><input type="file" name="gallery_img_new" class="w-full text-sm font-mono file:mr-3 file:py-2 file:px-4 file:border-4 file:border-black file:bg-[transparent] file:text-black file:hover:bg-[#ff00ff] file:hover:text-white file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none bg-gray-50 border-[3px] border-black p-2 h-14"></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Caption</label><input type="text" name="gallery_meta[caption]" required placeholder="E.g. Great memories" class="w-full border-[3px] border-black p-3 font-black text-xl focus:outline-none focus:ring-4 focus:ring-pink-200 bg-white"></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Photo Size</label>
                    <select name="gallery_meta[size]" class="w-full border-[3px] border-black p-3 font-mono focus:outline-none focus:ring-4 focus:ring-pink-200 bg-white cursor-pointer">
                        <option value="small">Small</option><option value="medium" selected>Medium</option><option value="large">Large</option>
                    </select>
                </div>
                <button type="submit" class="w-full bg-black text-white font-black text-xl p-4 uppercase border-[4px] border-black brutal-shadow hover:bg-gray-800 hover:-translate-y-1"><i class="fa-solid fa-plus"></i> Upload Photo</button>
            </form>
        </div>
    </div>

    <!-- Viral Modal -->
    <div id="viral-modal" class="hidden fixed inset-0 z-[100] bg-black bg-opacity-70 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white border-[6px] border-black brutal-shadow-lg w-full max-w-lg overflow-hidden transform -rotate-1">
            <div class="bg-[#ff00ff] text-white border-b-4 border-black p-4 flex justify-between items-center">
                <h2 class="font-black text-2xl uppercase tracking-widest"><i class="fa-solid fa-fire"></i> Add Viral</h2>
                <button type="button" onclick="document.getElementById('viral-modal').classList.add('hidden')" class="text-3xl font-black hover:text-black">&times;</button>
            </div>
            <form action="../api/update.php" method="POST" enctype="multipart/form-data" class="p-6 space-y-6">
                <input type="hidden" name="action" value="add_viral_item">
                <div><label class="block font-bold mb-2 uppercase text-sm">Content URL</label><input type="url" name="viral_meta[url]" required placeholder="https://tiktok.com/..." id="viral-url-input" class="w-full border-[3px] border-black p-3 font-mono focus:outline-none focus:ring-4 focus:ring-pink-200 bg-white" oninput="validateAndDetectPlatform(this.value)"><div id="url-error" class="text-red-600 text-xs font-bold mt-1 hidden"><i class="fa-solid fa-exclamation-circle"></i> Unsupported platform. Try TikTok, YouTube, Instagram, Facebook, or Twitter.</div></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Platform <span id="detected-platform" class="text-[10px] bg-pink-100 px-2 border border-black ml-2"></span></label>
                    <select name="viral_meta[platform]" id="viral-platform-select" class="w-full border-[3px] border-black p-3 font-mono focus:outline-none focus:ring-4 focus:ring-pink-200 bg-white cursor-pointer">
                        <option value="auto">Auto-detect from URL</option><option value="tiktok">TikTok</option><option value="instagram">Instagram</option><option value="youtube">YouTube</option><option value="facebook">Facebook</option><option value="twitter">X/Twitter</option><option value="other">Other</option>
                    </select>
                </div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Title</label><input type="text" name="viral_meta[title]" required placeholder="E.g. Guitar solo that broke the internet" class="w-full border-[3px] border-black p-3 font-black text-xl focus:outline-none focus:ring-4 focus:ring-pink-200 bg-white"></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">View Count</label><input type="text" name="viral_meta[views]" placeholder="E.g. 2.5M or 500K" class="w-full border-[3px] border-black p-3 font-mono focus:outline-none focus:ring-4 focus:ring-pink-200 bg-white"></div>
                <div><label class="block font-bold mb-2 uppercase text-sm">Thumbnail <span class="text-[10px] text-gray-500">Optional - auto-fetches from URL or upload image</span></label><div id="thumbnail-preview" class="hidden mb-3 border-[3px] border-black bg-gray-100 h-32 flex items-center justify-center overflow-hidden"><img id="preview-img" class="w-full h-full object-cover"></div><input type="file" name="viral_thumb_new" id="viral-thumb-input" class="w-full text-sm font-mono file:mr-3 file:py-2 file:px-4 file:border-4 file:border-black file:bg-[transparent] file:text-black file:hover:bg-[#ff00ff] file:hover:text-white file:transition-colors file:font-bold file:uppercase cursor-pointer focus:outline-none bg-gray-50 border-[3px] border-black p-2 h-14"></div>
                <button type="submit" class="w-full bg-black text-white font-black text-xl p-4 uppercase border-[4px] border-black brutal-shadow hover:bg-gray-800 hover:-translate-y-1"><i class="fa-solid fa-plus"></i> Add Viral Content</button>
            </form>
        </div>
    </div>

    <!-- Delete Modal -->
    <div id="delete-modal" class="hidden fixed inset-0 z-[200] bg-black bg-opacity-70 flex items-center justify-center p-4 backdrop-blur-sm">
        <div class="bg-white border-[6px] border-black brutal-shadow-lg w-full max-w-sm overflow-hidden transform -rotate-1 relative">
            <div class="absolute -top-4 -right-4 bg-red-500 w-12 h-12 rounded-full border-4 border-black z-0"></div>
            <div class="bg-red-600 text-white border-b-4 border-black p-4 flex justify-between items-center relative z-10">
                <h2 class="font-black text-2xl uppercase tracking-widest"><i class="fa-solid fa-triangle-exclamation"></i> Warning</h2>
            </div>
            <div class="p-6 relative z-10">
                <p class="font-bold text-lg mb-6 leading-tight border-b-2 border-red-200 pb-4">Are you sure you want to delete <br /><span id="delete-target-name" class="font-black text-red-600 text-xl inline-block mt-2 bg-red-100 px-2 py-1 transform rotate-1 border-2 border-red-300"></span>?</p>
                <div class="flex gap-4">
                    <button type="button" onclick="closeDeleteModal()" class="flex-1 bg-white text-black font-black p-3 border-[4px] border-black brutal-shadow hover:-translate-y-1 active:translate-y-0 transition-transform uppercase">Cancel</button>
                    <button type="button" id="confirm-delete-btn" class="flex-1 bg-red-600 text-white font-black p-3 border-[4px] border-black brutal-shadow hover:bg-red-700 hover:-translate-y-1 active:translate-y-0 transition-transform uppercase">Delete It!</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        let currentDeleteFormId = null;
        function confirmDelete(formId, targetName) {
            currentDeleteFormId = formId;
            document.getElementById('delete-target-name').innerText = targetName;
            document.getElementById('delete-modal').classList.remove('hidden');
        }
        function closeDeleteModal() {
            document.getElementById('delete-modal').classList.add('hidden');
            currentDeleteFormId = null;
        }
        document.getElementById('confirm-delete-btn').addEventListener('click', function () {
            if (currentDeleteFormId) { document.getElementById(currentDeleteFormId).submit(); }
        });

        // Platform auto-detection and URL validation for viral modal
        function validateAndDetectPlatform(url) {
            const el = document.getElementById('detected-platform');
            const sel = document.getElementById('viral-platform-select');
            const errorEl = document.getElementById('url-error');
            url = url.toLowerCase();
            let platform = '';
            let isSupported = false;
            
            if (url.includes('tiktok.com')) { platform = 'tiktok'; isSupported = true; }
            else if (url.includes('instagram.com')) { platform = 'instagram'; isSupported = true; }
            else if (url.includes('youtube.com') || url.includes('youtu.be')) { platform = 'youtube'; isSupported = true; }
            else if (url.includes('facebook.com') || url.includes('fb.watch')) { platform = 'facebook'; isSupported = true; }
            else if (url.includes('twitter.com') || url.includes('x.com')) { platform = 'twitter'; isSupported = true; }
            
            if (platform) {
                el.textContent = 'Detected: ' + platform.charAt(0).toUpperCase() + platform.slice(1);
                sel.value = platform;
                errorEl.classList.add('hidden');
                // Auto-fetch thumbnail preview
                fetchThumbnailPreview(platform, url);
            } else if (url.length > 0) {
                el.textContent = '';
                sel.value = 'auto';
                errorEl.classList.remove('hidden');
            } else {
                el.textContent = '';
                sel.value = 'auto';
                errorEl.classList.add('hidden');
            }
        }
        
        function detectPlatform(url) {
            validateAndDetectPlatform(url);
        }
        
        // Fetch thumbnail preview from social media
        function fetchThumbnailPreview(platform, url) {
            const previewEl = document.getElementById('thumbnail-preview');
            const imgEl = document.getElementById('preview-img');
            
            let thumbnailUrl = '';
            
            if (platform === 'youtube') {
                const match = url.match(/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i);
                if (match && match[1]) {
                    thumbnailUrl = `https://img.youtube.com/vi/${match[1]}/hqdefault.jpg`;
                }
            } else if (platform === 'tiktok') {
                // Note: TikTok oEmbed requires async fetch, showing loading state
                fetchTikTokThumbnail(url, imgEl, previewEl);
                return;
            } else if (platform === 'instagram') {
                // Instagram oEmbed requires async fetch
                fetchInstagramThumbnail(url, imgEl, previewEl);
                return;
            }
            
            if (thumbnailUrl) {
                imgEl.src = thumbnailUrl;
                previewEl.classList.remove('hidden');
            } else {
                previewEl.classList.add('hidden');
            }
        }
        
        function fetchTikTokThumbnail(url, imgEl, previewEl) {
            // TikTok oEmbed endpoint
            fetch(`https://www.tiktok.com/oembed?url=${encodeURIComponent(url)}`)
                .then(r => r.json())
                .catch(e => console.log('TikTok thumbnail fetch failed'))
                .then(data => {
                    if (data && data.thumbnail_url) {
                        imgEl.src = data.thumbnail_url;
                        previewEl.classList.remove('hidden');
                    }
                });
        }
        
        function fetchInstagramThumbnail(url, imgEl, previewEl) {
            // Instagram oEmbed endpoint
            fetch(`https://graph.facebook.com/v18.0/instagram_oembed?url=${encodeURIComponent(url)}`)
                .then(r => r.json())
                .catch(e => console.log('Instagram thumbnail fetch failed'))
                .then(data => {
                    if (data && data.thumbnail_url) {
                        imgEl.src = data.thumbnail_url;
                        previewEl.classList.remove('hidden');
                    }
                });
        }
        
        // Validate viral URL on existing items
        function validateViralUrl(inputEl) {
            const url = inputEl.value.toLowerCase();
            const errorEl = inputEl.parentElement.querySelector('.url-validation-error');
            
            let isSupported = false;
            if (url.includes('tiktok.com') || url.includes('instagram.com') || 
                url.includes('youtube.com') || url.includes('youtu.be') ||
                url.includes('facebook.com') || url.includes('fb.watch') ||
                url.includes('twitter.com') || url.includes('x.com')) {
                isSupported = true;
            }
            
            if (url.length > 0 && !isSupported) {
                errorEl.classList.remove('hidden');
            } else {
                errorEl.classList.add('hidden');
            }
        }
        
        // Handle thumbnail file upload preview
        document.getElementById('viral-thumb-input')?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('preview-img').src = event.target.result;
                    document.getElementById('thumbnail-preview').classList.remove('hidden');
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
</body>
</html>