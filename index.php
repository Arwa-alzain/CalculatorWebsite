<!DOCTYPE html>
<html lang="ar">

<head>
    <meta charset="UTF-8">
    <title>Calculator</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div class="calculator">
        <form method="post">
            <input type="text" name="expression" class="display"
                value="<?php echo isset($_POST['expression']) ? $_POST['expression'] : ''; ?>" readonly>

            <div class="buttons">
            <?php
                $buttons = [
                    ['7', '8', '9', '/'],
                    ['4', '5', '6', '*'],
                    ['1', '2', '3', '-'],
                    ['0', '.', '=', '+']
                ];

                foreach ($buttons as $row) {
                    echo '<div class="row">';
                    foreach ($row as $btn) {
                        echo "<button type='submit' name='btn' value='$btn'>$btn</button>";
                    }
                    echo '</div>';
                }
                ?>
                <button type="submit" name="btn" value="C" class="clear">C</button>
            </div>
        </form>

        <?php
        if ($_SERVER["REQUEST_METHOD"] === "POST") {
            $exp = $_POST["expression"] ?? '';
            $btn = $_POST["btn"] ?? '';

            if ($btn == 'C') {
                $exp = '';
            } elseif ($btn == '=') {
                // استخدام eval لتقييم التعبير (احذر منه في تطبيقات حقيقية!)
                try {
                    eval ("\$exp = $exp;");
                } catch (Throwable $e) {
                    $exp = 'Error!';
                }
            } else {
                $exp .= $btn;
            }

            // إعادة تحميل الصفحة مع القيمة الجديدة
            echo "<script>
          document.querySelector('.display').value = '" . htmlspecialchars($exp, ENT_QUOTES) . "';
        </script>";
        }
        ?>
    </div>
</body>

</html>