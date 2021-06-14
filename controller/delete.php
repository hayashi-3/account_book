<?php
  require_once '../classes/account.php';

  $account = new Account();
  $result = $account->delete($_GET['id']);
  header("location: ../public/index.php");
?>