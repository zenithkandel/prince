<?php
$analytics = $data['analytics'] ?? [];
$engagement = $analytics['engagement'] ?? ['labels' => [], 'instagram_guitar' => [], 'instagram_music' => []];
$content_mix = $analytics['content_mix'] ?? ['labels' => [], 'values' => [], 'colors' => []];
$music_stats = $analytics['music_stats'] ?? [];
$quick = $analytics['quick_stats'] ?? [];
$releases = $data['music']['releases'] ?? [];

// Build a lookup of existing stats by track title
$stats_by_title = [];
foreach ($music_stats as $ms) {
    $stats_by_title[$ms['title']] = $ms;
}
?>

<!-- TAB: ANALYTICS -->
<div class="mb-10 border-b-8 border-black border-dashed pb-8">
    <h2 class="text-3xl sm:text-4xl md:text-6xl font-black uppercase tracking-tight text-[#00e5ff]">Analytics</h2>
    <p class="text-gray-600 font-mono mt-3 text-sm bg-cyan-100 inline-block px-2 border-2 border-black border-dashed">Track your growth across all platforms.</p>
</div>

<!-- Quick Stats Dashboard -->
<div class="mb-10">
    <h3 class="font-black text-xl uppercase mb-4 flex items-center gap-2"><i class="fa-solid fa-chart-simple text-[#00e5ff]"></i> Current Stats</h3>
    <form action="../api/update.php" method="POST" class="space-y-4">
        <input type="hidden" name="action" value="save_analytics_quick">
        <div class="grid grid-cols-2 md:grid-cols-4 gap-3">
            <div class="bg-white border-4 border-black p-4 brutal-shadow relative">
                <div class="absolute -top-3 -left-3 bg-[#00e5ff] border-2 border-black px-2 py-0.5 font-black text-[10px] uppercase transform -rotate-3">Followers</div>
                <input type="number" name="quick_stats[total_followers]" value="<?php echo htmlspecialchars($quick['total_followers'] ?? 0); ?>" class="w-full border-b-4 border-black pb-1 font-black text-2xl md:text-3xl focus:outline-none focus:border-[#ff00ff] bg-transparent text-center mt-2">
                <p class="font-mono text-[10px] text-gray-400 text-center mt-1 uppercase">Total Followers</p>
            </div>
            <div class="bg-white border-4 border-black p-4 brutal-shadow relative">
                <div class="absolute -top-3 -left-3 bg-[#ff00ff] text-white border-2 border-black px-2 py-0.5 font-black text-[10px] uppercase transform rotate-2">Streams</div>
                <input type="number" name="quick_stats[total_streams]" value="<?php echo htmlspecialchars($quick['total_streams'] ?? 0); ?>" class="w-full border-b-4 border-black pb-1 font-black text-2xl md:text-3xl focus:outline-none focus:border-[#00e5ff] bg-transparent text-center mt-2">
                <p class="font-mono text-[10px] text-gray-400 text-center mt-1 uppercase">Total Streams</p>
            </div>
            <div class="bg-white border-4 border-black p-4 brutal-shadow relative">
                <div class="absolute -top-3 -left-3 bg-yellow-300 border-2 border-black px-2 py-0.5 font-black text-[10px] uppercase transform -rotate-2">Views</div>
                <input type="text" name="quick_stats[total_views]" value="<?php echo htmlspecialchars($quick['total_views'] ?? '0'); ?>" class="w-full border-b-4 border-black pb-1 font-black text-2xl md:text-3xl focus:outline-none focus:border-[#ff00ff] bg-transparent text-center mt-2" placeholder="e.g. 1.2M">
                <p class="font-mono text-[10px] text-gray-400 text-center mt-1 uppercase">Total Views</p>
            </div>
            <div class="bg-white border-4 border-black p-4 brutal-shadow relative">
                <div class="absolute -top-3 -left-3 bg-green-400 border-2 border-black px-2 py-0.5 font-black text-[10px] uppercase transform rotate-3">Growth</div>
                <input type="text" name="quick_stats[growth_rate]" value="<?php echo htmlspecialchars($quick['growth_rate'] ?? '0%'); ?>" class="w-full border-b-4 border-black pb-1 font-black text-2xl md:text-3xl focus:outline-none focus:border-[#ff00ff] bg-transparent text-center mt-2" placeholder="e.g. +185%">
                <p class="font-mono text-[10px] text-gray-400 text-center mt-1 uppercase">Growth Rate</p>
            </div>
        </div>
        <!-- IG Account Followers (feeds the doughnut chart) -->
        <div class="bg-white border-[3px] border-black p-4 brutal-shadow">
            <p class="font-black text-sm uppercase mb-3 flex items-center gap-2"><i class="fa-brands fa-instagram text-[#E1306C]"></i> Instagram Account Followers</p>
            <div class="grid grid-cols-2 gap-3">
                <div class="bg-gray-50 border-2 border-black p-3">
                    <label class="font-mono text-[10px] font-bold uppercase flex items-center gap-1 mb-1"><span class="w-2 h-2 border border-black" style="background:#E1306C"></span> @prince_on_guitar</label>
                    <input type="number" name="ig_accounts[guitar]" value="<?php echo htmlspecialchars($analytics['ig_accounts']['guitar'] ?? 0); ?>" class="w-full font-mono text-lg font-bold border-b-2 border-black focus:outline-none focus:border-[#E1306C] bg-transparent" min="0">
                </div>
                <div class="bg-gray-50 border-2 border-black p-3">
                    <label class="font-mono text-[10px] font-bold uppercase flex items-center gap-1 mb-1"><span class="w-2 h-2 border border-black" style="background:#833AB4"></span> @audiophile_prince</label>
                    <input type="number" name="ig_accounts[music]" value="<?php echo htmlspecialchars($analytics['ig_accounts']['music'] ?? 0); ?>" class="w-full font-mono text-lg font-bold border-b-2 border-black focus:outline-none focus:border-[#833AB4] bg-transparent" min="0">
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white font-black text-lg px-6 py-3 uppercase border-[4px] border-black brutal-shadow hover:bg-gray-800 hover:-translate-y-1 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Stats</button>
        </div>
    </form>
