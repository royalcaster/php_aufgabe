# Grundlagen der Medieninformatik

> **Hinweis:** Um arbeiten zu können, sollten Sie einen lokalen Webserver installieren, z.B. Apache über eine XAMPP-Installation. Eine Anleitung dazu finden Sie in den Folien von VL 7.

Eigenen Sie sich die Themenkomplexe "Dynamische Seiten mittels PHP" und "CSS-Animation" anhand der folgenden Aufgaben unter Verwendung der verlinkten Online-Ressourcen (sowie ggf. eigener Online-Recherche) an.

## 1. Dynamische Seiten mittels PHP

- Programmieren Sie eine PHP-Seite (benannt als "beitrag.php") zur Anzeige eines Blogbeitrags.
- Designen Sie diesen mittels CSS. Zur Einfachheit reicht es, wenn das Layout für eine Anzeige auf einem Desktop-Bildschirm (Auflösung 1920x1080px oder höher) ausgerichtet ist; eine mobile oder fluide Version ist nicht nötig.
- Nutzen Sie zum Layouting, wo geeignet, Flexbox zur Anordnung von Inhalten.
- Die folgenden Inhalte der HTML-Struktur sollen mittels PHP anhand `echo`-Befehlen dynamisch befüllt werden:
  - Seitentitel im Head-Bereich (nach dem folgenden Format: "Webseitenname – Beitragstitel")
  - Datum der Veröffentlichung (in einem gut lesbaren Datumsformat)
  - Beitragstitel
  - Beitragsinhalt (bestehend aus HTML-Text, d.h. Absätzen & co.)
  - Unter dem Beitrag stehende Informationen über den Autor (Name, kurzer Infotext, optional ein Bild des Autors)
- Normalerweise würde man diese Inhalte in einem Array als Ergebnis einer Datenbankabfrage zurückbekommen. Das faken wir aber - schreiben Sie stattdessen die dynamischen Inhalte nach dem folgenden Schema händisch im Quellcode in ein Array. Lagern Sie die Deklaration dieses Arrays zur besseren Übersichtlichkeit gerne in eine zweite .php-Datei aus und binden Sie sie über den `include`-Befehl ein:

```php
$result = array();
$result[0] = array(
    "title" => "Beitragstitel 1",
    "content" => "<p>Beitragsinhalt 1 in HTML-Form</p>",
    "published" => "2025-05-03",
    "author" => "Max Autorenname",
    "bio" => "Autorenbiografie"
);
$result[1] = array(
    "title" => "Beitragstitel 2",
    "content" => "<p>Beitragsinhalt 2 in HTML-Form</p>",
    "published" => "2025-08-13",
    "author" => "Maria Autorenname",
    "bio" => "Autorenbiografie"
);
$result[2] = array( ... ); // beliebig viele weitere
```

- Die Auswahl des anzuzeigenden Blog-Beitrags soll über die URL-Variable "beitrag" erfolgen. Beispiel: Über die Adresse "http://localhost/[dateipfad]/beitrag.php?beitrag=1" soll der Beitrag mit der ID 1 im Array (also der zweite Array-Eintrag) genutzt werden. Informieren Sie sich zu und verwenden Sie dafür die sogenannte "Superglobale" `$_GET`. **Achtung:** Bauen Sie auch einen Fallback für den Fall ein, dass kein Parameter angegeben ist.

## 2. CSS-Animation mittels `@keyframes`

- Belesen Sie sich zunächst zur Animation in CSS mithilfe der "Animation"-Eigenschaften und `@keyframes`-At-Rule.
- Erstellen Sie dann selbst eine kleine HTML/CSS-Webseite, auf Sie mindestens zwei Animationen mit `@keyframes` einsetzen, die mehrere Zustände durchläuft (d.h. mindestens 3 Schlüsselbilder/Keyframes). Wählen Sie selbst, was animiert wird – Hauptsache, es wird visuell nachvollziehbar und kreativ umgesetzt.
- Mögliche Themenideen (wählen Sie eine davon oder erfinden Sie Ihr eigenes Thema):
  - **Sonnenaufgang** - die Sonne geht auf, der Hintergrund wird heller, ein Vogel fliegt vorbei
  - **Ladeanimation** - erstellen Sie ein animiertes Ladeelement (z.B. Ladebalken mit hüpfenden Zahlen, etc.)
  - **Wetter-Icon** - animieren Sie ein Icon für eine Wetter-Seite (z.B. Wolke mit Regen und Blitzen, Sonne mit Strahlen, etc.)
- Die Animation soll sich wiederholen.
- Optional können Sie eine Steuerung mittels `:hover` oder per JavaScript mittels Buttons einbauen.

---

## Formatierung & Abgabe

- Quellcode ist **sauber zu formatieren**, d.h. eingerückt und unter Berücksichtigung von üblichen Formatierungsvorgaben für die jeweilige Sprache (Tipp: Nutzen Sie in Visual Studio Code die Tastenkombination Shift+Alt+F (Windows, auf anderen OS ggf. anders), um automatisch den Quellcode zu verschönern).
- **Kommentieren** Sie Ihren Quellcode (**unbedingt!**), um Ihre Überlegungen zu dokumentieren.
- Erarbeiten Sie Ihre Abgaben **selbstständig**, d.h. nicht in Teams und nicht automatisiert mittels KI-Tools - andernfalls wird Ihnen die Abgabe schlimmstenfalls als Betrugsversuch gewertet! Eine Nutzung von KI zum Schreiben der Artikel-Inhalte, zur Inspiration der Animation oder zur Unterstützung beim Verständnis ist dagegen natürlich zulässig.
- Geben Sie Ihre Aufgabe ab, indem Sie sie **bis spätestens am 16.1. um 23:59 Uhr** hier in Opal in den **Abgabe-Ordner** hochladen.
- Falls Sie nachträglich Inhalte korrigieren möchten, laden Sie eine entsprechend benannte neue Version zusätzlich zu Ihrer früheren Abgabe hoch. Es wird immer die neueste Version zur Bewertung herangezogen.
- Laden Sie Ihre Abgabe als .zip-Archiv mit der folgenden Benennung hoch: `Nachname_Vorname_Matrikelnummer_Version.zip` (z.B. Mustermann_Max_09648_2.zip)
- Achten Sie auf fürs Web sinnvolle Dateigrößen. Komprimieren Sie z.B. ggf. Bilder.
- Arbeiten Sie mit einer sauberen Ordnerstruktur nach folgender Vorgabe:

```
Onlinephase-Aufgaben
  - Aufgabe 1
    - [PHP/HTML-Dateien]
    - css
      - [CSS-Dateien]
    - img
      - [Bilddateien]
    - fonts
      - [Schriftart-Dateien]
    - js
      - [JavaScript-Dateien]
    - [weitere Unterordner für andere Inhaltsarten]
  - Aufgabe 2
    - [PHP/HTML-Dateien]
    - css
      - [CSS-Dateien]
  ... usw ...
```

