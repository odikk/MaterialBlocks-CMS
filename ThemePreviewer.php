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
    include_once "bb-include/bb-config.php";
	include_once "bb-include/bb-session.php";
    include_once "bb-include/bb-elements.php";
	include_once "bb-include/bb-fdb.php";
	include_once "bb-include/bb-sql.php";
    include_once "bb-include/bb-parse.php";
    
    function _space() {
    ?>
        <section class="container">
			<div class="col">
				<div class="row-100"></div>
			</div>
			<div class="col">
				<div class="row-100"></div>
			</div>
			<div class="col">
				<div class="row-100"></div>
			</div>
			<div class="col">
				<div class="row-100"></div>
			</div>
			<div class="col">
				<div class="row-100"></div>
			</div>
			<div class="col">
				<div class="row-100"></div>
			</div>
		</section>
    <?php
    }
    SessionStart();
    if(UserIsSessionValid(1)) {
?>
<!DOCTYPE html>
<html>
<?php
    $aSiteIDs=SQLGetSiteIDs();
    if(isset($_GET["site"])) {
        HTMLGetHead($aSiteIDs[$_GET["site"]]);
        $iSite=$_GET["site"];
    } else {
    ?>
        <head>
    	    <title>ThemePreviewer</title>
    	    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    	    <link rel="stylesheet" href="./res/bootstrap/css/bootstrap.min.css">
    	    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    	    <link rel="stylesheet" href="./res/font-awesome/css/font-awesome.min.css">
    	    <link type="text/css" rel="stylesheet" href="./themes/default/default.css">
        </head>
    <?php
    }
?>
<body>
    <?php
    if(!isset($_GET["site"])) {
        ?>
        <section class="fdb-block bg-dark">
            <div class="container">
        <?php
        for($i=0;$i<SQLGetSiteRowCount();$i++) {
            $row=SQLGetSiteRow($aSiteIDs[$i]);
            ?>
                <div class="row align-items-center">
                    <div class="col-12 col-sm-9 text-left">
                        <?php echo "<h2>".$row["title"]."</h2>"; ?>
                    </div>
                    <div class="col-12 col-sm-3 text-left text-sm-center mt-4 mt-sm-0">
                        <?php echo "<a class=\"btn btn-round btn-empty\" href=\"?site=".$i."\">Open</a>"; ?>
                    </div>
                </div>
            <?php
        }
        ?>
            </div>
        </section>
    <?php
    } else {
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/header.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/footer.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/404.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/blog.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/login.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/register.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/contact.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/calltoaction.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/content.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/feature.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/pricing.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/team.php";
        include_once "themes/".SQLGetSiteRow($aSiteIDs[$iSite])["theme"]."/testimonial.php";

        BBHeader($aSiteIDs[$iSite]);
        _space();
        BBError();
        _space();
        BBContact();
        _space();
        BBLogin();
        _space();
        BBRegister();
        _space();
        BBBlog();
        _space();
        ?>
        <section class="fdb-block p-2" id="navigator">
            <div class="container">
                <div class="row justify-content-center">
                    <h2>Show Blocks</h2>
                </div>
            </div>
            <div class="container-fluid">
                <p class="m-0 text-center">
                    <?php 
                    echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=".$iSite."&show_blocks=CallToAction#navigator\">Call to action</a>";
                    echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=".$iSite."&show_blocks=Content#navigator\">Content</a>";
                    echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=".$iSite."&show_blocks=Feature#navigator\">Feature</a>";
                    echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=".$iSite."&show_blocks=Pricing#navigator\">Pricing</a>";
                    echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=".$iSite."&show_blocks=Team#navigator\">Team</a>";
                    echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=".$iSite."&show_blocks=Testimonial#navigator\">Testimonial</a>";
                    ?>
                </p>
            </div>
        </section>
        <?php
        if(isset($_GET["show_blocks"])) {
            for($i=1;$i<=24;$i++) {
                if(function_exists($_GET["show_blocks"].$i)) {
                    if(call_user_func($_GET["show_blocks"].$i,"","","","",false)) {
                        $params=call_user_func($_GET["show_blocks"].$i,"","","","",false);
                        $imgs="";
                        $texts="";
                        $headings="";
                        $links="";
                        for($j=0;$j<$params[0];$j++) {
                            $imgs.="Image".($j+1)."|";
                        }
                        for($j=0;$j<$params[1];$j++) {
                            $texts.="Text".($j+1)."|";
                        }
                        for($j=0;$j<$params[2];$j++) {
                            $headings.="Heading".($j+1)."|";
                        }
                        for($j=0;$j<$params[3];$j++) {
                            $links.="Link".($j+1)."|";
                        }
                        call_user_func($_GET["show_blocks"].$i,rtrim($imgs,'|'),rtrim($texts,'|'),rtrim($headings,'|'),rtrim($links,'|'));
                        _space();
                    }
                }
            }
        }
        _space();
        BBFooter($aSiteIDs[$iSite]);
    }
    ?>
</body>
</html>
<?php
    } else {
    ?>
<!DOCTYPE html>
<html>
<head>
    <title>Error</title>
    <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet" href="./res/bootstrap/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    <link rel="stylesheet" href="./res/font-awesome/css/font-awesome.min.css">
    <link type="text/css" rel="stylesheet" href="./themes/default/default.css">
</head>
<body>
    <a href="index.php?site=dashboard">Please Login first!</a>
</body>
</html>
    <?php
    }
?>