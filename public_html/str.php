<?php
$text = "Танцуaй пока молbbсодой и ещё несколько сcилов";
$slova = array('a', 'b', 'c');
$texts = "Танцуaй пока молbодой и ещё несколько сcлов";
$text = explode(" ", $text);

foreach ($text as $key => $value) {
    foreach($slova as $slovo) {
        if (strpos($value, $slovo) !== false) {
            print_r ($value);
            echo '<br>';
        }
      }
}

$str = 'Эrто строка';
echo $str[1];

?>

