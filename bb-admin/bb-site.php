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
    
    function SiteChoser() {
        $user=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
    ?>
    <section class="fdb-block fdb-viewport" style="background-image: url(./fdb-imgs/bg_2.svg)">
        <div class="container justify-content-center align-items-center d-flex">
              <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <h1><i class="fa fa-tachometer" aria-hidden="true"></i> MaterialBlocks</h1>
                    <p class="text-h2">Dashboard and Control Center.</p>
                    <?php 
                    if($user["type"]==2) {
                        echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard&action=add\" class=\"btn btn-round\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> Add Site</a></p>"; 
                    }
                    ?>
                </div>
              </div>
        </div>
    </section>
    <?php
        $ids=SQLGetSiteIDs();
        for($i=1;$i<=SQLGetSiteRowCount();$i++) {
            $row=SQLGetSiteRow($ids[$i-1]);
        ?>
            <section class="fdb-block fdb-image-bg" style="background-image: url(./fdb-imgs/bg_0.svg);">
                <div class="container">
                      <div class="row justify-content-center">
                        <div class="col-12 col-md-10 col-lg-8 text-center">
                              <div class="fdb-box">
                                <div class="row justify-content-center">
                                      <div class="col-12 col-xl-8 text-center">
                                        <?php 
                                        echo "<h1>".$row["title"]."-".$row["description"]."</h1>";
                                        echo "<p class=\"text-h3 mt-4\"><a href=\"?site=dashboard&siteid=".$ids[$i-1]."\" class=\"btn btn-black btn-empty btn-round\">Open</a></p>";
                                        if($user["type"]==2) {
                                            echo "<p class=\"text-h3 mt-4\"><a href=\"?site=dashboard&delete=".$ids[$i-1]."\" class=\"btn btn-empty btn-round\">Delete</a></p>";
                                        }
                                        ?>
                                      </div>
                                </div>
                            </div>
                        </div>
                      </div>
                </div>
              </section>
        <?php
        }
    ?>
    <?php	
    }

    function SiteAdd() {
        if(isset($_GET["submit"])&&$_GET["submit"]=="site") {
            if(isset($_POST["title"])&&isset($_POST["desc"])&&isset($_POST["keys"])) SQLInstallSite($_POST["title"],$_POST["desc"],$_POST["keys"]);
            echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=dashboard\">";
        }
    ?>
    <section class="fdb-block fdb-viewport" style="background-image: url(./fdb-imgs/bg_2.svg)">
        <div class="container justify-content-center align-items-center d-flex">
              <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                      <h1><i class="fa fa-tachometer" aria-hidden="true"></i> MaterialBlocks</h1>
                      <p class="text-h2">Dashboard and Control Center.</p>
                    <?php echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard\" class=\"btn btn-round\"><i class=\"fa fa-home\" aria-hidden=\"true\"></i> Back</a></p>"; ?>
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
                                <h1>Add Site.</h1>
                                <p class="text-h3">Enter Site Information.</p>
                            </div>
                        </div>
                        <form action="?site=dashboard&action=add&submit=site" method="POST">
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
                                    <button class="btn" type="submit"><i class="fa fa-plus-circle" aria-hidden="true"></i> Add</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>    
    </section>
    <?php
    }
?>