<?php
    /*
		MaterialBlocks - Froala design-blocks based CMS
	    Copyright (C) 2017  Robin Krause
	
	    This program is free software: you can redistribute it and/or modify
	    it under the terms of the GNU General Public License as published by
	    the Free Software Foundation, either version 3 of the License, or
	    (at your option) any later version.
	
	    This program is distributed in the hope that it will be useful,
	    but WITHOUT ANY WARRANTY; without even the implied warranty of
	    MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	    GNU General Public License for more details.
	
	    You should have received a copy of the GNU General Public License
	    along with this program.  If not, see <http://www.gnu.org/licenses/>.
    */
    
    include_once "bb-include/bb-sql.php";
    include_once "bb-include/bb-session.php";
?>
<!DOCTYPE html>
<html>
<head>
    <title>MaterialBlocks-Installation</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    <link type="text/css" rel="stylesheet" href="./themes/default/default.css">
</head>
<body>
    <section class="fdb-block bg-dark fdb-viewport" style="background-image: url(./fdb-imgs/bg_c_1.svg);">
        <div class="container align-items-center justify-content-center d-flex">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-10 col-lg-8">
                    <h1>MaterialBlocks Installation</h1>
                    <h3><strong>Make sure you edited the bb-config.php!</strong></h3>
                </div>
            </div>
        </div>
    </section>
    <?php
        SQLInit();
        if(isset($_GET["action"])&&$_GET["action"]=="step1_sub") {
            if(isset($_POST["user"])&&isset($_POST["password"])&&isset($_POST["email"])) {
                SQLAddUserRow($_POST["user"],$_POST["password"],$_POST["email"],2);
                SessionSetUser($_POST["email"],password_hash($_POST["password"],PASSWORD_DEFAULT));
            }
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=?action=step2\">";
        } else if(isset($_GET["action"])&&$_GET["action"]=="step2_sub") {
            if(isset($_POST["title"])&&isset($_POST["desc"])&&isset($_POST["keys"])) SQLInstallSite($_POST["title"],$_POST["desc"],$_POST["keys"]);
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=?action=step3\">";
        }
    ?>
    <?php
        if(!isset($_GET["action"])||(isset($_GET["action"])&&$_GET["action"]=="step1")) {
    ?>
    <section class="fdb-block" style="background-image: url(./fdb-imgs/bg_4.svg)">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-left">
                    <div class="fdb-box">
                        <div class="row">
                            <div class="col">
                                <h1>Step 1.</h1>
                                <p class="text-h3">Register yourself.</p>
                            </div>
                        </div>
                        <form action="?action=step1_sub" method="POST">
                            <div class="row">
                                <div class="col mt-4">
                                    <input class="form-control" name="user" placeholder="Username" type="text" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    <input class="form-control" name="email" placeholder="Email" type="email" required>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <input class="form-control" name="password" placeholder="Password" type="password" required>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <button class="btn" type="submit">Next <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section class="fdb-block fdb-image-bg" style="background: url(./fdb-imgs/alt_wide_3.svg)">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1><a href="?action=step2" class="btn btn-round btn-black btn-empty">I already filled out this Form <i class="fa fa-angle-right" aria-hidden="true"></i></a></h1>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    ?>
    <?php
        if(isset($_GET["action"])&&$_GET["action"]=="step2") {
    ?>
    <section class="fdb-block" style="background-image: url(./fdb-imgs/bg_3.svg)">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-left">
                    <div class="fdb-box">
                        <div class="row">
                            <div class="col">
                                <h1>Step 2.</h1>
                                <p class="text-h3">Enter Page Information.</p>
                            </div>
                        </div>
                        <form action="?action=step2_sub" method="POST">
                            <div class="row">
                                <div class="col mt-4">
                                    <input class="form-control" name="title" placeholder="Site Title" type="text" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                    <input class="form-control" name="desc" placeholder="Site Description" type="text" required>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <textarea class="form-control" name="keys" rows="3" placeholder="Site Keywords"></textarea>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <button class="btn" type="submit">Next <i class="fa fa-angle-right" aria-hidden="true"></i></button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section class="fdb-block fdb-image-bg" style="background: url(./fdb-imgs/alt_wide_3.svg)">
        <div class="container">
            <div class="row text-center">
                <div class="col-12">
                    <h1><a href="?action=step3" class="btn btn-round btn-black btn-empty">I already filled out this Form <i class="fa fa-angle-right" aria-hidden="true"></i></a></h1>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    ?>
    <?php
        if(isset($_GET["action"])&&$_GET["action"]=="step3") {
    ?>
    <section class="fdb-block bg-dark" style="background-image: url(./fdb-imgs/bg_4.svg)">
        <div class="container">
            <div class="row">
                <div class="col-12 col-sm-10 col-md-8 col-lg-6 text-left">
                    <h1>Finished!</h1>
                    <p class="text-h3">MaterialBlocks is now ready to use!</p>
                    <h3><strong>Important: Delete this file from your server! (install.php located in BeardBlok root)</strong></h3>
                    <p class="mt-4">
                        <a class="btn btn-round btn-black btn-empty" href="index.php">View Page <i class="fa fa-angle-right" aria-hidden="true"></i></a>
                    </p>
                </div>
            </div>
        </div>
    </section>
    <?php
        }
    ?>
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
</body>
</html>