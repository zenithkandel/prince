# Prince Neupane - Portfolio ???

A highly expressive, production-level portfolio designed for Prince Neupane—a young music artist, vocalist, and guitarist. 

## ?? Design Concept

The core identity of this portfolio is built around a **"Nostalgic digital scrapbook + playful 90s interface"**. 

Since Prince is a young, creative artist (from Nepal, making noise in Toronto) with a background in *Voice of Nepal Kids*, we completely avoided boring "corporate SaaS" templates. Instead, the UI feels human, raw, and wonderfully chaotic.

**Key visual elements:**
*   **Neobrutalism Layout**: Thick black borders, solid overlapping drop shadows (ar(--shadow-solid-lg)).
*   **Scrapbook Vibe**: Elements resemble ripped notebook paper, polaroids, sticky notes, and tape scattered on a canvas.
*   **Expressive Typography**: Permanent Marker for big loud headings, Caveat for handwritten notes, and Space Mono for the digital/nostalgic contrast.
*   **Interactive Physics**: The gallery section allows polaroids to be dragged around organically, imitating a messy desk.

## ??? Architecture & Tech Stack

Built to be lightweight, blazing fast, but dynamically manageable by the artist without needing to touch code:

*   **PHP 8+** (Server-side rendering and Admin authentication)
*   **Tailwind CSS** (Via CDN for rapid styling, compiled/minified for production)
*   **Vanilla JavaScript** (For scroll spy, drag physics, and modals - zero heavy framework overhead)
*   **FontAwesome Premium** (Rich duotone and solid expressive icons)
*   **JSON Database** (pi/data.json) - Used as a flat-file database for screaming fast read/writes.

## ?? Folder Structure

`	ext
/prince
+-- index.php             # Main portfolio frontend
+-- /admin
¦   +-- index.php         # Secure Dashboard UI
¦   +-- login.php         # Authentication Gateway
+-- /api
¦   +-- data.json         # Flat-file database storing all content
¦   +-- auth.php          # Session & Login handling logic
¦   +-- update.php        # CRUD operations handling JSON writes & image uploads
+-- /assets
¦   +-- style.css         # CSS Variables & base styles
¦   +-- tailwind.css      # Minified Tailwind build 
¦   +-- script.js         # Frontend interactive physics
+-- /uploads              # Dynamically uploaded images (Gallery, Music covers)
`

## ?? How to Run & Deploy

This project is a traditional LAMP/LEMP stack application. It does not require Node.js or build steps to run.

1.  **Local Environment**: Place the folder inside htdocs (XAMPP) or www (MAMP/WAMP).
2.  **Start Apache**: Ensure your local PHP server is running.
3.  **Permissions**: Ensure the /api/data.json file and /uploads/ directory have chmod 755 or 777 permissions so the server can write to them.
4.  **Access Frontend**: Visit http://localhost/prince/
5.  **Access Admin**: Visit http://localhost/prince/admin/

## ?? Admin Panel Usage

The custom-built Admin Panel allows Prince to manage his entire portfolio without coding:

*   **Login**: Access /admin and enter the secure password.
*   **General Limits**: Update Hero text, About me paragraphs, and social links instantly.
*   **Music & Gallery**: 
    *   Upload new .jpg, .png, or .webp files.
    *   The system automatically assigns randomized brutalist rotation and sizing classes (e.g. otate-3 w-64 md:right-10) if left blank, keeping the scrapbook aesthetic organic!
    *   Inline delete buttons (???) dynamically remove items and their associated image files.

## ?? Mobile Architecture

Scaling a scrapbook requires a specialized perspective:
*   **Dynamic Padding**: Text sizes and paddings are heavily adjusted using sm: and md: Tailwind breakpoints to ensure legibility on 320px-420px screens.
*   **Gallery Physics**: Images auto-align into a constrained scroll view with fewer extreme rotations. Dragging is fully touch-supported (	ouchstart, 	ouchmove).
*   **Floating Navigation**: The sticky navigation bar drops to the bottom of the screen (ottom-4) simulating a persistent thumb-level control, avoiding top-nav hamburger menus.
