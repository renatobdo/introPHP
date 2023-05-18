<?php require_once 'vendor/autoload.php';

use Google\Cloud\Translate\V2\TranslateClient;

$projectId = '[PROJECT_ID]';
$translate = new TranslateClient([
    'projectId' => $projectId,
]);
$text = 'Hello, world!';
$targetLanguage = 'es'; // Target language code

$result = $translate->translate($text, [
    'target' => $targetLanguage,
]);

echo "Translated Text: " . $result['text'] . "\n";

?>
