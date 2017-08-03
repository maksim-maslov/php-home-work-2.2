<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>

        body {
            position: relative;
            margin: 100px auto;
        }

        section {
            max-width: 768px;
            margin: 0 auto;
        }

    </style>
</head>
<body>
    <section>
        <?php
        $file_list = scandir('test');
        chdir('test');
        $test_list = array_slice($file_list, 2);
        foreach ($test_list as $key => $value) {
            $json = file_get_contents($value);
            $data = json_decode($json, true);
            $test_number = $data[0]['test_number'];
            $test_name = $data[0]['test_name'];
            ?>
            <div> <?= $test_number . '. ' . $test_name ?> </div><p></p>
            <?php
        }
        ?>

        <form action="test.php" method="get">
            <input name="option" type="text" placeholder="Номер теста">
            <input type="submit" value="Отправить">
        </form>

        <p></p>
        <a href="index.php">Перейти на главную страницу</a>
    </section>
</body>
</html>



