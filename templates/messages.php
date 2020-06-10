<?php
if(empty($list)) exit;
?>
<div class="alert alert-<?php echo $class?>">
    <?php
    foreach($list as $message)
    {
        echo "<div>- $message</div>";
    }
    ?>
</div>