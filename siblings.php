<?php 
include 'common.php';
include 'header.php';
include 'checklogin.php';
if(isset($_POST['add'])){
$sibling = implode(' , ', $_POST['siblings']);
mysqli_query($con, "INSERT INTO student (siblings) VALUE ('$sibling')");
echo $sibling;
// header('location: studentadd.php');
}

echo'<script>
let txt1=document.getElementById("main").value;
let txt2=document.getElementById("tData").innerHTML;
let txt22=txt2+"<tr><td>"+txt1+"</td><td>";
document.getElementById("tData").innerHTML=txt22;
document.getElementById("main").value = "";
</script> ';
$sibling = implode(' , ', $_POST['siblings']); 
// var val=document.getElementById("main").value;
// var table = document.createElement("table");
// for (var i = 1; i < 4; i++){
//    var tr = document.createElement("tr");   

//    var td1 = document.createElement("td");
//    var td2 = document.createElement("td");

//    var text1 = document.createTextNode("Text1");
//    var text2 = document.createTextNode("Text2");

//    td1.appendChild(text1);
//    td2.appendChild(text2);
//    tr.appendChild(td1);
//    tr.appendChild(td2);
    // let name = document.getElementById("main").value;
    // let data = document.getElementById("tData").innerHTML;
    // let td = data+"<tr><td>"+name+"</td><td>";
    // document.getElementById("tData").innerHTML=td;
    // document.getElementById("main").value = "";
    // echo "<script type='text/javascript'>
    // let name=document.getElementById('main').value;
    // let data=document.getElementById('tData').innerHTML;
    // let td=data+'<tr><td>'+name+'</td><td>';
    // document.getElementById('tData').innerHTML=td;
    // document.getElementById('main').value = "";
    // </script>"
    // ;
    // echo "<table name='t_data' id='tData'><tr><td>".$sib."</td></tr></table>";
    // $sibling = implode(' , ', $_GET['sibling']);
    // mysqli_query($con, "INSERT INTO student (siblings) VALUE ('$sibling')");
    // echo $sibling;
        // function generateTable(table, data) {
    //     for (let element of data) {
    //       let row = table.insertRow();
    //       for (key in element) {
    //         let cell = row.insertCell();
    //         let text = document.createTextNode(element[key]);
    //         cell.appendChild(text);
    //       }
    //     }
    //   }
?>

 

































