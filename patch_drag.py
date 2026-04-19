import re

with open('index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Add gallery-item to all polaroid divs inside the gallery loop
old_cls = 'class="polaroid bg-white p-3 md:p-4 pb-10 md:pb-12 border-[4px] border-ink cursor-grab hover:z-50 m-4 shadow-brutal-md transition-all duration-300 hover:scale-105 active:scale-95 <?php echo htmlspecialchars($photo['
new_cls = 'class="gallery-item polaroid bg-white p-3 md:p-4 pb-10 md:pb-12 border-[4px] border-ink cursor-grab hover:z-50 m-4 shadow-brutal-md transition-all duration-300 hover:scale-105 active:scale-95 <?php echo htmlspecialchars($photo['

text = text.replace(old_cls, new_cls)

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Added gallery-item class!")