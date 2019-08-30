<?php
  if(isset($_GET['page'])) {
      $page = $_GET['page'];
      print("$page<br>\n");
  }


// ドライバ呼び出しを使用して MySQL データベースに接続します
$dsn = 'mysql:dbname=mysql;host=172.25.0.1;port=3316';
$user = 'mysql';
$password = 'mysql';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo "接続成功\n";

    $sql = 'SELECT * FROM seminar WHERE id='.$page;

    $stmt = $dbh -> query($sql);

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){   
    $rows[] = $result;
    foreach($rows as $row){
            $body = nl2br($row['body']);
          }
    }

} catch (PDOException $e) {
    echo "接続失敗: " . $e->getMessage() . "\n";
    exit();
}

?>

<!DOCTYPE html>
<html lang="ja">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>セミナーリスト</title>

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>
<body>
    <h3 class="text-center">[概要]</h3>
    <div>
    <a href="#" onclick="window.close()" class="btn btn-outline-dark position-fixed">[閉じる]</a>
    </div>
    <div class="offset-2 col-8 small text-dark my-5">
        <?= $body; ?>
    </div>
</body>
</html>