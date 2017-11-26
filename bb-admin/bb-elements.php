<?php
    /*
		BeardBlock - Froala design-blocks based CMS
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

    function ElementsShow($iID) {
        if(isset($_GET["submit"])) {
            if($_GET["submit"]!="header"&&$_GET["submit"]!="footer") {
                $name_changes="";
                $href_changes="";
                foreach($_POST as $key=>$value) {
                    if(substr($key,0,4)=="name") {
                        $name_changes.=$value."|";
                    } else if(substr($key,0,4)=="href") {
                        $href_changes.=$value."|";
                    }
                }
                $name_changes=substr($name_changes,0,strlen($name_changes)-1);
                $href_changes=substr($href_changes,0,strlen($href_changes)-1);
                if($_GET["submit"]=="menu") {
                    SQLSetMenuRow($iID,$name_changes,$href_changes);
                } else if($_GET["submit"]=="social") {
                    SQLSetSocialRow($iID,$name_changes,$href_changes);
                }
            } else {
                $img_changes="";
                $text_changes="";
                $heading_changes="";
                $link_changes="";
                foreach($_POST as $key=>$value) {
                    if(substr($key,0,4)=="img_") {
                        $img_changes.=$value."|";
                    } else if(substr($key,0,4)=="txt_") {
                        $text_changes.=$value."|";
                    } else if(substr($key,0,2)=="h_") {
                        $heading_changes.=$value."|";
                    } else if(substr($key,0,5)=="link_") {
                        $link_changes.=$value."|";
                    }
                }
                $img_changes=substr($img_changes,0,strlen($img_changes)-1);
                $text_changes=substr($text_changes,0,strlen($text_changes)-1);
                $heading_changes=substr($heading_changes,0,strlen($heading_changes)-1);
                $link_changes=substr($link_changes,0,strlen($link_changes)-1);
                if($_GET["submit"]=="header") {
                    SQLSetBlockRow(SQLGetElementsRow($iID,1)["blockid"],$img_changes,$text_changes,$heading_changes,$link_changes,"header");
                } else if($_GET["submit"]=="footer") {
                    SQLSetBlockRow(SQLGetElementsRow($iID,2)["blockid"],$img_changes,$text_changes,$heading_changes,$link_changes,"footer");
                }
            }
        } else if(isset($_GET["add_menu_entry"])&&$_GET["add_menu_entry"]=="true") {
            $row=SQLGetMenuRow($iID);
            $name_changes=$row["link_names"]."|";
            $href_changes=$row["link_hrefs"]."|";
            SQLSetMenuRow($iID,$name_changes,$href_changes);
        } else if(isset($_GET["add_social_entry"])&&$_GET["add_social_entry"]=="true") {
            $row=SQLGetSocialRow($iID);
            $name_changes=$row["social_icons"]."|";
            $href_changes=$row["social_hrefs"]."|";
            SQLSetSocialRow($iID,$name_changes,$href_changes);
        } else if(isset($_GET["del_menu_entry"])) {
            $row=SQLGetMenuRow($iID);
            $elem=HTMLGetMenuElement($iID,$_GET["del_menu_entry"]);
            if(count(explode("|",$row["link_names"]))==1) {
                $name_changes="";
                $href_changes="";
            } else {
                $name_changes=str_replace("|".$elem[0],"",$row["link_names"]);
                $href_changes=str_replace("|".$elem[1],"",$row["link_hrefs"]);
            }
            SQLSetMenuRow($iID,$name_changes,$href_changes);
        } else if(isset($_GET["del_social_entry"])) {
            $row=SQLGetSocialRow($iID);
            $elem=HTMLGetSocialElement($iID,$_GET["del_social_entry"]);
            if(count(explode("|",$row["social_icons"]))==1) {
                $name_changes="";
                $href_changes="";
            } else {
                $name_changes=str_replace("|".$elem[0],"",$row["social_icons"]);
                $href_changes=str_replace("|".$elem[1],"",$row["social_hrefs"]);
            }
            SQLSetSocialRow($iID,$name_changes,$href_changes);
        }
    ?>
	<section class="fdb-block fdb-viewport" style="background-image: url(./fdb-imgs/bg_2.svg)">
        <div class="container justify-content-center align-items-center d-flex">
              <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <h1><i class="fa fa-tachometer" aria-hidden="true"></i> BeardBlock</h1>
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
    <section class="fdb-block" style="background-image: url(./fdb-imgs/alt_wide_1.svg)" id="header">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Header Block.</h1>
                            <p class="text-h3">Change the Header-Block Design.</p>
                        </div>
                    </div>
                    <?php
                    echo "<form action=\"?site=dashboard&siteid=".$iID."&action=elements&submit=header#header\" method=\"POST\">";
                    $params=BBHeader($iID,false);
                    $imgs=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,1)["blockid"])["imgs"]);
                    $texts=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,1)["blockid"])["texts"]);
                    $headings=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,1)["blockid"])["headings"]);
                    $links=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,1)["blockid"])["links"]);
                    ?>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[0];$i++) {
                        echo "<label>Image ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$imgs[$i]."\" name=\"img_".($i+1)."\" placeholder=\"Image ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[1];$i++) {
                        echo "<label>Text ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$texts[$i]."\" name=\"txt_".($i+1)."\" placeholder=\"Text ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[2];$i++) {
                        echo "<label>Heading ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$headings[$i]."\" name=\"h_".($i+1)."\" placeholder=\"Heading ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[3];$i++) {
                        echo "<label>Link ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$links[$i]."\" name=\"link_".($i+1)."\" placeholder=\"Link ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <button class="btn btn-round btn-empty" type="submit"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="fdb-block" style="background-image: url(./fdb-imgs/bg_c_3.svg)" id="footer">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Footer Block.</h1>
                            <p class="text-h3">Change the Footer-Block Design.</p>
                        </div>
                    </div>
                    <?php
                    echo "<form action=\"?site=dashboard&siteid=".$iID."&action=elements&submit=footer#footer\" method=\"POST\">";
                    $params=BBFooter($iID,false);
                    $imgs=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,2)["blockid"])["imgs"]);
                    $texts=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,2)["blockid"])["texts"]);
                    $headings=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,2)["blockid"])["headings"]);
                    $links=explode("|",SQLGetBlockRow(SQLGetElementsRow($iID,2)["blockid"])["links"]);
                    ?>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[0];$i++) {
                        echo "<label>Image ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$imgs[$i]."\" name=\"img_".($i+1)."\" placeholder=\"Image ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[1];$i++) {
                        echo "<label>Text ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$texts[$i]."\" name=\"txt_".($i+1)."\" placeholder=\"Text ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[2];$i++) {
                        echo "<label>Heading ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$headings[$i]."\" name=\"h_".($i+1)."\" placeholder=\"Heading ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                    <?php 
                    for($i=0;$i<$params[3];$i++) {
                        echo "<label>Link ".($i+1)."</label>";
                        echo "<input class=\"form-control\" value=\"".$links[$i]."\" name=\"link_".($i+1)."\" placeholder=\"Link ".($i+1)."\" type=\"text\">";
                    }
                    ?>
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <button class="btn btn-black btn-round btn-empty" type="submit"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <section class="fdb-block pb-0" style="background-image: url(./fdb-imgs/bg_3.svg)" id="menu">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-7">
                    <h1>Menu Entries.</h1>
                </div>
            </div>
            <div class="row-50">
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-9">
                    <?php
                    echo "<form action=\"?site=dashboard&siteid=".$iID."&action=elements&submit=menu#menu\" method=\"POST\">";
                    $counter=0;
                    while($aElem=HTMLGetMenuElement($iID,$counter)) {
                        echo "<div class=\"row mt-3\">";
                        echo "<div class=\"col-5\">";
                        echo "<input class=\"form-control\" placeholder=\"Menu Entry\" name=\"name-".$counter."\" value=\"".$aElem[0]."\" type=\"text\">";
                        echo "</div>";
                        echo "<div class=\"col-5\">";
                        echo "<input class=\"form-control\" placeholder=\"Menu Link\" name=\"href-".$counter."\" value=\"".$aElem[1]."\" type=\"text\">";
                        echo "</div>";
                        echo "<div class=\"col-2\">";
                        echo "<a href=\"?site=dashboard&siteid=".$iID."&action=elements&del_menu_entry=".$counter."#menu\" class=\"btn btn-round btn-empty\" style=\"min-width:5px;padding:9px 9px;\"><i class=\"fa fa-minus-circle\" aria-hidden=\"true\"></i></a>";
                        echo "</div>";
                        echo "</div>";
                        $counter++;
                    }
                    ?>
                        <div class="row mt-3">
                            <div class="col text-center">
                                <?php echo "<a href=\"?site=dashboard&siteid=".$iID."&action=elements&add_menu_entry=true#menu\" class=\"btn btn-round btn-empty\" style=\"min-width:5px;padding:9px 9px;\"><i class=\"fa fa-plus-circle\"></i></a>"; ?> 
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-black btn-round btn-empty"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row-100"></div>
        </div>
    </section>
    <section class="fdb-block pb-0" style="background-image: url(./fdb-imgs/bg_3.svg)" id="social">
        <div class="container">
            <div class="row text-center justify-content-center">
                <div class="col-12 col-md-8 col-lg-7">
                    <h1>Social Media.</h1>
                </div>
            </div>
            <div class="row-50">
            </div>
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 col-lg-9">
                    <?php
                    echo "<form action=\"?site=dashboard&siteid=".$iID."&action=elements&submit=social#social\" method=\"POST\">";
                    $counter=0;
                    while($aElem=HTMLGetSocialElement($iID,$counter)) {
                        echo "<div class=\"row mt-3\">";
                        echo "<div class=\"col-5\">";
                        echo "<input class=\"form-control\" placeholder=\"Social Icon\" name=\"name-".$counter."\" value=\"".htmlspecialchars($aElem[0])."\" type=\"text\">";
                        echo "</div>";
                        echo "<div class=\"col-5\">";
                        echo "<input class=\"form-control\" placeholder=\"Social Link\" name=\"href-".$counter."\" value=\"".$aElem[1]."\" type=\"text\">";
                        echo "</div>";
                        echo "<div class=\"col-2\">";
                        echo "<a href=\"?site=dashboard&siteid=".$iID."&action=elements&del_social_entry=".$counter."#social\" class=\"btn btn-round btn-empty\" style=\"min-width:5px;padding:9px 9px;\"><i class=\"fa fa-minus-circle\" aria-hidden=\"true\"></i></a>";
                        echo "</div>";
                        echo "</div>";
                        $counter++;
                    }
                    ?>
                        <div class="row mt-3">
                            <div class="col text-center">
                                <?php echo "<a href=\"?site=dashboard&siteid=".$iID."&action=elements&add_social_entry=true#social\" class=\"btn btn-round btn-empty\" style=\"min-width:5px;padding:9px 9px;\"><i class=\"fa fa-plus-circle\"></i></a>"; ?> 
                            </div>
                        </div>
                        <div class="row mt-5">
                            <div class="col">
                                <button type="submit" class="btn btn-black btn-round btn-empty"><i class="fa fa-save"></i> Save</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="row-100"></div>
        </div>
    </section>
	<?php
    }
?>