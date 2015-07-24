<?php
require('../dbconnect.php');

session_start();

if (!empty($_POST)) {
	// エラー項目の確認
	if ($_POST['name'] == '') {
		$error['name'] = 'blank';
	}
	
	if ($_POST['mail_address'] == '') {
		$error['mail_address'] = 'blank';
	}
	if ($_POST['password'] == '') {
		$error['password'] = 'blank';
	}
	if ($_POST['workshop_id'] == '') {
		$error['workshop_id'] = 'blank';
		
	}
	
	if(empty($error)){
	 $_SESSION['join']=$_POST;
	 header('Location:check.php');
	 exit();
	 }
	}
	

	// 重複垢のチェック
	if (empty($error)) {
		$sql = sprintf('SELECT COUNT(*) AS cnt FROM member WHERE mail_address="%s"',
			mysqli_real_escape_string($db, $_POST['mail_address'])
		);
		$record = mysqli_query($db, $sql) or die(mysqli_error($db));
		$table = mysqli_fetch_assoc($record);
		if ($table['cnt'] > 0) {
			$error['mail_address'] = 'duplicate';
		}
	}


// 書き直し
if ($_REQUEST['action'] == 'rewrite') {
	$_POST = $_SESSION['join'];
	$error['rewrite'] = true;
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />

<title>被雇用者会員登録</title>
</head>

<body>
<div id="wrap">
<div id="head">
<h1>被雇用者会員登録</h1>
</div>

<div id="content">
<p>必要事項をご記入ください。</p>

<form action="" method="post" enctype="multipart/form-data">
	<dl>
		<dt>お名前 </dt>
		<dd>
			<input type="text" name="name" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['name'], ENT_QUOTES, 'UTF-8'); ?>" />
			<?php if ($error['name'] == 'blank'): ?>
			<p class="error">* お名前を入力してください</p>
			<?php endif; ?>
		</dd>
		
		<dt>メールアドレス</dt>
		<dd>
			<input type="text" name="mail_address" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['mail_address'], ENT_QUOTES, 'UTF-8'); ?>" />
			<?php if ($error['mail_address'] == 'blank'): ?>
			<p class="error">* メールアドレスを入力してください</p>
			<?php endif; ?>
			<?php if ($error['mail_address'] == 'duplicate'): ?>
			<p class="error">* 指定されたメールアドレスはすでに登録されています</p>
			<?php endif; ?>
		</dd>
		
		<dt>パスワード</dt>
		<dd>
			<input type="password" name="password" size="10" maxlength="20" value="<?php echo htmlspecialchars($_POST['password'], ENT_QUOTES, 'UTF-8'); ?>" />
			<?php if ($error['password'] == 'blank'): ?>
			<p class="error">* パスワードを入力してください</p>
			<?php endif; ?>
			
		<dt>仕事場ID <small>*雇用者に尋ねて記入してください</small></dt>
		<dd>
			<input type="text" name="workshop_id" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['workshop_id'], ENT_QUOTES, 'UTF-8'); ?>" />
			<?php if ($error['workshop_id'] == 'blank'): ?>
			<p class="error">* 仕事場IDを入力してください</p>
			<?php endif; ?>
		</dd>
	</dl>
	<div><input type="submit" value="入力内容を確認する" /></div>
</form>
</div>



</div>
</body>
</html>
