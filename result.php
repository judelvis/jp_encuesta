<?php
session_start();

require 'config.php';


$right_answer = 0;
$wrong_answer = 0;
$unanswered = 0;

$keys = array_keys($_POST);
$order = join(",", $keys);

//$query="select * from questions id IN($order) ORDER BY FIELD(id,$order)";
// echo $query;exit;

$response = mysql_query("select id,answer from questions where id IN($order) ORDER BY FIELD(id,$order)") or die(mysql_error());

while ($result = mysql_fetch_array($response)) {
    if ($result['answer'] == $_POST[$result['id']]) {
        $right_answer++;
    } else if ($_POST[$result['id']] == 5) {
        $unanswered++;
    } else {
        $wrong_answer++;
    }
}
$name = $_SESSION['name'];
mysql_query("update users set score='$right_answer' where user_name='$name'");
?>
<!DOCTYPE html>
<html>
<head>
    <title>Encuesta</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
    <link href="css/style.css" rel="stylesheet" media="screen">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="../../assets/js/html5shiv.js"></script>
    <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->

</head>
<body>
<header>
    <p class="text-center">
        Bienvenido <?php
        if (!empty($_SESSION['name'])) {
            echo $_SESSION['name'];
        } ?>

    </p>
</header>
<div class="container result">
    <div class="row">
        <div class='result-logo'>
            <h3>Muchas gracias por participar en nuestra encuesta.</h3>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="col-xs-6 col-sm-3 col-lg-3">
            <a href="<?php echo BASE_PATH; ?>" class='btn btn-success'>Repetir!!!</a>

            <div style="margin-top: 30%">
                <p>Total no. de MALO : <span class="answer"><?php echo $right_answer; ?></span></p>
            </div>

        </div>

    </div>
    <div class="row">

    </div>
</div>
<footer>
    <p class="text-center" id="foot">
        &copy; <a href="#" target="_blank"></a>2013
    </p>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.10.2.min.js"></script>
<script src="js/bootstrap.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/jquery.validate.min.js"></script>

</body>
</html>
