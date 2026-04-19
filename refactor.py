import os
import shutil
import re

# Move files
moves = {
    'admin.php': 'admin/index.php',
    'auth.php': 'api/auth.php',
    'handler.php': 'api/update.php',
    'data.json': 'api/data.json',
    'script.js': 'assets/script.js',
    'styles.css': 'assets/styles.css'
}

for src, dest in moves.items():
    if os.path.exists(src):
        shutil.move(src, dest)

# Update index.php
with open('index.php', 'r', encoding='utf-8') as f:
    idx = f.read()

idx = idx.replace("'data.json'", "'api/data.json'")
idx = idx.replace('"script.js"', '"assets/script.js"')
idx = idx.replace('"styles.css"', '"assets/styles.css"')
idx = idx.replace("'script.js'", "'assets/script.js'")
idx = idx.replace("'styles.css'", "'assets/styles.css'")

with open('index.php', 'w', encoding='utf-8') as f:
    f.write(idx)

# Update admin/index.php
with open('admin/index.php', 'r', encoding='utf-8') as f:
    adm = f.read()

adm = adm.replace("'auth.php'", "'../api/auth.php'")
adm = adm.replace("'data.json'", "'../api/data.json'")
adm = adm.replace('"handler.php"', '"../api/update.php"')
# logout redirection in auth.php / admin panel
adm = adm.replace("logout=1", "logout=1") # We'll need to check where logout hits

with open('admin/index.php', 'w', encoding='utf-8') as f:
    f.write(adm)

# Update api/auth.php
with open('api/auth.php', 'r', encoding='utf-8') as f:
    auth = f.read()
# auth redirects to admin.php on login, or index.php
auth = auth.replace('Location: admin.php', 'Location: ../admin/index.php')
# On logout it redirects to index.php ?
with open('api/auth.php', 'w', encoding='utf-8') as f:
    f.write(auth)

# Update api/update.php
with open('api/update.php', 'r', encoding='utf-8') as f:
    upd = f.read()
upd = upd.replace("'auth.php'", "'auth.php'") # it's in the same folder now
upd = upd.replace("'data.json'", "'data.json'")
upd = upd.replace("Location: admin.php", "Location: ../admin/index.php")
# For image uploads, $target_dir = "images/" becomes $target_dir = "../images/"
upd = upd.replace('"images/"', '"../images/"')

with open('api/update.php', 'w', encoding='utf-8') as f:
    f.write(upd)

print("Files reorganized and patched!")