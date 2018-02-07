<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>微信开发</title>
</head>
<script src="http://res.wx.qq.com/open/js/jweixin-1.2.0.js" type="text/javascript" charset="utf-8"></script>
<body>
{{$wx_config}}

<button onclick="clickShare();">分享</button>

</body>
</html>
<script type="text/javascript" charset="utf-8">

    wx.config({!! $wx_config !!});


    //微信相关
    wx.ready(function () {
        // config信息验证后会执行ready方法，所有接口调用都必须在config接口获得结果之后，config是一个客户端的异步操作，所以如果需要在页面加载时就调用相关接口，则须把相关接口放在ready函数中调用来确保正确执行。对于用户触发时才调用的接口，则可以直接调用，不需要放在ready函数中。
        console.log("okokok")

        wx.onMenuShareTimeline({
            title: '分享标题', // 分享标题
            link: 'http://fwhTest.isart.me/wxPage', // 分享链接，该链接域名或路径必须与当前页面对应的公众号JS安全域名一致
            imgUrl: 'http://osc6vvb9q.bkt.clouddn.com/2017107135228260789214.jpg', // 分享图标
            success: function (ret) {
                // 用户确认分享后执行的回调函数
                console.log("success ret:" + JSON.stringify(ret))
            },
            cancel: function () {
                // 用户取消分享后执行的回调函数
            }
        });

    });

    function clickShare() {

    }

</script>

