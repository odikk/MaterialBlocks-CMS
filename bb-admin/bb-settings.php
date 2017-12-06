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

    function SettingsShow($iID) {
        $row=SQLGetSiteRow($iID);
        if(isset($_GET["submit"])&&isset($_GET["siteid"])) {
            if($_GET["submit"]=="config") {
                if(isset($_POST["title"])&&isset($_POST["desc"])) {
                    SQLSetSiteRow($_GET["siteid"],$_POST["title"],$_POST["desc"],$_POST["keys"],$row["font_url"],$row["theme"]);
                }
                if(isset($_POST["ressource"])) {
                    SQLSetSiteRowEx($_GET["siteid"],1);
                } else {
                    SQLSetSiteRowEx($_GET["siteid"],0);
                }
            } else if($_GET["submit"]=="design") {
                if(isset($_POST["font"])&&isset($_POST["theme"])) {
                    SQLSetSiteRow($_GET["siteid"],$row["title"],$row["description"],$row["keywords"],$_POST["font"],$_POST["theme"]);
                }
            }
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=dashboard&siteid=".$_GET["siteid"]."&action=settings"."\">";
        }
    ?>
    <section class="fdb-block fdb-viewport" style="background-image: url(./fdb-imgs/bg_2.svg)">
        <div class="container justify-content-center align-items-center d-flex">
              <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <h1><i class="fa fa-tachometer" aria-hidden="true"></i> MaterialBlocks</h1>
                    <p class="text-h2">Dashboard and Control Center.</p>
                    <?php 
                        if(isset($_GET["siteid"])) {
                            echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard&siteid=".$_GET["siteid"]."\" class=\"btn btn-round\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Dashboard</a></p>"; 
                        }
                    ?>
                </div>
              </div>
        </div>
    </section>
    <section class="fdb-block" style="background-image: url(./fdb-imgs/bg_0.svg)">
        <div class="container">
            <div class="row justify-content-end">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5 text-left">
                    <div class="fdb-box">
                        <div class="row">
                            <div class="col">
                                <h1>Config.</h1>
                                <p class="text-h3">Edit Site Information.</p>
                            </div>
                        </div>
                        <?php
                        if(isset($_GET["siteid"])) {
                            echo "<form action=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=settings&submit=config\" method=\"POST\">";
                        }
                        ?>
                            <div class="row">
                                <div class="col mt-1">
                                    <?php echo "<input class=\"form-control\" name=\"title\" value=\"".$row["title"]."\" placeholder=\"Site Title\" type=\"text\" required>"; ?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col mt-4">
                                <?php echo "<input class=\"form-control\" name=\"desc\" value=\"".$row["description"]."\" placeholder=\"Site Description\" type=\"text\" required>"; ?>
                                </div>
                            </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <?php echo "<textarea class=\"form-control\" name=\"keys\" rows=\"3\" placeholder=\"Site Keywords\">".$row["keywords"]."</textarea>"; ?>
                                </div>
                            </div>
                            <div class="row justify-content-start mt-3">
							    <div class="col">
								    <div class="form-check">
                                        <?php 
                                        if($row["res_mode"]==0) {
                                            echo "<label class=\"form-check-label\"><input class=\"form-check-input\" name=\"ressource\" value=\"true\" type=\"checkbox\"> Use Offline ressources</label>";
                                        } else {
                                            echo "<label class=\"form-check-label\"><input class=\"form-check-input\" name=\"ressource\" value=\"true\" type=\"checkbox\" checked> Use Offline ressources</label>";
                                        }
                                        ?>
								    </div>
                                </div>
						    </div>
                            <div class="row mt-4">
                                <div class="col">
                                    <button class="btn" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <section class="fdb-block" style="background-image: url(./fdb-imgs/bg_3.svg)">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Design.</h1>
                            <p class="text-h3">Change the basic font or the used Theme.</p>
                            <p class="text-h3"><strong>Important: Themes must be installed under ./themes/theme_name!</strong></p>
                        </div>
                    </div>
                    <?php
                    if(isset($_GET["siteid"])) {
                        echo "<form action=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=settings&submit=design\" method=\"POST\">";
                    }
                    ?>
                        <div class="row">
                            <div class="col mt-4">
                                <?php echo "<input class=\"form-control\" name=\"font\" value=\"".$row["font_url"]."\" placeholder=\"Font URL\" type=\"text\" required>"; ?>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <?php echo "<input class=\"form-control\" name=\"theme\" value=\"".$row["theme"]."\" placeholder=\"Theme\" type=\"text\" required>"; ?>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn" type="submit"><i class="fa fa-save" aria-hidden="true"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    }
?>