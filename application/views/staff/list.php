<?php $this->setLayoutVar('title', 'スタッフ一覧') ?>
<?php echo $this->render('login_header'); ?>

スタッフ一覧 <br />    
<?php if(count($staffs) === 0) :?>
    スタッフは登録されていません。<br />
<?php else: ?>
    <table>
    <tr><th>コード</th><th>名前</th><th>操作</th></tr>
    <?php foreach($staffs as $staff):
        $code = $this->escape($staff['code']);
        $name = $this->escape($staff['name']); ?>
        <tr>
        <td><?php print $code; ?></td>
        <td><?php print $name; ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="code" value="<?php print $code;?>">
                <input type="submit" name="disp" value="参照" formaction="/staff/disp">
                <input type="submit" name="edit" value="編集" formaction="/staff/edit">
                <input type="submit" name="delete" value="削除" formaction="/staff/delete">
            </form>
        </td>
        </tr>
    <?php endforeach;?>
    </table> 
<?php endif; ?>

<form method="post" action="/staff/add">
    <input type="submit" name="add" value="追加">
</form>