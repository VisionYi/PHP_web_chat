<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="author" content="">
        <meta name="description" content="">
        <title><?php echo $title;?> - myWeb_basic</title>

        <link rel="stylesheet" type="text/css" href="/web_app/public/lib/bootstrap/dist/css/bootstrap.min.css"/>
        <link rel="stylesheet" type="text/css" href="/web_app/public/lib/font-awesome/css/font-awesome.css"/>
        <link rel="stylesheet" type="text/css" href="/web_app/public/css/stylish-portfolio.css"/>
        <link rel="stylesheet" type="text/css" href="/web_app/public/css/site.css" />
        <?php $this->get_css() ?>

    </head>
    <body>
        <nav class="navbar navbar-default ss-shadow-no-bottom ss-navbar" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <a class="navbar-brand" href="#"><b>軟體工程</b></a>
                    <button type="button" class="navbar-toggle ss-shadow-no-bottom" data-toggle="collapse" data-target="#navbar-1" style="margin-top:1px">
                        <i class="fa fa-bars fa-lg " title="open"></i>
                    </button>
                </div>
                <div class="collapse navbar-collapse " id="navbar-1">
                    <ul class="nav navbar-nav">
                        <li class="<?php echo ($title=='Index')? 'active':''; ?>">
                            <a href="/Home">首頁</a>
                        </li>
                        <li class="<?php echo ($title=='Contact')? 'active':'';?>">
                            <a href="/Home/Contact">聊天討論區</a>
                        </li>
                        <li class="<?php echo ($title=='About')? 'active':'';?>">
                            <a href="/Home/About">關於我們</a>
                        </li>
                        <li class="<?php echo ($title=='TestDB')? 'active':'';?>">
                            <a href="/TestDB">資料庫測試</a>
                        </li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <?php require 'LoginPartial.php'; ?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php $this->get_view() ?>

        <footer id="contact">
            <div class="container" >
                <div class="row">
                    <div class="col-lg-10 col-lg-offset-1 text-center">
                        <h4 class="ss-footer-textcolor">
                            <a href="http://www.kuas.edu.tw/" target="_blank"><b>國立高雄應用科技大學</b></a>
                            <br>
                            <a href="http://www.ec.kuas.edu.tw/" target="_blank"><b>電 子 工 程 系</b></a>
                        </h4>
                        <p class="text-muted">
                            <i class="fa fa-phone fa-fw"></i>(123) 456-7890
                            <br>
                            <i class="fa fa-envelope-o fa-fw"></i><a href="mailto:name@gmail.com"> name@gmail.com</a>
                        </p>
                        <ul class="list-inline">
                            <li>
                                <a href="#"><i class="fa fa-facebook fa-fw fa-3x"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter fa-fw fa-3x"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-dribbble fa-fw fa-3x fa-spin"></i></a>
                            </li>
                        </ul>
                        <hr>
                        <p class="text-muted">Copyright &copy; My Website 2016</p>
                    </div>
                </div>
            </div>
        </footer>

        <script type="text/javascript" src="/web_app/public/lib/jquery/dist/jquery.min.js"></script>
        <script type="text/javascript" src="/web_app/public/lib/angular/angular.min.js"></script>
        <script type="text/javascript" src="/web_app/public/lib/bootstrap/dist/js/bootstrap.min.js"></script>
        <?php $this->get_js() ?>

    </body>
</html>
