import re

with open('index.php', 'r', encoding='utf-8') as f:
    text = f.read()

old_text = r'class="gallery-item polaroid bg-white p-3 md:p-4 pb-10 md:pb-12 border-\[4px\] border-ink cursor-grab hover:z-50 m-4 shadow-brutal-md transition-all duration-300 hover:scale-105 active:scale-95 <\?php echo htmlspecialchars\(\$photo\[\'classes\'\]\); \?>"'
new_text = 'class="gallery-item polaroid bg-white p-3 md:p-4 pb-10 md:pb-12 border-[4px] border-ink cursor-grab hover:z-50 m-4 shadow-brutal-md transition-all duration-300 hover:scale-105 active:scale-95 max-w-[85vw] md:max-w-[400px] <?php echo htmlspecialchars($photo[\'classes\']); ?>"'

text, n = re.subn(old_text, new_text, text)
print(f'Replaced {n} occurrences in index.php')

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(text)
