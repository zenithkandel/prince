import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Using pure string substitution to remove everything related to Danger Zone since it's repeated twice (music + gallery)
def nuke_danger(t):
    while True:
        idx = t.find('Danger Zone')
        if idx == -1:
            break
        # Go upwards to find the container div <div class="mt-24 w-full pt-12 border-t-[8px]
        start_cut = t.rfind('<div class="mt-24', 0, idx)
        if start_cut == -1:
            break
            
        # Go downwards to find the end of that section: <?php endforeach; ?></div></div> OR <?php endif; ?>
        end_cut = t.find('<?php endif; ?>', idx)
        
        # Make sure we don't accidentally cut the submit buttons by bounding correctly.
        if end_cut != -1:
            # Check if there is a save button right before the endif
            if 'Save ' in t[start_cut:end_cut]:
                # We need a tighter bound if it captures the save button. 
                end_cut = t.find('<?php endforeach; ?>', idx)
                if end_cut != -1:
                    # Plus 2 closing divs: </div></div>
                    end_cut = t.find('</div>', end_cut)
                    end_cut = t.find('</div>', end_cut + 5)
                    if end_cut != -1:
                        end_cut += 6 # Include the </div>
            
            t = t[:start_cut] + t[end_cut:]
            
        else:
            break
    return t

new_text = nuke_danger(text)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(new_text)

print("Final danger zone check:", "Danger Zone" in new_text)
