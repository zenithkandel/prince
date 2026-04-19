<!-- Hero Section -->
<header id="hero"
    class="relative w-full min-h-screen flex flex-col md:flex-row items-center justify-center pt-10 px-6 max-w-7xl mx-auto gap-10 md:gap-0"
    aria-label="Hero Section">
    <!-- Background Doodles / Accents -->
    <div class="absolute inset-0 pointer-events-none opacity-50 z-0 overflow-hidden" aria-hidden="true">
        <i class="fa-solid fa-star text-4xl text-accent-yellow absolute top-20 left-[10%] -rotate-12 animate-float"
            style="animation-delay: 0s"></i>
        <i class="fa-duotone fa-star-shooting text-5xl text-accent-pink absolute top-40 right-[15%] rotate-45 animate-float"
            style="animation-delay: 1.5s"></i>
        <i class="fa-solid fa-music text-3xl text-accent-blue absolute bottom-32 left-[20%] rotate-12 animate-float"
            style="animation-delay: 3s"></i>
    </div>

    <!-- Left Context (Text) -->
    <article
        class="relative z-10 flex flex-col items-center md:items-start text-center md:text-left md:w-1/2 w-full mt-10 md:mt-0">
        <!-- Sticker Tag -->
        <div class="inline-block bg-accent-pink text-white font-mono font-bold text-sm px-4 py-1 border-[3px] border-ink shadow-brutal-sm rotate-[-4deg] mb-6 interactive-hover"
            role="presentation">
            <i class="fa-brands fa-youtube mr-2" aria-hidden="true"></i>
            <?php echo htmlspecialchars($data['hero']['tag']); ?>
        </div>

        <!-- Main Name -->
        <h1
            class="font-marker text-6xl xl:text-8xl 2xl:text-9xl text-ink leading-none uppercase relative w-full break-words">
            <span class="block relative z-10 transition-transform hover:-translate-y-2 duration-300">Prince</span>
            <span class="block relative z-10 transition-transform hover:-translate-y-2 duration-300 text-accent-blue"
                style="
                -webkit-text-stroke: 1px var(--color-text-dark);
                text-shadow: 4px 4px 0px var(--color-text-dark);
              "><?php echo htmlspecialchars($data['hero']['title_last']); ?></span>

            <!-- Underline doodle -->
            <svg class="absolute -bottom-6 md:-bottom-2 left-0 w-full h-8 text-accent-yellow -z-10" viewBox="0 0 400 30"
                fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round" aria-hidden="true">
                <path d="M5 25 Q 100 5 200 15 T 395 5" />
            </svg>
        </h1>

        <!-- Subtitle / Bio Snippet -->
        <p class="font-handwriting text-2xl md:text-4xl text-ink mt-8 max-w-lg leading-relaxed relative rotate-1">
            <?php echo htmlspecialchars($data['hero']['subtitle']); ?>
            <br />
            <span class="text-xl md:text-2xl font-mono opacity-80 mt-2 block tracking-tight">ðŸ‡³ðŸ‡µ Nepal &rarr;
                ðŸ‡¨ðŸ‡¦
                Toronto</span>
        </p>

        <!-- CTA Button -->
        <a href="#music" aria-label="Listen to Music CTA"
            class="mt-8 group inline-flex items-center justify-center gap-3 bg-accent-yellow font-mono font-black text-xl px-8 py-4 border-[4px] border-ink shadow-brutal-md transition-all duration-300 hover:shadow-brutal-lg hover:-translate-y-1 hover:-translate-x-1 active:shadow-brutal-sm active:translate-y-1 active:translate-x-1 rotate-2">
            <i class="fa-solid fa-play group-hover:fa-beat" aria-hidden="true"></i>
            <?php echo htmlspecialchars($data['hero']['cta']); ?>
        </a>
    </article>

    <!-- Right Context (Image/Collage) -->
    <aside class="relative z-10 w-full md:w-1/2 flex justify-center items-center mt-12 md:mt-0">
        <!-- Main Polaroid -->
        <div class="relative w-full max-w-[280px] md:max-w-sm polaroid rotate-3 interactive-hover group">
            <!-- Image container with mask -->
            <div
                class="w-full aspect-[4/5] border-[3px] border-ink overflow-hidden bg-white mb-4 relative skeleton-loader">
                <?php
                echo renderImage(
                    $data['hero']['img'],
                    "Prince Neupane Hero Image",
                    "w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0",
                    "eager"  // Eager for LCP element
                );
                ?>
            </div>
            <!-- Caption -->
            <p class="font-handwriting text-3xl text-center text-ink flex items-center justify-center gap-2">
                <?php echo $data['hero']['img_caption']; ?>
            </p>

            <!-- Accents -->
            <div class="absolute -bottom-10 -right-4 md:-right-8 w-24 h-24 bg-accent-blue rounded-full border-[3px] border-ink shadow-brutal-sm flex items-center justify-center -rotate-12 hover-wiggle"
                aria-hidden="true">
                <span class="font-marker text-white text-xl text-center leading-none">Vibes<br />Only</span>
            </div>
        </div>
    </aside>
</header>