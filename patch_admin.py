import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Add viewport meta tag
if '<meta name="viewport"' not in text:
    text = text.replace('<meta charset="UTF-8">', '<meta charset="UTF-8">\n    <meta name="viewport" content="width=device-width, initial-scale=1.0">')

# Modify Mobile Bottom Navigation
old_nav_pattern = r'<!-- Mobile Bottom Navigation -->.*?</nav>'

# New Bottom Navigation modeled after the site's Navigation Sticker
new_nav = """<!-- Mobile Bottom Navigation -->
    <nav class="md:hidden fixed bottom-4 left-0 w-full z-50 px-4">
        <div class="flex justify-center">
            <ul class="flex items-center justify-between w-full max-w-sm bg-yellow-300 px-4 py-3 border-[3px] border-black brutal-shadow rotate-1">
                <li class="text-center w-1/3">
                    <a href="?tab=general" class="font-mono font-bold text-[10px] uppercase flex flex-col items-center <?php echo $tab === 'general' ? 'text-black scale-110' : 'text-gray-800 opacity-80'; ?>">
                        <i class="fa-solid fa-house mb-1 text-xl"></i>
                        <span>Stats</span>
                    </a>
                </li>
                <li class="text-center w-1/3">
                    <a href="?tab=music" class="font-mono font-bold text-[10px] uppercase flex flex-col items-center <?php echo $tab === 'music' ? 'text-black scale-110' : 'text-gray-800 opacity-80'; ?>">
                        <i class="fa-solid fa-music mb-1 text-xl"></i>
                        <span>Music</span>
                    </a>
                </li>
                <li class="text-center w-1/3">
                    <a href="?tab=gallery" class="font-mono font-bold text-[10px] uppercase flex flex-col items-center <?php echo $tab === 'gallery' ? 'text-black scale-110' : 'text-gray-800 opacity-80'; ?>">
                        <i class="fa-solid fa-camera mb-1 text-xl"></i>
                        <span>Gallery</span>
                    </a>
                </li>
            </ul>
        </div>
    </nav>"""

text = re.sub(old_nav_pattern, new_nav, text, flags=re.DOTALL)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Meta viewport added and mobile bottom nav redesigned!")
