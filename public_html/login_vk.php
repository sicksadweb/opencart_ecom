
    <?php


$client_id = '7571690'; // ID приложения
$client_secret = 'XJsfGR8FgpJBpfGYBu36'; // Защищённый ключ
$redirect_uri = 'http://ecom/login_vk.php'; // Адрес сайта






$url = 'http://oauth.vk.com/authorize';

$params = array(
    'client_id' => $client_id,
    'display' => 'page',
    'redirect_uri' => $redirect_uri,
    'scope' => 'friends',
    'response_type' => 'code',
    'v'=> '5.122'
);



echo $link = '<p><a href="' . $url . '?' . urldecode(http_build_query($params)) . '">Аутентификация через ВКонтакте</a></p>';



if (isset($_GET['code'])) {
    $params = array(
        'client_id' => $>clientId,
        'client_secret' => $this->clientSecret,
        'code' => $_GET['code'],
        'redirect_uri' => $this->redirectUri
    );
}
