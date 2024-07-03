<?php
require_once('db.php');
?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Перепечин В.В.</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Custom style -->
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-12 index">
				<?php
				if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['logout'])) {
                    setcookie('User', '', -1, '/');
				    header('Location: index.php');
				    exit();
				}

				if (!isset($_COOKIE['User'])) {
					echo '<a href="/reg.php">Зарегистрируйтесь</a> или <a href="/login.php">войдите</a>';
				} else {

                    $sql = "SELECT * FROM users WHERE username='" . $_COOKIE['User'];
                    $result = mysqli_query($link, $sql);
                    $row = mysqli_fetch_assoc($result);
				    echo 'Привет, вы <b>' . $row['username'] . '</b>!';
				    echo '<form method="POST" style="display:inline;">
				            <button type="submit" name="logout" class="btn btn-danger">Выйти</button>
				          </form>';
				}
				?>
			</div>
		</div>
	</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
