import re

with open('index.php', 'r', encoding='utf-8') as f:
    html = f.read()

# 1. Update text-sizes in about section.
html = re.sub(
    r'<h2 class="font-marker text-5xl md:text-7xl mb-8 relative inline-block">',
    r'<h2 class="font-marker text-4xl sm:text-5xl md:text-7xl mb-6 md:mb-8 mt-6 md:mt-0 relative inline-block break-words">',
    html
)

html = re.sub(
    r'<div class="font-marker text-2xl mb-4 leading-relaxed tracking-wide">',
    r'<div class="font-marker text-lg sm:text-xl md:text-2xl mb-4 leading-relaxed tracking-wide">',
    html
)

html = re.sub(
    r'<i class="fa-solid fa-sparkle absolute -top-4 -right-8 text-3xl text-accent-pink animate-pulse"></i>',
    r'<i class="fa-solid fa-sparkle absolute -top-4 -right-4 md:-right-8 text-2xl md:text-3xl text-accent-pink animate-pulse"></i>',
    html
)


# 2. Fix the flex order for mobile (Image should come first, text below it) & Padding
# The container
html = re.sub(
    r'p-8 md:p-16 flex flex-col md:flex-row gap-12',
    r'p-6 sm:p-8 md:p-16 flex flex-col lg:flex-row gap-8 sm:gap-12 md:overflow-visible',
    html
)

# Wait... making the inline stuff proper spacing
html = re.sub(
    r'<p class="mb-4 bg-accent-yellow inline px-2 rotate-\[1deg\] shadow-brutal-sm">',
    r'<p class="mb-4 bg-accent-yellow inline-block px-3 py-1 rotate-[1deg] shadow-brutal-sm">',
    html
)

html = re.sub(
    r'<span class="bg-accent-blue px-2 rotate-\[-1deg\] inline-block shadow-brutal-sm text-white">',
    r'<span class="bg-accent-blue px-3 py-1 rotate-[-1deg] inline-block shadow-brutal-sm text-white mt-1 mb-1 md:mt-0 md:mb-0">',
    html
)

# 3. Add responsive padding to the doodle pin so it doesn't break horizontal scroll
html = re.sub(
    r'<div\s*class="absolute -right-4 md:-right-12 bottom-10 w-24 h-24 bg-accent-pink',
    r'<div class="hidden md:flex absolute -right-4 md:-right-12 bottom-10 w-20 h-20 md:w-24 md:h-24 bg-accent-pink',
    html
)


with open('index.php', 'w', encoding='utf-8') as f:
    f.write(html)
print("Updated index.php layout")
