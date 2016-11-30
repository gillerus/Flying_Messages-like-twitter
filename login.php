<?php
session_start();
?>

<!DOCTYPE html>

<html>
    <head>
        <title>Flying Messages</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="css/bootstrap.css">
        <style>
            .table-striped {
                > tbody > tr:nth-of-type(odd) {
                    background-color: red;
                }
            }

            .table-hover {
                > tbody > tr:hover {
                    background-color: blue;
                }
            }
            .carousel {
                width: 600px !important;
            }

        </style>
    </head>
    <body style='background-color: #1087dd'>
        <div class="container">
            <br>
            <div class="jumbotron" style="background: #00c0ef">
                <center>
                    <h2 class="well" style="width: 600px; text-align: justify; color: #1087dd"><center><b>"Flying Messages"</b></center></h2>
                    <div id="car1" class="carousel slide span8" data-interval="5000" data-pause="hover" data-wrap="true">

                        <!-- slajdy -->
                        <div class="carousel-inner">
                            <div class="item active">
                                <img class="img-rounded" src="img/fmfast1.jpg" alt="slajd 1">                    
                            </div>
                            <div class="item">
                                <img class="img-rounded" src="img/fmmodern1.jpg" alt="slajd 2">                    
                            </div>
                            <div class="item">
                                <img class="img-rounded" src="img/fmreliable.jpg" alt="slajd 3">                    
                            </div>
                            <div class="item">
                                <img class="img-rounded" src="img/fmsafe.jpg" alt="slajd 4">                    
                            </div>
                        </div>
                        <script src="js/libs/jquery/jquery.js"></script>
                        <script src="js/bootstrap.js"></script>
                        <script>
                            $('.carousel').carousel('cycle');
                        </script>
                        


                    </div>
                    <br>
                    <h4 class="well" style="width: 600px; text-align: justify; color: #1087dd"><span class="glyphicon glyphicon-thumbs-up" aria-hidden="true"></span> Witamy na stronie <b>"Flying Messages"</b> dołącz do naszej kosmicznej społeczności
                        aby w ekspersowym tempie wymieniać się wiadomościami i być w kontakcie ze znajomymi!
                    </h4>
                    <div class="well" style="width: 600px;">
                        <form class="form-horizontal" action="zaloguj.php" method="post">
                            <div class="form-group">
                                <label for="inputEmail3" class="col-sm-2 control-label" style="color: #1087dd">Email</label>
                                <div class="col-sm-10">
                                    <input name="email" type="email" class="form-control" id="inputEmail3" placeholder="Email">
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="inputPassword3" class="col-sm-2 control-label" style="color: #1087dd">Password</label>
                                <div class="col-sm-10">
                                    <input name="password" type="password" class="form-control" id="inputPassword3" placeholder="Password">
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="col-sm-offset-2 col-sm-2">
                                    <button type="submit" class="btn btn-sm" style="color: #1087dd">Zaloguj się</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <?php
                    if (isset($_SESSION['error'])) {
                        echo $_SESSION['error'];
                        unset($_SESSION['error']);
                    }
                    ?>                    
                    <div class="well" style="width: 600px; ">
                        <h4><a href="register.php"><button class="btn btn-block" style="color: #1087dd">Zarejestruje się</button></a></h4>
                    </div>
                    <div class="well" style="width: 600px;">
                        <div>
                            <h4><a href="https://github.com/gillerus"><button class="btn btn-block" style="color: #1087dd">CREATOR<span class="glyphicon glyphicon-hand-down" aria-hidden="true"></span><br><img src="img/dg11b.jpg" class="img-rounded" width="80"></button></a></h4>
                        </div>
                    </div>

                </center>   
            </div>
        </div>
    </body>
</html>