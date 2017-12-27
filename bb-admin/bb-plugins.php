<?php
    /*
		MaterialBlocks - Froala design-blocks based CMS
	    Copyright (C) 2017  Robin Krause  Manuel Serret
	
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

    function PluginsInstall() {
        if(isset($_GET["submit"])) {
			if($_GET["submit"]=="data") {
				if(isset($_POST["name"])) {
                    SQLAddPluginsRowEx($_POST["name"],1);
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=dashboard&siteid=".$_GET["siteid"]."\">";
				}
			}
		}
    ?>
    <section class="fdb-block fdb-viewport" style="background-color: #242424; color: #EEE;">
        <div class="container justify-content-center align-items-center d-flex">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <h1><i class="fa fa-tachometer" aria-hidden="true"></i> MaterialBlocks</h1>
                    <p class="text-h2">Multiple Site Dashboard and Control Center.</p>
                    <?php 
                        if(isset($_GET["siteid"])) {
                            echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard&siteid=".$_GET["siteid"]."\" class=\"btn btn-empty btn-round\"><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i> Dashboard</a></p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class="fdb-block" style="background-color: #212121; color: #EEE;">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Install Plug-In:</h1>
                        </div>
                    </div>
                    <?php echo "<form action=\"?site=dashboard&siteid=".$iID."&action=add_plugin&submit=data\" method=\"POST\">"; ?>
                        <div class="row">
                            <div class="col mt-2">
                        		<label>Plug-In Name:</label>
                        		<input class="form-control" name="name" placeholder="Plug-In Name" type="text" required>
                            </div>
                        </div>
                        <div class="row ml-1 mt-2">
                            <p><i><strong>Plug-In Name</strong> represents the folder in /plug-ins/...!</i></p>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn btn-round btn-empty btn-white" type="submit"><i class="fa fa-plug"></i> Install Plug-In</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    }

    function PluginsEdit() {
        if(isset($_GET["plugin"])) {
            if(isset($_GET["active"])) {
                SQLSetPluginsRow($_GET["plugin"],$_GET["active"]);
            } else if(isset($_GET["delete"])) {
                SQLDeletePlugins($_GET["plugin"]);
            }
        }
    ?>
    <section class="fdb-block fdb-viewport" style="background-color: #242424; color: #EEE;">
        <div class="container justify-content-center align-items-center d-flex">
            <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <h1><i class="fa fa-tachometer" aria-hidden="true"></i> MaterialBlocks</h1>
                    <p class="text-h2">Multiple Site Dashboard and Control Center.</p>
                    <?php 
                        if(isset($_GET["siteid"])) {
                            echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard&siteid=".$_GET["siteid"]."\" class=\"btn btn-empty btn-round\"><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i> Dashboard</a></p>";
                        }
                    ?>
                </div>
            </div>
        </div>
    </section>
    <section class="fdb-block" style="background-color: #212121; color: #EEE;">
    <?php
        $ids=SQLGetPluginsIDs();
        $count=SQLGetPluginsRowCount();
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
            $row=SQLGetPluginsRow($ids[$i-1]);
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
            echo "<h1><i class=\"fa fa-plug\" aria-hidden=\"true\"></i></h1>";
            echo "<h2>".$row["name"]."</h2>";
            echo "<br/><p>";
            if($row["active"]==1) {
                echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_plugins&plugin=".$row["id"]."&active=1\" class=\"btn btn-round btn-black\" style=\"min-width: 40px;padding: 8px 6px;margin-left:10px;\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></a>";
                echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_plugins&plugin=".$row["id"]."&active=0\" class=\"btn btn-round btn-empty btn-black\" style=\"min-width: 40px;padding: 8px 6px;margin-left:10px;\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>";
            } else {
                echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_plugins&plugin=".$row["id"]."&active=1\" class=\"btn btn-round btn-empty btn-black\" style=\"min-width: 40px;padding: 8px 6px;margin-left:10px;\"><i class=\"fa fa-check\" aria-hidden=\"true\"></i></a>";
                echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_plugins&plugin=".$row["id"]."&active=0\" class=\"btn btn-round btn-black\" style=\"min-width: 40px;padding: 8px 6px;margin-left:10px;\"><i class=\"fa fa-times\" aria-hidden=\"true\"></i></a>";
            }
            echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_plugins&plugin=".$row["id"]."&delete=true\" class=\"btn btn-round btn-empty\" style=\"min-width: 40px;padding: 8px 6px;margin-left:10px;\"><i class=\"fa fa-trash\" aria-hidden=\"true\"></i></a>";
            echo "</p>";
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