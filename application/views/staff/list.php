<?php $this->setLayoutVar('title', 'スタッフ一覧') ?>

スタッフ一覧 <br />
<form method="post">
    <?php
    foreach($staffs as $rec){
        print '<input type="radio" name="staffcode" value="'.$rec['code'].'">';
        print $rec['name'];
        print '<br />';
    }
    ?>
    <input type="submit" name="disp" value="参照">
    <input type="submit" name="add" value="追加">
    <input type="submit" name="edit" value="編集">
    <input type="submit" name="delete" value="削除">
</form>