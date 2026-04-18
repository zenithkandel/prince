<?php
require_once 'auth.php'; // Ensure user is logged in
require_login();

$json_file = 'data.json';
$data = json_decode(file_get_contents($json_file), true);

if (!is_dir('images')) {
    mkdir('images', 0777, true);
}

function handle_upload($input_name)
{
    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
        $target_dir = "images/";
        $filename = time() . '_' . basename($_FILES[$input_name]["name"]);
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
            return $target_file;
        }
    }
    return false;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // Action handler: Save General Settings
    if (isset($_POST['action']) && $_POST['action'] === 'save_general') {
        // Hero
        $hero_keys = ['tag', 'title_first', 'title_last', 'subtitle', 'location', 'img_caption', 'img_badge', 'cta'];
        foreach ($hero_keys as $key) {
            if (isset($_POST['hero'][$key]))
                $data['hero'][$key] = $_POST['hero'][$key];
        }
        $hero_img = handle_upload('hero_img');
        if ($hero_img)
            $data['hero']['img'] = $hero_img;

        // About
        $about_keys = ['img_caption', 'title', 'content_p1', 'content_highlight', 'content_p2', 'badge_icon', 'badge_text'];
        foreach ($about_keys as $key) {
            if (isset($_POST['about'][$key]))
                $data['about'][$key] = $_POST['about'][$key];
        }
        $about_img = handle_upload('about_img');
        if ($about_img)
            $data['about']['img'] = $about_img;

        // Contact
        if (isset($_POST['contact']['footer'])) {
            $data['contact']['footer'] = $_POST['contact']['footer'];
        }

        // Music Meta
        if (isset($_POST['music_meta']['title']))
            $data['music']['title'] = $_POST['music_meta']['title'];
        if (isset($_POST['music_meta']['cta']))
            $data['music']['cta'] = $_POST['music_meta']['cta'];
        if (isset($_POST['music_meta']['cta_link']))
            $data['music']['cta_link'] = $_POST['music_meta']['cta_link'];

        // Gallery Meta
        if (isset($_POST['gallery_meta']['title']))
            $data['gallery']['title'] = $_POST['gallery_meta']['title'];
        if (isset($_POST['gallery_meta']['badge']))
            $data['gallery']['badge'] = $_POST['gallery_meta']['badge'];

        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: admin.php?success=Settings%20Updated");
        exit;
    }

    // Action handler: Save/Edit array items (Music)
    if (isset($_POST['action']) && $_POST['action'] === 'save_music') {
        if (isset($_POST['music_releases']) && is_array($_POST['music_releases'])) {
            $new_releases = [];
            foreach ($_POST['music_releases'] as $index => $item_data) {
                $item = [
                    'title' => $item_data['title'],
                    'desc' => $item_data['desc'],
                    'link' => $item_data['link'],
                    'img' => $item_data['existing_img'] // Fallback
                ];

                // Handle upload per item
                $uploaded_img = handle_upload('music_img_' . $index);
                if ($uploaded_img) {
                    $item['img'] = $uploaded_img;
                }

                $new_releases[] = $item;
            }
            $data['music']['releases'] = $new_releases;
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        }
        header("Location: admin.php?tab=music&success=Music%20Releases%20Updated");
        exit;
    }

    // Action handler: Save/Edit array items (Gallery)
    if (isset($_POST['action']) && $_POST['action'] === 'save_gallery') {
        if (isset($_POST['gallery_images']) && is_array($_POST['gallery_images'])) {
            $new_images = [];
            foreach ($_POST['gallery_images'] as $index => $item_data) {
                $item = [
                    'caption' => $item_data['caption'],
                    'classes' => $item_data['classes'],
                    'img' => $item_data['existing_img'] // Fallback
                ];

                // Handle upload per item
                $uploaded_img = handle_upload('gallery_img_' . $index);
                if ($uploaded_img) {
                    $item['img'] = $uploaded_img;
                }

                $new_images[] = $item;
            }
            $data['gallery']['images'] = $new_images;
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        }
        header("Location: admin.php?tab=gallery&success=Gallery%20Images%20Updated");
        exit;
    }

    // Action handler: Add new blank item to Music array
    if (isset($_POST['action']) && $_POST['action'] === 'add_music_item') {
        $data['music']['releases'][] = [
            "title" => "New Track",
            "desc" => "Description",
            "link" => "#",
            "img" => ""
        ];
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: admin.php?tab=music&success=Added%20new%20entry!");
        exit;
    }

    // Action handler: Delete Music Item
    if (isset($_POST['action']) && $_POST['action'] === 'delete_music_item') {
        $idx = intval($_POST['delete_index']);
        if (isset($data['music']['releases'][$idx])) {
            array_splice($data['music']['releases'], $idx, 1);
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        }
        header("Location: admin.php?tab=music&success=Deleted%20item");
        exit;
    }

    // Action handler: Add new blank item to Gallery array
    if (isset($_POST['action']) && $_POST['action'] === 'add_gallery_item') {
        $data['gallery']['images'][] = [
            "img" => "",
            "caption" => "New Photo",
            "classes" => "w-64 rotate-2"
        ];
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        header("Location: admin.php?tab=gallery&success=Added%20new%20photo!");
        exit;
    }

    // Action handler: Delete Gallery Item
    if (isset($_POST['action']) && $_POST['action'] === 'delete_gallery_item') {
        $idx = intval($_POST['delete_index']);
        if (isset($data['gallery']['images'][$idx])) {
            array_splice($data['gallery']['images'], $idx, 1);
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT));
        }
        header("Location: admin.php?tab=gallery&success=Deleted%20photo");
        exit;
    }
}
?>