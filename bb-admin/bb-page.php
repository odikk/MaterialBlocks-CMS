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

    function PageAddPage($iID) {
		if(isset($_GET["submit"])) {
			if($_GET["submit"]=="data") {
				if(isset($_POST["title"])&&$_POST["title"]!="Home") {
					SQLAddPageRow($iID,$_POST["title"],"");
					if(isset($_POST["add"])&&$_POST["add"]=="true") {
						$page_id=SQLGetPageIDs()[SQLGetPageRowCount()-1];
						$row=SQLGetMenuRow($iID);
						$name_changes=$row["link_names"]."|".$_POST["title"];
						$href_changes=$row["link_hrefs"]."|?site=".$iID."&page=".$page_id;
						SQLSetMenuRow($iID,$name_changes,$href_changes);
                    }
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=dashboard&siteid=".$iID."&action=view_pages\">";
				}
			}
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
	<section class="fdb-block" style="background-image: url(./fdb-imgs/bg_c_3.svg)">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Page Information.</h1>
							<p class="text-h3">Adds an Empty-Page-Structure to your database.</p>
                        </div>
                    </div>
                    <?php echo "<form action=\"?site=dashboard&siteid=".$iID."&action=add_page&submit=data\" method=\"POST\">"; ?>
                        <div class="row">
                            <div class="col mt-2">
                        		<label>Page Title:</label>
                        		<input class="form-control" name="title" placeholder="Page Title" type="text" required>
                            </div>
                        </div>
						<div class="row justify-content-start mt-3">
							<div class="col">
								<div class="form-check">
									<label class="form-check-label"><input class="form-check-input" name="add" value="true" type="checkbox"> Add to Site-Menu</label>
								</div>
                            </div>
						</div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn btn-black btn-round btn-empty" type="submit"><i class="fa fa-plus-circle"></i> Add Page</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    }

    function PageAddCustomPage($iID) {
		if(isset($_GET["submit"])) {
			if($_GET["submit"]=="data") {
				if(isset($_POST["title"])&&isset($_POST["custom"])&&$_POST["title"]!="Home") {
					SQLAddPageRowEx($iID,$_POST["title"],1,$_POST["custom"],"");
					if(isset($_POST["add"])&&$_POST["add"]=="true") {
						$page_id=SQLGetPageIDs()[SQLGetPageRowCount()-1];
						$row=SQLGetMenuRow($iID);
						$name_changes=$row["link_names"]."|".$_POST["title"];
						$href_changes=$row["link_hrefs"]."|?site=".$iID."&page=".$page_id;
						SQLSetMenuRow($iID,$name_changes,$href_changes);
                    }
					echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=dashboard&siteid=".$iID."&action=view_pages\">";
				}
			}
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
	<section class="fdb-block" style="background-image: url(./fdb-imgs/bg_c_3.svg)">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Custom Page Information.</h1>
                        </div>
                    </div>
                    <?php echo "<form action=\"?site=dashboard&siteid=".$iID."&action=add_custom_page&submit=data\" method=\"POST\">"; ?>
                        <div class="row">
                            <div class="col mt-2">
                        		<label>Page Title:</label>
                        		<input class="form-control" name="title" placeholder="Page Title" type="text" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                        		<label>Custom PHP-Function:</label>
                        		<input class="form-control" name="custom" placeholder="e.g. Shop or Forum" type="text" required>
                            </div>
                        </div>
						<div class="row justify-content-start mt-3">
							<div class="col">
								<div class="form-check">
									<label class="form-check-label"><input class="form-check-input" name="add" value="true" type="checkbox"> Add to Site-Menu</label>
								</div>
                            </div>
						</div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn btn-black btn-round btn-empty" type="submit"><i class="fa fa-plus-circle"></i> Add Custom Page</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
    }

    function PageViewPages($iID) {
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
    <section class="fdb-block bg-dark" style="background-image: url(./fdb-imgs/bg_0.svg)">
    <?php
        $ids=SQLGetPageIDs();
        $count=SQLGetPageRowCount();
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
                $row=SQLGetPageRow($ids[$i-1]);
                if($row["siteid"]==$iID) {
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
                    echo "<h2>".$row["title"]."</h2>";
                    if($row["type"]==0) {
                        echo "<a href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$row["id"]."\" class=\"btn btn-round btn-empty\" style=\"min-width: 30px;\"><i class=\"fa fa-pencil\"></i></a>";
                    } else {
                        echo "<a href=\"?site=dashboard&siteid=".$iID."&action=edit_custom_page&page=".$row["id"]."\" class=\"btn btn-round btn-empty\" style=\"min-width: 30px;\"><i class=\"fa fa-pencil\"></i></a>";
                    }
                    if($row["title"]!="Home") {
                        echo "<a href=\"?site=dashboard&siteid=".$iID."&action=del_page&page=".$row["id"]."\" class=\"btn btn-round btn-empty\" style=\"min-width: 30px;\"><i class=\"fa fa-minus-circle\"></i></a>";
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
            }
            HTMLPageSwitcher($count,6);
        } else {
        ?>
            <div class="container">
                <div class="row text-center">
                    <h1>:( Nothing to show!</h1>    
                </div>
            </div>
        <?php
        }
    ?>
    </section>
    <?php
    }

    function PageDeletePage($iID,$iPageID) {
        SQLDeletePage($iPageID);
        echo "<meta http-equiv=\"refresh\" content=\"0; URL=?site=dashboard&siteid=".$iID."&action=view_pages\">";
    }

    function PageShowPreview($iPageID) {
        $row=SQLGetPageRow($iPageID);
		if($row["blockids"]!="") {
            echo "<section class=\"fdb-block bg-gray\" id=\"preview\">";
			echo "<div class=\"container\">";
			echo "<div class=\"row justify-content-center\">";
			echo "<h1>Page Preview:</h1>";
			echo "</div>";
			echo "</div>";
            echo "</section>";
			$blockids=explode("|",$row["blockids"]);
			for($i=0;$i<count($blockids);$i++) {
                $block=SQLGetBlockRow($blockids[$i]);
                $params=call_user_func($block["type"],"","","","",false);
                $imgs=explode("|",$block["imgs"]);
                $texts=explode("|",$block["texts"]);
                $headings=explode("|",$block["headings"]);
                $links=explode("|",$block["links"]);
                if($block["imgs"]==""&&$block["texts"]==""&&$block["headings"]==""&&$block["links"]=="") {
                    $img_out="";
                    $text_out="";
                    $heading_out="";
                    $link_out="";
                    for($j=0;$j<$params[0];$j++) {
                        if($j<count($imgs)-1) {
                            $img_out.=$imgs[$j]."|";
                        } else {
                            $img_out.="Image".($j+1)."|";
                        }
                    }
                    for($j=0;$j<$params[1];$j++) {
                        if($j<count($texts)-1) {
                            $text_out.=$texts[$j]."|";
                        } else {
                            $text_out.="Text".($j+1)."|";
                        }
                    }
                    for($j=0;$j<$params[2];$j++) {
                        if($j<count($headings)-1) {
                            $heading_out.=$headings[$j]."|";
                        } else {
                            $heading_out.="Heading".($j+1)."|";
                        }
                    }
                    for($j=0;$j<$params[3];$j++) {
                        if($j<count($links)-1) {
                            $link_out.=$links[$j]."|";
                        } else {
                            $link_out.="Link".($j+1)."|";
                        }
                    }
                    call_user_func($block["type"],$img_out,$text_out,$heading_out,$link_out);
                } else {
                    call_user_func($block["type"],$block["imgs"],$block["texts"],$block["headings"],$block["links"]);
                }
            ?>
            <?php echo "<section class=\"fdb-block pt-0\" style=\"background-image: url(./fdb-imgs/bg_c_3.svg)\" id=\"block_".$i."\">"; ?>
                <div class="container">
                    <div class="row text-center justify-content-center pt-5">
                        <div class="col-12 col-md-7">
                            <h1>Edit Block Options.</h1>
                        </div>
                    </div>
                    <div class="row justify-content-center pt-4">
                        <div class="col-12 col-md-7">
                            <?php
                            echo "<form action=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_page&page=".$iPageID."&block=".$blockids[$i]."&submit=block_data#block_".$i."\" method=\"POST\">";
                            for($j=0;$j<$params[0];$j++) {
                                echo "<div class=\"row mt-4\">";
                                echo "<div class=\"col\">";
                                if($j<count($imgs)) {
                                    echo "<input class=\"form-control\" value=\"".$imgs[$j]."\" name=\"img_".($j+1)."\" placeholder=\"Image".($j+1)."\" type=\"text\">";
                                } else {
                                    echo "<input class=\"form-control\" name=\"img_".($j+1)."\" placeholder=\"Image".($j+1)."\" type=\"text\">";
                                }
                                echo "</div>";
                                echo "</div>";
                            }
                            for($j=0;$j<$params[1];$j++) {
                                echo "<div class=\"row mt-4\">";
                                echo "<div class=\"col\">";
                                if($j<count($texts)) {
                                    echo "<input class=\"form-control\" value=\"".$texts[$j]."\" name=\"txt_".($j+1)."\" placeholder=\"Text".($j+1)."\" type=\"text\">";
                                } else {
                                    echo "<input class=\"form-control\" name=\"txt_".($j+1)."\" placeholder=\"Text".($j+1)."\" type=\"text\">";
                                }
                                echo "</div>";
                                echo "</div>";
                            }
                            for($j=0;$j<$params[2];$j++) {
                                echo "<div class=\"row mt-4\">";
                                echo "<div class=\"col\">";
                                if($j<count($headings)) {
                                    echo "<input class=\"form-control\" value=\"".$headings[$j]."\" name=\"h_".($j+1)."\" placeholder=\"Heading".($j+1)."\" type=\"text\">";
                                } else {
                                    echo "<input class=\"form-control\" name=\"h_".($j+1)."\" placeholder=\"Heading".($j+1)."\" type=\"text\">";
                                }
                                echo "</div>";
                                echo "</div>";
                            }
                            for($j=0;$j<$params[3];$j++) {
                                echo "<div class=\"row mt-4\">";
                                echo "<div class=\"col\">";
                                if($j<count($links)) {
                                    echo "<input class=\"form-control\" value=\"".$links[$j]."\" name=\"link_".($j+1)."\" placeholder=\"Link".($j+1)."\" type=\"text\">";
                                } else {
                                    echo "<input class=\"form-control\" name=\"link_".($j+1)."\" placeholder=\"Link".($j+1)."\" type=\"text\">";
                                }
                                echo "</div>";
                                echo "</div>";
                            }
                            ?>
                                <div class="row mt-5">
                                    <div class="col text-center">
                                        <button type="submit" class="btn btn-round btn-empty"><i class="fa fa-check-circle"></i> Save</button>
                                        <?php echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=edit_page&page=".$iPageID."&block=".$blockids[$i]."&del_block=true#preview\" class=\"btn btn-round btn-empty\"><i class=\"fa fa-minus-circle\"></i> Delete</a>"; ?>
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
		} else {
			echo "<section class=\"fdb-block\" id=\"preview\">";
			echo "<div class=\"container\">";
			echo "<div class=\"row align-items-center\">";
			echo "<h1>Nothing to Show :(</h1>";
			echo "</div>";
			echo "</div>";
			echo "</section>";
		}
    }

    function PageEditPage($iID,$iPageID) {
        $row=SQLGetPageRow($iPageID);
        if(isset($_GET["submit"])) {
            if($_GET["submit"]=="update") {
                if(isset($_POST["title"])) {
                    SQLSetPageRow($iPageID,$_POST["title"],$row["blockids"]);
                }
            } else if($_GET["submit"]=="block_data") {
                if(isset($_GET["block"])) {
                    $block=SQLGetBlockRow($_GET["block"]);
                    $params=call_user_func($block["type"],"","","","",false);
                    $imgs="";
                    $texts="";
                    $headings="";
                    $links="";
                    for($i=0;$i<$params[0];$i++) {
                        if(isset($_POST["img_".($i+1)])) {
                            $imgs.=$_POST["img_".($i+1)]."|";
                        } else {
                            $imgs.="|";
                        }
                    }
                    for($i=0;$i<$params[1];$i++) {
                        if(isset($_POST["txt_".($i+1)])) {
                            $texts.=$_POST["txt_".($i+1)]."|";
                        } else {
                            $texts.="|";
                        }
                    }
                    for($i=0;$i<$params[2];$i++) {
                        if(isset($_POST["h_".($i+1)])) {
                            $headings.=$_POST["h_".($i+1)]."|";
                        } else {
                            $headings.="|";
                        }
                    }
                    for($i=0;$i<$params[3];$i++) {
                        if(isset($_POST["link_".($i+1)])) {
                            $links.=$_POST["link_".($i+1)]."|";
                        } else {
                            $links.="|";
                        }
                    }
                    SQLSetBlockRow($_GET["block"],rtrim($imgs,"|"),rtrim($texts,"|"),rtrim($headings,"|"),rtrim($links,"|"),$block["type"]);
                }
            }
        } else if(isset($_GET["add_block"])) {
            SQLAddBlockRow("","","","",$_GET["add_block"]);
            if($row["blockids"]=="") {
                SQLSetPageRow($iPageID,$row["title"],SQLGetBlockIDs()[SQLGetBlockRowCount()-1]);
            } else {
                SQLSetPageRow($iPageID,$row["title"],$row["blockids"]."|".SQLGetBlockIDs()[SQLGetBlockRowCount()-1]);
            }
        } else if(isset($_GET["del_block"])) {
            if(isset($_GET["block"])) {
                SQLDeleteBlock($_GET["block"]);
                $row=SQLGetPageRow($iPageID);
                if(count(explode("|",$row["blockids"]))==1) {
                    $out="";
                } else {
                    $out=str_replace("|".$_GET["block"],"",$row["blockids"]);
                }
                SQLSetPageRow($iPageID,$row["title"],$out);
            }
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
                            echo "<p class=\"text-h3\"><a target=\"_blank\" href=\"index.php?site=".$_GET["siteid"]."&page=".$iPageID."\" class=\"btn btn-black btn-empty btn-round\"><i class=\"fa fa-code\" aria-hidden=\"true\"></i> View Page</a></p>";
                            echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard&siteid=".$_GET["siteid"]."&action=view_pages\" class=\"btn btn-round\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> View Pages</a></p>";
                        }
                    ?>
                </div>
              </div>
        </div>
    </section>
	<section class="fdb-block" style="background-image: url(./fdb-imgs/bg_c_3.svg)" id="info">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Update Page Information.</h1>
                        </div>
                    </div>
                    <?php echo "<form action=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&submit=update#info\" method=\"POST\">"; ?>
                        <div class="row">
                            <div class="col mt-2">
                        		<label>Page Title:</label>
                        		<?php echo "<input class=\"form-control\" value=\"".$row["title"]."\" name=\"title\" placeholder=\"Page Title\" type=\"text\" required>"; ?>
                            </div>
                        </div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn btn-black btn-round btn-empty" type="submit"><i class="fa fa-chain"></i> Update Page</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <?php
        PageShowPreview($iPageID);
    ?>
    <section class="fdb-block p-2" id="navigator">
        <div class="container">
            <div class="row justify-content-center">
                <h2>Add a Block</h2>
            </div>
        </div>
        <div class="container-fluid">
            <p class="m-0 text-center">
                <?php 
                echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&show_blocks=CallToAction#navigator\">Call to action</a>";
                echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&show_blocks=Content#navigator\">Content</a>";
                echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&show_blocks=Feature#navigator\">Feature</a>";
                echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&show_blocks=Pricing#navigator\">Pricing</a>";
                echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&show_blocks=Team#navigator\">Team</a>";
                echo "<a class=\"btn btn-round btn-empty m-1\" href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&show_blocks=Testimonial#navigator\">Testimonial</a>";
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
                    ?>
                    <section class="fdb-block p-2 bg-dark" style="background-image: url(./fdb-imgs/bg_c_2.svg)">
                        <div class="container-fluid">
                            <p class="m-0 text-center">
                                <?php 
                                echo "<a class=\"btn btn-white btn-round btn-empty m-1\" href=\"?site=dashboard&siteid=".$iID."&action=edit_page&page=".$iPageID."&add_block=".$_GET["show_blocks"].$i."#preview\">Choose</a>";
                                ?>
                            </p>
                        </div>
                    </section>
                    <?php
                }
            }
        }
    }
    ?>
    <?php
    }

    function PageEditCustomPage($iID,$iPageID) {
		if(isset($_GET["submit"])) {
			if($_GET["submit"]=="update") {
				if(isset($_POST["title"])&&isset($_POST["custom"])&&$_POST["title"]!="Home") {
                    SQLSetPageRowEx($iPageID,$_POST["title"],$_POST["custom"],"");
					if(isset($_POST["add"])&&$_POST["add"]=="true") {
						$page_id=SQLGetPageIDs()[SQLGetPageRowCount()-1];
						$row=SQLGetMenuRow($iID);
						$name_changes=$row["link_names"]."|".$_POST["title"];
						$href_changes=$row["link_hrefs"]."|?site=".$iID."&page=".$page_id;
						SQLSetMenuRow($iID,$name_changes,$href_changes);
                    }
				}
			}
        }
        $row=SQLGetPageRow($iPageID);
    ?>
    <section class="fdb-block fdb-viewport" style="background-image: url(./fdb-imgs/bg_2.svg)">
        <div class="container justify-content-center align-items-center d-flex">
              <div class="row justify-content-center text-center">
                <div class="col-12 col-md-8">
                    <h1><i class="fa fa-tachometer" aria-hidden="true"></i> BeardBlock</h1>
                    <p class="text-h2">Dashboard and Control Center.</p>
                    <?php 
                        if(isset($_GET["siteid"])) {
                            echo "<p class=\"text-h3\"><a href=\"index.php?site=dashboard&siteid=".$_GET["siteid"]."&action=view_pages\" class=\"btn btn-round\"><i class=\"fa fa-arrow-left\" aria-hidden=\"true\"></i> View Pages</a></p>";
                        }
                    ?>
                </div>
              </div>
        </div>
    </section>
	<section class="fdb-block" style="background-image: url(./fdb-imgs/bg_c_3.svg)">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-8 col-lg-7 col-xl-5 text-left">
                    <div class="row">
                        <div class="col">
                            <h1>Custom Page Information.</h1>
                        </div>
                    </div>
                    <?php echo "<form action=\"?site=dashboard&siteid=".$iID."&page=".$iPageID."&action=edit_custom_page&submit=update\" method=\"POST\">"; ?>
                        <div class="row">
                            <div class="col mt-2">
                        		<label>Page Title:</label>
                                <?php
                                echo "<input class=\"form-control\" value=\"".$row["title"]."\" name=\"title\" placeholder=\"Page Title\" type=\"text\" required>";
                                ?>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col mt-2">
                        		<label>Custom PHP-Function:</label>
                                <?php
                                echo "<input class=\"form-control\" value=\"".$row["custom_php"]."\" name=\"custom\" placeholder=\"Shop or Forum\" type=\"text\" required>";
                                ?>
                            </div>
                        </div>
						<div class="row justify-content-start mt-3">
							<div class="col">
								<div class="form-check">
									<label class="form-check-label"><input class="form-check-input" name="add" value="true" type="checkbox"> Add to Site-Menu</label>
								</div>
                            </div>
						</div>
                        <div class="row mt-4">
                            <div class="col">
                                <button class="btn btn-black btn-round btn-empty" type="submit"><i class="fa fa-chain"></i> Update Infromation</button>
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