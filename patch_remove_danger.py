import re

with open('admin/index.php', 'r', encoding='utf-8') as f:
    text = f.read()

# Make the regex less greedy to target exactly the two blocks that span from <!-- Dedicated Delete Zone --> to the </div> that closes them right before <?php endif; ?>
text = re.sub(r'<!-- Dedicated Delete Zone \(Cleaner UX\) -->[\s\S]*?(?=</form>\s*</div>\s*<div id="contact" class="tab-content hidden">|<div id="gallery" class="tab-content hidden">)', '', text)

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Danger Zones purged!")
