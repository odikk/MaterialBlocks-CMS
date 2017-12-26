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
    include_once "bb-sql.php";

    function HTMLGetHead($iID) {
    ?>
        <head>
            <?php echo "<title>".SQLGetSiteRow($iID)["title"]." | ".SQLGetSiteRow($iID)["description"]."</title>\n"; ?>
            <meta name="viewport" content="width=device-width, height=device-height, initial-scale=1.0, maximum-scale=1.0" />
            <?php echo "<meta name=\"description\" content=\"".SQLGetSiteRow($iID)["description"]."\">\n"; ?>
            <?php echo "<meta name=\"keywords\" content=\"".SQLGetSiteRow($iID)["keywords"]."\">\n"; ?>
            <?php echo "<meta name=\"author\" content=\"".SQLGetUserRow(SQLGetSiteRow($iID)["author_id"])["username"]."\">\n"; ?>
            <?php
            if(SQLGetSiteRow($iID)["res_mode"]==0) {
            ?>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta/css/bootstrap.min.css" integrity="sha384-/Y6pD6FV/Vv2HJnA6t+vslU6fwYXjCFtcEpHbNJ0lyAFsXTsjBbfaDjzALeQsN6M" crossorigin="anonymous">
                <?php echo "<link href=\"".SQLGetSiteRow($iID)["font_url"]."\" rel=\"stylesheet\">\n"; ?>
                <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
            <?php
            } else {
            ?>
                <link rel="stylesheet" href="./res/bootstrap/css/bootstrap.min.css">
                <?php echo "<link href=\"".SQLGetSiteRow($iID)["font_url"]."\" rel=\"stylesheet\">\n"; ?>
                <link rel="stylesheet" href="./res/font-awesome/css/font-awesome.min.css">
            <?php
            }
            ?>
            <?php echo "<link type=\"text/css\" rel=\"stylesheet\" href=\"./themes/".SQLGetSiteRow($iID)["theme"]."/".SQLGetSiteRow($iID)["theme"].".css\">\n"; ?>
        </head>
    <?php
    }

    function HTMLPageSwitcher($iMax,$iPage) {
        $iFactor=ceil($iMax/$iPage);
        ?>
        <div class="container-fluid">
            <p class="m-0 text-center">
        <?php
        if($iFactor>25) {
            $iFactor=25;
        }
        for($i=1;$i<=$iFactor;$i++) {
            if(isset($_GET["siteid"])&&isset($_GET["action"])) {
                echo "<a href=\"?site=dashboard&siteid=".$_GET["siteid"]."&action=".$_GET["action"]."&list=".$i."\" class=\"btn btn-empty btn-round\" style=\"min-width: 20px;padding: 9px 6px;margin-left:10px;\">".$i."</a>";
            } else if(isset($_GET["site"])&&isset($_GET["page"])) {
                echo "<a href=\"?site=".$_GET["site"]."&page=".$_GET["page"]."&list=".$i."\" class=\"btn btn-empty btn-round\" style=\"min-width: 20px;padding: 9px 6px;margin-left:10px;\">".$i."</a>";
            }
        }
        ?>
            </p>
        </div>
        <?php
    }

    function HTMLGetMenuElement($iSite,$iID) {
        $menu=SQLGetMenuRow($iSite);
        if(count($menu)==0) {
            return false;
        }
        if($menu["link_names"]!=""&&$menu["link_hrefs"]!="") {
            $link_names=explode("|",$menu["link_names"]);
            $link_hrefs=explode("|",$menu["link_hrefs"]);
            if(count($link_names)>$iID&&count($link_hrefs)>$iID) {
                $ret[2]="";
                $ret[0]=$link_names[$iID];
                $ret[1]=$link_hrefs[$iID];
                return $ret;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function HTMLGetSocialElement($iSite,$iID) {
        $social=SQLGetSocialRow($iSite);
        if(count($social)==0) {
            return false;
        }
        if($social["social_icons"]!=""&&$social["social_hrefs"]!="") {
            $social_icons=explode("|",$social["social_icons"]);
            $social_hrefs=explode("|",$social["social_hrefs"]);
            if(count($social_icons)>$iID&&count($social_hrefs)>$iID) {
                $ret[2]="";
                $ret[0]=$social_icons[$iID];
                $ret[1]=$social_hrefs[$iID];
                return $ret;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function HTMLGetCurrentLink() {
        return $_SERVER[REQUEST_URI];
    }

    function HTMLGetDashboardMenu($iSite) {
        if(UserIsSessionValid(1)) {
            $user=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
            if($user["type"]==2) {
        ?>
        <header style="background: #181818; color: #eee;" id="dash_nav">
            <div class="container">
                <nav class="navbar navbar-expand-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav0" aria-controls="navbarNav0" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav0">
                        <ul class="navbar-nav mr-auto ml-auto">
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."\"><i class=\"fa fa-tachometer\" aria-hidden=\"true\"></i> Dashboard</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=add_post\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> Add Post</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=add_page\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> Add Page</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=view_pages\"><i class=\"fa fa-columns\" aria-hidden=\"true\"></i> View Pages</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=settings\"><i class=\"fa fa-cog\" aria-hidden=\"true\"></i> Settings</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=logout\"><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> Log Out</a>"; ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <?php
            } else {
        ?>
        <header style="background: #181818; color: #eee;" id="dash_nav">
            <div class="container">
                <nav class="navbar navbar-expand-md">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav0" aria-controls="navbarNav0" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav0">
                        <ul class="navbar-nav mr-auto ml-auto">
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."\"><i class=\"fa fa-tachometer\" aria-hidden=\"true\"></i> Dashboard</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=add_post\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> Add Post</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=add_page\"><i class=\"fa fa-plus-circle\" aria-hidden=\"true\"></i> Add Page</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=view_pages\"><i class=\"fa fa-columns\" aria-hidden=\"true\"></i> View Pages</a>"; ?>
                            </li>
                            <li class="nav-item">
                                <?php echo "<a class=\"nav-link\" href=\"?site=dashboard&siteid=".$iSite."&action=logout\"><i class=\"fa fa-sign-out\" aria-hidden=\"true\"></i> Log Out</a>"; ?>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </header>
        <?php
            }
        }
    }

    function HTMLGetRandomQuote() {
        $aQuotes=array(
            "Mycroft Holmes: All lives end; all hearts are broken. Caring is not an advantage, Sherlock.&mdash;<em>Sherlock</em>",
            "SH: Yes, obviously.&mdash;<em>Sherlock</em>",
            "SH: Taking your own life. Interesting expression. Taking it from who? Once it's over, it's not you who'll miss it. Your own death is something that happens to everybody else. Your life is not your own. Keep your hands off it.&mdash;<em>Sherlock</em>",
            "Eleven: Friends don't lie!&mdash;<em>Stranger Things</em>",
            "Mike Wheeler: I never gave up on you. I called you every night. Every night for...<br/><br/>
             Eleven: 353 days. I heard.&mdash;<em>Stranger Things</em>",
            "Tony Stark: What's the stat, Rogers?<br/>
            </br>
            Steve Rogers: [looks at the Helicarrier tech] It seems to be powered by some sort of electricity!<br/>
            </br>
            Tony Stark: ...well, you're not wrong.&mdash;<em>The Avengers</em>",
            "Steve Rogers: Doctor Banner, now might be a good time for you to get angry.<br/>
            <br/>
            Bruce Banner: That's my secret, Captain: I'm always angry.<br/>
            <br/>
            [Banner hulks out and punches the Leviathan]&mdash;<em>The Avengers</em>",
            "Sam: [Both are overcome by exhaustion] Do you remember the Shire, Mr. Frodo? It'll be spring soon. And the orchards will be in blossom. And the birds will be nesting in the hazel thicket. And they'll be sowing the summer barley in the lower fields... and eating the first of the strawberries with cream. Do you remember the taste of strawberries?<br/>
            <br/>
            Frodo: No, Sam. I can't recall the taste of food... nor the sound of water... nor the touch of grass. I'm... naked in the dark, with nothing, no veil... between me... and the wheel of fire! I can see him... with my waking eyes!<br/>
            <br/>
            Sam: Then let us be rid of it... once and for all! Come on, Mr. Frodo. I can't carry it for you... but I can carry you!&mdash;<em>The Lord of the Rings: The Return of the King</em>",
            "Gandalf: I will not say \"Do not weep\", for not all tears are an evil.&mdash;<em>The Lord of the Rings: The Return of the King</em>",
            "Gandalf: Fool of a Took!&mdash;<em>The Lord of the Rings: The Return of the King</em>",
            "Aragorn: For Frodo.<br/>
            <br/>
            [He charges out towards the remaining army of Morder alone. Merry and Pippin raise their swords and yell then charge. The rest of the soldiers do the same and soon overtake Merry and Pippin]&mdash;<em>The Lord of the Rings: The Return of the King</em>"
        );
        return "<p>".$aQuotes[rand(0,count($aQuotes)-1)]."</p>";
    }
?>