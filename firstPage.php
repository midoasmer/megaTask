<?php
include 'init.php';
//$sql = "SELECT items.id,items.name FROM items
//JOIN orders ON orders.item_id=items.id SELECT orders.*";
//$r = $conn->query($sql);
//echo $conn->query($sql);
//foreach($r as $row) {
//    //echo $row['column_name']; // Print a single column data
//    echo print_r($row);       // Print the entire row data
//    break;
//}


///////////////////////////////////////////////////////////////////////////////////
if (isset($_GET['pageno'])) {
    $pageno = $_GET['pageno'];
} else {
    $pageno = 1;
}
$no_of_records_per_page = 10;
$offset = ($pageno-1) * $no_of_records_per_page;
//$querey = " SELECT (
//      SELECT COUNT(*)
//	  FROM   orders
//	  ) AS tota,
//	  (SELECT COUNT(*)
//	  FROM   departments
//	  ) AS No_Of_Departments
//FROM dual";
$total_pages_sql = "SELECT COUNT(*) FROM items";

$result = mysqli_query($conn,$total_pages_sql);
$total_rows = mysqli_fetch_array($result)[0];
$total_pages = ceil($total_rows / $no_of_records_per_page);
//$sql = "SELECT Items.id,Items.name FROM items
//LIMIT $offset, $no_of_records_per_page";
$sql = "SELECT items.id AS id,items.name AS name,COUNT(orders.id) AS num FROM items INNER JOIN orders ON orders.item_id=items.id GROUP BY items.name ORDER BY COUNT(orders.id) DESC  LIMIT $offset, $no_of_records_per_page";
$results = mysqli_query($conn,$sql);
//echo $results; exit();
//while($row = mysqli_fetch_array($results)){
//    //here goes the data
//}
?>
<!DOCTYPE html>
<html dir="rtl" lang="ar" xmlns="http://www.w3.org/1999/html">
<meta charset="UTF-8">
<meta name="Task" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="assets/css/bootstrap.min.css">
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
    <table class="table" id="tableData" >
        <thead>
        <tr>
            <th scope="col">اسم الصنف</th>
            <th scope="col">عدد المستخدمين الذين قامو بطلبه</th>
            <th scope="col">عدد الطلبات قيد التنفيذ الخاصه بالصنف</th>
            <th scope="col">عدد الطلبات التى تم تنفيذها الخاصه بالصنف</th>
            <th scope="col">عدد الطلبات التى تم طلبها بالمنطقه 1</th>
            <th scope="col">عدد الطلبات التى تم تنفيذها بالمنطقه 2</th>
            <th scope="col">عدد الطلبات التى تم تنفيذها بالمنطقه 3</th>
            <th scope="col">عدد المستخدمين تالذين قامو بطلبه مره واحده</th>
            <th scope="col">عدد المستخدمين تالذين قامو بطلبه اكثر من مره</th>
            <th scope="col">اجمالى عدد الطلبات</th>
        </tr>
        </thead>
        <tbody>
        <?php
        foreach ($results as $result)
        {
            //get number of users ordered for item
            $sql = "SELECT COUNT(DISTINCT  users.id) FROM users INNER JOIN orders ON orders.user_id=users.id WHERE orders.item_id='".$result['id']."'";
            $userNumber = $conn->query($sql);
            $userNumber = mysqli_fetch_array($userNumber)[0];
            //get number of users ordered for item one time
            $sql = "SELECT COUNT(users.id) FROM users WHERE 1 = (SELECT COUNT(*) FROM orders WHERE users.id=orders.user_id AND orders.item_id='".$result['id']."')";
            $userAskOne = $conn->query($sql);
            $userAskOne = mysqli_fetch_array($userAskOne)[0];
            //get number of users ordered for item more than one time
            $sql = "SELECT COUNT(users.id) FROM users WHERE 1 < (SELECT COUNT(*) FROM orders WHERE users.id=orders.user_id AND orders.item_id='".$result['id']."')";
            $userAskMoreOne = $conn->query($sql);
            $userAskMoreOne = mysqli_fetch_array($userAskMoreOne)[0];
            //get number of in way orders for item
            $sql = "SELECT COUNT(*) FROM orders  WHERE status='Ordered' AND item_id='".$result['id']."'";
            $inWay = $conn->query($sql);
            $inWay = mysqli_fetch_array($inWay)[0];
            //get number of delivered orders for item
            $sql = "SELECT COUNT(*) FROM orders  WHERE status='Delivered' AND item_id='".$result['id']."'";
            $don = $conn->query($sql);
            $don = mysqli_fetch_array($don)[0];
            //get number of orders for area1 for item
            $sql = "SELECT COUNT(*) FROM orders WHERE item_id='".$result['id']."' AND orders.address='1'";
            $totalArea1 = $conn->query($sql);
            $totalArea1 = mysqli_fetch_array($totalArea1)[0];
            //get number of orders for area2 for item
            $sql = "SELECT COUNT(*) FROM orders WHERE item_id='".$result['id']."' AND orders.address='2'";
            $totalArea2 = $conn->query($sql);
            $totalArea2 = mysqli_fetch_array($totalArea2)[0];
            //get number of orders for area3 for item
            $sql = "SELECT COUNT(*) FROM orders WHERE item_id='".$result['id']."' AND orders.address='3'";
            $totalArea3 = $conn->query($sql);
            $totalArea3 = mysqli_fetch_array($totalArea3)[0];

            echo '<tr>
<th>'.$result['name'].'</th>
<th>'.$userNumber.'</th>
<th>'.$inWay.'</th>
<th>'.$don.'</th>
<th>'.$totalArea1.'</th>
<th>'.$totalArea2.'</th>
<th>'.$totalArea3.'</th>
<th>'.$userAskOne.'</th>
<th>'.$userAskMoreOne.'</th>
<th>'.$result['num'].'</th>
</tr>';
        }
        ?>
        </tbody>
    </table>
    <nav aria-label="Page navigation example">
        <ul class="pagination">
            <li class="page-item"><a class="page-link" href="?pageno=1">First</a></li>
            <li class="page-item <?php if($pageno <= 1){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?pageno=".($pageno - 1); } ?>">Prev</a></li>
            <li class="page-item <?php if($pageno >= $total_pages){ echo 'disabled'; } ?>">
                <a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?pageno=".($pageno + 1); } ?>">Next</a></li>
            <li class="page-item"><a class="page-link" href="?pageno=<?php echo $total_pages; ?>">Last</a></li>
        </ul>
    </nav>
</div>
<script src="assets/js/bootstrap.min.js"></script>
<script src="assets/js/jquery.min.js"></script>
</body>
</html>