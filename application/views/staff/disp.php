<?php $this->setLayoutVar('title', 'スタッフ詳細') ?>

スタッフ情報参照<br />
<br />
スタッフコード<br />
<?php print $code; ?>
<br />
スタッフ名<br />
<?php print $name; ?>
<br />
<br />
<form>
    <input type="button" onclick="history.back()" value="戻る">
</form>