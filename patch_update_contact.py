import re

with open('api/update.php', 'r', encoding='utf-8') as f:
    text = f.read()

new_contact_logic = """        // Contact
        $contact_keys = ['email', 'youtube', 'instagram', 'tiktok', 'spotify', 'footer'];
        foreach ($contact_keys as $key) {
            if (isset($_POST['contact'][$key])) {
                $data['contact'][$key] = $_POST['contact'][$key];
            }
        }"""

text = re.sub(
    r'        // Contact\s+if \(isset\(\$_POST\[\'contact\'\]\[\'footer\'\]\)\) \{\s+\$data\[\'contact\'\]\[\'footer\'\] = \$_POST\[\'contact\'\]\[\'footer\'\];\s+\}',
    new_contact_logic,
    text
)

with open('api/update.php', 'w', encoding='utf-8') as f:
    f.write(text)
