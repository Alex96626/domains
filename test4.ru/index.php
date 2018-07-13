<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap-3.3.7-dist/css/bootstrap.min.css" >
    <script  src="css/bootstrap-3.3.7-dist/js/bootstrap.min.js" ></script>
    <link rel="stylesheet" href="css/style.css">

</head>
<body>
<div class="container">
    <div class="row">
        <nav class="navbar navbar-inverse" role="navigation" >
            <div class="container">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle " data-toggle="collapse" data-target="#responsive-menu">
                        <span class="sr-only">Открыть навигацию</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="responsive-menu" >
                    <ul class="nav navbar-nav">
                        <li > <a href="#"> Home</a><li>
                        <li ><a href="#">About US</a><li>
                        <li > <a href="#"> Services</a><li>
                        <li ><a href="#"> Portfolio</a><li>
                        <li class="active" ><a href="#"> Team</a><li>
                        <li ><a href="#"> Contact</a><li>
                    </ul>
                </div>
            </div>
    </div>
</div>


</nav>
<div class="container">
    <div class="row">
        <header class=" col-xs-6 col-sm-6 col-md-4 col-lg-3" >

                <?php
                require_once 'connection.php'; // подключаем скрипт
                require_once 'data_base.php'; // подключаем скрипт
                // подключаемся к серверу

                if($result)
                {
                    $rows = mysqli_num_rows($result);
                    echo '<div class="team ">';

                    for ($i = 0 ; $i < $rows ; ++$i){
                        echo "<ul>";
                            $row = mysqli_fetch_row($result);
                                echo "<li><img src='$row[1]''></li>";
                             for ($j = 2 ; $j < 4 ; ++$j) echo "<li>"."$row[$j]"."<br>"."</li>";
                            echo "<li>";
                                echo md5($row[4]);
                            echo "</li>";
                        echo "</ul>";
                    }

                    echo "</div>";
                    mysqli_free_result($result);
                }
                mysqli_close($link);
                ?>
        </header>
    </div>
</div>

<footer>
    <span class="text"><h2>CONTACT US</h2></span>
    <div class="container">
        <div class="row">
            <div class="form">
                <form class="form-horizontal">
                    <div class="row">
                        <div class=" col-xs-6 col-sm-6 col-md-4 col-lg-3">
                            <input class="input-text form-control" type="text" name="" value="Ваше имя" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-xs-6 col-sm-6 col-md-4 col-lg-3">
                            <input class="input-text form-control" type="text" name="" value="Ваш email" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class=" col-xs-6 col-sm-6 col-md-4 col-lg-3">
                            <textarea class="input-text form-control" type="text" name="" cols="0" rows="0" onfocus="if(this.value==this.defaultValue)this.value='';" onblur="if(this.value=='')this.value=this.defaultValue;">Ваше сообщение</textarea>
                        </div>
                    </div>
                    <input class="btn  btn-default" type="submit" value="Отправить сообщение " style="font-size: 12px">
                </form>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
