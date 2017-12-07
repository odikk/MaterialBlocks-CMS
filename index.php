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
	include_once "bb-include/bb-sql.php";
	include_once "bb-include/bb-parse.php";
?>
<!DOCTYPE html>
<html>
<?php
	SessionStart();
	$aSiteIDs=SQLGetSiteIDs();
	if(!isset($_GET["site"])) {
		HTMLGetHead($aSiteIDs[0]);
		$iSite=$aSiteIDs[0];
	} else {
		if($_GET["site"]!="dashboard") {
			if(count(SQLGetSiteRow($_GET["site"]))>0) {
				HTMLGetHead($_GET["site"]);
				$iSite=$_GET["site"];
			} else {
				HTMLGetHead($aSiteIDs[0]);
				$iSite=$aSiteIDs[0];
			}
		} else {
			include_once "bb-admin/bb-dashboard.php";
			DashboardGetHead();
		}
	}
?>
<body>
    <?php
		if(!SQLCheck()) {
			echo "<meta http-equiv=\"refresh\" content=\"0; URL=install.php\">";
		}
		if(isset($_GET["site"])&&$_GET["site"]=="dashboard") {
			if(isset($_GET["siteid"])) {
				HTMLGetDashboardMenu($_GET["siteid"]);
			}
			DashboardShow();
		} else {
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/header.php";
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/footer.php";
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/404.php";
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/blog.php";
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/login.php";
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/register.php";
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/contact.php";
			include_once "themes/".SQLGetSiteRow($iSite)["theme"]."/page.php";
			
			HTMLGetDashboardMenu($iSite);
			BBHeader($iSite);
			if(isset($_GET["page"])) {
				if($_GET["page"]=="blog") {
					if(function_exists("BBBlog")) {
						BBBlog();
					} else {
						BBError();
					}
				} else if($_GET["page"]=="login") {
					if(function_exists("BBLogin")) {
						if(isset($_GET["submit"])) {
							if(isset($_POST["email"])&&isset($_POST["password"])) {
								if(UserLogIn($_POST["email"],$_POST["password"],0)) {
									SessionSetUser($_POST["email"],$_POST["password"]);
									echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=".$_GET["site"]."\">";
								}
							}
						}
						BBLogin();
					} else {
						BBError();
					}
				} else if($_GET["page"]=="register") {
					if(function_exists("BBRegister")) {
						if(isset($_GET["submit"])) {
							if(isset($_POST["username"])&&isset($_POST["email"])&&isset($_POST["password"])) {
								$continue=true;
								if(isset($_POST["confirm_password"])) {
									if($_POST["password"]!=$_POST["confirm_password"]) {
										$continue=false;
									}
								}
								if($continue) {
									if(count(SQLGetUserRowByEmail($_POST["email"]))==0) {
										SQLAddUserRow($_POST["username"],$_POST["password"],$_POST["email"],0);
										echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=".$_GET["site"]."\">";
									}
								}
							}
						}
						BBRegister();
					} else {
						BBError();
					}
				} else if($_GET["page"]=="contact") {
					if(function_exists("BBContact")) {
						BBContact();
					} else {
						BBError();
					}
				} else {
					if(count(SQLGetPageRow($_GET["page"]))>0&&SQLGetPageRow($_GET["page"])["siteid"]==$iSite) {
						BBPage($_GET["page"]);
					} else {
						BBError();
					}
				}
			} else {
				BBPage(SQLGetSiteRow($iSite)["homepage"]);
			}
			BBFooter($iSite);
		}
    ?>
	<?php
	if(isset($iSite)) {
		if(SQLGetSiteRow($iSite)["res_mode"]==0) {
		?>
		<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<?php
		} else {
			echo "<script src=\"/res/jquery/jQuery.js\"></script>";
			echo "<script src=\"/res/popper/popper.js\"></script>";
			echo "<script src=\"/res/bootstrap/js/bootstrap.min.js\"></script>";
		}
	} else if(isset($_GET["siteid"])||$_GET["site"]=="dashboard") {
		if(SQLGetSiteRow(SQLGetSiteIDs()[0])["res_mode"]==0) {
		?>
			<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
			<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/js/bootstrap.min.js" integrity="sha384-h0AbiXch4ZDo7tp9hKZ4TsHbi047NrKGLO3SEJAg45jXxnGIfYzk4Si90RDIqNm1" crossorigin="anonymous"></script>
		<?php
		} else {
			echo "<script src=\"res/jquery/jQuery.js\"></script>";
			echo "<script src=\"res/popper/popper.js\"></script>";
			echo "<script src=\"res/bootstrap/js/bootstrap.min.js\"></script>";
		}
	}
	?>
</body>
</html>
