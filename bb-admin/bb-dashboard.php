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
	include_once "bb-site.php";
	include_once "bb-login.php";
	include_once "bb-user.php";
	include_once "bb-settings.php";
	include_once "bb-elements.php";
	include_once "bb-blog.php";
	include_once "bb-page.php";
	include_once "bb-plugins.php";

	function DashboardGetHead() {
	?>
	<head>
    	<title>Dashboard</title>
    	<meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
    	<link rel="stylesheet" href="./res/bootstrap/css/bootstrap.min.css">
    	<link href="https://fonts.googleapis.com/css?family=Roboto:300" rel="stylesheet">
    	<link rel="stylesheet" href="./res/font-awesome/css/font-awesome.min.css">
    	<link type="text/css" rel="stylesheet" href="./themes/default/default.css">
	</head>
	<?php
	}

	function DashboardMain($iID) {
		$row=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
		$site=SQLGetSiteRow($iID);
	?>
	<section class="fdb-block fdb-viewport" style="background-color: #242424; color: #EEE;">
        <div class="container justify-content-center align-items-center d-flex">
              <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <h1><i class="fa fa-tachometer" aria-hidden="true"></i> MaterialBlocks</h1>
                    <p class="text-h2">Multiple Site Dashboard and Control Center.</p>
					<?php echo "<p class=\"text-h3\">You are editing: <strong>".$site["title"]."-".$site["description"]."</strong></p>"; ?>
					<br/>
					<?php echo "<p class=\"text-h3\"><a href=\"index.php?site=".$iID."\" class=\"btn btn-empty btn-round\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> View Site</a>"; ?>
					<?php echo "<a href=\"index.php?site=dashboard\" class=\"btn btn-round\"><i class=\"fa fa-list\" aria-hidden=\"true\"></i> Show Sites</a></p>"; ?>
        		</div>
      		</div>
    	</div>
  	</section>
	<?php
		if($row["type"]==2) {
	?>
	<section class="fdb-block" style="background-color: #212121; color: #EEE;">
    	<div class="container">
			<div class="row">
				<h2>Pages:</h2>
			</div>
      		<div class="row text-center">
        		<div class="col-12 col-md-8 m-auto col-lg-4">
          			<div class="fdb-box">
            			<h2><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Page</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=add_page\" class=\"btn btn-empty btn-round\">Add Page</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
					  	<h2><i class="fa fa-columns" aria-hidden="true"></i> View Pages</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=view_pages\" class=\"btn btn-empty btn-round\">View Pages</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
					  	<h2><i class="fa fa-plus-circle" aria-hidden="true"></i> Add PHPPage</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=add_custom_page\" class=\"btn btn-empty btn-round\">Add Custom</a></p>";
						}
						?>
          			</div>
        		</div>
      		</div>
    	</div>
		<br/>
		<div class="container">
			<div class="row">
				<h2>Community:</h2>
			</div>
      		<div class="row text-center">
        		<div class="col-12 col-md-8 m-auto col-lg-4">
          			<div class="fdb-box">
            			<h2><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Post</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=add_post\" class=\"btn btn-empty btn-round\">Add Post</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
					  	<h2><i class="fa fa-columns" aria-hidden="true"></i> View Posts</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=view_posts\" class=\"btn btn-empty btn-round\">View Posts</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
					  	<h2><i class="fa fa-users" aria-hidden="true"></i> View Users</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) { 
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=view_users\" class=\"btn btn-empty btn-round\">View Users</a></p>";
						}
						?>
          			</div>
        		</div>
      		</div>
    	</div>
		<br/>
		<div class="container">
			<div class="row">
				<h2>Settings:</h2>
			</div>
      		<div class="row text-center">
			  	<div class="col-12 col-md-8 m-auto col-lg-4">
          			<div class="fdb-box">
            			<h2><i class="fa fa-pencil" aria-hidden="true"></i> Edit Elements</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=elements\" class=\"btn btn-empty btn-round\">Edit Elements</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
            			<h2><i class="fa fa-cog" aria-hidden="true"></i> Settings</h2>
						<br/>
            			<?php
						if(isset($_GET["siteid"])) { 
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=settings\" class=\"btn btn-empty btn-round\">Settings</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box" style="background-color: #F44336; color: #eee;">
					  	<h2><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</h2>
						<br/>
						<?php 
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=logout\" class=\"btn btn-empty btn-white btn-round\">Log Out</a></p>";
						}
						?>
          			</div>
        		</div>
      		</div>
    	</div>
  	</section>
	<?php
		} else {
	?>
	<section class="fdb-block" style="background-color: #212121; color: #EEE;">
    	<div class="container">
			<div class="row">
				<h2>Pages:</h2>
			</div>
      		<div class="row text-center">
        		<div class="col-12 col-md-8 m-auto col-lg-4">
          			<div class="fdb-box">
            			<h2><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Page</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=add_page\" class=\"btn btn-empty btn-round\">Add Page</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
					  	<h2><i class="fa fa-columns" aria-hidden="true"></i> View Pages</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=view_pages\" class=\"btn btn-empty btn-round\">View Pages</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
					  	<h2><i class="fa fa-plus-circle" aria-hidden="true"></i> Add PHPPage</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=add_custom_page\" class=\"btn btn-empty btn-round\">Add Custom</a></p>";
						}
						?>
          			</div>
        		</div>
      		</div>
    	</div>
		<br/>
		<div class="container">
			<div class="row">
				<h2>Community:</h2>
			</div>
      		<div class="row text-center">
        		<div class="col-12 col-md-8 m-auto col-lg-4">
          			<div class="fdb-box">
            			<h2><i class="fa fa-plus-circle" aria-hidden="true"></i> Add Post</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=add_post\" class=\"btn btn-empty btn-round\">Add Post</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box">
					  	<h2><i class="fa fa-columns" aria-hidden="true"></i> View Posts</h2>
						<br/>
						<?php
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=view_posts\" class=\"btn btn-empty btn-round\">View Posts</a></p>";
						}
						?>
          			</div>
        		</div>
        		<div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
          			<div class="fdb-box" style="background-color: #F44336; color: #eee;">
					  	<h2><i class="fa fa-sign-out" aria-hidden="true"></i> Log Out</h2>
						<br/>
						<?php 
						if(isset($_GET["siteid"])) {
							echo "<p><a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=logout\" class=\"btn btn-empty btn-white btn-round\">Log Out</a></p>";
						}
						?>
          			</div>
        		</div>
      		</div>
    	</div>
  	</section>
	<?php
		}
	}

	function DashboardFooter() { //Plug-In Area
		$row=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
		if($row["type"]==2) {
		?>
		<section class="fdb-block" style="background-color: #181818; color: #EEE;">
			<div class="container">
				<div class="row">
					<h2>Plug-Ins:</h2>
				</div>
				<div class="row">
					<?php echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=add_plugin\" class=\"btn btn-empty btn-white btn-round\"><i class=\"fa fa-plug\" aria-hidden=\"true\"></i> Install</a>"; ?>
					<?php echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_plugins\" class=\"btn btn-round\"><i class=\"fa fa-pencil\" aria-hidden=\"true\"></i> Edit</a>"; ?>
				</div>
				<div class="row mt-5">
					<p><i>The following elements are Plug-In generated!</i></p>
				</div>
			</div>
		</section>
		<?php
		$count=SQLGetPluginsRowCount();
		for($i=0;$i<$count;$i++) {
			$row=SQLGetPluginsRow(SQLGetPluginsIDs()[$i]);
			if($row["active"]==1) {
				include "plug-ins/".$row["name"]."/".$row["name"].".php";

				if(($i+1)%2==1) {
				?>
				<section class="fdb-block" style="background-color: #212121; color: #EEE;">
				<?php
				} else {
				?>
				<section class="fdb-block" style="background-color: #181818; color: #EEE;">
				<?php
				}
				if(function_exists($row["name"])) {
					call_user_func($row["name"]);
				} else {
					echo "<div class=\"container justify-content-center\">";
					echo "<h2>Plug-In Error: Main-Function(".$row["name"]."()) is missing/or can't be called!</h2>";
					echo "</div>";
				}
				?>
				</section>
				<?php
			}
		}
		?>
		<?php
		}
	}

	function DashboardShow() {
		if(UserIsSessionValid(1)) {
			$row=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
			if(isset($_GET["siteid"])&&isset($_GET["action"])) {
				if($_GET["action"]=="logout") {
					SessionDestroyUser();
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=dashboard\">";
				} else if($_GET["action"]=="view_users") {
					if($row["type"]==2) {
						UserViewer();
					}
				} else if($_GET["action"]=="edit_user") {
					if($row["type"]==2) {
						UserEdit();
					}
				} else if($_GET["action"]=="settings") {
					if($row["type"]==2) {
						SettingsShow($_GET["siteid"]);
					}
				} else if($_GET["action"]=="elements") {
					if($row["type"]==2) {
						include("themes/".SQLGetSiteRow($_GET["siteid"])["theme"]."/header.php");
						include("themes/".SQLGetSiteRow($_GET["siteid"])["theme"]."/footer.php");
						ElementsShow($_GET["siteid"]);
					}
				} else if($_GET["action"]=="add_post") {
					BlogAddPost($_GET["siteid"]);
				} else if($_GET["action"]=="view_posts") {
					BlogViewPosts($_GET["siteid"]);
				} else if($_GET["action"]=="edit_post") {
					if(isset($_GET["post"])) {
						BlogEditPost($_GET["siteid"],$_GET["post"]);
					}
				} else if($_GET["action"]=="del_post") {
					if(isset($_GET["post"])) {
						if($row["type"]==2) {
							BlogDeletePost($_GET["siteid"],$_GET["post"]);
							echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=dashboard&siteid=".$_GET["siteid"]."&action=view_posts\">";
						}
					}
				} else if($_GET["action"]=="add_page") {
					PageAddPage($_GET["siteid"]);
				} else if($_GET["action"]=="view_pages") {
					PageViewPages($_GET["siteid"]);
				} else if($_GET["action"]=="edit_page") {
					if(isset($_GET["page"])) {
						include("themes/".SQLGetSiteRow($_GET["siteid"])["theme"]."/page.php");
						PageEditPage($_GET["siteid"],$_GET["page"]);
					}
				} else if($_GET["action"]=="del_page") {
					if(isset($_GET["page"])) {
						if($row["type"]==2) {
							PageDeletePage($_GET["siteid"],$_GET["page"]);
							echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=dashboard&siteid=".$_GET["siteid"]."&action=view_pages\">";
						}
					}
				} else if($_GET["action"]=="add_custom_page") {
					PageAddCustomPage($_GET["siteid"]);
				} else if($_GET["action"]=="edit_custom_page") {
					if(isset($_GET["page"])) {
						PageEditCustomPage($_GET["siteid"],$_GET["page"]);
					}
				} else if($_GET["action"]=="add_plugin") {
					PluginsInstall();
				} else if($_GET["action"]=="edit_plugins") {
					PluginsEdit();
				}
			} else if(isset($_GET["siteid"])&&!isset($_GET["action"])) {
				DashboardMain($_GET["siteid"]);
			} else {
				if(isset($_GET["action"])&&$_GET["action"]=="add") {
					if($row["type"]==2) {
						SiteAdd();
					}
				} else if(!isset($_GET["action"])) {
					if(isset($_GET["delete"])) {
						if($row["type"]==2) {
							SQLDeleteSite($_GET["delete"]);
							echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=dashboard\">";
						}
					}
					SiteChoser();
				}
			}
			DashboardFooter();
		} else {
			if(isset($_GET["action"])&&$_GET["action"]=="login") {
				if(isset($_POST["email"])&&isset($_POST["password"])) {
					if(UserLogIn($_POST["email"],$_POST["password"],1)) {
						SessionSetUser($_POST["email"],$_POST["password"]);
						echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=dashboard\">";
					} else {
						echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=dashboard\">";
					}
				}
			}
			LoginForm();
		}
	}
?>