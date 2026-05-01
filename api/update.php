<?php
require_once 'auth.php'; // Ensure user is logged in
require_login();

$json_file = 'data.json';
$data = json_decode(file_get_contents($json_file), true);

if (!is_dir('../images')) {
    mkdir('../images', 0777, true);
}

function handle_upload($input_name)
{
    if (isset($_FILES[$input_name]) && $_FILES[$input_name]['error'] === UPLOAD_ERR_OK) {
        $target_dir = "../images/";
        $filename = time() . '_' . basename($_FILES[$input_name]["name"]);
        $target_file = $target_dir . $filename;
        if (move_uploaded_file($_FILES[$input_name]["tmp_name"], $target_file)) {
            return "images/" . $filename;
        }
    }
    return false;
}

/**
 * Generate random scrapbook layout classes based on size selection
 */
function generate_gallery_classes($size = 'medium')
{
    $size_map = [
        'small' => ['w-48 md:w-64', 'w-52 md:w-68', 'w-48 md:w-60'],
        'medium' => ['w-56 md:w-72', 'w-60 md:w-80', 'w-64 md:w-80'],
        'large' => ['w-72 md:w-96', 'w-80 md:w-[28rem]', 'w-72 md:w-[26rem]']
    ];

    $rotations = [
        '-rotate-12',
        '-rotate-[8deg]',
        '-rotate-6',
        '-rotate-3',
        '-rotate-2',
        'rotate-2',
        'rotate-3',
        'rotate-6',
        'rotate-[7deg]',
        'rotate-[15deg]'
    ];

    $margins = [
        '',
        'mt-12 md:mt-24',
        'md:ml-12',
        'md:-ml-20',
        'mt-10 md:-mt-10',
        'md:mt-20',
        'md:-ml-12 mt-10 md:-mt-10'
    ];

    $widths = $size_map[$size] ?? $size_map['medium'];
    $width = $widths[array_rand($widths)];
    $rotate = $rotations[array_rand($rotations)];
    $margin = $margins[array_rand($margins)];

    return trim($width . ' ' . $rotate . ' ' . $margin);
}

/**
 * Detect platform from a URL string
 */
function detect_platform($url)
{
    $url = strtolower($url);
    if (strpos($url, 'tiktok.com') !== false)
        return 'tiktok';
    if (strpos($url, 'instagram.com') !== false)
        return 'instagram';
    if (strpos($url, 'youtube.com/shorts') !== false)
        return 'youtube';
    if (strpos($url, 'youtu.be') !== false)
        return 'youtube';
    if (strpos($url, 'youtube.com') !== false)
        return 'youtube';
    if (strpos($url, 'facebook.com') !== false)
        return 'facebook';
    if (strpos($url, 'fb.watch') !== false)
        return 'facebook';
    if (strpos($url, 'twitter.com') !== false || strpos($url, 'x.com') !== false)
        return 'twitter';
    return 'other';
}

/**
 * Fetch thumbnail URL dynamically from API or oEmbed
 */
