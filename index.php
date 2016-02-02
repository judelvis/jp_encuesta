<?php
session_start();
require 'config.php';
mysql_query("INSERT INTO users (id, user_name,score,category_id)VALUES ('NULL','$name',0,'1')") or die(mysql_error());


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
    <style>
        .container {
            margin-top: 110px;
        }

        .error {
            color: #B94A48;
        }

        .form-horizontal {
            margin-bottom: 0px;
        }

        .hide {
            display: none;
        }
    </style>
</head>
<body>
<header>
    <p class="text-center">
        Bienvenido
    </p>
</header>

<div class="container question">
    <div class="col-xs-12 col-sm-8 col-md-8 col-xs-offset-4 col-sm-offset-3 col-md-offset-3">
        <p>
            Encuesta
        </p>
        <hr>
        <form class="form-horizontal" role="form" id='login' method="post" action="result.php">
            <?php
            $res = mysql_query("select * from questions where category_id='1' ") or die(mysql_error());
            $rows = mysql_num_rows($res);
            $i = 1;
            while ($result = mysql_fetch_array($res)) {
                ?>

                <?php if ($i == 1) { ?>
                    <div id='question<?php echo $i; ?>' class='cont'>
                        <p class='questions' id="qname<?php echo $i; ?>"><h1> <?php echo $i ?>
                            .<?php echo $result['question_name']; ?></p></h1>
                        <h3><input type="radio" value="1" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer1']; ?>
                        <br/>
                        <input type="radio" value="2" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer2']; ?>
                        <br/>
                        <input type="radio" value="3" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer3']; ?>
                        <br/>
                        <input type="radio" value="4" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer4']; ?>
                        <br/>
                        <input type="radio" checked='checked' style='display:none' value="5"
                               id='radio1_<?php echo $result['id']; ?>' name='<?php echo $result['id']; ?>'/>
                        <br/>
                        <button id='next<?php echo $i; ?>' class='next btn btn-success' type='button'>Siguiente</button>
                            </h3>
                    </div>

                <?php } elseif ($i < 1 || $i < $rows) { ?>

                    <div id='question<?php echo $i; ?>' class='cont'>
                        <p class='questions' id="qname<?php echo $i; ?>"><?php echo $i ?>
                            .<?php echo $result['question_name']; ?></p>
                        <input type="radio" value="1" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer1']; ?>
                        <br/>
                        <input type="radio" value="2" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer2']; ?>
                        <br/>
                        <input type="radio" value="3" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer3']; ?>
                        <br/>
                        <input type="radio" value="4" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer4']; ?>
                        <br/>
                        <input type="radio" checked='checked' style='display:none' value="5"
                               id='radio1_<?php echo $result['id']; ?>' name='<?php echo $result['id']; ?>'/>
                        <br/>
                        <button id='pre<?php echo $i; ?>' class='previous btn btn-success' type='button'>Anterior
                        </button>
                        <button id='next<?php echo $i; ?>' class='next btn btn-success' type='button'>Siguiente</button>
                    </div>

                <?php } elseif ($i == $rows) { ?>
                    <div id='question<?php echo $i; ?>' class='cont'>
                        <p class='questions' id="qname<?php echo $i; ?>"><?php echo $i ?>
                            .<?php echo $result['question_name']; ?></p>
                        <input type="radio" value="1" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer1']; ?>
                        <br/>
                        <input type="radio" value="2" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer2']; ?>
                        <br/>
                        <input type="radio" value="3" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer3']; ?>
                        <br/>
                        <input type="radio" value="4" id='radio1_<?php echo $result['id']; ?>'
                               name='<?php echo $result['id']; ?>'/><?php echo $result['answer4']; ?>
                        <br/>
                        <input type="radio" checked='checked' style='display:none' value="5"
                               id='radio1_<?php echo $result['id']; ?>' name='<?php echo $result['id']; ?>'/>
                        <br/>

                        <button id='pre<?php echo $i; ?>' class='previous btn btn-success' type='button'>Anterior
                        </button>
                        <button id='next<?php echo $i; ?>' class='next btn btn-success' type='submit'>Finalizar</button>
                    </div>
                <?php }
                $i++;
            } ?>

        </form>
    </div>
</div>


<?php

if (isset($_POST[1])) {
    $keys = array_keys($_POST);
    $order = join(",", $keys);

    //$query="select * from questions id IN($order) ORDER BY FIELD(id,$order)";
    // echo $query;exit;

    $response = mysql_query("select id,answer from questions where id IN($order) ORDER BY FIELD(id,$order)") or die(mysql_error());
    $right_answer = 0;
    $wrong_answer = 0;
    $unanswered = 0;
    while ($result = mysql_fetch_array($response)) {
        if ($result['answer'] == $_POST[$result['id']]) {
            $right_answer++;
        } else if ($_POST[$result['id']] == 5) {
            $unanswered++;
        } else {
            $wrong_answer++;
        }

    }

    echo "right_answer : " . $right_answer . "<br>";
    echo "wrong_answer : " . $wrong_answer . "<br>";
    echo "unanswered : " . $unanswered . "<br>";
}
?>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="js/jquery-1.10.2.min.js"></script>
<!-- Include all compiled plugins (below), or include individual files as needed -->
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.validate.min.js"></script>

<script>
    $('.cont').addClass('hide');
    count = $('.questions').length;
    $('#question' + 1).removeClass('hide');

    $(document).on('click', '.next', function () {
        element = $(this).attr('id');
        last = parseInt(element.substr(element.length - 1));
        nex = last + 1;
        $('#question' + last).addClass('hide');

        $('#question' + nex).removeClass('hide');
    });

    $(document).on('click', '.previous', function () {
        element = $(this).attr('id');
        last = parseInt(element.substr(element.length - 1));
        pre = last - 1;
        $('#question' + last).addClass('hide');

        $('#question' + pre).removeClass('hide');
    });

</script>
</body>
</html>
