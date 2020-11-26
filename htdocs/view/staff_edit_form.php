<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ショッピングサイト</title>
</head>
<body>
    スタッフ修正<br />
    変更する項目をチェックしてください。<br />
    <br />
    スタッフコード<br />
    <?php print $code; ?>
    <br />
    <br />
    <form method="post">
        <input type="hidden" name="code" value="<?php print $code; ?>">
        スタッフ名<br />
        <input type="text" name="name" style="width:200px" value="<?php print $name;?>">
        <input type="checkbox" name="changename" value="1" checked><br />
        パスワードを入力してください<br />
        <input type="password" name="pass" style="width:100px">
        <input type="checkbox" name="changepass" value="1" checked><br />
        パスワードをもう一度入力してください<br />
        <input type="password" name="pass2" style="width:100px"><br />
        <br />
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" name="edit_check" value="OK">
    </form>
</body>
</html>