</div>

<!-- Engagement Data -->
<div class="mb-10">
    <h3 class="font-black text-xl uppercase mb-4 flex items-center gap-2"><i class="fa-solid fa-bolt text-yellow-400"></i> Engagement Rates</h3>
    <p class="text-gray-500 font-mono text-xs mb-4 bg-yellow-50 inline-block px-2 border border-black border-dashed">Rate each content type from 0-100 based on how well it performs.</p>
    <form action="../api/update.php" method="POST" class="space-y-4">
        <input type="hidden" name="action" value="save_analytics_engagement">
        <div class="bg-white border-[3px] border-black p-4 sm:p-6 brutal-shadow">
            <div class="mb-4">
                <label class="font-black uppercase text-sm flex items-center gap-2 mb-3">
                    <span class="w-4 h-4 rounded-sm border-2 border-black" style="background:#E1306C"></span> @prince_on_guitar Engagement
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    <?php
                    $eng_labels = $engagement['labels'] ?? ['Reels', 'Stories', 'Posts', 'Lives', 'Collabs'];
                    $eng_guitar = $engagement['instagram_guitar'] ?? [85, 45, 60, 30, 70];
                    foreach ($eng_labels as $eli => $el):
                    ?>
                        <div class="flex flex-col gap-1">
                            <label class="font-mono text-[10px] font-bold uppercase text-gray-500"><?php echo htmlspecialchars($el); ?></label>
                            <div class="relative">
                                <input type="range" name="engagement_guitar[<?php echo $eli; ?>]" min="0" max="100" value="<?php echo htmlspecialchars($eng_guitar[$eli] ?? 50); ?>" class="engagement-slider w-full" oninput="this.nextElementSibling.textContent = this.value + '%'">
                                <span class="font-mono text-xs font-bold text-center block mt-1"><?php echo htmlspecialchars($eng_guitar[$eli] ?? 50); ?>%</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="border-t-2 border-dashed border-gray-200 pt-4">
                <label class="font-black uppercase text-sm flex items-center gap-2 mb-3">
                    <span class="w-4 h-4 rounded-sm border-2 border-black" style="background:#833AB4"></span> @audiophile_prince Engagement
                </label>
                <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-5 gap-3">
                    <?php
                    $eng_music = $engagement['instagram_music'] ?? [92, 55, 40, 65, 80];
                    foreach ($eng_labels as $eli => $el):
                    ?>
                        <div class="flex flex-col gap-1">
                            <label class="font-mono text-[10px] font-bold uppercase text-gray-500"><?php echo htmlspecialchars($el); ?></label>
                            <div class="relative">
                                <input type="range" name="engagement_music[<?php echo $eli; ?>]" min="0" max="100" value="<?php echo htmlspecialchars($eng_music[$eli] ?? 50); ?>" class="engagement-slider w-full" oninput="this.nextElementSibling.textContent = this.value + '%'">
                                <span class="font-mono text-xs font-bold text-center block mt-1"><?php echo htmlspecialchars($eng_music[$eli] ?? 50); ?>%</span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-yellow-300 font-black text-lg px-6 py-3 uppercase border-[4px] border-black brutal-shadow hover:bg-yellow-400 hover:-translate-y-1 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Engagement</button>
        </div>
    </form>
