<form method="POST" name="sortForm" style="margin-bottom: 5px;">
    <div>
        <select name="sortType">
            <?php
            foreach ($sortOptions as $key => $val) {
                $selected = '';
                if(isset($_POST['sortType'])) {
                    if ($key == $_POST['sortType']) {
                        $selected = 'selected';
                    }
                }
                echo '<option value="' . $key . '"' . $selected . '>' . $val . '</option>';
            }

            ?>
        </select>
        <input type="submit" value="Сортирай" name="sort">
    </div>
</form>