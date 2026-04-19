import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Using pure string slicing or broad regex to gut the entire block properly up to the end of form without missing whitespace.
text = re.sub(
    r'<!-- Dedicated Delete Zone \(Cleaner UX\) -->[\s\S]*?(?=</form>\s*</div>\s*<div id="contact" class="tab-content hidden">)',
    '',
    text
)
text = re.sub(
    r'<!-- Dedicated Delete Zone \(Cleaner UX\) -->[\s\S]*?(?=</form>\s*</div>\s*<div id="gallery" class="tab-content hidden">)',
    '',
    text
)

text = re.sub(
    r'<!-- Old Music Danger Zone removed -->\s*<div class="mt-24 w-full pt-12 border-t-\[8px\] border-black border-dashed relative">[\s\S]*?</div>\s*</div>\s*<\?php endif; \?>',
    '',
    text
)

text = re.sub(
    r'<!-- Old Gallery Danger Zone removed -->\s*<div class="mt-24 w-full pt-12 border-t-\[8px\] border-black border-dashed relative">[\s\S]*?</div>\s*</div>\s*<\?php endif; \?>',
    '',
    text
)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Done stripping.")
