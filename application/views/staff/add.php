<?php $this->setLayoutVar('title', 'スタッフ追加') ?>

スタッフ追加 <br />
<form method="post" action="/staff/add_check">
    スタッフ名<br />
    <input type="text" name="name"><br />
    パスワード<br />
    <input type="password" name="pass"><br />
    パスワード（確認）<br />
    <input type="password" name="pass2"><br />
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" name="add_check" value="追加">
</form>    