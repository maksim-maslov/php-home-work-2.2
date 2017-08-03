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
            max-width: 320px;
            margin: 0 auto;
        }

    </style>
</head>
<body>
    <section>
        <form enctype="multipart/form-data" method="post">
            <input type="file" name="usefile">
            <p></p>
            <input type="submit" value="Отправить">
            <p></p>
        </form>

        <?php
        if (isset($_FILES['usefile'])) {
            $file = $_FILES['usefile'];
            $path_file = $file['name'];
            if (!file_exists('test')) {
                mkdir('test') ? chdir('test') : var_dump('Ошибка при загрузке файла');
            } else {
                chdir('test');
            }
            if (move_uploaded_file($file['tmp_name'], $path_file)) {
                echo 'Файл передан';
            } else {
                echo 'Файл не передан';
            }
        }
        ?>

        <p></p>
        <a href="index.php">Перейти на главную страницу</a>
    </section>
</body>
</html>





