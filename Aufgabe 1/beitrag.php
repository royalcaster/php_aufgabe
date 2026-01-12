<?php
/**
 * beitrag.php - Dynamische Blogbeitrags-Anzeige
 * 
 * Diese Seite zeigt einen einzelnen Blogbeitrag an.
 * Der anzuzeigende Beitrag wird über den URL-Parameter "beitrag" ausgewählt.
 * Beispiel: beitrag.php?beitrag=0 zeigt den ersten Beitrag an.
 * 
 * Falls kein Parameter angegeben ist, wird der erste Beitrag (Index 0) angezeigt.
 */

// Einbinden der Daten-Datei mit allen Blogbeiträgen
include 'data.php';

/**
 * Ermitteln des anzuzeigenden Beitrags
 * 
 * Wir nutzen die Superglobale $_GET, um den URL-Parameter "beitrag" auszulesen.
 * Falls kein Parameter angegeben ist oder der Index ungültig ist,
 * wird als Fallback der erste Beitrag (Index 0) verwendet.
 */
$beitrag_id = 0; // Standardwert (Fallback)

// Prüfen ob der GET-Parameter "beitrag" gesetzt ist
if (isset($_GET['beitrag'])) {
    // Parameter auslesen und in Integer umwandeln
    $requested_id = intval($_GET['beitrag']);
    
    // Prüfen ob der Index im gültigen Bereich liegt
    if ($requested_id >= 0 && $requested_id < count($result)) {
        $beitrag_id = $requested_id;
    }
    // Falls ungültiger Index: Fallback auf 0 bleibt bestehen
}

// Aktuellen Beitrag aus dem Array holen
$beitrag = $result[$beitrag_id];

/**
 * Hilfsfunktion zur Formatierung des Datums
 * Wandelt das ISO-Format (YYYY-MM-DD) in ein gut lesbares deutsches Format um
 */
function formatiereDatum($datum) {
    $monate = array(
        1 => 'Januar', 2 => 'Februar', 3 => 'März', 4 => 'April',
        5 => 'Mai', 6 => 'Juni', 7 => 'Juli', 8 => 'August',
        9 => 'September', 10 => 'Oktober', 11 => 'November', 12 => 'Dezember'
    );
    
    $timestamp = strtotime($datum);
    $tag = date('j', $timestamp);
    $monat = $monate[intval(date('n', $timestamp))];
    $jahr = date('Y', $timestamp);
    
    return "$tag. $monat $jahr";
}
?>
<!DOCTYPE html>
<html lang="de">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Dynamischer Seitentitel: Webseitenname – Beitragstitel -->
    <title><?php echo $website_name . " – " . $beitrag['title']; ?></title>
    
    <!-- Einbinden der CSS-Datei -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <!-- Header mit Navigation -->
    <header class="site-header">
        <div class="header-container">
            <!-- Logo/Seitenname -->
            <a href="beitrag.php" class="logo">
                <?php echo $website_name; ?>
            </a>
            
            <!-- Navigation zu anderen Beiträgen -->
            <nav class="main-nav">
                <span class="nav-label">Beiträge:</span>
                <?php 
                // Dynamische Navigation zu allen verfügbaren Beiträgen
                for ($i = 0; $i < count($result); $i++): 
                    $is_active = ($i === $beitrag_id) ? 'active' : '';
                ?>
                    <a href="beitrag.php?beitrag=<?php echo $i; ?>" 
                       class="nav-link <?php echo $is_active; ?>"
                       title="<?php echo htmlspecialchars($result[$i]['title']); ?>">
                        <?php echo ($i + 1); ?>
                    </a>
                <?php endfor; ?>
            </nav>
        </div>
    </header>

    <!-- Hauptinhalt -->
    <main class="main-content">
        <article class="blog-post">
            <!-- Artikel-Header mit Metadaten -->
            <header class="post-header">
                <!-- Veröffentlichungsdatum -->
                <time class="post-date" datetime="<?php echo $beitrag['published']; ?>">
                    <?php echo formatiereDatum($beitrag['published']); ?>
                </time>
                
                <!-- Beitragstitel -->
                <h1 class="post-title">
                    <?php echo htmlspecialchars($beitrag['title']); ?>
                </h1>
            </header>
            
            <!-- Beitragsinhalt (HTML-formatiert) -->
            <div class="post-content">
                <?php echo $beitrag['content']; ?>
            </div>
            
            <!-- Autor-Box unter dem Beitrag -->
            <footer class="post-footer">
                <div class="author-box">
                    <!-- Optionales Autorenbild -->
                    <div class="author-image">
                        <?php if (!empty($beitrag['author_image'])): ?>
                            <!-- Wenn ein Bild angegeben ist, wird es angezeigt -->
                            <!-- Falls das Bild nicht existiert, wird ein Platzhalter verwendet -->
                            <div class="author-avatar">
                                <?php 
                                // Erste Buchstaben des Namens als Fallback-Avatar
                                $initials = '';
                                $name_parts = explode(' ', $beitrag['author']);
                                foreach ($name_parts as $part) {
                                    $initials .= substr($part, 0, 1);
                                }
                                echo strtoupper($initials);
                                ?>
                            </div>
                        <?php else: ?>
                            <div class="author-avatar">
                                <?php 
                                $initials = '';
                                $name_parts = explode(' ', $beitrag['author']);
                                foreach ($name_parts as $part) {
                                    $initials .= substr($part, 0, 1);
                                }
                                echo strtoupper($initials);
                                ?>
                            </div>
                        <?php endif; ?>
                    </div>
                    
                    <!-- Autor-Informationen -->
                    <div class="author-info">
                        <span class="author-label">Geschrieben von</span>
                        <h3 class="author-name">
                            <?php echo htmlspecialchars($beitrag['author']); ?>
                        </h3>
                        <p class="author-bio">
                            <?php echo htmlspecialchars($beitrag['bio']); ?>
                        </p>
                    </div>
                </div>
            </footer>
        </article>
        
        <!-- Weitere Beiträge als Vorschläge -->
        <aside class="more-posts">
            <h2 class="more-posts-title">Weitere Beiträge</h2>
            <div class="posts-grid">
                <?php 
                // Alle anderen Beiträge anzeigen (außer dem aktuellen)
                foreach ($result as $index => $post): 
                    if ($index !== $beitrag_id):
                ?>
                    <a href="beitrag.php?beitrag=<?php echo $index; ?>" class="post-card">
                        <time class="card-date">
                            <?php echo formatiereDatum($post['published']); ?>
                        </time>
                        <h3 class="card-title">
                            <?php echo htmlspecialchars($post['title']); ?>
                        </h3>
                        <span class="card-author">
                            von <?php echo htmlspecialchars($post['author']); ?>
                        </span>
                    </a>
                <?php 
                    endif;
                endforeach; 
                ?>
            </div>
        </aside>
    </main>

    <!-- Footer -->
    <footer class="site-footer">
        <p>&copy; <?php echo date('Y'); ?> <?php echo $website_name; ?>. Erstellt für Grundlagen der Medieninformatik.</p>
    </footer>
</body>
</html>

