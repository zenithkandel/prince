import re
import os

with open('index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Define boundaries
boundaries = {
    'header.php': [r'^(.*?)(?=<body)', '<!-- _HEADER_ -->'],
    'nav.php': [r'(<body[^>]*>.*?)(?=<!-- MAIN CANVAS CONTAINER -->)', '<!-- _NAV_ -->'],
    'hero.php': [r'(<!-- Hero Section -->.*?)(?=<!-- About Section -->)', '<!-- _HERO_ -->'],
    'about.php': [r'(<!-- About Section -->.*?)(?=<!-- Music Section -->)', '<!-- _ABOUT_ -->'],
    'music.php': [r'(<!-- Music Section -->.*?)(?=<!-- Gallery Section -->)', '<!-- _MUSIC_ -->'],
    'gallery.php': [r'(<!-- Gallery Section -->.*?)(?=<!-- Contact Section -->)', '<!-- _GALLERY_ -->'],
    'contact.php': [r'(<!-- Contact Section -->.*?)(?=</main>)', '<!-- _CONTACT_ -->'],
    'footer.php': [r'(</main>.*?)$', '<!-- _FOOTER_ -->']
}

components = {}
for name, data in boundaries.items():
    pattern = data[0]
    match = re.search(pattern, text, re.DOTALL | re.IGNORECASE)
    if match:
        components[name] = match.group(1)
        print(f"Extracted {name}")
    else:
        print(f"Failed to extract {name}")

for name, html in components.items():
    with open(f'components/{name}', 'w', encoding='utf-8') as out:
        out.write(html)
