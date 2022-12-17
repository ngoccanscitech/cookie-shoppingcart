<?php
    require_once('db/dbhelper.php');
    require_once('utils/utility.php');
    include('layouts/header.php');

    $productList = executeResult('select * from products');
?>
    <!-- Body -->
    <div class="container">
        <div class="row p-5">
            <?php
                foreach($productList as $item)
                {
                    echo '<div class="col-md-3 col-6">
                    <a href="product_detail.php?id='.$item['id'].'"><img src="'.$item['thumbnail'].'" alt=""></a>
                    <a href="product_detail.php?id='.$item['id'].'"><p>'.$item['title'].'</p></a>
                    <p style="color:red">'.number_format($item['price'], 0, ',', '.').' đ </p>
                    </div>';
                }
            ?>
        </div>
    </div>

    <?php
    include('layouts/footer.php');
?>
    