function fetch_thumbnail_url($platform, $url)
{
    if (empty($url)) return '';
    
    if ($platform === 'youtube') {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
        if (isset($matches[1])) {
            return "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg";
        }
    } elseif ($platform === 'tiktok') {
        $oembed_json = @file_get_contents("https://www.tiktok.com/oembed?url=" . urlencode($url));
        if ($oembed_json) {
            $oembed_data = json_decode($oembed_json, true);
            if (!empty($oembed_data['thumbnail_url'])) {
                return $oembed_data['thumbnail_url'];
            }
        }
    } elseif ($platform === 'instagram') {
        $oembed_json = @file_get_contents("https://graph.facebook.com/v18.0/instagram_oembed?url=" . urlencode($url));
        if ($oembed_json) {
            $oembed_data = json_decode($oembed_json, true);
            if (!empty($oembed_data['thumbnail_url'])) {
                return $oembed_data['thumbnail_url'];
            }
        }
    }
    
    return '';
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // =========================================
    // Action: Save General Settings
    // =========================================
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
        $about_keys = ['img_caption', 'title', 'content_p1', 'content_highlight', 'content_p2', 'content_p2_highlight', 'badge_text'];
        foreach ($about_keys as $key) {
            if (isset($_POST['about'][$key]))
                $data['about'][$key] = $_POST['about'][$key];
        }
        // Badge icon from dropdown (stored as simple name, not FA class)
        if (isset($_POST['about']['badge_icon'])) {
            $data['about']['badge_icon'] = $_POST['about']['badge_icon'];
        }
        $about_img = handle_upload('about_img');
        if ($about_img)
            $data['about']['img'] = $about_img;

        // Contact
        $contact_keys = ['title', 'desc_p1', 'desc_p2', 'email', 'youtube', 'instagram', 'tiktok', 'spotify', 'footer', 'signature'];
        foreach ($contact_keys as $key) {
            if (isset($_POST['contact'][$key])) {
                $data['contact'][$key] = $_POST['contact'][$key];
            }
        }

        // Music Meta (section title, CTA, CTA link)
        if (isset($_POST['music_section']['title']))
            $data['music']['title'] = $_POST['music_section']['title'];
        if (isset($_POST['music_section']['cta']))
            $data['music']['cta'] = $_POST['music_section']['cta'];
        if (isset($_POST['music_section']['cta_link']))
            $data['music']['cta_link'] = $_POST['music_section']['cta_link'];

        // Gallery Meta (section title, badge)
        if (isset($_POST['gallery_section']['title']))
            $data['gallery']['title'] = $_POST['gallery_section']['title'];
        if (isset($_POST['gallery_section']['badge']))
            $data['gallery']['badge'] = $_POST['gallery_section']['badge'];

        // Viral Meta (section title, subtitle)
        if (isset($_POST['viral_section']['title']))
            $data['viral']['title'] = $_POST['viral_section']['title'];
        if (isset($_POST['viral_section']['subtitle']))
            $data['viral']['subtitle'] = $_POST['viral_section']['subtitle'];

        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: ../admin/index.php?success=Settings%20Updated");
        exit;
    }

    // =========================================
    // Action: Save/Edit Music releases
    // =========================================
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
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        header("Location: ../admin/index.php?tab=music&success=Music%20Releases%20Updated");
        exit;
    }

    // =========================================
    // Action: Add new Music item with Modal data
    // =========================================
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
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: ../admin/index.php?tab=music&success=Added%20new%20entry!");
        exit;
    }

    // =========================================
    // Action: Delete Music Item
    // =========================================
    if (isset($_POST['action']) && $_POST['action'] === 'delete_music_item') {
        $idx = intval($_POST['delete_index']);
        if (isset($data['music']['releases'][$idx])) {
            array_splice($data['music']['releases'], $idx, 1);
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        header("Location: ../admin/index.php?tab=music&success=Deleted%20item");
        exit;
    }

    // =========================================
    // Action: Save/Edit Gallery items
    // =========================================
    if (isset($_POST['action']) && $_POST['action'] === 'save_gallery') {
        if (isset($_POST['gallery_images']) && is_array($_POST['gallery_images'])) {
            $new_images = [];
            foreach ($_POST['gallery_images'] as $index => $item_data) {
                $size = $item_data['size'] ?? 'medium';
                $item = [
                    'caption' => $item_data['caption'],
                    'size' => $size,
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
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        header("Location: ../admin/index.php?tab=gallery&success=Gallery%20Images%20Updated");
        exit;
    }

    // =========================================
    // Action: Add new Gallery item with Modal data
    // =========================================
    if (isset($_POST['action']) && $_POST['action'] === 'add_gallery_item_with_data') {
        $size = $_POST['gallery_meta']['size'] ?? 'medium';

        $new_item = [
            "img" => "",
            "caption" => $_POST['gallery_meta']['caption'] ?? "New Photo",
            "size" => $size
        ];

        $uploaded_img = handle_upload('gallery_img_new');
        if ($uploaded_img) {
            $new_item['img'] = $uploaded_img;
        }

        if (!isset($data['gallery']['images']) || !is_array($data['gallery']['images'])) {
            $data['gallery']['images'] = [];
        }
        $data['gallery']['images'][] = $new_item;
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: ../admin/index.php?tab=gallery&success=Added%20new%20photo!");
        exit;
    }

    // =========================================
    // Action: Delete Gallery Item
    // =========================================
    if (isset($_POST['action']) && $_POST['action'] === 'delete_gallery_item') {
        $idx = intval($_POST['delete_index']);
        if (isset($data['gallery']['images'][$idx])) {
            array_splice($data['gallery']['images'], $idx, 1);
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        header("Location: ../admin/index.php?tab=gallery&success=Deleted%20photo");
        exit;
    }

    // =========================================
    // Action: Save/Edit Viral items
    // =========================================
    if (isset($_POST['action']) && $_POST['action'] === 'save_viral') {
        if (isset($_POST['viral_items']) && is_array($_POST['viral_items'])) {
            $new_items = [];
            foreach ($_POST['viral_items'] as $index => $item_data) {
                $url = $item_data['url'] ?? '';
                $platform = $item_data['platform'] ?? detect_platform($url);

                $item = [
                    'url' => $url,
                    'platform' => $platform,
                    'title' => $item_data['title'] ?? '',
                    'views' => $item_data['views'] ?? '0',
                    'thumbnail' => $item_data['existing_thumbnail'] ?? ''
                ];

                // Auto-fetch thumbnail if it's empty
                if (empty($item['thumbnail']) && !empty($url)) {
                    if ($platform === 'youtube') {
                        preg_match('/(?:youtube\.com\/(?:[^\/]+\/.+\/|(?:v|e(?:mbed)?)\/|.*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/i', $url, $matches);
                        if (isset($matches[1])) {
                            $item['thumbnail'] = "https://img.youtube.com/vi/{$matches[1]}/hqdefault.jpg";
                        }
                    } elseif ($platform === 'tiktok') {
                        $oembed_json = @file_get_contents("https://www.tiktok.com/oembed?url=" . urlencode($url));
                        if ($oembed_json) {
                            $oembed_data = json_decode($oembed_json, true);
                            if (!empty($oembed_data['thumbnail_url'])) {
                                $item['thumbnail'] = $oembed_data['thumbnail_url'];
                            }
                        }
                    } elseif ($platform === 'instagram') {
                        $oembed_json = @file_get_contents("https://graph.facebook.com/v18.0/instagram_oembed?url=" . urlencode($url));
                        if ($oembed_json) {
                            $oembed_data = json_decode($oembed_json, true);
                            if (!empty($oembed_data['thumbnail_url'])) {
                                $item['thumbnail'] = $oembed_data['thumbnail_url'];
                            }
                        }
                    }
                }

                // Handle thumbnail upload per item
                $uploaded_thumb = handle_upload('viral_thumb_' . $index);
                if ($uploaded_thumb) {
                    $item['thumbnail'] = $uploaded_thumb;
                }

                $new_items[] = $item;
            }
            $data['viral']['items'] = $new_items;
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        header("Location: ../admin/index.php?tab=viral&success=Viral%20Content%20Updated");
        exit;
    }

    // =========================================
    // Action: Add new Viral item
    // =========================================
    if (isset($_POST['action']) && $_POST['action'] === 'add_viral_item') {
        $url = $_POST['viral_meta']['url'] ?? '';
        $platform = $_POST['viral_meta']['platform'] ?? '';

        // Auto-detect platform if not manually set or set to 'auto'
        if (empty($platform) || $platform === 'auto') {
            $platform = detect_platform($url);
        }

        $new_item = [
            'url' => $url,
            'platform' => $platform,
            'title' => $_POST['viral_meta']['title'] ?? '',
            'views' => $_POST['viral_meta']['views'] ?? '0',
            'thumbnail' => $_POST['viral_meta']['thumbnail_url'] ?? ''
        ];

        $uploaded_thumb = handle_upload('viral_thumb_new');
        if ($uploaded_thumb) {
            $new_item['thumbnail'] = $uploaded_thumb;
        }

        if (!isset($data['viral']['items']) || !is_array($data['viral']['items'])) {
            $data['viral']['items'] = [];
        }
        $data['viral']['items'][] = $new_item;
        file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        header("Location: ../admin/index.php?tab=viral&success=Added%20viral%20content!");
        exit;
    }

    // =========================================
    // Action: Delete Viral Item
    // =========================================
    if (isset($_POST['action']) && $_POST['action'] === 'delete_viral_item') {
        $idx = intval($_POST['delete_index']);
        if (isset($data['viral']['items'][$idx])) {
            array_splice($data['viral']['items'], $idx, 1);
            file_put_contents($json_file, json_encode($data, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE));
        }
        header("Location: ../admin/index.php?tab=viral&success=Deleted%20viral%20content");
        exit;
    }
}
?>