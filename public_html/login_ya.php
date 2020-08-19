<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
    "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="ru">
<head>
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8"/>
    <title>Аутентификация через Yandex</title>
</head>
<body>

<?php

$client_id = '0f77313fc79c4841baa1512c05611c3b'; // Id приложения login_ya.php
$client_secret = 'ad56c105b3024ba388ffed0fa08e748b'; // Пароль приложения
$redirect_uri = 'http://ecom/index.php?route=account/register_bymail'; // Callback URI

$url = 'https://oauth.yandex.ru/authorize';

$params = array(
    'response_type' => 'code',
    'client_id'     => $client_id,
    'display'       => 'popup'
);

echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через Yandex</a></p>';



?>

</body>
</html>