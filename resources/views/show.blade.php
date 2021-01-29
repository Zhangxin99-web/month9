<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Bootstrap 实例 - 基本的表格</title>
    <link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
    <script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <!--第一步：引入Javascript / CSS （CDN）-->
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="http://cdn.datatables.net/1.10.21/css/jquery.dataTables.css">
    <!-- jQuery -->
    <script type="text/javascript" charset="utf8" src="http://code.jquery.com/jquery-1.10.2.min.js"></script>
    <!-- DataTables -->
    <script type="text/javascript" charset="utf8" src="http://cdn.datatables.net/1.10.21/js/jquery.dataTables.js"></script>
</head>
<body>

<!--第二步：添加如下 HTML 代码-->
<table id="table_id_example" class="display">
    <thead>
    <tr>
        <th>文章ID</th>
        <th>文章标题</th>
        <th>作者</th>
        <th>摘要</th>
        <th>操作</th>
    </tr>
    </thead>
    <tbody>
    @foreach($data as $val)
    <tr>
        <td>{{$val->id}}</td>
        <td>{{$val->title}}</td>
        <td>{{$val->author}}</td>
        <td>{{$val->desn}}</td>
        <td>
            <a href="{{url("del")}}/{{$val->id}}" id="del" ids="{{$val->id}}" class="ids">删除</a>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

</body>
</html>
<script>
    // <!--第三步：初始化Datatables-->
    $(document).ready( function () {
        $('#table_id_example').DataTable();
    } );
        $("#del").click(function () {
            var id=$(".ids").attr("ids")
            $.ajax({
                type: "GET",
                url: "http://www.kedemo.com/del",
                dataType: "json",
                data:{
                    id:id,
                    _token:"{{csrf_token()}}"
                },
                success: function(msg){
                    console.log(msg)
                }
            });
    })
</script>
