<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ショッピングサイト</title>
</head>
<body>
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
    <form method="post">
        <input type="hidden" name="code" value="<?php print $code; ?>">
        <!-- <input type="hidden" name="csfr_token" value="<?php print $csfr_token; ?>"> -->
        <input type="button" onclick="history.back()" value="戻る">
        <input type="submit" name="delete_done" value="OK">
    </form>
</body>
</html>