<?php
  require_once '../classes/account.php';
  
  $account = new Account();
  $accountData = $account->getAll();

  function h($s) {
    return htmlspecialchars($s, ENT_QUOTES, "UTF-8");
  }
?>

<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>家計簿</title>
</head>
<body>
  <h2>家計簿</h2>
  <p><a href="./register_form.html">新規作成</a></p>
  <table>
      <tr>
        <th>日付</th>
        <th>収支</th>
        <th>タイトル</th>
        <th>金額</th>
        <th>メモ</th>
        <th>登録日時</th>
        <th>詳細</th>
        <th>編集</th>
        <th>削除</th>
      </tr>
      <?php foreach($accountData as $column): ?>
        <tr>
          <td><?php echo h(date('Y/m/d', strtotime($column['date']))) ?></td>
          <td><?php echo h($account->setTypeName($column['type'])) ?></td>
          <td><?php echo h($column['title']) ?></td>
          <td>¥<?php echo h(number_format($column['amount'])) ?></td>
          <td><?php echo h($column['memo']) ?></td>
          <td><?php echo h(date('Y/m/d', strtotime($column['created_at']))) ?></td>
          <td><a href="../controller/detail.php?id=<?php echo $column['id'] ?>">詳細</a></td>
          <td><a href="../public/update_form.php?id=<?php echo $column['id'] ?>">編集</a></td>
          <td><a href="#">削除</a></td>
        </tr>
      <?php endforeach; ?>
    </table>
</body>
</html>