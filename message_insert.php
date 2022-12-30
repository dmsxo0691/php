<meta charset="utf-8">
<?php
$send_id = $_GET["send_id"];

$rv_id = $_POST['rv_id'];
$subject = $_POST['subject'];
$content = $_POST['content'];
$subject = htmlspecialchars($subject, ENT_QUOTES);
$subject = htmlspecialchars($content, ENT_QUOTES);
$regist_day = date("Y-m-d (H:1)");

if(!$send_id){
    echo ("
        <script>
        alert('로그인 후 이용해주세요');
        history.go(-1)
        </script>
        ");
    exit;
}

$con = mysqli_connect("localhost:3308", "root", "1234", "sample");
$sql = "select * from members where id='$rv_id'";
$result = mysqli_query($con, $sql);
$num_record = mysqli_num_rows($result);

if($num_record){
    $sql = "insert into message (send_id, rv_id, subject, content, regist_day)";
    $sql .= "values('$send_id', '$rv_id', '$subject', '$content', '$regist_day')";
    mysqli_query($con, $sql);
}else{
    echo("
    <script>
    alert('수신 아이디가 잘못되었습니다');
    history.go(-1)
    </script>
    ");
    exit;
}
mysqli_close($con);

echo "
    <script>
    location.href = 'message_box.php?mode=send';
    </script>
    ";
    ?>