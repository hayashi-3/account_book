<?php
  require_once('../classes/account.php');

  $account = new Account();
  $result = $account->getById($_GET['id']);
?>
<!DOCTYPE html>
<html lang="ja">
  <head?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>詳細</title>
  </head>
  <body>
    <h2>詳細</h2>
    <p>日付：<?php echo $result['date'] ?></p>
    <p>収支：<?php echo $account->setTypeName($result['type']) ?></p>
    <p>品目：<?php echo $result['title'] ?></p>
    <p>金額：<?php echo $result['amount'] ?></p>
    <p>メモ：<?php echo $result['memo'] ?></p>
    <p>登録日時：<?php echo $result['created_at'] ?></p>
    <a href="../public/index.php">戻る</a>
  </body>
</html> 