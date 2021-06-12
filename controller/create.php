<?php
  require_once '../classes/account.php';
  $accounts = $_POST;

  $account = new Account();
  $account->accountCreate($accounts);
  header("location: ../public/index.php");
?>