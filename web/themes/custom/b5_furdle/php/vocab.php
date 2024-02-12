<?php
// /var/www/vhosts/furdle.us/httpdocs/php/vocab.php == perms should be dir: 740, file: 644
function getRandomFurdle() {
    return rand(0,1641);
}
$vocabFile = fopen("/var/www/vhosts/furdle.us/httpdocs/game/js/tf.js", "w") or die("Unable to open file!");
$word = "let tfi = " . getRandomFurdle();
fwrite($vocabFile, $word);
fclose($vocabFile);
?>