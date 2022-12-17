<?php
    require_once('../utils/utility.php');
    $id = getPost('id');
    $num = getPost('num');
    $action = getPost('action');

    $cart = [];
    if(isset($_COOKIE['cart']))
    {
        $json = $_COOKIE['cart'];
        $cart = json_decode($json, true);
    }

    switch ($action) {
        case 'add':
            $isFind = false;
            for($i = 0;$i < count($cart);$i++)
            {
                if($cart[$i]['id'] == $id)
                {
                    $cart[$i]['num'] += $num;
                    $isFind = true;
                    break;
                }
            }
        if(!$isFind)
        {
            $cart[] = [
                'id' => $id,
                'num' => $num
            ];
        }
        setcookie('cart', json_encode($cart), time() + 30*24*60*60, '/');
    }

?>