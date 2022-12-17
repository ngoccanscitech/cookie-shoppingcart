<?php
    require_once('db/dbhelper.php');
    require_once('utils/utility.php');
    include('layouts/header.php');
    $cart = [];
    if(isset($_COOKIE['cart']))
    {
        $json = $_COOKIE['cart'];
        $cart = json_decode($json, true);
    }
    $idList = [];
    foreach ($cart as $item)
    {
        $idList[] = $item['id'];
    }
    if(count($idList) > 0)
    {
        $idList = implode(',', $idList);
        // [2,5,6] => 2,5,6
    
        $sql = "SELECT * FROM products where id in ($idList)";
        $cartList = executeResult($sql);
    }else{
        $cartList = [];
    }
?>
    <!-- Body -->
    <div class="container">
        <div class="row p-5">
            <div class="col-md-12">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Thumbnail</th>
                            <th>Title</th>
                            <th>Num</th>
                            <th>Price</th>
                            <th>Total</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $count = 0;
                        $total = 0;
                        foreach($cartList as $item)
                        {
                            $num = 0;
                            foreach($cart as $value)
                            {
                                if($value['id'] == $item['id'])
                                {
                                    $num = $value['num'];
                                    break;
                                    // Kiếm được rồi thì break ra để nhẹ chương trình
                                }
                            }
                            $total += $num*$item['price'];
                            echo '<tr>
                            <td>'.(++$count).'</td>
                            <td><img src="'.$item['thumbnail'].'" style="height: 100px"/></td>
                            <td>'.$item['title'].'</td>
                            <td>'.$num.'</td>
                            <td>'.number_format($item['price'], 0, ',', '.').'</td>
                            <td>'.number_format($num*$item['price'], 0, ',', '.').'</td>
                            <td><button class="btn btn-danger">Delete</button></td>
                        </tr>';
                        }
                        ?>
                    </tbody>
                </table>
                <p style="font-size: 30px;color:red">
                        Total: <?= number_format($total, 0, ',', '.') ?>
                </p>
            </div>
        </div>
    </div>
    <script>
        function addToCart(id)
        {
            $.post('api/cookie.php', {
                'action':'add',
                'id':id,
                'num':1
            }, function(data){
                location.reload()
            })
        }
    </script>
    <?php
    include('layouts/footer.php');
?>
    