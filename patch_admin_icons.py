import os

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

replacements = {
    '<label class="font-bold uppercase text-sm">Public Email</label>': '<label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-solid fa-envelope text-lg"></i> Public Email</label>',
    '<label class="font-bold uppercase text-sm">YouTube Link</label>': '<label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-youtube text-red-500 text-lg"></i> YouTube Link</label>',
    '<label class="font-bold uppercase text-sm">Instagram Link</label>': '<label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-instagram text-pink-500 text-lg"></i> Instagram Link</label>',
    '<label class="font-bold uppercase text-sm">TikTok Link</label>': '<label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-tiktok text-gray-800 text-lg"></i> TikTok Link</label>',
    '<label class="font-bold uppercase text-sm">Spotify Link</label>': '<label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-brands fa-spotify text-green-500 text-lg"></i> Spotify Link</label>',
    '<label class="font-bold uppercase text-sm">Footer Text</label>': '<label class="font-bold uppercase text-sm flex items-center gap-2"><i class="fa-regular fa-copyright text-gray-600 text-lg"></i> Footer Text</label>'
}

for old, new in replacements.items():
    text = text.replace(old, new)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Icons injected successfully.")
