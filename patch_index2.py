import re

with open('index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Fix polaroid style in gallery
old_gallery = '<div class="polaroid <?php echo htmlspecialchars($photo[\'classes\']); ?> md:absolute scale-90 md:scale-100 shadow-brutal-md hover:shadow-brutal-lg z-10 hover:z-[60]"'
new_gallery = '<div class="polaroid bg-white p-4 pb-12 border-[4px] border-ink bg-white transition-all duration-300 md:absolute scale-90 md:scale-100 shadow-brutal-md hover:shadow-brutal-lg z-[10] hover:z-[60] <?php echo htmlspecialchars($photo[\'classes\']); ?>"'
text = text.replace(old_gallery, new_gallery)

# Ensure paragraphs from data.json render properly without stripping HTML tags since they contain span tags.
text = re.sub(r'<\?php echo htmlspecialchars\(\$data\[\'about\'\]\[\'content_p1\'\]\); \?>', r"<?php echo $data['about']['content_p1']; ?>", text)
text = re.sub(r'<\?php echo htmlspecialchars\(\$data\[\'about\'\]\[\'content_p2\'\]\); \?>', r"<?php echo $data['about']['content_p2']; ?>", text)

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Fixed polaroids and paragraph tags")
