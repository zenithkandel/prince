import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    content = f.read()

# Replace <img src="<?php echo htmlspecialchars... with <img src="../<?php echo htmlspecialchars...
content = re.sub(r'<img src="<\?php echo htmlspecialchars\(', r'<img src="../<?php echo htmlspecialchars(', content)
content = content.replace('src="../../<?php', 'src="../<?php')

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(content)

print("Images fixed!")
