<!--Form.php-->
<!--Recieves data and fills it into data.txt-->
<!--Which is later used to display the data the user saved-->

<?php
mb_internal_encoding('UTF-8');

$pageTitle = "Въведи";
include "include" . DIRECTORY_SEPARATOR . "header.php";

if($_POST){
    $name = trim($_POST['name']);
    $name = str_replace('!', '', $name);

    $price = trim($_POST['price']);
    $price = str_replace('!', '', $price);

    $date = trim($_POST['date']);

    $selectedType = (int)$_POST['type'];
    $errorFlag = false;

    if(mb_strlen($name) <= 3) {
        echo 'Името е много късо';
        $errorFlag = true;
    }
    if ($price <= 0) {
        echo 'Цената не трябва да е 0!';
        $errorFlag = true;
    }
    //Checks if the date is empty
    //If empty, initialises it to the current date
    if(!empty($date)) {
        $date = strtotime($date);
        $date = date('d.m.Y', $date);
    }
    if(!array_key_exists($selectedType, $types)) {
        echo 'Ключа не съществува в типовете!';
        $errorFlag = true;
    }

    if(!$errorFlag) {
        if(empty($date)) {
            $date = date('d.m.Y');
        }

        $result = $date . '!' . $name . '!' . $price . '!' . $selectedType . "\n";
        file_put_contents('data.txt', $result, FILE_APPEND);
    }
}

?>
    <a href="http://localhost/telerik_php/Records_file_system/index.php">Индекс</a>
        <form method="POST">
        <div>Име: <input type="text" name="name"/></div>
        <div>Цена: <input type="text" name="price"></div>
        <div>Дата: <input type="date" name="date"</div>
        <div>Тип:
            <select name="type">
                <?php
                foreach ($types as $key=>$val) {
                    if($key == 0) {
                        continue;
                    }
                    echo '<option value="'.$key.'">' . $val . '</option>';
                }

                ?>
            </select>
        </div>
        <div><input type="submit" value="Въведи"></div>
    </form>
<?php
include "include" . DIRECTORY_SEPARATOR ."footer.php";
?>