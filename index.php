<?php $data = json_decode(file_get_contents('api/data.json'), true); ?><!doctype html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <!-- SEO & Meta Tags -->
  <title>Prince Neupane | Artist, Musician &#38; Creative Portfolio</title>
  <meta name="description"
    content="Official portfolio of Prince Neupane. Explore the music, photos, and creative journey of an independent artist." />
  <meta name="keywords" content="Prince Neupane, Music, Portfolio, Artist, Musician, Creative" />
  <meta name="author" content="Prince Neupane" />
  <meta property="og:title" content="Prince Neupane - Portfolio" />
  <meta property="og:description"
    content="Official portfolio of Prince Neupane. Explore the music, photos, and creative journey of an independent artist." />
  <meta property="og:image"
    content="<?php echo htmlspecialchars(isset($data['hero']['img']) ? $data['hero']['img'] : ''); ?>" />
  <meta property="og:url" content="https://princeneupane.com" />
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="Prince Neupane - Portfolio" />
  <meta name="twitter:description"
    content="Official portfolio of Prince Neupane. Explore the music, photos, and creative journey." />

  <!-- Tailwind CSS -->
  <script src="https://cdn.tailwindcss.com"></script>

  <!-- Custom Tailwind Configuration to map our variables -->
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            paper: "var(--bg-primary)",
            accent: {
              blue: "var(--color-accent-blue)",
              pink: "var(--color-accent-pink)",
              yellow: "var(--color-accent-yellow)",
            },
            ink: "var(--color-text-dark)",
          },
          boxShadow: {
            "brutal-sm": "var(--shadow-solid-sm)",
            "brutal-md": "var(--shadow-solid-md)",
            "brutal-lg": "var(--shadow-solid-lg)",
          },
          fontFamily: {
            marker: ['"Permanent Marker"', "cursive"],
            mono: ['"Space Mono"', "monospace"],
            handwriting: ['"Caveat"', "cursive"],
            sans: ['"Inter"', "sans-serif"],
          },
        },
      },
    };
  </script>

  <!-- FontAwesome Premium Icons -->
  <script defer src="https://zenithkandel.com.np/fontawesome/zenith-icons.js"></script>

  <!-- Custom CSS -->
  <link rel="stylesheet" href="assets/styles.css" />

  <!-- Phosphor icons or other additions -->
</head>

