<!-- Aesthetic Gallery/Scrapbook -->
<section id="gallery" aria-labelledby="gallery-title"
    class="w-full relative py-20 bg-cover bg-center overflow-hidden border-b-[8px] border-ink" style="
        background-color: #f1f5f9;
        background-image: 
            linear-gradient(90deg, transparent 96%, #e2e8f0 96%),
            linear-gradient(0deg, transparent 96%, #e2e8f0 96%);
        background-size: 40px 40px;
      ">

    <div class="max-w-6xl mx-auto w-full relative z-30 pt-10 px-4 md:px-6">
        <!-- Title Badge -->
        <h2 id="gallery-title"
            class="inline-block bg-white text-ink font-marker text-4xl md:text-6xl px-6 py-3 border-[6px] border-ink brutal-shadow-lg rotate-3 mb-24 interactive-hover uppercase">
            Scrapbook / Gallery
            <i class="fa-solid fa-camera pointer-events-none text-accent-pink ml-2" aria-hidden="true"></i>
        </h2>

        <!-- Scrapbook Canvas -->
        <div class="relative w-full min-h-[80vh] md:min-h-[100vh] mt-10" aria-label="Photo Gallery">
            <!-- Scatter Photos based on JSON Data -->
            <?php if (!empty($data['gallery']['images'])): ?>
                <?php foreach ($data['gallery']['images'] as $index => $item): ?>
                    <!-- Photo Item -->
                    <figure
                        class="gallery-item absolute cursor-grab active:cursor-grabbing hover:z-[60] transition-transform duration-300 md:w-auto w-[250px] sm:w-[300px] <?php echo htmlspecialchars($item['classes']); ?>"
                        style="touch-action: none; top: <?php echo rand(10, 80); ?>%; left: <?php echo rand(5, 75); ?>%; max-width: 90vw;">
                        <!-- Wrapper -> Needs to be polaroid -->
                        <div
                            class="polaroid inline-block border-[6px] border-ink bg-white p-4 pb-12 brutal-shadow-lg relative group">
                            <!-- Pin/Tape -->
                            <div class="absolute -top-4 left-1/2 -translate-x-1/2 w-8 h-8 rounded-full bg-accent-blue border-[3px] border-ink shadow-brutal-sm z-10 group-hover:scale-125 transition-transform"
                                aria-hidden="true"></div>

                            <!-- The Photo -->
                            <div class="w-full h-auto aspect-[4/5] overflow-hidden border-[3px] border-ink relative skeleton-loader"
                                style="max-width: 400px;">
                                <?php
                                echo renderImage(
                                    $item['src'] ?? '',
                                    $item['caption'] ?? 'Gallery Image',
                                    "w-full h-full object-cover grayscale-[0.8] contrast-125 group-hover:grayscale-0 transition-all duration-700 pointer-events-none select-none",
                                    "lazy"
                                );
                                ?>
                            </div>

                            <!-- Fun Caption -->
                            <figcaption
                                class="font-handwriting text-2xl md:text-3xl text-center mt-6 text-gray-800 rotate-1 group-hover:-rotate-1 transition-transform pointer-events-none select-none px-2 leading-tight">
                                <?php echo htmlspecialchars($item['caption'] ?? ''); ?>
                            </figcaption>
                        </div>
                    </figure>
                <?php endforeach; ?>
            <?php else: ?>
                <p
                    class="font-marker text-4xl text-center text-ink bg-white inline-block p-4 border-[4px] border-ink rotate-2 brutal-shadow w-full max-w-sm mx-auto relative z-[50]">
                    No images found! Time to take some snaps.
                </p>
            <?php endif; ?>
        </div>
    </div>
</section>

<!-- Script to enable drag and drop using Draggabilly (Vanilla JS plugin approach without react) -->
<!-- Lazy load external dragging script -->
<script src="https://unpkg.com/draggabilly@3/dist/draggabilly.pkgd.min.js" defer></script>
<script defer>
    document.addEventListener("DOMContentLoaded", function () {
        // Init Draggabilly once script is loaded
        const draggies = [];
        const items = document.querySelectorAll('.gallery-item');

        if (typeof Draggabilly !== 'undefined' && items.length > 0) {
            items.forEach(function (item) {
                const draggie = new Draggabilly(item, {
                    containment: '#gallery .max-w-6xl' // Contain within gallery area
                });

                draggie.on('dragStart', function () {
                    item.style.zIndex = '100'; // Bring to front while dragging
                });
                draggie.on('dragEnd', function () {
                    item.style.zIndex = ''; // Reset z-index
                });
                draggies.push(draggie);
            });
        }
    });
</script>