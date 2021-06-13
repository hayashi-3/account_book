<?php
 require_once('../classes/account.php');

 ini_set("display_errors", 1);
 error_reporting(E_ALL);

 $account = new Account();
 $result = $account->getById($_GET['id']);

  $id = $result['id'];
  $date = $result['date'];
  $type = (int)$result['type'];
  $title = $result['title'];
  $amount = $result['amount'];
  $memo = $result['memo'];
?>

<!DOCTYPE html>
<html lang="ja">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>更新フォーム</title>
</head>
<body>
    <h2>更新フォーム</h2>
    <form action="../controller/update.php" method="POST">
        <input type="hidden" name="id" value="<?php echo $id?>">
        <p>日付：</p>
        <input type="date" name="date" value="<?php echo $date?>">
        <p>収支：</p>
        <input type="radio" name="type" value="0" <?php if($type === 0) echo "checked"?>>支出
        <input type="radio" name="type" value="1" <?php if($type === 1) echo "checked"?>>収入
        <p>品目：</p>
        <input type="text" name="title" value="<?php echo $title?>">
        <br>
        <p>金額：</p>
        <input type="number" name="amount" value="<?php echo $amount?>">
        <br>
        <p>メモ：</p>
        <textarea name="memo" cols="30" rows="10"><?php echo $memo?></textarea>
        <br>
        <input type="submit" value="送信">
    </form>
</body>
</html>