<?php
$connect = mysqli_connect("localhost", "root", "", "tus-control_pen");
$query = "SELECT count(*) as present_absent_count, dept_id,
     case
         when dept_id = 01 then 'บัญชี'
         when dept_id = 02 then 'ขาย'
         when dept_id = 03 then 'บุคคล'
       end as dept_id FROM employee GROUP BY dept_id ;";
$result = mysqli_query($connect, $query);
$i=0;
while ($row = mysqli_fetch_array($result)) {
    $label[$i] = $row["dept_id"];
    $count[$i] = $row["present_absent_count"];
    $i++;
}
?>
<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Graph</title>
<link rel="stylesheet" type="text/css" href="../vendor/bootstrap/css/bootstrap.min.css">
<script type="text/javascript"
    src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript">  


google.charts.load('current', {'packages':['corechart']});  
google.charts.setOnLoadCallback(drawPieChart);  

function drawPieChart()  
{  
    var pie = google.visualization.arrayToDataTable([  
              ['attendancede', 'Numbder'],
              ['<?php echo $label[0]; ?>', <?php echo $count[0]; ?>],
              ['<?php echo $label[1]; ?>', <?php echo $count[1]; ?>],
              ['<?php echo $label[2]; ?>', <?php echo $count[2]; ?>],
                    
         ]);  
    var header = {  
          title: 'Number of employees for each pass',
          slices: {0: {color: '#666666'}, 1:{color: '#006EFF'}}
         };  
    var piechart = new google.visualization.PieChart(document.getElementById('piechart'));  
    piechart.draw(pie, header);  
} 

</script>
</head>
<?php
 require_once 'sidebar.php';
?>
<body>
    <div class="container">
    </br>
    <h3>จำนวนพนักงานแต่ละฝ่าย</h3>
    <div id="piechart" stlye ="width=50%"></div>
    </div>
</body>
</html>