<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?php if (isset($title)): echo $this->escape($title) . ' - ';endif; ?>
    ショッピングサイト</title>
</head>
<body>
    <?php echo $_content; ?>
</body>
</html>