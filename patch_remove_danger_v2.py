import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Removing the "Dedicated Delete Zone" for Music
old_music_danger = r'<!-- Dedicated Delete Zone \(Cleaner UX\) -->\s*<\?php if \(!empty\(\$data\[\'music\'\]\[\'releases\'\]\)\): \?>\s*<div class="mt-24 w-full pt-12 border-t-\[8px\] border-black border-dashed relative">[\s\S]*?</div>\s*<\?php endforeach; \?>\s*</div>\s*</div>\s*<\?php endif; \?>'
text = re.sub(old_music_danger, '<!-- Old Music Danger Zone removed -->', text)

# Removing the "Dedicated Delete Zone" for Gallery
old_gallery_danger = r'<!-- Dedicated Delete Zone \(Cleaner UX\) -->\s*<\?php if \(!empty\(\$data\[\'gallery\'\]\[\'images\'\]\)\): \?>\s*<div class="mt-24 w-full pt-12 border-t-\[8px\] border-black border-dashed relative">[\s\S]*?</div>\s*<\?php endforeach; \?>\s*</div>\s*</div>\s*<\?php endif; \?>'
text = re.sub(old_gallery_danger, '<!-- Old Gallery Danger Zone removed -->', text)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Danger Zones officially purged!")
