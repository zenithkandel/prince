# Prince Neupane - Portfolio

A highly expressive, production-level portfolio designed for Prince Neupane - a young music artist, vocalist, and guitarist.

## Theme & Design Concept

The core identity of this portfolio is built around a **"Nostalgic digital scrapbook + playful 90s interface"** and **"Neo-brutalism"**.

Since Prince is a young, creative artist with a background in *Voice of Nepal Kids*, we completely avoided boring "corporate SaaS" templates. Instead, the UI feels human, raw, wonderfully chaotic, and highly interactive.

**Key visual elements:**
* **Neo-brutalism Layout**: Thick black borders, solid overlapping drop shadows, and bold, high-contrast accent colors like vibrant yellow, cyan, magenta/pink, and Spotify green.
* **Scrapbook Vibe**: Elements resemble ripped notebook paper, polaroids, sticky notes, and tape scattered on a canvas. CSS rotations make elements look organically placed.
* **Expressive Typography**: Permanent Marker for big loud headings, Caveat for handwritten notes, and Space Mono for the digital/nostalgic contrast.
* **Interactive Physics**: The gallery section allows polaroids to be dragged around organically, imitating a messy desk. Neobrutalist scroll-reveal animations are used as elements enter the viewport.

## Architecture & Tech Stack

Built to be lightweight, blazing fast, but dynamically manageable by the artist without needing to touch code.

* **PHP 8+**: Server-side rendering, routing, and Admin authentication.
* **Tailwind CSS (v4)**: Used via CDN for rapid styling, grid layouts, and neo-brutalist utility classes.
* **Vanilla JavaScript**:
    * IntersectionObserver for Persistent Scroll Reveal animations.
    * Scroll Spy navigation highlighting.
    * Drag-and-drop physics and modal management.
    * Zero heavy framework overhead (No React/Vue).
* **JSON Database (api/data.json)**: Used as a flat-file database for fast read/writes without the need for MySQL.

## Specifications & Features

* **Custom Admin Dashboard**: A fully functional backend (/admin) allowing real-time edits to the Hero text, About section, Music releases, Gallery uploads, and Social/Contact links.
* **Dynamic Data Binding**: The frontend (index.php) reads directly from api/data.json, meaning any changes saved in the admin panel instantly reflect on the live site.
* **Performance & SEO**: Implemented native lazy loading (loading="lazy") for images, optimized viewport meta tags, semantic HTML5 structuring, and Open Graph/Twitter Card meta tags.
* **Two-Way Scroll Animations**: Elements visually pop in and out as you scroll up and down the page using the .scroll-reveal and .is-visible classes managed by Javascript.
* **Responsive Navigation**: A sticky bottom-nav on mobile that avoids traditional top-nav hamburger menus, keeping links right at the user's thumb.
* **Mobile-First Design**: Fully responsive layout with optimized touch targets, safe-area support for notched devices, and reduced animations for mobile performance.

## Resources & Assets Used

* **Icons**: FontAwesome Premium (via CDN zenith-icons.js) for rich duotone and solid expressive icons.
* **Fonts**: Google Fonts (Space Mono, Permanent Marker, Caveat, Inter).
* **Styling**: Tailwind CSS (via CDN) + custom CSS variables and animations.
* **Backend Server**: XAMPP/LAMP environment for local PHP execution.

## Folder Structure

```
/prince
├── index.php             # Main portfolio frontend
├── /admin
│   └── index.php         # Secure Dashboard UI (with inline auth)
├── /api
│   ├── data.json         # Flat-file database storing all content
│   ├── auth.php          # Session & Login handling logic (inline login form)
│   ├── update.php        # CRUD operations handling JSON writes & image uploads
│   └── get.php           # Public JSON API endpoint
├── /assets
│   ├── styles.css        # CSS Variables, animations, viral card styles
│   └── script.js         # Frontend interactive physics & IntersectionObservers
├── /images               # Uploaded images (Gallery, Music covers, Favicon)
└── README.md
```

## How to Run & Deploy

This project is a traditional LAMP/LEMP stack application.

1. **Local Environment**: Place the folder inside htdocs (XAMPP) or www (MAMP/WAMP).
2. **Start Apache**: Ensure your local PHP server is running.
3. **Permissions**: Ensure the /api/data.json file and /images/ directory have write permissions so the PHP server can write to them.
4. **Access Frontend**: Visit http://localhost/prince/
5. **Access Admin**: Visit http://localhost/prince/admin/

## Admin Panel Usage

The custom-built Admin Panel allows Prince to manage his entire portfolio without coding:

* **Login**: Access /admin and enter the secure password.
* **General Settings**: Update Hero text, About me paragraphs, and all Social/Contact links (Email, YouTube, Instagram, TikTok, Spotify).
* **Music & Gallery**:
    * Upload new .jpg, .png, or .webp files.
    * The system automatically assigns randomized brutalist rotation and sizing classes if left blank, keeping the scrapbook aesthetic organic.
    * Inline delete buttons dynamically remove items and their associated image files.
* **Viral Content**: Add viral short-form content from TikTok, Instagram, YouTube, Facebook, or X/Twitter with automatic platform detection and thumbnail fetching.
