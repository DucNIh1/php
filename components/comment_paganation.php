<ul class="paganation">
    <?php 
        if($currentPage > 3){
            ?>
    <li><a href="?product_id=<?php echo $product_id?>&page=<?php echo 1 ?>"><?php echo 'Trang đầu' ?></a></li>
    <?php }
    ?>
    <?php
        for ($i = 1; $i <= $totalPages; $i++) {
        ?>
    <?php
    if ($currentPage != $i) {
        if ($i >= $currentPage - 3 && $i <= $currentPage + 3) {
            ?>

    <li><a href="?product_id=<?php echo $product_id?>&page=<?php echo $i ?>"><?php echo $i ?></a></li>
    <?php }
    } 
            else{
            ?>
    <li><a href="?product_id=<?php echo $product_id?>&page=<?php echo $i?>"
            style="background-color: #fba1b7; color: #fff"><?php echo $i?></a></li>
    <?php } ?>
    <?php }
    ?>
    <?php 
        if($currentPage < $totalPages -2){
            ?>
    <li><a href="?product_id=<?php echo $product_id?>&page=<?php echo $totalPages ?>"><?php echo 'Trang cuối' ?></a>
    </li>
    <?php }
    ?>
</ul>