import io

with io.open('admin.php', 'r', encoding='utf-8') as f:
    content = f.read()

replacements = {
    '🏠': '<i class="fa-solid fa-house"></i>',
    '🎵': '<i class="fa-solid fa-music"></i>',
    '📸': '<i class="fa-solid fa-camera"></i>',
    '↗': '<i class="fa-solid fa-arrow-up-right-from-square"></i>',
    '✅': '<i class="fa-solid fa-check-circle"></i>',
    '⚡': '<i class="fa-solid fa-bolt"></i>',
    '📝': '<i class="fa-solid fa-file-signature"></i>',
    '💾': '<i class="fa-solid fa-floppy-disk"></i>',
    '💿': '<i class="fa-solid fa-compact-disc"></i>',
    '✂': '<i class="fa-solid fa-scissors"></i>',
    '🗑': '<i class="fa-solid fa-trash-can"></i>',
    '🔥': '<i class="fa-solid fa-fire"></i>',
    '💥': '<i class="fa-solid fa-burst"></i>',
    '\uFE0F': ''
}

for old, new in replacements.items():
    content = content.replace(old, new)

script_tag = '<script src="https://zenithkandel.com.np/fontawesome/zenith-icons.js"></script>'
if script_tag not in content:
    content = content.replace('<script src="https://cdn.tailwindcss.com"></script>', '<script src="https://cdn.tailwindcss.com"></script>\n    ' + script_tag)

with io.open('admin.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Icons fixed!")
