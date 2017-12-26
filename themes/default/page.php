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

    include_once "calltoaction.php";
    include_once "content.php";
    include_once "feature.php";
    include_once "pricing.php";
    include_once "team.php";
    include_once "testimonial.php";
    
    function BBPage($iPageID) {
		$row=SQLGetPageRow($iPageID);
		if($row["type"]==0) {
			if($row["blockids"]!="") {
				$blockids=explode("|",$row["blockids"]);
				for($i=0;$i<count($blockids);$i++) {
					$block=SQLGetBlockRow($blockids[$i]);
					call_user_func($block["type"],$block["imgs"],$block["texts"],$block["headings"],$block["links"]);
				}
			} else {
				echo "<section class=\"fdb-block\">";
				echo "<div class=\"container\">";
				echo "<div class=\"row align-items-center\">";
				echo "<h1>Nothing to Show :(</h1>";
				echo "</div>";
				echo "</div>";
				echo "</section>";
			}
		} else {
			include_once "custom.php";
			BBCustom($row["custom_php"]);			
		}
    }
?>