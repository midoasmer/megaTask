<?php
if($_SERVER['REQUEST_METHOD'] == 'POST'){
   header('Location: firstPage.php');
}
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar">
<meta charset="UTF-8">
<meta name="Task" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
<!-- Latest compiled and minified CSS -->
<!--<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">-->
<body>
<!-- Navigation -->
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">MegaCompany</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="#">Link1</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link2</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link3</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link4</a>
            </li>
        </ul>
    </div>
</nav>

<div class="container">
<h1 id="whiteH">الرجاء الانتظار حتى يتم عمل تهيئه لقاعده البيانات وادخل بيانات الاختبار بها قد تستغرق 45 ثانيه وهذا فقط عند تشغيل البرنامج لاول مره على الجهاز </h1>
    <table class="table" id="tableData" style="display: none">
        <thead>
        <tr>
            <th scope="col">اسم الصنف</th>
            <th scope="col">عدد المستخدمين الذين قامو بطلبه</th>
            <th scope="col">عدد الطلبات قيد التنفيذ الخاصه بالصنف</th>
            <th scope="col">عدد الطلبات التى تم تنفيذها الخاصه بالصنف</th>
            <th scope="col">عدد الطلبات التى تم تنفيذها بالمنطقه 1</th>
            <th scope="col">عدد الطلبات التى تم تنفيذها بالمنطقه 2</th>
            <th scope="col">عدد المستخدمين تالذين قامو بطلبه مره واحده</th>
            <th scope="col">عدد المستخدمين تالذين قامو بطلبه اكثر من مره</th>
            <th scope="col">اجمالى عدد الطلبات</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
    <form action="<?php echo $_SERVER['PHP_SELF']?>" method="POST">
        <button id="dataButton" type="submit" class="btn btn-outline-primary" style="display: none">عرض البيانات</button>
    </form>

</div>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
<script type="text/javascript" language="javascript">

    $(document).ready(function() {
        jQuery.ajax({
            type: "POST",
            url: 'database/createDataBase.php',
            data: {functionname: 'ini', arguments: ["localhost", "root", "","megaTask"]},
            success:function(data) {
                console.log(data);
                document.getElementById('tableData').style.display=null;
                document.getElementById('dataButton').style.display=null;
                document.getElementById('whiteH').innerHTML='تم عمل قاعده البينات وادخال البيانات بها يمكنك التجربه الان';
            }
        });
    });
</script>
</body>
</html>