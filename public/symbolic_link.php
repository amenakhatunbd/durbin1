<?php $target = '/home/durbiin/public_html/storage/app/public/';

$shortcut = '/home/durbiin/public_html/public/storage';
var_dump(symlink($target, $shortcut));
exit;
?>
