<?php $this->setLayoutVar('title', 'スタッフ一覧') ?>

スタッフ一覧 <br />
<table>
    <tr><th>コード</th><th>名前</th><th>操作</th></tr>
    <?php foreach($staffs as $rec):?>
        <tr>
        <td><?php print $rec['code']; ?></td>
        <td><?php print $rec['name']; ?></td>
        <td>
            <form method="post">
                <input type="hidden" name="code" value="<?php print $rec['code'];?>">
                <input type="submit" name="disp" value="参照" formaction="staff/disp">
                <input type="submit" name="edit" value="編集" formaction="staff/edit">
                <input type="submit" name="delete" value="削除" formaction="staff/delete">
            </form>
        </td>
        </tr>
    <?php endforeach; ?>
</table>

<form method="post" action="staff/add">
    <input type="submit" name="add" value="追加">
</form>