<!DOCTYPE html>
<html lang="ru">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="Cache-Control" content="no-cache">
  <title>PHP Chat</title>
  <link rel="stylesheet" href="/page.css">
  <link rel="icon" type="image" href="chat.ico">
</head>
<body>
  <form action = "index.php" method="POST" class="form">
    <input type = "text" name = "name" value="Dan" placeholder="Введите ваш никнейм" class="input">
    <input type = "textarea" name = "message" placeholder="Введите ваше сообщение" class="input">
    <button type = "submit" class="button">Отправить сообщение</button>
  </form>
  <?php
      $name = $_POST['name'];
      if($name == "") $name = 'Аноним';
      $msg = $_POST['message'];
      $now = date("d/m/y H:i:s");
      if($msg != "") {
        $file = fopen("chat.txt", "a");
        fwrite($file, "\n" . $name . 'Å: ' . $msg . "Ú$now");
        fclose($file);
      }
  ?>
  <div class="chat">
    <h1 class="title">PHP Chat<br>________________________________________</h1>
    <div class="textfield">
      <?php
        $moders = file("moders.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $dons = file("dons.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $arr = file("chat.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        $arrlength = count($arr);
        $counter = 0;
        function checkdons($user) {
          global $dons;
          foreach ($dons as $don) {
            if ($don == $user) {
              return 1;
            }
          }
          return 0;
        }
        function checkmoders($user) {
          global $moders;
          foreach ($moders as $moder) {
            if ($moder == $user) {
              return 1;
            }
          }
          return 0;
        }
        foreach($arr as $item) {
          $counter+=1;
          if ($counter > $arrlength-20) {
            $msgparts1 = explode("Å", $item);
            $msgparts2 = explode("Ú", $msgparts1[1]);
              if (checkdons($msgparts1[0])) {
                echo "<br>------------------------------------------------------<br>"."<span style = 'color: red'>".$msgparts1[0]."</span>".$msgparts2[0]."<br>$msgparts2[1]";
              }
              else if (checkmoders($msgparts1[0])) {
                echo "<br>------------------------------------------------------<br>"."<span style = 'color: blue'>".$msgparts1[0]."</span>".$msgparts2[0]."<br>$msgparts2[1]";
              }
              else {
                echo "<br>------------------------------------------------------<br>".$msgparts1[0].$msgparts2[0]."<br>$msgparts2[1]";
              }
            }
        }
      ?>
    </div>
  </div>
  <footer class="footer"> by Nasdermn 2023</footer>
  <script>
    const element = document.querySelector('.textfield');
    element.scrollTop = element.scrollHeight;
  </script>
</body>
</html>