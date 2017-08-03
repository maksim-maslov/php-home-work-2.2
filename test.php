<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <style>

        body {
            position: relative;
            margin: 20px auto;
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
        if (isset($_GET['option'])) {
            $test_number = (int)$_GET['option'];
            $f = FILTER_VALIDATE_INT;
            $options = ['options' => ['min_range' => 1, 'max_range' => 3]];
            if (filter_var($test_number, $f, $options)) {
                $file_list = scandir('test');
                //    var_dump($test_list);
                chdir('test');
                $test_list = array_slice($file_list, 2);
                $test_file_name = $test_list[$_GET['option'] - 1];
                $json = file_get_contents($test_file_name);
                $data = json_decode($json, true);
                //    if ($data[0]['test_number'] != ($_GET['option'])) {
                //        foreach ($test_list as $value) {
                //            $json = file_get_contents($value);
                //            $data = json_decode($json, true);
                //            if ($data[0]['test_number'] == ($_GET['option'])) {
                //                $test_file_name = $value;
                //            }
                //        }
                //    }
                $question_list = array_slice($data, 1);
                global $correct_answers;
                ?>

                <form method="post">
                    <?php
                    foreach ($question_list as $key => $value) {
                        ?>
                        <p></p>
                        <fieldset>
                            <p></p>
                            <div><?= $value['question'] ?></div><p></p>
                            <?php
                            foreach ($value['options'] as $index => $item) {
                                ?>
                                <input type="radio" name="<?= $key + 1 ?>" value="<?= $index + 1 ?>"><span><?= $index + 1 . '. ' . $item ?></span><p></p>
                                <?php
                            }
                            ?>
                        </fieldset>
                        <?php
                        $correct_answers[$key + 1] = $value['answer'];
                    }
                    ?>
                    <p></p>
                    <input type="submit" value="Отправить">
                </form>

                <?php
                if (isset($_POST[1])) {
                    $user_answers = $_POST;
                    $incorrect_answers = array_diff_assoc($user_answers, $correct_answers);
                    $count_all_answers = count($correct_answers);
                    $count_incorrect_answers = count($incorrect_answers);
                    $count_correct_answers = $count_all_answers - $count_incorrect_answers;
                    ?>
                    <p></p>
                    <div>Количество правильных ответов <?= $count_correct_answers . ' из ' . $count_all_answers ?></div>
                    <?php
                }
            } else {
                echo "Неверно указан номер теста";
            }
        }
        ?>

        <p></p>
        <a href="index.php">Перейти на главную страницу</a>
    </section>
</body>
</html>

