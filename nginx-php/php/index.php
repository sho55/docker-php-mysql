<?php
// ドライバ呼び出しを使用して MySQL データベースに接続します
$dsn = 'mysql:dbname=mysql;host=172.25.0.1;port=3316';
$user = 'mysql';
$password = 'mysql';

try {
    $dbh = new PDO($dsn, $user, $password);
    echo "接続成功\n";

    $sql = 'SELECT * FROM seminar ORDER BY seminar_date';
    $stmt = $dbh -> query($sql);

    while($result = $stmt->fetch(PDO::FETCH_ASSOC)){
      // var_dump($result);
    $rows[] = $result;
    // var_dump($message);
    // $i ++;
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

    <link rel="stylesheet" type="text/css" href="./css/style.css" />

    <!-- fontawesome -->
    <link href="https://use.fontawesome.com/releases/v5.6.1/css/all.css" rel="stylesheet">

     <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="jquery.quicksearch.js" type="application/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</head>

<style type="text/css">
p {
    margin: 0;
}

a{
    color:#2196f3;
}

.container {
    background: #FFF;
    overflow: hidden;
    width: 100%;
}

.container p {
    font-size:12px;
    color:#7f7f7f;
    display: -webkit-box;
    -webkit-box-orient: vertical;
    -webkit-line-clamp: 4;
}
</style>

<body>
<h1 class="text-center font-weight-bold">セミナー情報</h1>
<!-- デザイン２ -->
<div class="container">
    <div class="row">
        <div class="col-md-12 my-3 ">
            <form>
                <input type="text" id="search-text" placeholder="検索ワードを入力" class="rounded">
            </form>
        </div>

        <?php
          foreach($rows as $row){
          ?>
          <div class="offset-md-2 col-md-8 my-3">
          <p class="h6 seminar-title"><a href="<?php echo $row['detail_url']; ?>" class="mb-2 mb-md-0 mt-4" target="_blank"><?php echo $row['name']; ?><i class="fas fa-external-link-alt ml-1"></i></a></p>
            <div class="small mt-1">日程：<?php echo $row['seminar_date']; ?></div>
            <div class="small mt-1">開催場所：<?php echo $row['location']; ?></div>
            <div class="small mt-1">費用：<?php echo $row['price']; ?>円</div>

          <!-- <div class="mt-4">【概要】</div> -->
                    <!-- <a href="/page.php?page=<?= $row['id']; ?>" class="btn btn-outline-dark d-block d-md-inline-block mb-2 mb-md-0 mt-4" target="_blank" value="1">【概要】</a> -->
          <!-- <div class="text-secondary small"><?php echo nl2br($row['body']); ?></div> -->
            <div class="container">
            <p>
                <?php echo nl2br($row['body']); ?>
            </p>
            </div>

          </div>
          <hr>
        <?php
          }
          ?>
</div>
</div>
<nav aria-label="...">
  <ul class="pagination">
    <li class="page-item">
      <a class="page-link" href="#" aria-label="前">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    <li class="page-item"><a class="page-link" href="#">1</a></li>
    <li class="page-item"><a class="page-link" href="#">2</a></li>
    <li class="page-item"><a class="page-link" href="#">3</a></li>
    <li class="page-item">
      <a class="page-link" href="#" aria-label="次">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
  </ul>
</nav>

<!-- <div class="wrapper">
    <div class="search-area">
      <form>
        <input type="text" id="search-text" placeholder="検索ワードを入力">
      </form>
      <div class="search-result">
        <div class="search-result__hit-num"></div>
        <div id="search-result__list"></div>
      </div>
    </div> -->

    <ul class="seminar-contents">
      <a>りんご120円</a>
      <a>ばなな100円</a>
      <a>みかん150円</a>
      <a>いちご220円</a>
      <a>すいか500円</a>
    </ul>
  </div><!-- /.wrapper -->
</body>

<script type="text/javascript">
$(function() {
    searchWord = function() {
        var searchText = $(this).val(), // 検索ボックスに入力された値
            targetText;

        $('.seminar-contents a').each(function() {
            targetText = $(this).text();

            // 検索対象となるリストに入力された文字列が存在するかどうかを判断
            if (targetText.indexOf(searchText) != -1) {
                $(this).removeClass('hidden');
            } else {
                $(this).addClass('hidden');
            }
        });
    };

    // searchWordの実行
    $('#search-text').on('input', searchWord);
});
</script>

</html>