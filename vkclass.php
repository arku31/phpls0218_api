<?php

namespace arku;

class Vk
{
    protected $appid = 6432304;
    protected $protectedkey = "mxmBIHcOu3sEC2gZIckB"; //секретный ключ, secret
    protected $url = "http://api.loft:85/vk.php";

    public function simplevk()
    {
        $url = 'https://api.vk.com/method/users.get?user_ids=2&fields=bdate&v=5.68';

        return file_get_contents($url);
    }

    public function authorizeUrl()
    {
        $auth = "https://oauth.vk.com/authorize?client_id={$this->appid}&client_secret={$this->protectedkey}";
        $auth.= "&v=5.63&response_type=code&redirect_uri={$this->url}&scope=email,friends";

        return $auth;
    }

    public function access_token($code)
    {
        $params = http_build_query([
            'client_id' => $this->appid,
            'client_secret' => $this->protectedkey,
            'redirect_uri' => $this->url,
            'code' => $code,
        ]);
        $url = "https://oauth.vk.com/access_token?".$params;
        $response = file_get_contents($url);

        $data = json_decode($response, true);

        return $data['access_token'];
    }

    public function getReviews($token)
    {
        $url= 'https://api.vk.com/method/board.getComments?group_id=76297300&topic_id=32368710'.
            '&access_token='.$token.'&v=5.68';
        $result= file_get_contents($url);
        $data = json_decode($result, true);
        return $data;
    }

    public function getFriends($token)
    {
        $url= 'https://api.vk.com/method/friends.get?'.
            'access_token='.$token.'&v=5.68';
        $result= file_get_contents($url);
        $data = json_decode($result, true);
        return $data;
    }

    public function getUser($token)
    {
        $url= 'https://api.vk.com/method/users.get?'.
            'access_token='.$token.'&v=5.68&fields=education';
        $result= file_get_contents($url);
        $data = json_decode($result, true);
        return $data;
    }
}


/*
 * Таблица users
 * id 255
 * email asd@asd.ru
 * name
 * surname
 * password adasdasd
 * vk_id 5123
 * fb_id 1111111
 *
 * select * from users where vk_id = 5123;
 */