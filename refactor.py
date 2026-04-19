import os
import shutil

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

try:
    with open('index.php', 'r', encoding='utf-8') as f: idx = f.read()
    idx = idx.replace("'data.json'", "'api/data.json'")
    idx = idx.replace('"script.js"', '"assets/script.js"')
    idx = idx.replace('"styles.css"', '"assets/styles.css"')
    idx = idx.replace("'script.js'", "'assets/script.js'")
    idx = idx.replace("'styles.css'", "'assets/styles.css'")
    with open('index.php', 'w', encoding='utf-8') as f: f.write(idx)
except Exception as e: print("idx error", e)

try:
    with open('admin/index.php', 'r', encoding='utf-8') as f: adm = f.read()
    adm = adm.replace("'auth.php'", "'../api/auth.php'")
    adm = adm.replace("'data.json'", "'../api/data.json'")
    adm = adm.replace('"handler.php"', '"../api/update.php"')
    with open('admin/index.php', 'w', encoding='utf-8') as f: f.write(adm)
except Exception as e: print("adm error", e)

try:
    with open('api/auth.php', 'r', encoding='utf-8') as f: auth = f.read()
    auth = auth.replace('Location: admin.php', 'Location: index.php')
    auth = auth.replace('action="admin.php"', 'action="index.php"')
    with open('api/auth.php', 'w', encoding='utf-8') as f: f.write(auth)
except Exception as e: print("auth error", e)

try:
    with open('api/update.php', 'r', encoding='utf-8') as f: upd = f.read()
    upd = upd.replace("'auth.php'", "'auth.php'")
    upd = upd.replace("'data.json'", "'data.json'")
    upd = upd.replace("Location: admin.php", "Location: ../admin/index.php")
    upd = upd.replace('"images/"', '"../images/"')
    upd = upd.replace("'images'", "'../images'")
    with open('api/update.php', 'w', encoding='utf-8') as f: f.write(upd)
except Exception as e: print("upd error", e)

print("Files reorganized and patched!")