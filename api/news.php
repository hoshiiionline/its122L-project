<?php
$rssFeedUrl = 'https://news.google.com/rss/search?q=i+love+jesus+catholic+church';

try {
    $rssFeed = @simplexml_load_file($rssFeedUrl);
    
    if ($rssFeed) {
        $articles = [];
        foreach ($rssFeed->channel->item as $item) {
            $articles[] = [
                'title' => (string) $item->title,
                'link' => (string) $item->link,
                'description' => strip_tags((string) $item->description),
                'pubDate' => (string) $item->pubDate,
            ];
        }
        // Get only the first 3 articles
        $articles = array_slice($articles, 0, 3);
    }
} catch (Exception $e) {
    error_log("RSS Feed Error: " . $e->getMessage());
}
?>

<?php if (!empty($articles)): ?>
    <?php foreach ($articles as $article): ?>
        <div class="article">
            <h2>
                <a href="<?= htmlspecialchars($article['link']); ?>" 
                   onclick='return confirmRedirect();' 
                   target="_blank">
                    <?= htmlspecialchars($article['title']); ?>
                </a>
            </h2>
            <p><?= htmlspecialchars($article['description']); ?></p>
            <small>
                <i class="fa-regular fa-calendar"></i>
                Published on: <?= date('F j, Y, g:i a', strtotime($article['pubDate'])); ?>
            </small>
        </div>
    <?php endforeach; ?>
<?php else: ?>
    <div class="article">
        <h2>Unable to Load News</h2>
        <p>We're having trouble loading the latest news. Please check back later.</p>
    </div>
<?php endif; ?>
<script src="../js/script.js"></script>