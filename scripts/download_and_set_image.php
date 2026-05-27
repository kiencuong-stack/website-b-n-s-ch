<?php

// Download external image and set book image path in sqlite DB
$url = 'https://dtv-ebook.com.vn/images/truyen-online/ebook-de-men-phieu-luu-ky-prc-pdf-epub.jpg';
$destDir = __DIR__ . '/../storage/app/public/books';
if (!is_dir($destDir)) {
    mkdir($destDir, 0755, true);
}
$destPath = $destDir . '/demen.jpg';

$context = stream_context_create([
    'http' => [
        'header' => "User-Agent: Mozilla/5.0 (Windows NT 10.0; Win64; x64)\r\n",
        'timeout' => 20,
    ],
]);

$img = @file_get_contents($url, false, $context);

$dbPath = __DIR__ . '/../database/database.sqlite';

// If download failed, fall back to placeholder
if ($img === false) {
    fwrite(STDOUT, "Download failed, falling back to placeholder.\n");
    try {
        $pdo = new PDO('sqlite:' . $dbPath);
        $stmt = $pdo->prepare('UPDATE books SET image = ? WHERE id = ?');
        $stmt->execute(['placeholders/book.svg', 6]);
        echo "Set to placeholder in DB.\n";
        exit(0);
    } catch (Exception $e) {
        fwrite(STDERR, "DB error: " . $e->getMessage() . "\n");
        exit(1);
    }
}

file_put_contents($destPath, $img);

if (!file_exists($dbPath)) {
    fwrite(STDERR, "Database file not found: $dbPath\n");
    exit(1);
}

try {
    $pdo = new PDO('sqlite:' . $dbPath);
    $stmt = $pdo->prepare('UPDATE books SET image = ? WHERE id = ?');
    $stmt->execute(['books/demen.jpg', 6]);
    echo "Image saved to storage and DB updated.\n";
} catch (Exception $e) {
    fwrite(STDERR, "DB error: " . $e->getMessage() . "\n");
    exit(1);
}

?>
