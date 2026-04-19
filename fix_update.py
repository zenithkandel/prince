import json

with open('api/update.php', 'r', encoding='utf-8') as f:
    upd = f.read()

upd = upd.replace("'../images']", "'images']")

# Add handler for 'add_music_item_with_data'
new_music_handler = """    // Action handler: Add new item to Music array with Modal data
    if (isset($_POST['action']) && $_POST['action'] === 'add_music_item_with_data') {
        $new_item = [
            "title" => $_POST['music_meta']['title'] ?? "New Track",
            "desc" => $_POST['music_meta']['desc'] ?? "",
            "link" => $_POST['music_meta']['link'] ?? "",
            "img" => ""
        ];
        
        $uploaded_img = handle_upload('music_img_new');
        if ($uploaded_img) {
            $new_item['img'] = $uploaded_img;
        }

        $data['music']['releases'][] = $new_item;
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: ../admin/index.php?tab=music&success=Added%20new%20entry!");
        exit;
    }"""
upd = upd.replace("// Action handler: Delete Music Item", new_music_handler + "\n\n    // Action handler: Delete Music Item")


new_gallery_handler = """    // Action handler: Add new item to Gallery array with Modal data
    if (isset($_POST['action']) && $_POST['action'] === 'add_gallery_item_with_data') {
        $new_item = [
            "img" => "",
            "caption" => $_POST['gallery_meta']['caption'] ?? "New Photo",
            "classes" => $_POST['gallery_meta']['classes'] ?? "w-64 rotate-2"
        ];
        
        $uploaded_img = handle_upload('gallery_img_new');
        if ($uploaded_img) {
            $new_item['img'] = $uploaded_img;
        }

        if (!isset($data['gallery']['images']) || !is_array($data['gallery']['images'])) {
            $data['gallery']['images'] = [];
        }
        $data['gallery']['images'][] = $new_item;
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: ../admin/index.php?tab=gallery&success=Added%20new%20photo!");
        exit;
    }"""

upd = upd.replace("// Action handler: Delete Gallery Item", new_gallery_handler + "\n\n    // Action handler: Delete Gallery Item")

with open('api/update.php', 'w', encoding='utf-8') as f:
    f.write(upd)

# Also fix the data.json file if it corrupted it
with open('api/data.json', 'r', encoding='utf-8') as f:
    data = json.load(f)

if '../images' in data.get('gallery', {}):
    # This was corrupted
    if 'images' not in data['gallery']:
        data['gallery']['images'] = data['gallery']['../images']
    else:
        data['gallery']['images'].extend(data['gallery']['../images'])
    del data['gallery']['../images']
    with open('api/data.json', 'w', encoding='utf-8') as f:
        json.dump(data, f, indent=4)

print("Updated update.php with modal endpoints and fixed keys")
