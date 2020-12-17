<?php $this->setLayoutVar('title', 'スタッフ削除') ?>
スタッフ削除<br />
<br />
スタッフコード<br />
<?php print $code; ?>
<br />
スタッフ名<br />
<?php print $name; ?>
<br />
このスタッフを削除してよろしいですか？<br />
<br />
<form method="post" action="delete_done">
    <input type="hidden" name="code" value="<?php print $code; ?>">
    <input type="hidden" name="_token" value="<?php print $this->escape($_token);?>">
    <input type="button" onclick="history.back()" value="戻る">
    <input type="submit" name="delete_done" value="OK">
</form>