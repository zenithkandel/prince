<?php
$analytics = $data['analytics'] ?? null;
if (empty($analytics)) return;

$platforms = $analytics['platforms'] ?? [];
$engagement = $analytics['engagement'] ?? [];
$content_mix = $analytics['content_mix'] ?? [];
$music_stats = $analytics['music_stats'] ?? [];
$quick = $analytics['quick_stats'] ?? [];
?>

<!-- Analytics Section -->
<section id="analytics" class="relative w-full py-24 flex flex-col items-center z-10 overflow-hidden bg-[#1a1a2e] border-y-[4px] border-ink">
  <!-- Dot pattern background -->
  <div class="absolute inset-0 opacity-10 pointer-events-none" style="background-image: radial-gradient(rgba(255,255,255,0.3) 1px, transparent 1px); background-size: 20px 20px;"></div>

  <div class="relative w-full max-w-6xl mx-auto px-4 sm:px-6 z-10">
    <!-- Section Title -->
    <div class="flex flex-col items-center mb-12 sm:mb-16">
      <div class="bg-accent-yellow border-[3px] border-ink shadow-brutal-md px-6 sm:px-8 py-3 mb-4 rotate-[-2deg] hover:rotate-0 transition-transform scroll-reveal">
        <h2 class="font-marker text-4xl sm:text-5xl md:text-7xl uppercase text-ink">
          <?php echo htmlspecialchars($analytics['title'] ?? 'The Journey'); ?>
        </h2>
      </div>
      <p class="font-handwriting text-xl sm:text-2xl md:text-3xl text-white text-center opacity-80 scroll-reveal">
        <?php echo htmlspecialchars($analytics['subtitle'] ?? ''); ?>
      </p>
    </div>

    <!-- Quick Stats Row -->
    <div class="grid grid-cols-2 md:grid-cols-4 gap-3 sm:gap-4 mb-10 sm:mb-14 scroll-reveal" style="transition-delay: 100ms;">
      <div class="bg-white border-[3px] border-ink shadow-brutal-md p-4 sm:p-6 text-center rotate-[-1deg] hover:rotate-0 transition-transform">
        <div class="font-marker text-3xl sm:text-4xl md:text-5xl text-accent-blue"><?php echo number_format($quick['total_followers'] ?? 0); ?></div>
        <div class="font-mono text-xs sm:text-sm font-bold uppercase mt-1">Total Followers</div>
      </div>
      <div class="bg-white border-[3px] border-ink shadow-brutal-md p-4 sm:p-6 text-center rotate-[1deg] hover:rotate-0 transition-transform">
        <div class="font-marker text-3xl sm:text-4xl md:text-5xl text-accent-pink"><?php echo number_format($quick['total_streams'] ?? 0); ?></div>
        <div class="font-mono text-xs sm:text-sm font-bold uppercase mt-1">Total Streams</div>
      </div>
      <div class="bg-white border-[3px] border-ink shadow-brutal-md p-4 sm:p-6 text-center rotate-[-2deg] hover:rotate-0 transition-transform">
        <div class="font-marker text-3xl sm:text-4xl md:text-5xl text-accent-yellow"><?php echo htmlspecialchars($quick['total_views'] ?? '0'); ?></div>
        <div class="font-mono text-xs sm:text-sm font-bold uppercase mt-1">Total Views</div>
      </div>
      <div class="bg-white border-[3px] border-ink shadow-brutal-md p-4 sm:p-6 text-center rotate-[2deg] hover:rotate-0 transition-transform">
        <div class="font-marker text-3xl sm:text-4xl md:text-5xl text-green-500"><?php echo htmlspecialchars($quick['growth_rate'] ?? '0%'); ?></div>
        <div class="font-mono text-xs sm:text-sm font-bold uppercase mt-1">Growth Rate</div>
      </div>
    </div>

    <!-- Charts Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 sm:gap-8 mb-10 sm:mb-14">

      <!-- Chart 1: Instagram Account Comparison Doughnut -->
      <div class="bg-white border-[3px] sm:border-[4px] border-ink shadow-brutal-lg p-4 sm:p-6 rotate-[1deg] hover:rotate-0 transition-transform scroll-reveal" style="transition-delay: 200ms;">
        <h3 class="font-marker text-xl sm:text-2xl md:text-3xl mb-2 flex items-center gap-2">
          <i class="fa-brands fa-instagram text-[#E1306C]"></i> Instagram Breakdown
        </h3>
        <p class="font-mono text-xs text-gray-500 mb-4">Follower split between both accounts</p>
        <div class="flex flex-col sm:flex-row items-center gap-4">
          <div class="relative" style="width: 200px; height: 200px;">
            <canvas id="igComparisonChart"></canvas>
          </div>
          <div class="flex flex-col gap-3 text-left">
            <div class="flex items-center gap-2">
              <span class="w-4 h-4 rounded-sm border-2 border-ink" style="background: #E1306C;"></span>
              <span class="font-mono text-sm font-bold">@prince_on_guitar</span>
            </div>
            <p class="font-sans text-xs text-gray-500 ml-6">Guitar covers & originals</p>
            <div class="flex items-center gap-2 mt-1">
              <span class="w-4 h-4 rounded-sm border-2 border-ink" style="background: #833AB4;"></span>
              <span class="font-mono text-sm font-bold">@audiophile_prince</span>
            </div>
            <p class="font-sans text-xs text-gray-500 ml-6">Vocals, production & vibes</p>
          </div>
        </div>
      </div>

      <!-- Chart 2: Engagement by Content Type (Radar) -->
      <div class="bg-white border-[3px] sm:border-[4px] border-ink shadow-brutal-lg p-4 sm:p-6 rotate-[-1deg] hover:rotate-0 transition-transform scroll-reveal" style="transition-delay: 300ms;">
        <h3 class="font-marker text-xl sm:text-2xl md:text-3xl mb-2 flex items-center gap-2">
          <i class="fa-solid fa-bolt text-accent-yellow"></i> Engagement by Type
        </h3>
        <p class="font-mono text-xs text-gray-500 mb-4">How each content format performs</p>
        <div class="flex flex-wrap gap-3 mb-3 justify-center">
          <span class="flex items-center gap-1.5"><span class="w-3 h-3 border border-ink" style="background:#E1306C"></span><span class="font-mono text-[10px] font-bold">@prince_on_guitar</span></span>
          <span class="flex items-center gap-1.5"><span class="w-3 h-3 border border-ink" style="background:#833AB4"></span><span class="font-mono text-[10px] font-bold">@audiophile_prince</span></span>
        </div>
        <div class="relative" style="height: 260px;">
          <canvas id="engagementChart"></canvas>
        </div>
      </div>

      <!-- Chart 3: Content Mix Polar Area -->
      <div class="bg-white border-[3px] sm:border-[4px] border-ink shadow-brutal-lg p-4 sm:p-6 rotate-[2deg] hover:rotate-0 transition-transform scroll-reveal" style="transition-delay: 400ms;">
        <h3 class="font-marker text-xl sm:text-2xl md:text-3xl mb-2 flex items-center gap-2">
          <i class="fa-solid fa-palette text-accent-pink"></i> Content Mix
        </h3>
        <p class="font-mono text-xs text-gray-500 mb-4">What type of content gets posted</p>
        <div class="relative" style="height: 280px;">
          <canvas id="contentMixChart"></canvas>
        </div>
      </div>

      <!-- Chart 4: Platform Color Legend Card -->
      <div class="bg-white border-[3px] sm:border-[4px] border-ink shadow-brutal-lg p-4 sm:p-6 rotate-[-2deg] hover:rotate-0 transition-transform scroll-reveal" style="transition-delay: 500ms;">
        <h3 class="font-marker text-xl sm:text-2xl md:text-3xl mb-4 flex items-center gap-2">
          <i class="fa-solid fa-palette text-accent-blue"></i> Platform Colors
        </h3>
        <p class="font-mono text-xs text-gray-500 mb-4">What each color represents across all charts</p>
        <div class="grid grid-cols-1 gap-3">
          <div class="flex items-center gap-3 bg-gray-50 border-2 border-ink p-3">
            <span class="w-6 h-6 flex-shrink-0 border-2 border-ink" style="background:#E1306C"></span>
            <div>
              <div class="font-mono font-bold text-sm">@prince_on_guitar</div>
              <div class="font-sans text-xs text-gray-500">Guitar covers & originals</div>
            </div>
          </div>
          <div class="flex items-center gap-3 bg-gray-50 border-2 border-ink p-3">
            <span class="w-6 h-6 flex-shrink-0 border-2 border-ink" style="background:#833AB4"></span>
            <div>
              <div class="font-mono font-bold text-sm">@audiophile_prince</div>
              <div class="font-sans text-xs text-gray-500">Vocals, production & vibes</div>
            </div>
          </div>
          <div class="flex items-center gap-3 bg-gray-50 border-2 border-ink p-3">
            <span class="w-6 h-6 flex-shrink-0 border-2 border-ink" style="background:#FF0000"></span>
            <div>
              <div class="font-mono font-bold text-sm">YouTube</div>
              <div class="font-sans text-xs text-gray-500">Full performances & music videos</div>
            </div>
          </div>
          <div class="flex items-center gap-3 bg-gray-50 border-2 border-ink p-3">
            <span class="w-6 h-6 flex-shrink-0 border-2 border-ink" style="background:#00f2ea"></span>
            <div>
              <div class="font-mono font-bold text-sm">TikTok</div>
              <div class="font-sans text-xs text-gray-500">Short-form viral content</div>
            </div>
          </div>
          <div class="flex items-center gap-3 bg-gray-50 border-2 border-ink p-3">
            <span class="w-6 h-6 flex-shrink-0 border-2 border-ink" style="background:#1DB954"></span>
            <div>
              <div class="font-mono font-bold text-sm">Spotify</div>
              <div class="font-sans text-xs text-gray-500">Streaming numbers</div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Chart 5: Music Performance Horizontal Bar -->
    <div class="bg-white border-[3px] sm:border-[4px] border-ink shadow-brutal-lg p-4 sm:p-6 scroll-reveal mb-10 sm:mb-14" style="transition-delay: 600ms;">
      <h3 class="font-marker text-xl sm:text-2xl md:text-3xl mb-2 flex items-center gap-2">
        <i class="fa-solid fa-music text-accent-blue"></i> Track Performance
      </h3>
      <p class="font-mono text-xs text-gray-500 mb-4">Streams vs likes for each release</p>
      <div class="flex flex-wrap gap-3 mb-4">
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 border border-ink" style="background:#00e5ff"></span><span class="font-mono text-[10px] font-bold">Streams</span></span>
        <span class="flex items-center gap-1.5"><span class="w-3 h-3 border border-ink" style="background:#ff00ff"></span><span class="font-mono text-[10px] font-bold">Likes</span></span>
      </div>
      <div class="relative" style="height: 300px;">
        <canvas id="musicStatsChart"></canvas>
      </div>
    </div>

    <!-- Instagram Dual Accounts CTA -->
    <div class="flex flex-col sm:flex-row gap-4 sm:gap-6 justify-center scroll-reveal" style="transition-delay: 700ms;">
      <a href="<?php echo htmlspecialchars($data['contact']['instagram_guitar'] ?? '#'); ?>" target="_blank"
        class="bg-white border-[3px] border-ink shadow-brutal-md p-4 sm:p-5 flex items-center gap-3 sm:gap-4 hover:-translate-y-1 transition-all rotate-[-1deg] hover:rotate-0 group flex-1 max-w-sm">
        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full border-[3px] border-ink flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #E1306C, #833AB4);">
          <i class="fa-brands fa-instagram text-white text-xl sm:text-2xl"></i>
        </div>
        <div>
          <div class="font-mono font-bold text-sm sm:text-base">@prince_on_guitar</div>
          <div class="font-sans text-xs text-gray-500">Guitar covers & originals</div>
        </div>
        <i class="fa-solid fa-arrow-right ml-auto text-ink group-hover:translate-x-1 transition-transform"></i>
      </a>
      <a href="<?php echo htmlspecialchars($data['contact']['instagram_music'] ?? '#'); ?>" target="_blank"
        class="bg-white border-[3px] border-ink shadow-brutal-md p-4 sm:p-5 flex items-center gap-3 sm:gap-4 hover:-translate-y-1 transition-all rotate-[1deg] hover:rotate-0 group flex-1 max-w-sm">
        <div class="w-12 h-12 sm:w-14 sm:h-14 rounded-full border-[3px] border-ink flex items-center justify-center flex-shrink-0" style="background: linear-gradient(135deg, #833AB4, #C13584);">
          <i class="fa-brands fa-instagram text-white text-xl sm:text-2xl"></i>
        </div>
        <div>
          <div class="font-mono font-bold text-sm sm:text-base">@audiophile_prince</div>
          <div class="font-sans text-xs text-gray-500">Vocals, production & vibes</div>
        </div>
        <i class="fa-solid fa-arrow-right ml-auto text-ink group-hover:translate-x-1 transition-transform"></i>
      </a>
    </div>
  </div>
