import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Using pure string operations for perfect extraction
gallery_start = text.find('<!-- Dedicated Delete Zone (Cleaner UX) -->')
# Only looking within the gallery tab context
gallery_end = text.find('<div class="fixed bottom', gallery_start)

if gallery_start != -1 and gallery_end != -1:
    text = text[:gallery_start] + text[gallery_end:]

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Final danger zone check:", "Danger Zone" in text)
