import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Since the previous attempts did not catch the nested divs correctly:
text = re.sub(r'<!-- Dedicated Delete Zone \(Cleaner UX\) -->[\s\S]*?</div>\s*</div>\s*</div>\s*</div>\s*<\?php endif; \?>', '', text)
text = re.sub(r'<!-- Old Music Danger Zone removed -->[\s\S]*?</div>\s*</div>\s*</div>\s*</div>\s*<\?php endif; \?>', '', text)
text = re.sub(r'<!-- Old Gallery Danger Zone removed -->[\s\S]*?</div>\s*</div>\s*</div>\s*</div>\s*<\?php endif; \?>', '', text)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("danger present:", "Danger Zone" in text)
