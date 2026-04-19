import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Using pure string operations to completely strip everything from "<!-- Dedicated Delete Zone" to the ending "<?php endif; ?>" before the closing form/tab logic.

while True:
    d_start = text.find('<!-- Dedicated Delete Zone')
    if d_start == -1:
        break
        
    start_cut = text.rfind('<div class="mt-24', 0, d_start)
    if start_cut == -1:
        start_cut = d_start
        
    # The end marker should be right before the saving button, or the tag closing the tab content.
    # The Danger Zone ends tightly right before the closing form tag or the Save Button div.
    end_cut = text.find('<div class="fixed bottom', start_cut)
    
    if end_cut != -1:
        text = text[:start_cut] + text[end_cut:]
    else:
        break

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Final danger zone check:", "Danger Zone" in text)
