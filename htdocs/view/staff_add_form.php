<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ショッピングサイト</title>
</head>
<body>
    スタッフ追加 <br />
    <form method="post" action="../index.php">
        スタッフ名<br />
        <input type="text" name="name"><br />
        パスワード<br />
        <input type="password" name="pass"><br />
        パスワード（確認）<br />
        <input type="password" name="pass2"><br />
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" name="add_check" value="追加">
    </form>    
</body>
</html>