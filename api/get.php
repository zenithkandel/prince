<?php
header('Content-Type: application/json');

$json_file = 'data.json';
if (file_exists($json_file)) {
    echo file_get_contents($json_file);
} else {
    echo json_encode(['error' => 'Data not found']);
}
