[joinフォルダ:会員登録やログイン]

join.php:会員登録画面(ここからスタート、パスワードは暗号化される）
check.php:登録内容確認
thanks.php:登録完了画面
login.php:ログイン画面


[shift:メイン機能]

index.php:全体シフト表示
ajax.php:DBとのやり取り用?
register.php:シフト登録



[dbconnect.php:ＤＢ接続ファイル(joinフォルダはこれ1つで全部繋がる）]
shiftではファイルごとに接続しているため必要に応じて変更すべし





Notice～のエラーがでる場合は
php.iniの
error_reporting=...
↓
error_reporting=E_ALL & ~E_NOTICE　に変更