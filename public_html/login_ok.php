
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

    $result = false;
    $params = array(
        'client_id' => $client_id,
        'client_secret' => $client_secret,
        'redirect_uri' => $redirect_uri,
        'code' => $_GET['code'],
    );

    $token = json_decode(file_get_contents('https://oauth.vk.com/access_token' . '?' . urldecode(http_build_query($params))), true);

    print_r($token);
    if (isset($token['access_token'])) {


        $params = array(
            'uids'         => $token['user_id'],

            'fields'       => 'uid,first_name,last_name,screen_name,sex,bdate,photo_big',
            'access_token' => $token['access_token']
        );

        $user_id = $token['user_id'];
//        $user_id = '430040520';       
        
        $request_params = array(
        'user_id' => $user_id,
        'fields' => 'bdate',
        'v' => '5.52',
        'access_token' => $token['access_token']
        );
        $get_params = http_build_query($request_params);
        $result = json_decode(file_get_contents('https://api.vk.com/method/users.get?'. $get_params));


        print_r($result);
    }



}