</section>

<!-- Chart.js CDN -->
<script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>

<script>
document.addEventListener('DOMContentLoaded', function() {
  const analyticsData = <?php echo json_encode($analytics); ?>;

  // Neo-brutalist chart defaults
  Chart.defaults.font.family = "'Space Mono', monospace";
  Chart.defaults.font.weight = 'bold';
  Chart.defaults.color = '#121212';
  Chart.defaults.plugins.legend.labels.usePointStyle = true;
  Chart.defaults.plugins.legend.labels.padding = 16;

  const gridColor = 'rgba(18, 18, 18, 0.1)';
  const borderSettings = { borderWidth: 3, borderColor: '#121212' };

  // Chart 1: Instagram Comparison Doughnut
  if (document.getElementById('igComparisonChart') && analyticsData.growth && analyticsData.growth.length > 0) {
    const latest = analyticsData.growth[analyticsData.growth.length - 1];
    new Chart(document.getElementById('igComparisonChart'), {
      type: 'doughnut',
      data: {
        labels: ['@prince_on_guitar', '@audiophile_prince'],
        datasets: [{
          data: [latest.instagram_guitar || 0, latest.instagram_music || 0],
          backgroundColor: ['#E1306C', '#833AB4'],
          borderWidth: 3, borderColor: '#121212', hoverOffset: 8
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: true, cutout: '55%',
        plugins: { legend: { display: false } }
      }
    });
  }

  // Chart 2: Engagement Radar
  if (document.getElementById('engagementChart') && analyticsData.engagement) {
    new Chart(document.getElementById('engagementChart'), {
      type: 'radar',
      data: {
        labels: analyticsData.engagement.labels || [],
        datasets: [
          {
            label: '@prince_on_guitar',
            data: analyticsData.engagement.instagram_guitar || [],
            borderColor: '#E1306C', backgroundColor: 'rgba(225, 48, 108, 0.15)',
            borderWidth: 3, pointRadius: 5, pointBackgroundColor: '#E1306C', pointBorderColor: '#121212', pointBorderWidth: 2
          },
          {
            label: '@audiophile_prince',
            data: analyticsData.engagement.instagram_music || [],
            borderColor: '#833AB4', backgroundColor: 'rgba(131, 58, 180, 0.15)',
            borderWidth: 3, pointRadius: 5, pointBackgroundColor: '#833AB4', pointBorderColor: '#121212', pointBorderWidth: 2
          }
        ]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          r: {
            beginAtZero: true, max: 100,
            grid: { color: gridColor },
            angleLines: { color: gridColor },
            pointLabels: { font: { size: 11, weight: 'bold' } },
            ticks: { display: false }
          }
        }
      }
    });
  }

  // Chart 3: Content Mix Polar Area
  if (document.getElementById('contentMixChart') && analyticsData.content_mix) {
    new Chart(document.getElementById('contentMixChart'), {
      type: 'polarArea',
      data: {
        labels: analyticsData.content_mix.labels || [],
        datasets: [{
          data: analyticsData.content_mix.values || [],
          backgroundColor: (analyticsData.content_mix.colors || []).map(c => c + '99'),
          borderColor: analyticsData.content_mix.colors || [],
          borderWidth: 3
        }]
      },
      options: {
        responsive: true, maintainAspectRatio: false,
        plugins: { legend: { position: 'bottom', labels: { font: { size: 10 }, padding: 10 } } },
        scales: { r: { grid: { color: gridColor }, ticks: { display: false } } }
      }
    });
  }

  // Chart 4: Music Performance Horizontal Bar
  if (document.getElementById('musicStatsChart') && analyticsData.music_stats) {
    const labels = analyticsData.music_stats.map(m => m.title);
    new Chart(document.getElementById('musicStatsChart'), {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [
          {
            label: 'Streams',
            data: analyticsData.music_stats.map(m => m.streams || 0),
            backgroundColor: '#00e5ff', borderColor: '#121212', borderWidth: 3, borderRadius: 0
          },
          {
            label: 'Likes',
            data: analyticsData.music_stats.map(m => m.likes || 0),
            backgroundColor: '#ff00ff', borderColor: '#121212', borderWidth: 3, borderRadius: 0
          }
        ]
      },
      options: {
        indexAxis: 'y', responsive: true, maintainAspectRatio: false,
        plugins: { legend: { display: false } },
        scales: {
          x: { grid: { color: gridColor }, border: borderSettings, beginAtZero: true },
          y: { grid: { display: false }, border: borderSettings }
        }
      }
    });
  }
});
</script>
