<!-- Contact Section -->
<footer id="contact" aria-labelledby="contact-title"
    class="w-full bg-accent-blue py-24 pb-48 relative border-t-[8px] border-ink z-[100] mt-auto">
    <div class="max-w-4xl mx-auto w-full flex flex-col items-center px-4 relative">

        <!-- Big Contact Envelope -->
        <article
            class="bg-white w-full border-[8px] border-ink shadow-brutal-lg p-8 md:p-16 rotate-1 relative transition-transform hover:rotate-0 duration-500 max-w-2xl text-center">

            <!-- Fun Star Badge -->
            <div class="absolute -top-12 -right-8 md:-top-16 md:-right-12 text-6xl md:text-8xl text-accent-yellow drop-shadow-brutal-md hover:scale-110 active:scale-95 transition-transform cursor-pointer"
                aria-hidden="true">
                <i class="fa-solid fa-certificate"></i>
                <span
                    class="absolute inset-0 flex items-center justify-center font-marker text-ink text-xl md:text-2xl mt-1">Talk!</span>
            </div>

            <h2 id="contact-title"
                class="font-marker text-5xl md:text-7xl uppercase mb-6 drop-shadow-[3px_3px_0px_#ff00ff]">
                Hit Me Up!
            </h2>

            <p
                class="font-mono text-lg md:text-xl text-gray-700 leading-relaxed max-w-lg mx-auto mb-10 border-b-4 border-dashed border-accent-pink pb-8">
                Whether you want to collab, book a gig, or just share some wild music recs... my inbox is always open.
                Let's make art.
            </p>

            <!-- Social Links -->
            <div class="flex flex-col md:flex-row justify-center items-center gap-6" aria-label="Social Media Links">

                <a href="mailto:<?php echo htmlspecialchars($data['footer']['email'] ?? 'hello@example.com'); ?>"
                    aria-label="Email Prince"
                    class="bg-accent-yellow text-ink font-mono font-black text-xl px-8 py-4 border-[4px] border-ink brutal-shadow-lg transition-transform hover:-translate-y-2 active:translate-y-0 w-full md:w-auto uppercase flex items-center justify-center gap-3">
                    <i class="fa-solid fa-envelope" aria-hidden="true"></i> Email Me
                </a>

                <div class="flex gap-4">
                    <?php if (!empty($data['footer']['socials']['instagram'])): ?>
                        <a href="<?php echo htmlspecialchars($data['footer']['socials']['instagram']); ?>" target="_blank"
                            rel="noopener noreferrer" aria-label="Instagram Profile"
                            class="bg-accent-pink text-white text-3xl w-16 h-16 flex items-center justify-center border-[4px] border-ink brutal-shadow transition-transform hover:scale-110 hover:-rotate-6">
                            <i class="fa-brands fa-instagram" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($data['footer']['socials']['youtube'])): ?>
                        <a href="<?php echo htmlspecialchars($data['footer']['socials']['youtube']); ?>" target="_blank"
                            rel="noopener noreferrer" aria-label="YouTube Channel"
                            class="bg-[#ff0000] text-white text-3xl w-16 h-16 flex items-center justify-center border-[4px] border-ink brutal-shadow transition-transform hover:scale-110 hover:rotate-6">
                            <i class="fa-brands fa-youtube" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>

                    <?php if (!empty($data['footer']['socials']['spotify'])): ?>
                        <a href="<?php echo htmlspecialchars($data['footer']['socials']['spotify']); ?>" target="_blank"
                            rel="noopener noreferrer" aria-label="Spotify Profile"
                            class="bg-[#1DB954] text-white text-3xl w-16 h-16 flex items-center justify-center border-[4px] border-ink brutal-shadow transition-transform hover:scale-110 hover:-rotate-3">
                            <i class="fa-brands fa-spotify" aria-hidden="true"></i>
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </article>

        <!-- Copyright Doodle -->
        <p class="mt-16 font-handwriting text-2xl text-ink font-bold text-center underline decoration-wavy decoration-accent-pink decoration-4"
            aria-label="Copyright Info">
            &copy; <?php echo date('Y'); ?> <?php echo htmlspecialchars($data['hero']['title_last']); ?>. All vibes
            reserved. <i class="fa-solid fa-peace" aria-hidden="true"></i>
        </p>

    </div>
</footer>