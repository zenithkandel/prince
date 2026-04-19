<!DOCTYPE html>
<html lang="en" class="scroll-smooth">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <title><?php echo htmlspecialchars($data['hero']['title_last']); ?> - Portfolio</title>
  <meta name="description" content="<?php echo htmlspecialchars(strip_tags($data['hero']['subtitle'])); ?>" />
  <meta name="keywords"
    content="<?php echo htmlspecialchars($data['hero']['title_last']); ?>, artist, musician, portfolio, nepal, toronto, music" />
  <meta name="author" content="<?php echo htmlspecialchars($data['hero']['title_last']); ?>" />

  <!-- Open Graph -->
  <meta property="og:title" content="<?php echo htmlspecialchars($data['hero']['title_last']); ?> - Portfolio" />
  <meta property="og:description" content="<?php echo htmlspecialchars(strip_tags($data['hero']['subtitle'])); ?>" />
  <meta property="og:image"
    content="<?php echo htmlspecialchars('https://' . $_SERVER['HTTP_HOST'] . '/' . $data['hero']['img']); ?>" />
  <meta property="og:url"
    content="<?php echo htmlspecialchars('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>" />
  <meta property="og:type" content="website" />

  <!-- Twitter Cards -->
  <meta name="twitter:card" content="summary_large_image" />
  <meta name="twitter:title" content="<?php echo htmlspecialchars($data['hero']['title_last']); ?> - Portfolio" />
  <meta name="twitter:description" content="<?php echo htmlspecialchars(strip_tags($data['hero']['subtitle'])); ?>" />
  <meta name="twitter:image"
    content="<?php echo htmlspecialchars('https://' . $_SERVER['HTTP_HOST'] . '/' . $data['hero']['img']); ?>" />

  <!-- Preconnect external resources -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

  <!-- Compiled Tailwind -->
  <link rel="preload" href="assets/tailwind.css" as="style">
  <link rel="stylesheet" href="assets/tailwind.css" />
  <link rel="stylesheet" href="assets/style.css" />

  <!-- FontAwesome Icons (deferred to improve paint time) -->
  <script src="https://zenithkandel.com.np/fontawesome/zenith-icons.js" defer></script>

  <!-- JSON-LD Structured Data Schema -->
  <script type="application/ld+json">
  {
    "@context": "https://schema.org",
    "@type": "MusicGroup",
    "name": "<?php echo htmlspecialchars($data['hero']['title_last']); ?>",
    "image": "<?php echo htmlspecialchars('https://' . $_SERVER['HTTP_HOST'] . '/' . $data['hero']['img']); ?>",
    "url": "<?php echo htmlspecialchars('https://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI']); ?>",
    "description": "<?php echo htmlspecialchars(strip_tags($data['hero']['subtitle'])); ?>"
  }
  </script>
</head>

<body class="bg-paper text-ink overflow-x-hidden min-h-screen relative w-full pt-20 lg:pt-0">
  <?php $data = json_decode(file_get_contents('api/data.json'), true); ?><!doctype html>
  <html lang="en" class="scroll-smooth">

  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Prince Neupane - Portfolio</title>

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
    <script src="https://zenithkandel.com.np/fontawesome/zenith-icons.js"></script>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="assets/styles.css" />

    <!-- Phosphor icons or other additions -->
  </head>