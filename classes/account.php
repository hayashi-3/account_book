<?php
  require_once '../dbconnect.php';
  class Account {
    public function setTypeName($type) {
      if ($type === '0') {
        return '支出';
      } else {
        return '収入';
      }
    }

    public function getAll() {
      $dbh = connect();
      $sql = "SELECT * FROM account";
      $stmt = $dbh->query($sql);
      $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
      $dbh = null;
      return $result;
    }

    public function accountCreate($accounts) {
      $sql = 'INSERT INTO
                account(date, type, title, amount, memo)
              VALUES
                (:date, :type, :title, :amount, :memo)';
  
      $dbh = connect();
      $dbh->beginTransaction();
      try {
        $stmt = $dbh->prepare($sql);
        $stmt->bindValue(':date', $accounts['date'], PDO::PARAM_STR);
        $stmt->bindValue(':type', $accounts['type'], PDO::PARAM_INT);
        $stmt->bindValue(':title', $accounts['title'], PDO::PARAM_STR);
        $stmt->bindValue(':amount', $accounts['amount'], PDO::PARAM_INT);
        $stmt->bindValue(':memo', $accounts['memo'], PDO::PARAM_STR);
        $stmt->execute();
        $dbh->commit();
        echo '家計簿に登録しました';
      } catch(PDOException $e) {
          $dbh->rollBack();
        exit($e);
      }
    }

    public function getById($id) {
      if(empty($id)) {
        exit('IDが不正です');
      }

      $dbh = connect();

      $stmt = $dbh->prepare("SELECT * FROM account WHERE id = :id");
      $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

      $stmt->execute();
      $result = $stmt->fetch(PDO::FETCH_ASSOC);

      if(!$result) {
        exit('詳細がありません。');
      }
      return $result;
    }

    public function accountUpdate($accounts) {
      $sql = "UPDATE account SET
              date = :date, type = :type, title = :title, amount = :amount, memo = :memo
            WHERE
              id = :id";

    $dbh = connect();
    $dbh->beginTransaction();
    try {
      $stmt = $dbh->prepare($sql);
      $stmt->bindValue(':date', $accounts['date'], PDO::PARAM_STR);
      $stmt->bindValue(':type', $accounts['type'], PDO::PARAM_INT);
      $stmt->bindValue(':title', $accounts['title'], PDO::PARAM_STR);
      $stmt->bindValue(':amount', $accounts['amount'], PDO::PARAM_INT);
      $stmt->bindValue(':memo', $accounts['memo'], PDO::PARAM_STR);
      $stmt->bindValue(':id', $accounts['id'], PDO::PARAM_INT);
      $stmt->execute();
      $dbh->commit();
      echo '更新しました';
      } catch(PDOException $e) {
          $dbh->rollBack();
        exit($e);
      }
    }

    public function delete($id) {
      if(empty($id)) {
        exit('IDが不正です');
      }

      $dbh = connect();

      $stmt = $dbh->prepare("DELETE FROM account WHERE id = :id");
      $stmt->bindValue(':id', (int)$id, PDO::PARAM_INT);

      $stmt->execute();
      echo '削除しました';
      return $result;
    }
  }
?>