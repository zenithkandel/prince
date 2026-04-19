import re

def main():
    with open('index.php', 'r', encoding='utf-8') as f:
        content = f.read()

    components = {}
    
    # 1. Extract head/header
    head_match = re.search(r'(<\?php.*?)<body', content, re.DOTALL | re.IGNORECASE)
    if head_match:
        components['header'] = head_match.group(1)

    # 2. Extract body tag and nav
    nav_match = re.search(r'(<body[^>]*>.*?)(<!-- MAIN CANVAS CONTAINER -->)', content, re.DOTALL | re.IGNORECASE)
    if nav_match:
        components['nav'] = nav_match.group(1)

    # 3. Extract Hero
    hero_match = re.search(r'(<section id="hero".*?)(<!-- About Section -->)', content, re.DOTALL | re.IGNORECASE)
    if hero_match:
        components['hero'] = hero_match.group(1)

    # 4. Extract About
    about_match = re.search(r'(<!-- About Section -->\s*<section id="about".*?)(<!-- Music Showcase -->)', content, re.DOTALL | re.IGNORECASE)
    if about_match:
        components['about'] = about_match.group(1)
        
    # 5. Extract Music
    music_match = re.search(r'(<!-- Music Showcase -->\s*<section id="music".*?)(<!-- Aesthetic Gallery/Scrapbook -->)', content, re.DOTALL | re.IGNORECASE)
    if music_match:
        components['music'] = music_match.group(1)

    # 6. Extract Gallery
    gallery_match = re.search(r'(<!-- Aesthetic Gallery/Scrapbook -->\s*<section id="gallery".*?)(<!-- Footer / Scrapbook End -->)', content, re.DOTALL | re.IGNORECASE)
    if gallery_match:
        components['gallery'] = gallery_match.group(1)

    # 7. Extract Contact / Footer
    contact_match = re.search(r'(<!-- Footer / Scrapbook End -->\s*<footer id="contact".*?)(<script>)', content, re.DOTALL | re.IGNORECASE)
    if contact_match:
        components['contact'] = contact_match.group(1)

    # 8. Extract Scripts / Closing
    footer_match = re.search(r'(<script>.*)', content, re.DOTALL | re.IGNORECASE)
    if footer_match:
        components['footer'] = footer_match.group(1)

    # Write them to files to inspect
    import os
    if not os.path.exists('components'):
        os.makedirs('components')

    for name, html in components.items():
        with open(f'components/{name}.php', 'w', encoding='utf-8') as out:
            out.write(html)
            
    print(f"Split {len(components)} components.")

if __name__ == "__main__":
    main()
