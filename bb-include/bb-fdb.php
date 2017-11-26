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

function FdbGetBlockFromTemplate($sBlock,$sTemplate) {
  $sContent=file_get_contents($sTemplate);
  $iPos=strpos($sContent,"*".$sBlock."*");
  if($iPos === false) {
    return false;
  } else {
    $sCut=substr($sContent,$iPos+strlen("*".$sBlock."*"));
    $iPos2=strpos($sCut,"*end*");
    if($iPos2 === false) {
      return false;
    } else {
      return substr($sCut,0,$iPos2);
    }
  }
}
?>