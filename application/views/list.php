<?php $this->setLayoutVar('title', $item_name . '一覧');?>

<?php echo $this->render('login_header'); ?>

<?php print $item_name;?>一覧 <br /> 

<?php if(count($items) === 0) :?>
    <?php print $item_name;?>は登録されていません。<br />
<?php else: ?>
    <table>
        <tr>
            <?php foreach(array_keys($attributes) as $key):?>
                <th><?php print $key;?></th>
            <?php endforeach;?>    
            <th>操作</th>
        </tr>
        <?php foreach($items as $item):?>
            <tr>
                <?php foreach($attributes as $attribute):?>
                    <td><?php print $this->escape($item[$attribute]);?></td>
                <?php endforeach;?>
                <td>
                    <form method="post">
                        <input type="hidden" name="code" value="<?php print $this->escape($item[$code_key]);?>">
                        <input type="submit" name="disp" value="参照" formaction="/<?php print $controller;?>/disp">
                        <input type="submit" name="edit" value="編集" formaction="/<?php print $controller;?>/edit">
                        <input type="submit" name="delete" value="削除" formaction="/<?php print $controller;?>/delete">
                    </form>
                </td>
            </tr>
        <?php endforeach;?>
    </table> 
<?php endif ?>

<form method="post" action="/<?php print $controller;?>/add">
    <input type="submit" name="add" value="追加">
</form>