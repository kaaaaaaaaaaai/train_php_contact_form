<html>
<body>
<?php
if(isset($error)){
    foreach ($error as $k => $v) {
        foreach ($v as $key => $value) {
            print "{$k} => {$value}<br />";
        }
    }
}
?>
<h1>input.php</h1>
<form method="post" action="/contact/confirm">
    <div class="form-group">
        <label>名前</label>
        <input type="text" name="name" value="">
    </div>
    <div class="form-group">
        <input name="gender" type="radio" value="men" checked="checked"><label for="men">男</label>
        <input name="gender" type="radio" value="women"><label for="women">女</label>
    </div>
    <div class="form-group">
        <label>コメント</label>
        <input type="text" name="comment" value="">
    </div>
    <div class="form-group">
        <label>E-Mail</label>
        <input type="text" name="email" value="">
    </div>
    <button type="submit"  value="register" name='action'>登録</button>
</form>
</body>
</html>