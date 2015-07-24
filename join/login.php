<?php
require('../dbconnect.php');

session_start();




if (!empty($_POST)) {
	// ログインの処理
	if ($_POST['mail_address'] != '' && $_POST['password'] != '' && $_POST['workshop_id'] != '') {
		$sql = sprintf('SELECT * FROM member WHERE mail_address="%s" AND password="%s" AND workshop_id="%s"',
			mysqli_real_escape_string($db, $_POST['mail_address']),
			mysqli_real_escape_string($db, sha1($_POST['password'])),
			mysqli_real_escape_string($db, $_POST['workshop_id'])
		);
		
	$record = mysqli_query($db, $sql) or die(mysqli_error($db));
		if ($table = mysqli_fetch_assoc($record)) {
			// ログイン成功
			$_SESSION['number'] = $table['number'];

			$url = "../shift/index.php";
			header("Location: ".$url);
			exit();
			
		} else {
			$error['login'] = 'failed';
		}
	} else {
		$error['login'] = 'blank';
	}
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<link rel="stylesheet" type="text/css" href="style.css" />
<title>ログインする</title>
</head>

<body>
<div id="wrap">
	<div id="head">
		<h1>ログインする</h1>
	</div>
	<div id="content">
		<div id="lead">
			<p>必要事項を記入してログインしてください。</p>
			<p>会員登録がまだの方はこちらからどうぞ。</p>
			<p>&raquo;<a href="join.php">会員登録をする</a></p>
		</div>
	<form action="" method="post">
		<dl>
		
			<dt>メールアドレス</dt>
			<dd>
			<input type="text" name="mail_address" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['mail_address']); ?>" />
			<?php if ($error['login'] == 'blank'): ?>
			<p class="error">* 記入漏れがあります</p>
			<?php endif; ?>
			<?php if ($error['login'] == 'failed'): ?>
			<p class="error">* ログインに失敗しました。正しくご記入ください。
			</p>
			<?php endif; ?>
		</dd>
		
		<dt>パスワード</dt>
		<dd>
			<input type="password" name="password" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['password']); ?>" />
		</dd>
		
		<dt>仕事場ID</dt>
			<dd>
			<input type="text" name="workshop_id" size="35" maxlength="255" value="<?php echo htmlspecialchars($_POST['workshop_id']); ?>" /
		</dl>
		<div><input type="submit" value="ログインする" />
		</div>
	</form>
</div>

</div>
</body>
</html>
