<!-- Music Showcase -->
<section id="music" aria-labelledby="music-title"
    class="relative w-full min-h-[80vh] py-24 z-20 px-4 md:px-6 bg-accent-pink border-y-[8px] border-ink shadow-brutal-lg">

    <!-- Background pattern for music section -->
    <div class="absolute inset-0 opacity-10 pointer-events-none" style="
          background-image: repeating-linear-gradient(45deg, #000 0, #000 2px, transparent 2px, transparent 8px);
        " aria-hidden="true"></div>

    <div class="max-w-6xl mx-auto w-full relative z-10 flex flex-col items-center">
        <!-- Section Title (Sticker) -->
        <h2 id="music-title"
            class="bg-accent-yellow text-ink font-marker text-5xl md:text-7xl px-8 py-4 border-[6px] border-ink shadow-brutal-lg -rotate-2 mb-16 interactive-hover uppercase">
            Latest Drops
            <i class="fa-solid fa-compact-disc ml-2 animate-spin-slow" aria-hidden="true"></i>
        </h2>

        <!-- Main Wrapper -->
        <div class="w-full flex justify-center mb-16">
            <article
                class="bg-white border-[6px] border-ink shadow-brutal-lg p-6 lg:p-12 w-full max-w-4xl rotate-1 relative z-20 flex flex-col lg:flex-row gap-8 lg:gap-12 items-center lg:items-start group hover:rotate-0 transition-transform duration-500">
                <!-- Left: Featured Artwork -->
                <div class="w-full max-w-[300px] lg:w-1/2 relative">
                    <div class="w-full aspect-square border-[4px] border-ink overflow-hidden brutal-shadow relative">
                        <?php
                        echo renderImage(
                            $data['music']['featured']['cover'],
                            "Featured Cover Art",
                            "w-full h-full object-cover transition-transform duration-700 group-hover:scale-110",
                            "lazy"
                        );
                        ?>
                        <!-- "New" Badge -->
                        <div
                            class="absolute top-2 -right-2 md:top-4 md:-right-4 bg-accent-blue text-ink font-mono font-black border-[3px] border-ink px-3 py-1 shadow-brutal-sm rotate-12 z-20">
                            NEW !!
                        </div>
                    </div>
                </div>

                <!-- Right: Details -->
                <div class="w-full lg:w-1/2 flex flex-col justify-center gap-6 lg:gap-8">
                    <h3 class="font-marker text-4xl lg:text-6xl uppercase tracking-tighter leading-none break-words">
                        <?php echo htmlspecialchars($data['music']['featured']['title']); ?>
                    </h3>
                    <p
                        class="font-handwriting text-2xl md:text-3xl text-gray-600 border-l-4 border-accent-pink pl-4 leading-tight">
                        <?php echo htmlspecialchars($data['music']['featured']['description']); ?>
                    </p>

                    <!-- Stream Tags -->
                    <div class="flex flex-wrap gap-4 mt-2">
                        <span
                            class="bg-black text-[#1DB954] font-mono font-bold px-4 py-2 border-[2px] border-ink brutal-shadow flex items-center justify-center gap-2">
                            <i class="fa-brands fa-spotify text-2xl"></i> Streaming
                        </span>
                        <span
                            class="bg-white text-ink font-mono font-bold px-4 py-2 border-[2px] border-ink brutal-shadow">
                            Available Now
                        </span>
                    </div>

                    <!-- Stream Link -->
                    <a href="<?php echo htmlspecialchars($data['music']['featured']['link']); ?>" target="_blank"
                        rel="noopener noreferrer" aria-label="Stream Latest Drop"
                        class="block w-full bg-accent-yellow text-ink text-center font-marker text-2xl px-6 py-4 border-[4px] border-ink brutal-shadow-lg hover:bg-accent-blue hover:-translate-y-1 active:translate-y-1 transition-all">
                        Listen on Spotify <i class="fa-solid fa-arrow-up-right-from-square ml-2" aria-hidden="true"></i>
                    </a>
                </div>
            </article>
        </div>

        <!-- Scrollable Releases Grid -->
        <div class="w-full mt-12 relative flex justify-center">
            <h3 class="font-handwriting text-4xl text-white mb-6 -rotate-3 text-center drop-shadow-[2px_2px_0px_#000]">
                Other Bops ðŸŽ¶
            </h3>
        </div>

        <!-- Render Music releases dynamically with Flexbox -->
        <div class="w-full flex-wrap flex justify-center gap-8 px-4" aria-label="Music Releases">
            <?php if (!empty($data['music']['releases'])): ?>
                <?php foreach ($data['music']['releases'] as $index => $item): ?>
                    <!-- Music Card Wrapper -->
                    <div class="relative w-full max-w-[340px] m-4 mx-auto flex-shrink-0 group">
                        <article
                            class="bg-white border-[6px] border-ink p-6 brutal-shadow flex flex-col gap-6 relative mt-4 focus-within:ring-4 ring-cyan-200 transition-all hover:bg-gray-50 focus-within:bg-white <?php echo htmlspecialchars($item['classes'] ?? 'rotate-2'); ?>">
                            <!-- Card Header -->
                            <div
                                class="absolute -top-5 -left-5 bg-black text-[#00e5ff] border-4 border-ink px-4 py-1.5 font-black transform -rotate-3 text-lg shadow-[4px_4px_0px_#00e5ff] group-hover:rotate-0 transition-transform z-10 flex items-center gap-2">
                                <i class="fa-solid fa-music" aria-hidden="true"></i> Track
                            </div>

                            <div class="relative pt-6">
                                <div class="border-[4px] border-ink overflow-hidden relative brutal-shadow mb-4">
                                    <?php
                                    echo renderImage(
                                        $item['cover'] ?? '',
                                        $item['title'] ?? 'Release Cover',
                                        "w-full aspect-square object-cover group-hover:scale-105 transition-transform duration-500",
                                        "lazy"
                                    );
                                    ?>
                                </div>
                                <h4 class="font-marker text-2xl uppercase tracking-widest break-words leading-none mb-2">
                                    <?php echo htmlspecialchars($item['title'] ?? 'Unknown Release'); ?>
                                </h4>

                                <a href="<?php echo htmlspecialchars($item['link'] ?? '#'); ?>" target="_blank"
                                    rel="noopener noreferrer"
                                    aria-label="Stream <?php echo htmlspecialchars($item['title'] ?? 'Release'); ?> on Spotify"
                                    class="inline-block mt-4 bg-[#1DB954] text-white font-mono font-bold text-center px-4 py-2 border-[3px] border-ink shadow-brutal-sm hover:brutal-shadow active:translate-y-1 hover:-translate-y-1 transition-all uppercase w-full">
                                    <i class="fa-brands fa-spotify"></i> Play
                                </a>
                            </div>
                        </article>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <p class="font-handwriting text-3xl text-white text-center">No releases found!</p>
            <?php endif; ?>
        </div>

    </div>
</section>