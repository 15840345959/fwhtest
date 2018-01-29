<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>微信扫码登录</title>
</head>
<body>
<div id="qrCode">

</div>
<script src="http://res.wx.qq.com/connect/zh_CN/htmledition/js/wxLogin.js"></script>
<script>
    window.onload = function () {

        var obj = new WxLogin({
            id: "qrCode",
            appid: "wx685ff20a78495315",
            scope: "snsapi_login",
            redirect_uri: "http://fwhTest.isart.me/webLogin",
            href: '',
            state: "<?php echo time(); ?>"
        });
    }


</script>
</body>
</html>