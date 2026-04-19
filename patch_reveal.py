import re

with open('index.php', 'r', encoding='utf-8') as f:
    html = f.read()

# 1. Hero text block
html = html.replace(
    '<div class="relative z-20 md:w-3/5 text-center md:text-left">',
    '<div class="relative z-20 md:w-3/5 text-center md:text-left scroll-reveal">'
)

# 2. Hero image block
html = html.replace(
    '<div class="relative w-full md:w-2/5 p-4 z-20 mt-10 md:mt-0 flex justify-center">',
    '<div class="relative w-full md:w-2/5 p-4 z-20 mt-10 md:mt-0 flex justify-center scroll-reveal" style="transition-delay: 200ms;">'
)

# 3. About Container
html = html.replace(
    'class="relative bg-white w-full border-[4px] border-ink \nshadow-brutal-lg p-6 sm:p-8 md:p-16 flex flex-col lg:flex-row gap-8 sm:gap-12 md:overflow-visible \ninteractive-hover overflow-visible"',
    'class="relative bg-white w-full border-[4px] border-ink shadow-brutal-lg p-6 sm:p-8 md:p-16 flex flex-col lg:flex-row gap-8 sm:gap-12 md:overflow-visible interactive-hover overflow-visible scroll-reveal"'
)
# Fallback if python messed up newlines:
html = re.sub(
    r'class="(relative bg-white w-full border-\[4px\] border-ink [^"]*interactive-hover overflow-visible)"',
    r'class="\1 scroll-reveal"',
    html
)

# 4. Music Cards Loop Wrapper
html = html.replace(
    '<h2 class="font-marker text-5xl md:text-7xl mb-12 text-center text-ink">',
    '<h2 class="font-marker text-5xl md:text-7xl mb-12 text-center text-ink scroll-reveal">'
)

html = html.replace(
    '<div class="max-w-7xl mx-auto flex flex-wrap justify-center gap-10 md:gap-16">',
    '<div class="max-w-7xl mx-auto flex flex-wrap justify-center gap-10 md:gap-16 scroll-reveal">'
)

# 5. Gallery Title
html = html.replace(
    'px-10 py-4 mb-20 rotate-[-3deg] z-20 hover:rotate-3 transition-transform">',
    'px-10 py-4 mb-20 rotate-[-3deg] z-20 hover:rotate-3 transition-transform scroll-reveal">'
)

# 6. Contact Note
html = html.replace(
    'class="bg-accent-yellow w-full md:w-3/4 max-w-2xl border-[4px] \nborder-ink shadow-brutal-lg p-8 md:p-14 relative rotate-2 interactive-hover \ntransition-transform duration-300 hover:rotate-1">',
    'class="bg-accent-yellow w-full md:w-3/4 max-w-2xl border-[4px] border-ink shadow-brutal-lg p-8 md:p-14 relative rotate-2 interactive-hover transition-transform duration-300 hover:rotate-1 scroll-reveal">'
)
# Fallback:
html = re.sub(
    r'class="(bg-accent-yellow w-full md:w-3/4 max-w-2xl border-\[4px\][^"]*hover:rotate-1)"',
    r'class="\1 scroll-reveal"',
    html
)

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(html)
