<!-- About Section -->
<section id="about" aria-labelledby="about-title"
    class="relative w-full min-h-[80vh] py-24 flex items-center justify-center z-10 px-4 md:px-6">
    <!-- Paper Background Constraint -->
    <div class="max-w-5xl mx-auto w-full relative">
        <!-- Tape -->
        <div class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-40 h-10 bg-[rgba(255,255,255,0.6)] backdrop-blur-sm z-30 shadow-sm border border-gray-200 -rotate-2"
            aria-hidden="true">
        </div>
        <div class="absolute -bottom-6 right-10 w-24 h-8 bg-accent-yellow opacity-80 z-30 shadow-sm border border-ink rotate-6"
            aria-hidden="true">
        </div>

        <!-- Notebook Paper Grid & Content -->
        <div class="relative bg-white w-full border-[4px] border-ink shadow-brutal-lg p-6 md:p-12 lg:p-16 flex flex-col md:flex-row gap-8 md:gap-12 interactive-hover overflow-visible"
            style="
              background-image: linear-gradient(
                180deg,
                var(--bg-primary) 0,
                var(--bg-primary) 2px,
                transparent 2px,
                transparent 100%
              );
              background-size: 100% 32px;
            ">

            <!-- Left: Polaroid / Story Image -->
            <aside class="w-full md:w-1/3 relative z-20 flex flex-col gap-6 items-center">
                <div class="polaroid -rotate-3 w-full max-w-[280px]">
                    <?php
                    echo renderImage(
                        $data['about']['img'],
                        "Prince Singing",
                        "w-full h-auto aspect-[3/4] object-cover border-[2px] border-ink filter sepia hover:sepia-0 transition-all duration-500"
                    );
                    ?>
                    <p class="font-handwriting text-xl text-center mt-2">
                        <?php echo htmlspecialchars($data['about']['img_caption']); ?> <span
                            aria-hidden="true">ðŸ«</span>
                    </p>
                </div>

                <!-- "Hello" Sticker -->
                <div class="absolute -top-10 -left-6 md:-left-10 bg-accent-pink text-white font-marker text-3xl px-6 py-2 border-[3px] border-ink shadow-brutal-sm -rotate-12 select-none"
                    aria-hidden="true">
                    Hello !
                </div>
            </aside>

            <!-- Right: Text Content -->
            <article class="w-full md:w-2/3 flex flex-col justify-center relative z-20">
                <h2 id="about-title"
                    class="font-marker text-4xl md:text-5xl text-accent-blue mb-6 tracking-wide drop-shadow-[2px_2px_0px_#000]">
                    The Story
                </h2>

                <div class="font-mono text-base md:text-lg text-ink space-y-6 leading-relaxed">
                    <p class="bg-yellow-100 p-1 inline-block -rotate-1">
                        <?php echo htmlspecialchars($data['about']['bio']['p1']); ?>
                    </p>
                    <br />
                    <p class="bg-cyan-100 p-1 inline-block rotate-1">
                        <?php echo htmlspecialchars($data['about']['bio']['p2']); ?>
                    </p>
                    <br />
                    <p class="bg-pink-100 text-ink p-1 inline-block font-bold">
                        <?php echo htmlspecialchars($data['about']['bio']['p3']); ?>
                    </p>
                </div>

                <!-- Callout Doodle -->
                <div class="mt-8 flex justify-end">
                    <span class="font-handwriting text-3xl text-accent-pink -rotate-6">
                        Let's make some noise! ðŸŽ¸
                    </span>
                </div>
            </article>
        </div>
    </div>
</section>