<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>ショッピングサイト</title>
</head>
<body>
    <?php
    try{
        $dbh = connect_shop_database();
        $sql = 'SELECT name FROM mst_staff WHERE 1';
        $stmt = $dbh->prepare($sql);
        $stmt->execute();
        $dbh =null;

        while(true) {
            
        }
    } catch(Exception $e) {

    }

    ?>
</body>
</html>