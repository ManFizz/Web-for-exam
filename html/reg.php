<?php
if (isset($_COOKIE['User'])) {
    header("Location: index.php");
}


require_once('db.php');

$error = "";
$success = "";

$link = mysqli_connect($servername, $username, $password, $dbName);

if (!$link) {
    $error = "Ошибка подключения: " . mysqli_connect_error();
}

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
    $username = $_POST['login'];
    $password = $_POST['password'];

    if (!$email || !$username || !$password) {
        $error = "Пожалуйста, введите все значения!";
    } else {
        $sql = "INSERT INTO users (email, username, pass) VALUES ('$email', '$username', '$password')";
        if (!mysqli_query($link, $sql)) {
            $error = "Не удалось добавить пользователя: " . mysqli_error($link);
        } else {
            $success = "Пользователь успешно добавлен!";
			header("Location: login.php");
        }
    }
}

mysqli_close($link);
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
			<div class="col-12">
				<h1>Регистрация</h1>
			</div>
		</div>
		
		<div class="row">
			<div class="col-12">
                <?php
                if ($error) {
                    echo "<div class='alert alert-danger'>$error</div>";
                } elseif ($success) {
                    echo "<div class='alert alert-success'>$success</div>";
                }
                ?>
				<form method="POST" action="reg.php">
					<div class="row form__reg"><input class="form" type="email" name="email" placeholder="Email"></div>
					<div class="row form__reg"><input class="form" type="text" name="login" placeholder="Login"></div>
					<div class="row form__reg"><input class="form" type="password" name="password" placeholder="Password"></div>
					<button type="submit" class="btn-red btn__reg" name="submit">Продолжить</button>
				</form>
			</div>
		</div>
	</div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>