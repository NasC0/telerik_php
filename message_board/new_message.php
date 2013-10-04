<?php
    $pageTitle = 'Ново съобщение';
    include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

    if(isset($_SESSION['isLogged'])) {
        if(isset($_GET['add'])) {
            $errorFlag = false;
            $msgTitle = trim($_GET['title']);
            if(mb_strlen($msgTitle) <= 0 || mb_strlen($msgTitle) >= 50) {
                echo '</p>Дължината на заглавието трябва да е по-голяма от 0 и по-малка от 50 символа!</p>';
                $errorFlag = true;
            }
            $msgBody = trim($_GET['body']);
            if (mb_strlen($msgBody) <= 0 || mb_strlen($msgBody) >= 250) {
                echo '</p>Дължината на съдържанието трябва да е по-голяма от 0 и по-малка от 250 символа!</p>';
                $errorFlag = true;
            }
            $date = date('d.m.Y H:i:s');
            $username = $_SESSION['username'];
            $group = $_GET['group'];

            if(!$errorFlag) {
                $query = "INSERT INTO messages
                      (msg_name, msg_body, msg_date, added_by, group_id)
                      VALUES ('$msgTitle', '$msgBody', NOW(), '$username', '$group')";
                $result = mysqli_query($connection, $query);
                if($result) {
                    echo '<p>Съобщението е добавено успешно!</p>';
                    header('Location:messages.php');
                    exit();
                }
                else {
                    echo '</p>Съобщението е добавено неуспешно!</p>';
                }
            }

        }
        ?>
        <form style="margin-top:10px" method="GET" name="addMessage">
            <div>Заглавие: <input type="text" name="title"></div>
            <div>Категория:
                <select name="group">
                    <?php
                    foreach ($groups as $key=>$val) {
                        if($key == 0) {
                            continue;
                        }
                        echo '<option value="' .$key. '">' .$val.'</option>';
                    }
                    ?>
                </select>
            </div>
            <div><p>Съдържание:</p> <textarea rows="4" cols="50" name="body"></textarea></div>
            <div><input type="submit" value="Добави съобщение" name="add"></div>
        </form>
        <?php
    }
    else {
        header('Location: index.php');
        exi();
    }