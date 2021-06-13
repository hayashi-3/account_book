<?php
  require_once '../classes/account.php';
  $accounts = $_POST;

  $account = new Account();
  $account->accountUpdate($accounts);
  header("location: ../public/index.php");
?>