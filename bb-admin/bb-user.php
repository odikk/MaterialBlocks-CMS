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
    
    function UserViewer() {
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
    <?php
        $ids=SQLGetUserIDs();
        $count=SQLGetUserRowCount();
        if(!isset($_GET["list"])) {
            $iFrom=1;
        } else {
            $iFrom=(6*($_GET["list"]-1))+1;
        }
        $iTo=$iFrom+5;
        if($count<$iTo) {
            $iTo=$count;
        }
        $iStep=0;
        for($i=$iFrom;$i<=$iTo;$i++) {
            $row=SQLGetUserRow($ids[$i-1]);
            if($iStep==0) {
            ?>
            <div class="container">
                <div class="row text-center">
                    <div class="col-12 col-md-8 m-auto col-lg-4">
              		    <div class="fdb-box">
            <?php
            } else {
            ?>
                    <div class="col-12 col-md-8 m-auto col-lg-4 pt-5 pt-lg-0">
                        <div class="fdb-box">
            <?php
            }
            echo "<h1><i class=\"fa fa-user-circle\" aria-hidden=\"true\"></i></h1>";
            echo "<h2>".$row["username"]."</h2>";
            echo "<h3>".$row["email"]."</h3>";
            if($row["type"]==0) {
                echo "<p><strong>Normal User</strong></p>";
            } else if($row["type"]==1) {
                echo "<p><strong>Editor</strong></p>";
            } else if($row["type"]==2) {
                echo "<p><strong>Administrator</strong></p>";
            }
            ?>
                        </div>
                    </div>
            <?php
            $iStep++;
            if($iStep==3||$i==$iTo) {
                $iStep=0;
            ?>
                </div>
            </div>
            <br/>
            <?php
            }
        }
        HTMLPageSwitcher($count,6);
    ?>
    </section>
    <?php	
    }
?>