</div>

<!-- Content Mix -->
<div class="mb-10">
    <h3 class="font-black text-xl uppercase mb-4 flex items-center gap-2"><i class="fa-solid fa-palette text-[#ff00ff]"></i> Content Mix</h3>
    <p class="text-gray-500 font-mono text-xs mb-4 bg-purple-50 inline-block px-2 border border-black border-dashed">What percentage of your content falls into each category?</p>
    <form action="../api/update.php" method="POST" class="space-y-4">
        <input type="hidden" name="action" value="save_analytics_content_mix">
        <div class="bg-white border-[3px] border-black p-4 sm:p-6 brutal-shadow">
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                <?php
                $cm_labels = $content_mix['labels'] ?? ['Guitar Covers', 'Original Songs', 'Vocal Performances', 'Behind the Scenes', 'Collabs', 'Viral Clips'];
                $cm_values = $content_mix['values'] ?? [30, 25, 18, 12, 8, 7];
                $cm_colors = $content_mix['colors'] ?? ['#00e5ff', '#ff00ff', '#ffea00', '#E1306C', '#1DB954', '#00f2ea'];
                foreach ($cm_labels as $cmi => $cml):
                ?>
                    <div class="flex items-center gap-3 bg-gray-50 border-2 border-black p-3">
                        <span class="w-5 h-5 rounded-sm border-2 border-black flex-shrink-0" style="background:<?php echo htmlspecialchars($cm_colors[$cmi] ?? '#ccc'); ?>"></span>
                        <div class="flex-1">
                            <input type="text" name="content_mix_labels[<?php echo $cmi; ?>]" value="<?php echo htmlspecialchars($cml); ?>" class="w-full font-mono text-sm font-bold border-b-2 border-black focus:outline-none focus:border-[#ff00ff] bg-transparent">
                        </div>
                        <div class="flex items-center gap-1">
                            <input type="number" name="content_mix_values[<?php echo $cmi; ?>]" value="<?php echo htmlspecialchars($cm_values[$cmi] ?? 0); ?>" min="0" max="100" class="w-16 border-[3px] border-black p-1.5 font-mono text-sm font-bold text-center focus:outline-none focus:ring-2 focus:ring-purple-300">
                            <span class="font-mono text-xs font-bold">%</span>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-[#ff00ff] text-white font-black text-lg px-6 py-3 uppercase border-[4px] border-black brutal-shadow hover:bg-pink-600 hover:-translate-y-1 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Content Mix</button>
        </div>
    </form>
</div>

<!-- Track Stats - Pulled from Music Releases, admin picks which to show -->
<div class="mb-10">
    <h3 class="font-black text-xl uppercase mb-4 flex items-center gap-2"><i class="fa-solid fa-music text-[#00e5ff]"></i> Track Stats</h3>
    <?php if (empty($releases)): ?>
        <div class="bg-white border-[3px] border-dashed border-black p-8 text-center brutal-shadow">
            <i class="fa-solid fa-compact-disc text-4xl text-gray-300 mb-3 block"></i>
            <p class="font-black uppercase text-lg">No tracks yet.</p>
            <p class="font-mono text-sm text-gray-500 mt-1">Add music releases first in the Music tab. Stats appear here automatically.</p>
        </div>
    <?php else: ?>
        <p class="text-gray-500 font-mono text-xs mb-4 bg-cyan-50 inline-block px-2 border border-black border-dashed">Toggle which tracks appear on the site. Fill in streams & likes for each.</p>
        <form action="../api/update.php" method="POST" class="space-y-4">
            <input type="hidden" name="action" value="save_analytics_music_stats">
            <div class="space-y-3">
                <?php foreach ($releases as $ri => $release):
                    $title = $release['title'] ?? '';
                    $existing = $stats_by_title[$title] ?? ['streams' => 0, 'likes' => 0, 'show' => 1];
                    $is_shown = ($existing['show'] ?? 1) == 1;
                ?>
                    <div class="bg-white border-[3px] border-black p-3 sm:p-4 brutal-shadow flex flex-col sm:flex-row gap-3 items-stretch sm:items-center <?php echo $is_shown ? '' : 'opacity-50'; ?>">
                        <input type="hidden" name="music_stats[<?php echo $ri; ?>][title]" value="<?php echo htmlspecialchars($title); ?>">
                        <input type="hidden" name="music_stats[<?php echo $ri; ?>][show]" value="0">
                        <!-- Toggle -->
                        <label class="flex items-center gap-2 flex-shrink-0 cursor-pointer">
                            <input type="checkbox" name="music_stats[<?php echo $ri; ?>][show]" value="1" <?php echo $is_shown ? 'checked' : ''; ?> class="track-show-toggle w-5 h-5 accent-green-500 cursor-pointer" onchange="this.closest('.bg-white').classList.toggle('opacity-50', !this.checked)">
                            <span class="font-mono text-[10px] font-bold uppercase <?php echo $is_shown ? 'text-green-600' : 'text-gray-400'; ?> track-label"><?php echo $is_shown ? 'Visible' : 'Hidden'; ?></span>
                        </label>
                        <div class="font-black text-base sm:text-lg uppercase flex items-center gap-2 min-w-0 sm:w-48">
                            <i class="fa-solid fa-compact-disc text-[#00e5ff] flex-shrink-0"></i>
                            <span class="truncate"><?php echo htmlspecialchars($title); ?></span>
                        </div>
                        <div class="flex gap-3 flex-1">
                            <div class="flex items-center gap-2 flex-1 bg-gray-50 border border-gray-200 p-2">
                                <i class="fa-solid fa-headphones text-gray-400 text-sm flex-shrink-0"></i>
                                <input type="number" name="music_stats[<?php echo $ri; ?>][streams]" value="<?php echo htmlspecialchars($existing['streams']); ?>" class="w-full font-mono text-sm font-bold border-b border-transparent hover:border-gray-300 focus:border-[#00e5ff] focus:outline-none bg-transparent" min="0" placeholder="Streams">
                            </div>
                            <div class="flex items-center gap-2 flex-1 bg-gray-50 border border-gray-200 p-2">
                                <i class="fa-solid fa-heart text-gray-400 text-sm flex-shrink-0"></i>
                                <input type="number" name="music_stats[<?php echo $ri; ?>][likes]" value="<?php echo htmlspecialchars($existing['likes']); ?>" class="w-full font-mono text-sm font-bold border-b border-transparent hover:border-gray-300 focus:border-[#ff00ff] focus:outline-none bg-transparent" min="0" placeholder="Likes">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="bg-[#00e5ff] text-black font-black text-lg px-6 py-3 uppercase border-[4px] border-black brutal-shadow hover:bg-cyan-300 hover:-translate-y-1 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Track Stats</button>
            </div>
        </form>
    <?php endif; ?>
</div>

<style>
.engagement-slider {
    -webkit-appearance: none;
    appearance: none;
    height: 8px;
    background: #e5e7eb;
    border: 2px solid #000;
    border-radius: 0;
    outline: none;
}
.engagement-slider::-webkit-slider-thumb {
    -webkit-appearance: none;
    appearance: none;
    width: 20px;
    height: 20px;
    background: #ff00ff;
    border: 3px solid #000;
    cursor: pointer;
    box-shadow: 2px 2px 0px #000;
}
.engagement-slider::-moz-range-thumb {
    width: 20px;
    height: 20px;
    background: #ff00ff;
    border: 3px solid #000;
    cursor: pointer;
    box-shadow: 2px 2px 0px #000;
    border-radius: 0;
}
</style>


