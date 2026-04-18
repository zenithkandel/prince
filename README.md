# Prince Neupane - Portfolio 🎸✨

A highly expressive, high-quality production-level portfolio designed for Prince Neupane—a young music artist, vocalist, and guitarist.

## 🎨 Design Concept

The core identity of this portfolio is designed around a **"Nostalgic digital scrapbook + playful 90s interface"**.

Since Prince is a young, creative artist (17-18) from Nepal to Toronto with a background in _Voice of Nepal Kids_, we completely avoided boring "corporate SaaS" templates. Instead, the UI feels human, raw, and slightly imperfect.

**Key visual elements:**

- **Neobrutalism Layout**: Thick black borders (`4px solid`), solid overlapping drop shadows (`var(--shadow-solid-lg)`).
- **Scrapbook Vibe**: Elements resemble ripped notebook paper, polaroids, sticky notes, and tapes scattered on a canvas.
- **Expressive Typography**: `Permanent Marker` for big loud headings, `Caveat` for handwritten notes, and `Space Mono` for the digital/nostalgic contrast.
- **Fake Draggable Physics**: The gallery section allows polaroids to be dragged around organically imitating a messy desk.

## 🛠️ Tech Stack

Built lightweight and blazing fast:

- **HTML5** (Semantically structured)
- **Tailwind CSS** (Via CDN for rapid styling, heavily customized with global variables)
- **Vanilla JavaScript** (For scroll, parallax hover tilts, and drag physics - zero heavy framework overhead)
- **FontAwesome Premium** (Using a custom external CDN for rich, duotone and solid expressive icons)

## 📁 Folder Structure

```text
/prince
├── index.html           # Main markup & structure
├── styles.css           # Custom CSS variables, animations, and typography bindings
├── script.js            # Vanilla JS physics (drag, tilt, hover)
└── /images              # All optimized assets (Polaroids, Hero shots)
```

## 🚀 How to Run

1. Simply clone this repository or download the folder.
2. Open `index.html` in any modern web browser or run via Live Server (VS Code Extension).
3. No build tools (npm/node) are required! The site runs instantly through CDN-linked dependencies.

## 🎨 Customization Guide

### Changing Global Themes

Open `styles.css`. Inside the `:root` block, simply edit the color hex codes:

```css
--bg-primary: #f4f0e6;
--color-accent-blue: #00e5ff;
--color-accent-pink: #ff00ff;
--color-accent-yellow: #ffea00;
```

Because the entire Tailwind instance within `index.html` reads these variables, **changing one color here will automatically update the entire site.**

### Changing Images

Place your new pictures inside `images/`. Update the `src=""` attributes in `index.html`.
For polaroids, simply add the class `polaroid` to any container wrapping an `img` tag to instantly get the white-border shadow and tape effect.

## 📱 Mobile Architecture

Scaling a scrapbook requires a specialized perspective:

- Gallery images auto-align into a constrained scroll view with fewer extreme rotations.
- Standard hover wiggles fall back to auto-animations.
- The sticky navigation bar drops to the bottom of the screen (`bottom-4`) simulating a persistent thumb-level control, avoiding top-nav hamburger clutter.

---

> Built with 💛 for Prince. Let's Make Noise.