<body class="bg-paper text-ink overflow-x-hidden min-h-screen relative w-full pt-20 lg:pt-0">
  <!-- FLOATING NAVIGATION (Sticky bottom on mobile, Top right on desktop) -->
  <nav class="fixed bottom-4 left-0 w-full z-50 px-4 md:bottom-auto md:top-6 md:px-8">
    <div class="max-w-7xl mx-auto flex justify-center md:justify-end">
      <!-- Navigation Sticker -->
      <ul
        class="flex items-center gap-2 sm:gap-3 md:gap-6 bg-accent-yellow px-6 py-3 border-[3px] border-ink shadow-brutal-md rotate-1 hover:rotate-0 transition-transform duration-300">
        <li class="text-center">
          <a href="#hero"
            class="font-mono font-bold text-xs sm:text-sm md:text-base hover:text-accent-pink transition-colors group">
            <i class="fa-solid fa-home mr-1 group-hover:fa-bounce"></i> Home
          </a>
        </li>
        <li class="text-center">
          <a href="#about"
            class="font-mono font-bold text-xs sm:text-sm md:text-base hover:text-accent-blue transition-colors group">
            <i class="fa-solid fa-user-music mr-1 group-hover:fa-bounce"></i>
            About
          </a>
        </li>
        <li class="text-center">
          <a href="#music"
            class="font-mono font-bold text-xs sm:text-sm md:text-base hover:text-accent-pink transition-colors group">
            <i class="fa-solid fa-cassette-tape mr-1 group-hover:fa-bounce"></i>
            Music
          </a>
        </li>
        <li class="text-center">
          <a href="#gallery"
            class="font-mono font-bold text-xs sm:text-sm md:text-base hover:text-accent-blue transition-colors group">
            <i class="fa-solid fa-camera-retro mr-1 group-hover:fa-bounce"></i>
            Gallery
          </a>
        </li>
        <li class="text-center hidden sm:block">
          <a href="#contact"
            class="font-mono font-bold text-xs sm:text-sm md:text-base hover:text-accent-pink transition-colors group">
            <i class="fa-solid fa-paper-plane mr-1 group-hover:fa-bounce"></i>
            Contact
          </a>
        </li>
      </ul>
    </div>
  </nav>

  <!-- MAIN CANVAS CONTAINER -->
  <main class="relative w-full overflow-hidden flex flex-col items-center">
    <!-- Hero Section -->
    <section id="hero"
      class="relative w-full min-h-screen flex flex-col md:flex-row items-center justify-center pt-10 px-6 max-w-7xl mx-auto gap-10 md:gap-0">
      <!-- Background Doodles / Accents -->
      <div class="absolute inset-0 pointer-events-none opacity-50 z-0 overflow-hidden">
        <!-- Stars & Scribbles using FontAwesome -->
        <i class="fa-solid fa-star text-4xl text-accent-yellow absolute top-20 left-[10%] -rotate-12 animate-float"
          style="animation-delay: 0s"></i>
        <i class="fa-duotone fa-star-shooting text-5xl text-accent-pink absolute top-40 right-[15%] rotate-45 animate-float"
          style="animation-delay: 1.5s"></i>
        <i class="fa-solid fa-music text-3xl text-accent-blue absolute bottom-32 left-[20%] rotate-12 animate-float"
          style="animation-delay: 3s"></i>
      </div>

      <!-- Left Context (Text) -->
      <div
        class="relative z-10 flex flex-col items-center md:items-start text-center md:text-left md:w-1/2 w-full mt-10 md:mt-0 scroll-reveal">
        <!-- Sticker Tag -->
        <div
          class="inline-block bg-accent-pink text-white font-mono font-bold text-sm px-4 py-1 border-[3px] border-ink shadow-brutal-sm rotate-[-4deg] mb-6 interactive-hover">
          <i class="fa-brands fa-youtube mr-2"></i> <?php echo htmlspecialchars($data['hero']['tag']); ?>
        </div>

        <!-- Main Name -->
        <h1 class="font-marker text-6xl md:text-8xl lg:text-9xl text-ink leading-none uppercase relative">
           <span class="block relative z-10 transition-transform hover:-translate-y-2 duration-300"><?php echo htmlspecialchars($data['hero']['title_first']); ?></span>
          <span class="block relative z-10 transition-transform hover:-translate-y-2 duration-300 text-accent-blue"
            style="
                -webkit-text-stroke: 1px var(--color-text-dark);
                text-shadow: 4px 4px 0px var(--color-text-dark);
              "><?php echo htmlspecialchars($data['hero']['title_last']); ?></span>

          <!-- Underline doodle -->
          <svg class="absolute -bottom-6 md:-bottom-2 left-0 w-full h-8 text-accent-yellow -z-10" viewBox="0 0 400 30"
            fill="none" stroke="currentColor" stroke-width="8" stroke-linecap="round">
            <path d="M5 25 Q 100 5 200 15 T 395 5" />
          </svg>
        </h1>

        <!-- Subtitle / Bio Snippet -->
        <p class="font-handwriting text-2xl md:text-4xl text-ink mt-8 max-w-lg leading-relaxed relative rotation-1">
          <?php echo htmlspecialchars($data['hero']['subtitle']); ?>
          <br />
          <span class="text-xl md:text-2xl font-mono opacity-80 mt-2 block tracking-tight"><?php echo htmlspecialchars($data['hero']['location']); ?></span>
        </p>

        <!-- CTA Button -->
        <a href="#music"
          class="mt-8 group inline-flex items-center justify-center gap-3 bg-accent-yellow font-mono font-black text-xl px-8 py-4 border-[4px] border-ink shadow-brutal-md transition-all duration-300 hover:shadow-brutal-lg hover:-translate-y-1 hover:-translate-x-1 active:shadow-brutal-sm active:translate-y-1 active:translate-x-1 rotate-2">
          <i class="fa-solid fa-play group-hover:fa-beat"></i>
          <?php echo htmlspecialchars($data['hero']['cta']); ?>
        </a>
      </div>

      <!-- Right Context (Image/Collage) -->
      <div class="relative z-10 w-full md:w-1/2 flex justify-center items-center mt-12 md:mt-0 scroll-reveal"
        style="transition-delay: 200ms;">
        <!-- Main Polaroid -->
        <div class="relative w-72 md:w-96 polaroid rotate-3 interactive-hover group">
          <!-- Image container with mask -->
          <div class="w-full h-80 md:h-[450px] border-[3px] border-ink overflow-hidden bg-white mb-4">
            <img src="<?php echo htmlspecialchars($data['hero']['img']); ?>" alt="Prince Neupane - Hero Image"
              loading="lazy"
              class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-110 grayscale group-hover:grayscale-0" />
          </div>
          <!-- Caption -->
          <p class="font-handwriting text-3xl text-center text-ink flex items-center justify-center gap-2">
            <?php echo $data['hero']['img_caption']; ?>
          </p>

          <!-- Accents -->
          <div
            class="absolute -bottom-10 -right-8 w-24 h-24 bg-accent-blue rounded-full border-[3px] border-ink shadow-brutal-sm flex items-center justify-center -rotate-12 hover-wiggle">
            <span class="font-marker text-white text-xl text-center leading-none"><?php echo nl2br(htmlspecialchars($data['hero']['img_badge'] ?? 'Vibes\nOnly')); ?></span>
          </div>
        </div>
      </div>
    </section>

    <!-- About Section -->
    <section id="about" class="relative w-full min-h-screen py-24 flex items-center justify-center z-10 px-6">
      <!-- Paper Background Constraint -->
      <div class="max-w-5xl mx-auto w-full relative">
        <!-- Tape -->
        <div
          class="absolute -top-6 left-1/2 transform -translate-x-1/2 w-40 h-10 bg-[rgba(255,255,255,0.6)] backdrop-blur-sm z-30 shadow-sm border border-gray-200 rotate-[-2deg]">
        </div>
        <div
          class="absolute -bottom-6 right-10 w-24 h-8 bg-accent-yellow opacity-80 z-30 shadow-sm border border-ink rotate-6">
        </div>

        <!-- Notebook Paper Grid & Content -->
        <div
          class="relative bg-white w-full border-[4px] border-ink shadow-brutal-lg p-6 sm:p-8 md:p-16 flex flex-col lg:flex-row gap-8 sm:gap-12 md:overflow-visible interactive-hover overflow-visible scroll-reveal"
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
          <div class="w-full md:w-1/3 relative z-20 flex flex-col gap-6">
            <div class="polaroid -rotate-3">
              <img src="<?php echo htmlspecialchars($data['about']['img']); ?>" alt="Prince Singing - About Image"
                loading="lazy"
                class="w-full h-auto aspect-[3/4] object-cover border-[2px] border-ink filter sepia hover:sepia-0 transition-all duration-500" />
              <p class="font-handwriting text-xl text-center mt-2">
                <?php echo htmlspecialchars($data['about']['img_caption']); ?> 🏫
              </p>
            </div>
          </div>

          <!-- Right: Text Content -->
          <div class="w-full md:w-2/3 relative z-20 flex flex-col justify-center">
            <h2
              class="font-marker text-4xl sm:text-5xl md:text-7xl mb-6 md:mb-8 mt-6 md:mt-0 relative inline-block break-words">
              <?php echo htmlspecialchars($data['about']['title']); ?>
              <i
                class="fa-solid fa-sparkle absolute -top-4 -right-4 md:-right-8 text-2xl md:text-3xl text-accent-pink animate-pulse"></i>
            </h2>

            <?php
              // Map simple icon names to FontAwesome classes
              $icon_map = [
                'guitar' => 'fa-solid fa-guitar',
                'microphone' => 'fa-solid fa-microphone',
                'music' => 'fa-solid fa-music',
                'star' => 'fa-solid fa-star',
                'heart' => 'fa-solid fa-heart',
                'fire' => 'fa-solid fa-fire',
                'bolt' => 'fa-solid fa-bolt',
                'headphones' => 'fa-solid fa-headphones',
              ];
              $badge_icon_key = $data['about']['badge_icon'] ?? 'guitar';
              $badge_icon_class = $icon_map[$badge_icon_key] ?? 'fa-solid fa-guitar';

              // Auto-highlight keyword in content_p2
              $p2_text = htmlspecialchars($data['about']['content_p2'] ?? '');
              $p2_highlight = htmlspecialchars($data['about']['content_p2_highlight'] ?? '');
              if (!empty($p2_highlight) && strpos($p2_text, $p2_highlight) !== false) {
                $p2_rendered = str_replace(
                  $p2_highlight,
                  '<span class="bg-accent-blue px-3 py-1 rotate-[-1deg] inline-block shadow-brutal-sm text-white mt-1 mb-1 md:mt-0 md:mb-0">' . $p2_highlight . '</span>',
                  $p2_text
                );
              } else {
                $p2_rendered = $p2_text;
              }
            ?>
            <div class="font-marker text-lg sm:text-xl md:text-2xl mb-4 leading-relaxed tracking-wide">
              <p class="mb-4">
                <?php echo htmlspecialchars($data['about']['content_p1'] ?? ''); ?>
              </p>
              <p class="mb-4 bg-accent-yellow inline-block px-3 py-1 rotate-[1deg] shadow-brutal-sm">
                <?php echo htmlspecialchars($data['about']['content_highlight'] ?? ''); ?>
              </p>
              <br /><br />
              <p>
                <?php echo $p2_rendered; ?>
              </p>
            </div>

            <!-- Doodles/Pins -->
            <div
              class="hidden md:flex absolute -right-4 md:-right-12 bottom-10 w-20 h-20 md:w-24 md:h-24 bg-accent-pink rounded-full border-[3px] border-ink flex flex-col items-center justify-center text-white polaroid hover-wiggle shadow-brutal-sm">
              <i class="<?php echo htmlspecialchars($badge_icon_class); ?> text-3xl mb-1"></i>
              <span class="font-mono text-xs font-bold uppercase"><?php echo htmlspecialchars($data['about']['badge_text'] ?? '100% Raw'); ?></span>
            </div>
          </div>
        </div>
      </div>
    </section>

    <!-- Music Section -->
    <section id="music"
      class="relative w-full min-h-screen py-24 flex items-center justify-center z-20 overflow-hidden bg-accent-blue border-y-[4px] border-ink">
      <!-- Graphic background -->
      <div class="absolute inset-0 w-full h-full opacity-20 pointer-events-none" style="
            background-image: radial-gradient(
              var(--color-text-dark) 1px,
              transparent 1px
            );
            background-size: 20px 20px;
          "></div>

      <div class="relative w-full max-w-6xl mx-auto px-6 z-10 flex flex-col items-center">
        <!-- Section Title (Sticker) -->
        <div
          class="bg-white border-[3px] border-ink shadow-brutal-md px-8 py-3 mb-16 rotate-[1deg] hover:rotate-0 transition-transform scroll-reveal">
          <h2 class="font-marker text-5xl md:text-7xl uppercase">
            Latest Releases
          </h2>
        </div>

        <!-- Releases Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8 w-full scroll-reveal"
          style="transition-delay: 200ms;">
          <?php foreach ($data['music']['releases'] as $index => $release):
            $rotations = ['rotate-[-1deg]', 'rotate-[2deg]', 'rotate-[-2deg]', 'rotate-[1deg]'];
            $rot = $rotations[$index % 4];
            ?>
            <a href="<?php echo htmlspecialchars($release['link']); ?>" target="_blank"
              class="bg-white border-[4px] border-ink shadow-brutal-md p-4 group hover:-translate-y-2 hover:shadow-brutal-lg transition-all <?php echo $rot; ?>">
              <div
                class="aspect-square border-[2px] border-ink mb-4 flex items-center justify-center overflow-hidden relative bg-gray-200">
                <img src="<?php echo htmlspecialchars($release['img']); ?>"
                  alt="<?php echo htmlspecialchars($release['title']); ?> Cover Art" loading="lazy"
                  class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500">
                <div class="absolute inset-0 bg-black opacity-0 group-hover:opacity-20 transition-opacity"></div>
                <i
                  class="fa-solid fa-circle-play absolute text-white text-6xl opacity-0 group-hover:opacity-100 transition-opacity z-20 drop-shadow-md"></i>
              </div>
              <h3 class="font-mono font-bold text-xl uppercase"><?php echo htmlspecialchars($release['title']); ?></h3>
              <p class="font-sans text-gray-600 text-sm"><?php echo htmlspecialchars($release['desc']); ?></p>
            </a>
          <?php endforeach; ?>
        </div>

        <!-- CTA -->
        <a href="<?php echo htmlspecialchars($data['music']['cta_link']); ?>" target="_blank"
          class="mt-12 bg-accent-pink text-white font-mono font-black text-xl px-10 py-4 border-[4px] border-ink shadow-brutal-md transition-all duration-300 hover:shadow-brutal-lg hover:-translate-y-1 rotate-[-1deg]">
          <i class="fa-brands fa-youtube mr-2"></i>
          <?php echo htmlspecialchars($data['music']['cta']); ?>
        </a>
      </div>
    </section>

    <!-- Gallery Section -->
    <section id="gallery" class="relative w-full min-h-[150vh] py-24 flex flex-col items-center z-10">
      <!-- Title Marker -->
      <div
        class="bg-accent-yellow border-[3px] border-ink shadow-brutal-md px-10 py-4 mb-20 rotate-[-3deg] z-20 hover:rotate-3 transition-transform scroll-reveal">
        <h2 class="font-marker text-5xl md:text-7xl uppercase text-ink">
          Visuals
        </h2>
        <div
          class="absolute -right-6 -bottom-6 bg-accent-pink text-white font-handwriting text-2xl h-14 w-14 rounded-full flex items-center justify-center border-[2px] border-ink animate-bounce shadow-md">
          xox
        </div>
      </div>

      <!-- The Grid / Scatter Canvas -->
      <div
        class="relative w-full max-w-6xl min-h-screen flex flex-wrap justify-center content-center gap-10 px-4 md:px-0 pb-32 scroll-reveal text-center">
        <?php foreach ($data['gallery']['images'] as $photo): ?>
          <div
            class="gallery-item polaroid bg-white p-3 md:p-4 pb-10 md:pb-12 border-[4px] border-ink cursor-grab hover:z-50 m-4 shadow-brutal-md transition-all duration-300 hover:scale-105 active:scale-95 max-w-[85vw] md:max-w-[400px] <?php echo htmlspecialchars($photo['classes']); ?>"
            <?php echo !empty($photo['style']) ? 'style="' . htmlspecialchars($photo['style']) . '"' : ''; ?>>
            <div class="w-full aspect-[4/5] border-[3px] border-ink overflow-hidden bg-gray-200">
              <img src="<?php echo htmlspecialchars($photo['img']); ?>"
                alt="Gallery Photo - <?php echo htmlspecialchars($photo['caption'] ?? 'Prince Neupane'); ?>"
                loading="lazy" class="w-full h-full object-cover">
            </div>
            <p class="font-handwriting text-2xl text-center text-ink mt-2">
              <?php echo htmlspecialchars($photo['caption']); ?>
            </p>
          </div>
        <?php endforeach; ?>
      </div>
    </section>

    <!-- Contact Section -->
    <section id="contact"
      class="relative w-full min-h-screen flex items-center justify-center pb-24 md:pb-0 z-30 pt-32 overflow-hidden bg-cover bg-center"
      style="background-image: radial-gradient(circle, var(--color-accent-blue) 10%, transparent 10.5%), radial-gradient(circle, var(--color-accent-pink) 10%, transparent 10.5%); background-size: 30px 30px; background-position: 0 0, 15px 15px; opacity: 0.95;">
      <div class="relative w-full max-w-4xl mx-auto px-4 flex flex-col items-center">
        <!-- Large Sticky Note -->
        <div
          class="bg-accent-yellow w-full md:w-3/4 max-w-2xl border-[4px] border-ink shadow-brutal-lg p-8 md:p-14 relative rotate-2 interactive-hover transition-transform duration-300 hover:rotate-1 scroll-reveal">
          <!-- Virtual Pin -->
          <div
            class="w-8 h-8 rounded-full bg-red-500 border-2 border-white shadow-md absolute -top-4 left-1/2 transform -translate-x-1/2">
            <div class="w-2 h-2 rounded-full bg-white absolute top-1 right-2 opacity-70"></div>
          </div>
          <h2 class="font-marker text-5xl md:text-7xl mb-4 text-center">Let's Connect</h2>
          <p class="font-handwriting text-2xl md:text-4xl text-center mb-10 leading-relaxed text-opacity-80">
            Got a beat? A show? Or just wanna say hi?<br />Drop me a line, I don't bite. <i
              class="fa-solid fa-guitar"></i>
          </p>
          <div class="flex flex-col gap-4 max-w-md mx-auto">
            <a href="mailto:<?php echo htmlspecialchars($data['contact']['email'] ?? '69.prince.0112@gmail.com'); ?>"
              class="bg-white border-[3px] border-ink p-4 flex items-center gap-4 hover-wiggle group cursor-pointer transition-colors hover:bg-accent-pink shadow-brutal-sm">
              <i class="fa-solid fa-envelope-open-text text-3xl group-hover:text-white transition-colors"></i>
              <div>
                <h3 class="font-mono font-bold text-lg leading-none group-hover:text-white">Email</h3>
                <span class="font-sans text-sm text-gray-600 group-hover:text-gray-200"><?php echo htmlspecialchars($data['contact']['email'] ?? '69.prince.0112@gmail.com'); ?></span>
              </div>
            </a>
            <div class="grid grid-cols-2 gap-4 mt-2">
              <a href="<?php echo htmlspecialchars($data['contact']['instagram'] ?? 'https://instagram.com/prince_on_guitar'); ?>" target="_blank"
                class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[-1deg] hover:bg-accent-blue hover:text-ink">
                <i class="fa-brands fa-instagram text-2xl"></i><span class="font-mono font-bold">Instagram</span>
              </a>
              <a href="<?php echo htmlspecialchars($data['contact']['youtube'] ?? 'https://www.youtube.com/@Prince_on_guitar'); ?>" target="_blank"
                class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[1deg] hover:bg-red-500 hover:text-white">
                <i class="fa-brands fa-youtube text-2xl"></i><span class="font-mono font-bold">YouTube</span>
              </a>
              <a href="<?php echo htmlspecialchars($data['contact']['tiktok'] ?? '#'); ?>" target="_blank" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[2deg] hover:bg-black hover:text-white"><i class="fa-brands fa-tiktok text-2xl"></i><span class="font-mono font-bold">TikTok</span></a>
              <a href="<?php echo htmlspecialchars($data['contact']['spotify'] ?? '#'); ?>" target="_blank" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[-2deg] hover:bg-[#1DB954] hover:text-ink"><i class="fa-brands fa-spotify text-2xl"></i><span class="font-mono font-bold">Spotify</span></a>
            </div>
          </div>
          <div class="absolute bottom-6 right-6 font-marker text-4xl text-ink transform rotate-[-10deg] opacity-70">-
            Prince</div>
        </div>
        <div class="mt-20 text-center flex flex-col items-center">
          <p class="font-mono text-ink bg-white border-2 border-ink px-4 py-1 rotate-1 shadow-brutal-sm inline-block">
            <?php echo isset($data['contact']['footer']) ? htmlspecialchars($data['contact']['footer']) : '© 2026 Prince Neupane. All rights reserved.'; ?>
          </p>
          <a href="https://github.com/zenithkandel" target="_blank"
            class="font-mono text-sm mt-6 text-gray-800 hover:text-accent-pink transition-colors underline underline-offset-4 font-bold decoration-2 mb-10">Made
            by Zenith</a>
        </div>
      </div>
    </section>

  </main>

  <!-- Custom JavaScript -->
  <script src="assets/script.js"></script>
</body>

</html>
