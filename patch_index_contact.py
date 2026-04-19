import re

with open('index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Update email hook
text = text.replace(
    'href="mailto:69.prince.0112@gmail.com"',
    'href="mailto:<?php echo htmlspecialchars($data[\'contact\'][\'email\'] ?? \'69.prince.0112@gmail.com\'); ?>"'
)
text = text.replace(
    '<span class="font-sans text-sm text-gray-600 group-hover:text-gray-200">69.prince.0112@gmail.com</span>',
    '<span class="font-sans text-sm text-gray-600 group-hover:text-gray-200"><?php echo htmlspecialchars($data[\'contact\'][\'email\'] ?? \'69.prince.0112@gmail.com\'); ?></span>'
)

# Update Instagram hook
text = text.replace(
    'href="https://instagram.com/prince_on_guitar"',
    'href="<?php echo htmlspecialchars($data[\'contact\'][\'instagram\'] ?? \'https://instagram.com/prince_on_guitar\'); ?>"'
)

# Update YouTube hook
text = text.replace(
    'href="https://www.youtube.com/@Prince_on_guitar"',
    'href="<?php echo htmlspecialchars($data[\'contact\'][\'youtube\'] ?? \'https://www.youtube.com/@Prince_on_guitar\'); ?>"'
)

# Update TikTok hook
text = re.sub(
    r'<a href="#"\s*class="bg-ink text-white border-\[3px\] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-\[2deg\] hover:bg-black hover:text-white">\s*<i class="fa-brands fa-tiktok text-2xl"></i><span class="font-mono font-bold">TikTok</span>\s*</a>',
    r'<a href="<?php echo htmlspecialchars($data[\'contact\'][\'tiktok\'] ?? \'#\'); ?>" target="_blank" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[2deg] hover:bg-black hover:text-white"><i class="fa-brands fa-tiktok text-2xl"></i><span class="font-mono font-bold">TikTok</span></a>',
    text
)

# Update Spotify hook
text = re.sub(
    r'<a href="#"\s*class="bg-ink text-white border-\[3px\] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-\[-2deg\] hover:bg-\[#1DB954\] hover:text-ink">\s*<i class="fa-brands fa-spotify text-2xl"></i><span class="font-mono font-bold">Spotify</span>\s*</a>',
    r'<a href="<?php echo htmlspecialchars($data[\'contact\'][\'spotify\'] ?? \'#\'); ?>" target="_blank" class="bg-ink text-white border-[3px] border-ink p-4 flex justify-center items-center gap-2 hover:-translate-y-1 hover:shadow-brutal-sm transition-all rotate-[-2deg] hover:bg-[#1DB954] hover:text-ink"><i class="fa-brands fa-spotify text-2xl"></i><span class="font-mono font-bold">Spotify</span></a>',
    text
)

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(text)
