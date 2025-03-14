<?php
require_once __DIR__ . '/postRenderer.php';

function getLatestPosts($limit = 3) {
    $posts = [];
    $postsDir = __DIR__ . '/posts';
    
    if (is_dir($postsDir)) {
        $files = scandir($postsDir);
        if ($files) {
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && is_file($postsDir . '/' . $file)) {
                    $markdown = file_get_contents($postsDir . '/' . $file);
                    $posts[] = [
                        'slug' => $file,
                        'markdown' => $markdown,
                        'create_date' => filemtime($postsDir . '/' . $file)
                    ];
                }
            }
        }
    }
    
    // Sort posts by date in descending order
    usort($posts, function($a, $b) {
        return $b['create_date'] - $a['create_date'];
    });
    
    // Return only the specified number of posts
    return array_slice($posts, 0, $limit);
}
?> 