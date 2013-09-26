<!--Index.php-->
<!--Iterates through the saved data in data.txt-->
<!--And displays it in a table fashion-->
<!--Contains a filter form for the table representation-->

<?php
    $pageTitle = "Индекс";
    include "include" .DIRECTORY_SEPARATOR. "header.php";

    $type = 0;  //Keeps the type, default is 0 - Всички

    //If a filter is set, gets the value and saves it in $type
    if(isset($_POST['type'])) {
        $type = $_POST['type'];
    }
?>

<a href="http://localhost/telerik_php/Records_file_system/form.php">Добави entry</a>
<form method="POST">
    <select name="type">
        <!--Iterates the Types in constants.php-->
        <!--Used to set the filter options-->
        <!--Includes the Всички filter-->
        <?php
        foreach ($types as $key => $val) {

            //$selected displays the correct option after filtering
            $selected = '';
            if($key == $type) {
                $selected = 'selected';
            }
            echo '<option value="'.$key.'" ' . $selected . '>'.$val.'</option>';
        }
        ?>
    </select>
    <input type="submit" name="Филтрирай">
</form>

<table border="1">
    <thead>
        <tr>
            <th>Дата</th>
            <th>Име</th>
            <th>Цена</th>
            <th>Тип</th>
        </tr>
    </thead>
    <tbody>
    <?php
    if(file_exists('data.txt')) {

        $result = file('data.txt');
        //totalSum - keeps the total spent sum
        $totalSum = 0.0;

        foreach ($result as $val) {
            $split = explode('!', $val);

            //If a filter is set checks if the type doesn't equal the filter value
            //If it does, continues from the next step of the loop
            if ($type != trim($split[3]) && $type != 0) {
                continue;
            }

            echo '<tr>
                  <td>' . $split[0] . '</td>
                  <td>' . $split[1] . '</td>
                  <td>' . $split[2] . '</td>
                  <td>' . $types[trim($split[3])] . '</td>
                  </tr>';

            $totalSum += $split[2];
        }

    }
    ?>
        <tr>
            <td>--</td>
            <td>--</td>
            <td><?= $totalSum ?></td>
            <td>--</td>
        </tr>
    </tbody>
</table>

<?php
    include "include" . DIRECTORY_SEPARATOR . "footer.php";
?>