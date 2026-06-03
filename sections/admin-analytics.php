<?php
$analytics = $data['analytics'] ?? [];
$growth = $analytics['growth'] ?? [];
$engagement = $analytics['engagement'] ?? ['labels' => [], 'instagram_guitar' => [], 'instagram_music' => []];
$content_mix = $analytics['content_mix'] ?? ['labels' => [], 'values' => [], 'colors' => []];
$music_stats = $analytics['music_stats'] ?? [];
$quick = $analytics['quick_stats'] ?? [];
$platforms = $analytics['platforms'] ?? [];
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
        <div class="flex justify-end">
            <button type="submit" class="bg-black text-white font-black text-lg px-6 py-3 uppercase border-[4px] border-black brutal-shadow hover:bg-gray-800 hover:-translate-y-1 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Stats</button>
        </div>
    </form>
</div>

<!-- Monthly Growth Data -->
<div class="mb-10">
    <h3 class="font-black text-xl uppercase mb-4 flex items-center gap-2"><i class="fa-solid fa-chart-line text-[#ff00ff]"></i> Monthly Growth</h3>
    <p class="text-gray-500 font-mono text-xs mb-4 bg-pink-50 inline-block px-2 border border-black border-dashed">Add a row for each month. Fill in follower counts per platform. The charts update automatically!</p>
    <form action="../api/update.php" method="POST" class="space-y-4">
        <input type="hidden" name="action" value="save_analytics_growth">
        <div id="growth-rows" class="space-y-3">
            <?php if (!empty($growth)): ?>
                <?php foreach ($growth as $gi => $g): ?>
                    <div class="growth-row bg-white border-[3px] border-black p-3 sm:p-4 brutal-shadow flex flex-col sm:flex-row gap-2 sm:gap-3 items-stretch sm:items-center relative">
                        <button type="button" onclick="this.closest('.growth-row').remove()" class="absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full border-2 border-black text-xs font-bold flex items-center justify-center hover:bg-red-700 z-10" title="Remove">&times;</button>
                        <input type="text" name="growth[<?php echo $gi; ?>][month]" value="<?php echo htmlspecialchars($g['month'] ?? ''); ?>" placeholder="Month (e.g. Jan 2026)" class="border-[3px] border-black p-2 font-mono text-sm font-bold focus:outline-none focus:ring-2 focus:ring-yellow-300 w-full sm:w-36">
                        <div class="flex flex-wrap gap-2 flex-1">
                            <div class="flex items-center gap-1">
                                <span class="w-3 h-3 rounded-sm border border-black" style="background:#E1306C"></span>
                                <input type="number" name="growth[<?php echo $gi; ?>][instagram_guitar]" value="<?php echo htmlspecialchars($g['instagram_guitar'] ?? 0); ?>" placeholder="IG Guitar" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-pink-300 w-24" min="0">
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-3 h-3 rounded-sm border border-black" style="background:#833AB4"></span>
                                <input type="number" name="growth[<?php echo $gi; ?>][instagram_music]" value="<?php echo htmlspecialchars($g['instagram_music'] ?? 0); ?>" placeholder="IG Music" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 w-24" min="0">
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-3 h-3 rounded-sm border border-black" style="background:#FF0000"></span>
                                <input type="number" name="growth[<?php echo $gi; ?>][youtube]" value="<?php echo htmlspecialchars($g['youtube'] ?? 0); ?>" placeholder="YouTube" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-red-300 w-24" min="0">
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-3 h-3 rounded-sm border border-black" style="background:#00f2ea"></span>
                                <input type="number" name="growth[<?php echo $gi; ?>][tiktok]" value="<?php echo htmlspecialchars($g['tiktok'] ?? 0); ?>" placeholder="TikTok" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-cyan-300 w-24" min="0">
                            </div>
                            <div class="flex items-center gap-1">
                                <span class="w-3 h-3 rounded-sm border border-black" style="background:#1DB954"></span>
                                <input type="number" name="growth[<?php echo $gi; ?>][spotify]" value="<?php echo htmlspecialchars($g['spotify'] ?? 0); ?>" placeholder="Spotify" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-green-300 w-24" min="0">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="flex flex-col sm:flex-row gap-3">
            <button type="button" onclick="addGrowthRow()" class="bg-yellow-300 font-black border-[3px] border-black px-6 py-3 brutal-shadow hover:bg-yellow-400 hover:-translate-y-1 uppercase transition-all flex items-center justify-center gap-2">
                <span class="text-xl leading-none">+</span> Add Month
            </button>
            <button type="submit" class="bg-[#ff00ff] text-white font-black text-lg px-6 py-3 uppercase border-[4px] border-black brutal-shadow hover:bg-pink-600 hover:-translate-y-1 transition-all flex items-center justify-center gap-2"><i class="fa-solid fa-floppy-disk"></i> Save Growth Data</button>
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

