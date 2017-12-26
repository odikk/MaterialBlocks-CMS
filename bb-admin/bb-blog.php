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

    function BlogAddPost($iID) {
        if(isset($_GET["submit"])) {
            if($_GET["submit"]=="post") {
                if(isset($_POST["title"])&&isset($_POST["img"])&&isset($_POST["message"])) {
                    SQLAddPostRow($_POST["title"],$_POST["message"],$_POST["img"],UserGetIDFromSession());
                    $post_id=SQLGetPostIDsUnordered()[SQLGetPostRowCount()-1];
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=dashboard&siteid=".$iID."&action=edit_post&post=".$post_id."\">";
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
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-7">
                    <h1>Add Post</h1>
                    <h3>Click on <i class="fa fa-pencil"></i>Publish to continue!</h3>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <?php echo "<form action=\"?site=dashboard&siteid=".$iID."&action=add_post&submit=post\" method=\"POST\">"; ?>
                        <div class="row mt-4">
                            <div class="col">
                                <input class="form-control" name="title" placeholder="Post Title" type="text" required>
                            </div>
                            <div class="col">
                                <input class="form-control" name="img" placeholder="Post Image" type="text" required>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <textarea class="form-control" name="message" rows="13" placeholder="Post Content"></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-empty btn-round"><i class="fa fa-pencil"></i> Publish</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    }

    function BlogViewPosts($iID) {
        $user=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
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
        $ids=SQLGetPostIDs();
        $count=SQLGetPostRowCount();
        if($count>0) {
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
                $row=SQLGetPostRow($ids[$i-1]);
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
                echo "<img alt=\"image\" class=\"img-fluid\" src=\"".$row["img"]."\">";
                echo "<h2>".$row["title"]."</h2>";
                echo "<h3>".date("d.m.Y",strtotime($row["date"]))."</h3><br/>";
                echo "<a href=\"?site=dashboard&siteid=".$iID."&action=edit_post&post=".$row["id"]."\" class=\"btn btn-round btn-empty\" style=\"min-width: 30px;\"><i class=\"fa fa-pencil\"></i></a>";
                if($user["type"]==2) {
                    echo "<a href=\"?site=dashboard&siteid=".$iID."&action=del_post&post=".$row["id"]."\" class=\"btn btn-round btn-empty\" style=\"min-width: 30px;\"><i class=\"fa fa-minus-circle\"></i></a>";
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
        } else {
        ?>
            <div class="container">
                <div class="row text-center">
                    <h1>Nothing to show! :(</h1>   
                </div>
            </div>
        <?php
        }
    ?>
    </section>
    <?php
    }

    function BlogDeletePost($iID,$iPostID) {
        SQLDeletePost($iPostID);
    }

    function BlogEditPost($iID,$iPostID) {
        if(isset($_GET["submit"])) {
            if($_GET["submit"]=="post") {
                if(isset($_POST["title"])&&isset($_POST["img"])&&isset($_POST["message"])) {
                    SQLSetPostRow($iPostID,$_POST["title"],$_POST["message"],$_POST["img"]);
                    echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=dashboard&siteid=".$iID."&action=edit_post&post=".$iPostID."\">";
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
                            echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard&siteid=".$_GET["siteid"]."&action=view_posts\" class=\"btn btn-empty btn-round\"><i class=\"fa fa-angle-left\" aria-hidden=\"true\"></i> View Posts</a>";
                            echo "<a href=\"index.php?site=".$_GET["siteid"]."&page=blog&post=".$iPostID."\" class=\"btn btn-white btn-round\"><i class=\"fa fa-code\" aria-hidden=\"true\"></i> View Post</a></p>";
                        }
                    ?>
                </div>
              </div>
        </div>
    </section>
    <section class="fdb-block" style="background-color: #212121; color: #EEE;">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-7">
                    <h1>Edit Post</h1>
                    <h3>Click on <i class="fa fa-chain"></i>Update to continue!</h3>
                </div>
            </div>
            <div class="row pt-4">
                <div class="col-12">
                    <?php 
                    echo "<form action=\"?site=dashboard&siteid=".$iID."&action=edit_post&post=".$iPostID."&submit=post\" method=\"POST\">"; 
                    $row=SQLGetPostRow($iPostID);
                    ?>
                        <div class="row mt-4">
                            <div class="col">
                                <?php echo "<input class=\"form-control\" value=\"".$row["title"]."\" name=\"title\" placeholder=\"Post Title\" type=\"text\" required>"; ?>
                            </div>
                            <div class="col">
                                <?php echo "<input class=\"form-control\" value=\"".$row["img"]."\" name=\"img\" placeholder=\"Post Image\" type=\"text\" required>"; ?>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <textarea class="form-control" name="message" rows="13" placeholder="Post Content"><?php echo $row["content"] ?></textarea>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col text-center">
                                <button type="submit" class="btn btn-empty btn-round"><i class="fa fa-chain"></i> Update</button>
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