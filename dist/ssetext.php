<?php 
  session_start();
  $user = $_SESSION['user'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CP - Алексей</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/ea2635cacf.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="css/main.min.css">
    <script src="js/index.js"></script>
</head>
<body>
    <section class="section">
        <div class="container">
            <div class="section__inner">
            <div class="inp"><input type="text" class="input-text"></div>
                <a class="btn btn--def">Отправить</a>
            </div>
        </div>
    </section>

    <script>
        var eventSource = new EventSource('server/sse.php');

        eventSource.onopen = function(e) {
            //console.log("Открыто соединение");
        };
        eventSource.onmessage = function(e) {
            console.log("Сообщение: " + e.data);
        };
        eventSource.onerror = function(e) {
            // if (this.readyState == EventSource.CONNECTING) {
            //     console.log("Ошибка соединения, переподключение");
            // } else {
            //     console.log("Состояние ошибки: " + this.readyState);
            // }
        };
    </script>
</body>
</html>