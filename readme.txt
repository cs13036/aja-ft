[join:会員登録やログイン]

register.php:会員登録画面
check.php:登録内容確認
thanks.php:登録完了画面
login.php:ログイン画面

[shift:カレンダーとか]

index.php:カレンダー部分
ajax.php:DBとのやり取り用？


[dbconnect.php:ＤＢ接続ファイル(joinで使用）]



Notice～のエラーがでる場合は
php.iniの
error_reporting=...
↓
error_reporting=E_ALL & ~E_NOTICE　に変更