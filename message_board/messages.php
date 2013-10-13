<?php
$pageTitle = 'Съобщения';
include 'includes' . DIRECTORY_SEPARATOR . 'header.php';

if (isset($_SESSION['isLogged'])) {
    $order = 'desc';
    $groupSort = '';
    if (isset($_GET['sortType']) || isset($_GET['group'])) {
        $type = $_GET['sortType'];
        $group = (int)$_GET['group'];
        $order = $_GET['sortType'];

        if ((int)$_GET['group'] != 0) {
            $groupSort = " WHERE group_id = $group";
        }
    }
    ?>
    <div>
        <form method="GET" name="sortForm">
            <select name="sortType">
                <?php
                foreach ($sortOptions as $key => $val) {
                    $selected = '';
                    if ($key == $type) {
                        $selected = 'selected';
                    }
                    echo '<option value="' . $key . '"' . $selected . '>' . $val . '</option>';
                }

                ?>
            </select>
            <select name="group">
                <?php
                foreach ($groups as $key => $val) {
                    $selected = '';
                    if ($key == $group) {
                        $selected = 'selected';
                    }
                    echo '<option value="' . $key . '"' . $selected . '>' . $val . '</option>';
                }
                ?>
            </select>
            <input type="submit" name="sort" value="Сортирай">
        </form>
    </div>
    <?php
    $query = "SELECT * FROM messages";
    $query .= $groupSort . " ORDER BY msg_date $order";

    $result = mysqli_query($connection, $query);

    while ($row = mysqli_fetch_assoc($result)) {

        $msgName = $row['msg_name'];
        $msgBody = $row['msg_body'];
        $msgDate = strtotime($row['msg_date']);
        $msgDate = date('d.m.Y', $msgDate);
        $addedBy = $row['added_by'];
        $group = $row['group_id'];

        echo "<div style='border:1px solid #6fd03d; width:400px; margin-top:10px; padding:5px;'><p>$msgName добавено от $addedBy на $msgDate";
        echo " | Група: $groups[$group]";
        if ($_SESSION['isAdmin'] == true) {
            $msgId = $row['msg_id'];
            echo ' | <a href="delete.php?msg=' . $msgId . '">Изтрий съобщението</a>';
        }
        echo "</p>";
        echo "<p style='margin: 5px; word-wrap:break-word;'>$msgBody</p></div>";
    }
} else {
    header('Location: index.php');
    exit();
}