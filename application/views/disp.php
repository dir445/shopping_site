<?php print $item_name;?>情報参照<br />
<br />
<?php foreach($attributes as $key => $value) :?>
    <?php print $key;?><br />
    <?php print $value;?><br />    
<?php endforeach;?>
<br />
<form>
    <input type="button" onclick="history.back()" value="戻る">
</form>