<?php
    require_once('db/dbhelper.php');
    require_once('utils/utility.php');
    include('layouts/header.php');

    $id = getGet('id');
    $product = executeResult('select * from products where id='.$id, true);
?>
    <!-- Body -->
    <div class="container">
        <div class="row p-5">
            <div class="col-md-5">
                <img src="<?=$product['thumbnail'] ?>" alt="path to image" class="w-100">
            </div>
            <div class="col-md-7">
                <h4><?=$product['title']?></h4>
                <p style="font-size:36px;color:red;"><?=number_format($product['price'], '0', ',','.')?>đ</p>
                <a href="#" class="btn btn-secondary w-100" onclick="addToCart(<?=$product['id']?>)">Add to card</a>
            </div>
            <div class="col-md-12 mt-3">
                <p class="p-3" style="background-color: #e7dcdc;"><?=$product['content']?></p>
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
    