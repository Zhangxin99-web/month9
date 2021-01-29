<!DOCTYPE html>
<html>
<head>
    <title></title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/popper.js/1.15.0/umd/popper.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script type="text/javascript" charset="utf-8" src="/editor/ueditor.config.js"></script>
    <script type="text/javascript" charset="utf-8" src="/editor/ueditor.all.min.js"> </script>
    <!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
    <!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
    <script type="text/javascript" charset="utf-8" src="/editor/lang/zh-cn/zh-cn.js"></script>
    <!--引入CSS-->
    <link rel="stylesheet" type="text/css" href="webuploader/webuploader.css">

    <!--引入JS-->
    <script type="text/javascript" src="webuploader/webuploader.js"></script>

</head>
<body>

<div class="container">
    <h2>添加文章</h2>
    <form action="{{url("store")}}" method="post" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="email">文章标题:</label>
            <input type="text" class="form-control" name="title">
        </div>
        <div class="form-group">
            <label for="pwd">文章作者:</label>
            <input type="text" class="form-control" name="author">
        </div>
        <div id="uploader" class="wu-example">
            <!--用来存放文件信息-->
            <div id="thelist" class="uploader-list"></div>
            <div class="btns">
                <input type="hidden" name="pic" id="pic">
                <div id="picker">选择文件</div>
                <img src="" width="200" height="200" id="article_pic">
            </div>
        </div>
        <div class="form-group">
            <label for="pwd">文章摘要:</label>
            <textarea name="desn" id="desn">
            </textarea>
        </div>
        <button type="submit" class="btn btn-primary">添加</button>
    </form>
</div>

</body>
</html>
<script>
    UE.getEditor('desn');
</script>
<script>
    $(function () {
        var uploader = WebUploader.create({
            // 选完文件后，是否自动上传。
            auto: true,
            // swf文件路径
            swf: '/webuploader/Uploader.swf',
            fileVal:"pic",
            //传参
            formData:{
                _token:"{{csrf_token()}}"
            },
            // 文件接收服务端。
            server: 'http://www.kedemo.com/uploader',
            // 选择文件的按钮。可选。
            // 内部根据当前运行是创建，可能是input元素，也可能是flash.
            pick: {
                id:'#picker',
                multiple:false
            },
            // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
            resize: true,
            title: 'Images',
            extensions: 'gif,jpg,jpeg,bmp,png',
            mimeTypes: 'image/*',
            compress:{
                width: 100,
                height: 100,
            }
        });
        uploader.on( 'uploadSuccess', function( file ,res) {
            console.log(res)
            $("#pic").val(res.path)
            if(res.code==200){
                $("#article_pic").attr("src",res.path)
            }
        });
    })

</script>
