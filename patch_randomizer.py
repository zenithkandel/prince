import re

with open('api/update.php', 'r', encoding='utf-8') as f:
    text = f.read()

old_block = """    if (isset($_POST['action']) && $_POST['action'] === 'add_gallery_item_with_data') {
        $new_item = [
            "img" => "",
            "caption" => $_POST['gallery_meta']['caption'] ?? "New Photo",
            "classes" => $_POST['gallery_meta']['classes'] ?? "w-64 rotate-2"
        ];"""

new_block = """    if (isset($_POST['action']) && $_POST['action'] === 'add_gallery_item_with_data') {
        
        $input_classes = trim($_POST['gallery_meta']['classes'] ?? "");
        if ($input_classes === "" || $input_classes === "w-64 rotate-2") {
            // Generate Random Tailwind Classes for scattered look
            $widths = ["w-48 md:w-64", "w-56 md:w-72", "w-60 md:w-80", "w-64 md:w-80", "w-72 md:w-96"];
            $rotations = ["-rotate-12", "-rotate-[8deg]", "-rotate-6", "-rotate-3", "-rotate-2", "rotate-2", "rotate-3", "rotate-6", "rotate-[7deg]", "rotate-[12deg]", "rotate-[15deg]"];
            
            $width = $widths[array_rand($widths)];
            $rotate = $rotations[array_rand($rotations)];
            
            $classes = $width . " " . $rotate;
        } else {
            $classes = $input_classes;
        }

        $new_item = [
            "img" => "",
            "caption" => $_POST['gallery_meta']['caption'] ?? "New Photo",
            "classes" => $classes
        ];"""

text = text.replace(old_block, new_block)

with open('api/update.php', 'w', encoding='utf-8') as f:
    f.write(text)

print("Updated api/update.php with randomizer logic!")
