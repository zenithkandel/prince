# Prince Neupane - Portfolio 🎸✨

A highly expressive, production-level portfolio designed for Prince Neupane—a young music artist, vocalist, and guitarist. 

## 🎨 Theme & Design Concept

The core identity of this portfolio is built around a **"Nostalgic digital scrapbook + playful 90s interface"** and **"Neo-brutalism"**. 

Since Prince is a young, creative artist with a background in *Voice of Nepal Kids*, we completely avoided boring "corporate SaaS" templates. Instead, the UI feels human, raw, wonderfully chaotic, and highly interactive.

**Key visual elements:**
*   **Neo-brutalism Layout**: Thick black borders (order-[3px], order-black), solid overlapping drop shadows (rutal-shadow), and bold, high-contrast accent colors like vibrant yellow (g-yellow-300), cyan (g-cyan-400), magenta/pink (g-[#ff00ff]), and Spotify green (g-[#1DB954]).
*   **Scrapbook Vibe**: Elements resemble ripped notebook paper, polaroids, sticky notes, and tape scattered on a canvas. We use explicit CSS rotations (otate-1, -rotate-2, etc.) to make elements look organically placed.
*   **Expressive Typography**: Permanent Marker for big loud headings, Caveat for handwritten notes, and Space Mono for the digital/nostalgic contrast.
*   **Interactive Physics**: The gallery section allows polaroids to be dragged around organically, imitating a messy desk. Neobrutalist scroll-reveal animations are used as elements enter the viewport.

## 🛠️ Architecture & Tech Stack

Built to be lightweight, blazing fast, but dynamically manageable by the artist without needing to touch code. We achieved this through a custom-built solution without heavy framework overhead:

*   **PHP 8+**: Server-side rendering, routing, and Admin authentication.
*   **Tailwind CSS (v4)**: Used for rapid styling, grid layouts, and neo-brutalist utility classes. Compiled and minified via @tailwindcss/cli for production.
*   **Vanilla JavaScript**: 
    *   IntersectionObserver for Persistent Scroll Reveal animations.
    *   Scroll Spy navigation highlighting.
    *   Drag-and-drop physics and modal management.
    *   Zero heavy framework overhead (No React/Vue).
*   **JSON Database (pi/data.json)**: Used as a flat-file database for screaming fast read/writes without the need for MySQL.
*   **Python (Build Tooling)**: Used internally during development for running structural HTML/PHP text-replacements and codebase patching.

## 📐 Specifications & Features

*   **Custom Admin Dashboard**: A fully functional backend (/admin) allowing real-time edits to the Hero text, About section, Music releases, Gallery uploads, and Social/Contact links.
*   **Dynamic Data Binding**: The frontend (index.php) reads directly from pi/data.json, meaning any changes saved in the admin panel instantly reflect on the live site.
*   **Performance & SEO**: Implemented native lazy loading (loading="lazy") for images, optimized viewport meta tags, semantic HTML5 structuring, and minimized CSS assets.
*   **Two-Way Scroll Animations**: Elements visually pop in and out as you scroll up and down the page using the .scroll-reveal and .is-visible classes managed by Javascript.
*   **Responsive Navigation**: A sticky bottom-nav on mobile that avoids traditional top-nav hamburger menus, keeping links right at the user's thumb. Fits 5 custom styled items via fine-tuned mobile breakpoints.

## 📚 Resources & Assets Used

*   **Icons**: FontAwesome Premium (via CDN zenith-icons.js) for rich duotone and solid expressive icons (e.g., platforms like Instagram, TikTok, Spotify).
*   **Fonts**: Google Fonts (Space Mono, Permanent Marker, Caveat, Inter).
*   **Styling**: Tailwind CSS (used via CLI to generate ssets/tailwind.css).
*   **Backend Server**: XAMPP/LAMP environment for local PHP execution.

## 📁 Folder Structure

`	ext
/prince
├── index.php             # Main portfolio frontend
├── /admin
│   ├── index.php         # Secure Dashboard UI
│   └── login.php         # Authentication Gateway
├── /api
│   ├── data.json         # Flat-file database storing all content
│   ├── auth.php          # Session & Login handling logic
│   └── update.php        # CRUD operations handling JSON writes & image uploads
├── /assets
│   ├── style.css         # CSS Variables & base styles
│   ├── tailwind.css      # Minified Tailwind build 
│   └── script.js         # Frontend interactive physics & IntersectionObservers
└── /uploads              # Dynamically uploaded images (Gallery, Music covers)
`

## 🚀 How to Run & Deploy

This project is a traditional LAMP/LEMP stack application. 

1.  **Local Environment**: Place the folder inside htdocs (XAMPP) or www (MAMP/WAMP).
2.  **Start Apache**: Ensure your local PHP server is running.
3.  **Permissions**: Ensure the /api/data.json file and /uploads/ directory have chmod 755 or 777 permissions so the PHP server can write to them.
4.  **Access Frontend**: Visit http://localhost/prince/
5.  **Access Admin**: Visit http://localhost/prince/admin/

## ⚙️ Admin Panel Usage

The custom-built Admin Panel allows Prince to manage his entire portfolio without coding:

*   **Login**: Access /admin and enter the secure password.
*   **General Stats**: Update Hero text, About me paragraphs, and all Social/Contact links (Email, YouTube, Instagram, TikTok, Spotify).
*   **Music & Gallery**: 
    *   Upload new .jpg, .png, or .webp files.
    *   The system automatically assigns randomized brutalist rotation and sizing classes if left blank, keeping the scrapbook aesthetic organic!
    *   Inline delete buttons dynamically remove items and their associated image files.
