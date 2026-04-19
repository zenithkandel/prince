import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

while True:
    idx = text.find('Danger Zone')
    if idx == -1:
        break
        
    start_tag = text.rfind('<!-- Dedicated Delete Zone (Cleaner UX) -->', 0, idx)
    if start_tag == -1:
        start_tag = text.rfind('<div class="mt-24', 0, idx)
        
    # go past the Danger Zone to the next '<?php endif; ?>' or Save Button
    end_tag = text.find('<div class="fixed bottom', idx)
    
    if start_tag != -1 and end_tag != -1:
        text = text[:start_tag] + text[end_tag:]
    else:
        break

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("danger present:", "Danger Zone" in text)
