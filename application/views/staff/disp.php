<?php $this->setLayoutVar('title', 'スタッフ詳細') ?>
<?php echo $this->render('login_header'); ?>

スタッフ情報参照<br />
<br />
スタッフコード<br />
<?php print $this->escape($code); ?>
<br />
スタッフ名<br />
<?php print $this->escape($name); ?>
<br />
<br />
<form>
    <input type="button" onclick="history.back()" value="戻る">
</form>