<!-- Music Stats -->
<div class="mb-10">
    <h3 class="font-black text-xl uppercase mb-4 flex items-center gap-2"><i class="fa-solid fa-music text-[#00e5ff]"></i> Track Stats</h3>
    <p class="text-gray-500 font-mono text-xs mb-4 bg-cyan-50 inline-block px-2 border border-black border-dashed">Update streams and likes for each track.</p>
    <form action="../api/update.php" method="POST" class="space-y-4">
        <input type="hidden" name="action" value="save_analytics_music_stats">
        <div class="space-y-3">
            <?php if (!empty($music_stats)): ?>
                <?php foreach ($music_stats as $mi => $ms): ?>
                    <div class="bg-white border-[3px] border-black p-3 sm:p-4 brutal-shadow flex flex-col sm:flex-row gap-3 items-stretch sm:items-center">
                        <div class="font-black text-lg uppercase flex items-center gap-2 min-w-0 sm:w-40">
                            <i class="fa-solid fa-compact-disc text-[#00e5ff]"></i>
                            <input type="hidden" name="music_stats[<?php echo $mi; ?>][title]" value="<?php echo htmlspecialchars($ms['title'] ?? ''); ?>">
                            <span class="truncate"><?php echo htmlspecialchars($ms['title'] ?? ''); ?></span>
                        </div>
                        <div class="flex gap-3 flex-1">
                            <div class="flex items-center gap-1 flex-1">
                                <label class="font-mono text-[10px] font-bold text-gray-400 uppercase hidden sm:block">Streams</label>
                                <input type="number" name="music_stats[<?php echo $mi; ?>][streams]" value="<?php echo htmlspecialchars($ms['streams'] ?? 0); ?>" class="w-full border-[3px] border-black p-2 font-mono text-sm font-bold focus:outline-none focus:ring-2 focus:ring-cyan-300" min="0">
                            </div>
                            <div class="flex items-center gap-1 flex-1">
                                <label class="font-mono text-[10px] font-bold text-gray-400 uppercase hidden sm:block">Likes</label>
                                <input type="number" name="music_stats[<?php echo $mi; ?>][likes]" value="<?php echo htmlspecialchars($ms['likes'] ?? 0); ?>" class="w-full border-[3px] border-black p-2 font-mono text-sm font-bold focus:outline-none focus:ring-2 focus:ring-pink-300" min="0">
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <div class="flex justify-end">
            <button type="submit" class="bg-[#00e5ff] text-black font-black text-lg px-6 py-3 uppercase border-[4px] border-black brutal-shadow hover:bg-cyan-300 hover:-translate-y-1 transition-all"><i class="fa-solid fa-floppy-disk"></i> Save Track Stats</button>
        </div>
    </form>
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

<script>
let growthRowIndex = <?php echo count($growth); ?>;

function addGrowthRow() {
    const container = document.getElementById('growth-rows');
    const months = ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'];
    const now = new Date();
    const suggestedMonth = months[now.getMonth()] + ' ' + now.getFullYear();

    const row = document.createElement('div');
    row.className = 'growth-row bg-white border-[3px] border-black p-3 sm:p-4 brutal-shadow flex flex-col sm:flex-row gap-2 sm:gap-3 items-stretch sm:items-center relative';
    row.innerHTML = `
        <button type="button" onclick="this.closest('.growth-row').remove()" class="absolute -top-2 -right-2 bg-red-500 text-white w-6 h-6 rounded-full border-2 border-black text-xs font-bold flex items-center justify-center hover:bg-red-700 z-10" title="Remove">&times;</button>
        <input type="text" name="growth[${growthRowIndex}][month]" value="${suggestedMonth}" placeholder="Month (e.g. Jan 2026)" class="border-[3px] border-black p-2 font-mono text-sm font-bold focus:outline-none focus:ring-2 focus:ring-yellow-300 w-full sm:w-36">
        <div class="flex flex-wrap gap-2 flex-1">
            <div class="flex items-center gap-1">
                <span class="w-3 h-3 rounded-sm border border-black" style="background:#E1306C"></span>
                <input type="number" name="growth[${growthRowIndex}][instagram_guitar]" placeholder="IG Guitar" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-pink-300 w-24" min="0">
            </div>
            <div class="flex items-center gap-1">
                <span class="w-3 h-3 rounded-sm border border-black" style="background:#833AB4"></span>
                <input type="number" name="growth[${growthRowIndex}][instagram_music]" placeholder="IG Music" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-purple-300 w-24" min="0">
            </div>
            <div class="flex items-center gap-1">
                <span class="w-3 h-3 rounded-sm border border-black" style="background:#FF0000"></span>
                <input type="number" name="growth[${growthRowIndex}][youtube]" placeholder="YouTube" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-red-300 w-24" min="0">
            </div>
            <div class="flex items-center gap-1">
                <span class="w-3 h-3 rounded-sm border border-black" style="background:#00f2ea"></span>
                <input type="number" name="growth[${growthRowIndex}][tiktok]" placeholder="TikTok" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-cyan-300 w-24" min="0">
            </div>
            <div class="flex items-center gap-1">
                <span class="w-3 h-3 rounded-sm border border-black" style="background:#1DB954"></span>
                <input type="number" name="growth[${growthRowIndex}][spotify]" placeholder="Spotify" class="border-[3px] border-black p-2 font-mono text-sm focus:outline-none focus:ring-2 focus:ring-green-300 w-24" min="0">
            </div>
        </div>
    `;
    container.appendChild(row);
    growthRowIndex++;
}
</script>
