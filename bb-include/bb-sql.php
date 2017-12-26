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

	include_once "bb-config.php";

	/* CONTENT:
		0. sql functions
		1. init
		2. bb_site
		3. bb_user
		4. bb_menu
		5. bb_social
		6. bb_elements
		7. bb_block
		8. bb_post
		9. bb_page
	    10. install
	*/

	/* 0. sql functions */
	function __sqlCreateDatabase() {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW);
		$sQuery="CREATE DATABASE IF NOT EXISTS ".BB_DB_NAME;
		mysqli_query($conn,$sQuery);
		mysqli_close($conn);
	}

	function __sqlCreateTable($sTable,$sFields) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="CREATE TABLE IF NOT EXISTS ".$sTable." (".$sFields.")";
		mysqli_query($conn,$sQuery);
		mysqli_close($conn);
	}

	function __sqlFetchRow($sTable,$iID) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="SELECT * FROM ".$sTable." WHERE id='".$iID."'";
		$vQuery=mysqli_query($conn,$sQuery);
		$aRow=mysqli_fetch_assoc($vQuery);
		mysqli_close($conn);
		return $aRow;
	}

	function __sqlFetchIDs($sTable) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="SELECT id FROM ".$sTable;
		$vQuery=mysqli_query($conn,$sQuery);
		$tRow[]="";
		$iIndex=0;
		while($aRow=mysqli_fetch_assoc($vQuery)) {
			$tRow[$iIndex]=$aRow["id"];
			$iIndex++;
		}
		mysqli_close($conn);
		return $tRow;
	}

	function __sqlFetchIDsOrderBy($sTable,$sOrder) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="SELECT id FROM ".$sTable." ORDER BY ".$sOrder." DESC";
		$vQuery=mysqli_query($conn,$sQuery);
		$tRow[]="";
		$iIndex=0;
		while($aRow=mysqli_fetch_assoc($vQuery)) {
			$tRow[$iIndex]=$aRow["id"];
			$iIndex++;
		}
		mysqli_close($conn);
		return $tRow;
	}

	function __sqlFetchRowByParam($sTable,$sField,$sValue) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="SELECT * FROM ".$sTable." WHERE ".$sField."='".$sValue."'";
		$vQuery=mysqli_query($conn,$sQuery);
		$aRow=mysqli_fetch_assoc($vQuery);
		mysqli_close($conn);
		return $aRow;
	}

	function __sqlUpdate($sTable,$iID,$sField,$vValue) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="UPDATE ".$sTable." SET ".$sField."='".$vValue."' WHERE id='".$iID."'";
		mysqli_query($conn,$sQuery);
		mysqli_close($conn);
	}

	function __sqlInsert($sTable,$sFields,$sValues) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="INSERT INTO ".$sTable." (".$sFields.") VALUES (".$sValues.")";
		mysqli_query($conn,$sQuery);
		mysqli_close($conn);
	}

	function __sqlRowCount($sTable) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="SELECT * FROM ".$sTable;
		$iRet=mysqli_num_rows(mysqli_query($conn,$sQuery));
		mysqli_close($conn);
		return $iRet;
	}

	function __sqlDelete($sTable,$iID) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="DELETE FROM ".$sTable." WHERE id=".$iID;
		$iRet=mysqli_query($conn,$sQuery);
		mysqli_close($conn);
		return $iRet;
	}

	/* 1. init */
	function SQLInit() {
		__sqlCreateDatabase();
		__sqlCreateTable("bb_site","id int NOT NULL AUTO_INCREMENT,".
								   "title varchar(50) NOT NULL,".
								   "description varchar(100) DEFAULT NULL,".
								   "keywords varchar(255) DEFAULT NULL,".
								   "author_id int DEFAULT NULL,".
								   "font_url varchar(255) DEFAULT NULL,".
								   "theme varchar(55) DEFAULT NULL,".
								   "homepage int DEFAULT NULL,".
								   "res_mode int DEFAULT NULL,".
								   "PRIMARY KEY (id)");
		__sqlCreateTable("bb_user","id int NOT NULL AUTO_INCREMENT,".
								   "username varchar(60) NOT NULL,".
								   "password TEXT DEFAULT NULL,".
								   "email varchar(255) DEFAULT NULL,".
								   "type int DEFAULT NULL,".
								   "PRIMARY KEY (id)");
		__sqlCreateTable("bb_elements","id int NOT NULL,".
									   "type int NOT NULL,".
									   "blockid int DEFAULT NULL,".
									   "PRIMARY KEY (id,type)");
		__sqlCreateTable("bb_menu","id int NOT NULL,".
								   "link_names TEXT DEFAULT NULL,".
								   "link_hrefs TEXT DEFAULT NULL,".
								   "PRIMARY KEY (id)");
		__sqlCreateTable("bb_social","id int NOT NULL,".
									 "social_icons TEXT DEFAULT NULL,".
									 "social_hrefs TEXT DEFAULT NULL,".
									 "PRIMARY KEY (id)");
		__sqlCreateTable("bb_block","id int NOT NULL AUTO_INCREMENT,".
									"imgs TEXT DEFAULT NULL,".
									"texts TEXT DEFAULT NULL,".
									"headings TEXT DEFAULT NULL,".
									"links TEXT DEFAULT NULL,".
									"type varchar(150) NOT NULL,".
									"PRIMARY KEY (id)");
		__sqlCreateTable("bb_post","id int NOT NULL AUTO_INCREMENT,".
								   "title varchar(255) NOT NULL,".
								   "content TEXT DEFAULT NULL,".
								   "date DATE DEFAULT NULL,".
								   "img varchar(255) NOT NULL,".
								   "author_id int NOT NULL,".
								   "PRIMARY KEY(id)");
		__sqlCreateTable("bb_page","id int NOT NULL AUTO_INCREMENT,".
								   "title varchar(255) NOT NULL,".
								   "siteid int NOT NULL,".
								   "type int NOT NULL,".
								   "custom_php varchar(255) DEFAULT NULL,".
								   "blockids TEXT DEFAULT NULL,".
								   "PRIMARY KEY(id)");
	}

	function SQLCheck() {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		if($conn==false) {
			return false;
		} else {
			mysqli_close($conn);
			return true;
		}
	}

    /* 2. bb_site functions */
    function SQLGetSiteRow($iID) {
		return __sqlFetchRow("bb_site",$iID);
	}

	function SQLGetSiteRowCount() {
		return __sqlRowCount("bb_site");
	}

	function SQLGetSiteIDs() {
		return __sqlFetchIDs("bb_site");
	}

	function SQLSetSiteRow($iID,$sTitle,$sDesc,$sKeywords,$sFontURL,$sTheme) {
		__sqlUpdate("bb_site",$iID,"title",$sTitle);
		__sqlUpdate("bb_site",$iID,"description",$sDesc);
		__sqlUpdate("bb_site",$iID,"keywords",$sKeywords);
		__sqlUpdate("bb_site",$iID,"font_url",$sFontURL);
		__sqlUpdate("bb_site",$iID,"theme",$sTheme);
	}

	function SQLSetSiteRowEx($iID,$iResMode) {
		__sqlUpdate("bb_site",$iID,"res_mode",$iResMode);
	}

	function SQLAddSiteRow($sTitle,$sDesc,$sKeywords,$iAuthor,$sFontURL,$sTheme,$iPage) {
		$sFields="title,description,keywords,author_id,font_url,theme,homepage,res_mode";
		$sValues="'".$sTitle."', '".$sDesc."', '".$sKeywords."', '".$iAuthor."', '".$sFontURL."', '".$sTheme."', ".$iPage.", 0";
		__sqlInsert("bb_site",$sFields,$sValues); 
	}

	function SQLDeleteSite($iID) {
		__sqlDelete("bb_site",$iID);
	}

	/* 3. bb_user functions */
	function SQLGetUserRow($iID) {
		return __sqlFetchRow("bb_user",$iID);
	}

	function SQLGetUserRowByEmail($sEmail) {
		return __sqlFetchRowByParam("bb_user","email",$sEmail);
	}

	function SQLGetUserRowCount() {
		return __sqlRowCount("bb_user");	
	}

	function SQLGetUserIDs() {
		return __sqlFetchIDs("bb_user");
	}

	function SQLSetUserRow($iID,$sName,$sPassword,$sEmail) {
		__sqlUpdate("bb_user",$iID,"username",$sName);
		__sqlUpdate("bb_user",$iID,"password",password_hash($sPassword,PASSWORD_DEFAULT));
		__sqlUpdate("bb_user",$iID,"email",$sEmail);
	}

	function SQLSetUserType($iID,$iType) {
		__sqlUpdate("bb_user",$iID,"type",$iType);
	}
	
	function SQLAddUserRow($sName,$sPassword,$sEmail,$iType) {
		$sFields="username,password,email,type";
		$sValues="'".$sName."', '".password_hash($sPassword,PASSWORD_DEFAULT)."', '".$sEmail."', ".$iType;
		__sqlInsert("bb_user",$sFields,$sValues);
	}

	/* 4. bb_menu functions */
    function SQLGetMenuRow($iID) {
		return __sqlFetchRow("bb_menu",$iID);
	}

	function SQLGetMenuRowCount() {
		return __sqlRowCount("bb_menu");
	}

	function SQLGetMenuIDs() {
		return __sqlFetchIDs("bb_menu");
	}

	function SQLSetMenuRow($iID,$sLinkNames,$sLinkHrefs) {
		__sqlUpdate("bb_menu",$iID,"link_names",$sLinkNames);
		__sqlUpdate("bb_menu",$iID,"link_hrefs",$sLinkHrefs);
	}

	function SQLDeleteMenu($iID) {
		__sqlDelete("bb_menu",$iID);
	}

	//@install only
	function SQLAddMenuRow($iID,$sLinkNames,$sLinkHrefs) {
		$sFields="id,link_names,link_hrefs";
		$sValues=$iID.", '".$sLinkNames."', '".$sLinkHrefs."'";
		__sqlInsert("bb_menu",$sFields,$sValues); 
	}

	/* 5. bb_social functions */
    function SQLGetSocialRow($iID) {
		return __sqlFetchRow("bb_social",$iID);
	}

	function SQLGetSocialRowCount() {
		return __sqlRowCount("bb_social");
	}

	function SQLGetSocialIDs() {
		return __sqlFetchIDs("bb_social");
	}

	function SQLSetSocialRow($iID,$sSocialIcons,$sSocialHrefs) {
		__sqlUpdate("bb_social",$iID,"social_icons",$sSocialIcons);
		__sqlUpdate("bb_social",$iID,"social_hrefs",$sSocialHrefs);
	}

	function SQLDeleteSocial($iID) {
		__sqlDelete("bb_social",$iID);
	}

	//@install only
	function SQLAddSocialRow($iID,$sSocialIcons,$sSocialHrefs) {
		$sFields="id,social_icons,social_hrefs";
		$sValues=$iID.", '".$sSocialIcons."', '".$sSocialHrefs."'";
		__sqlInsert("bb_social",$sFields,$sValues);
	}

	/* 6. bb_elements functions */
    function SQLGetElementsRow($iID,$iType) {
		$conn=mysqli_connect(BB_DB_LOCATION,BB_DB_USER,BB_DB_PW,BB_DB_NAME);
		$sQuery="SELECT * FROM bb_elements WHERE id='".$iID."' AND type='".$iType."'";
		$vQuery=mysqli_query($conn,$sQuery);
		$aRow=mysqli_fetch_assoc($vQuery);
		mysqli_close($conn);
		return $aRow;
	}

	function SQLGetElementsRowCount() {
		return __sqlRowCount("bb_elements");
	}

	function SQLGetElementsIDs() {
		return __sqlFetchIDs("bb_elements");
	}

	function SQLDeleteElements($iID) {
		__sqlDelete("bb_elements",$iID);
	}

	//@install only
	function SQLAddElementsRow($iID,$iType,$iBlockID) {
		$sFields="id,type,blockid";
		$sValues=$iID.", ".$iType.", ".$iBlockID;
		__sqlInsert("bb_elements",$sFields,$sValues);
	}

	/* 7. bb_block functions */
    function SQLGetBlockRow($iID) {
		return __sqlFetchRow("bb_block",$iID);
	}

	function SQLGetBlockRowCount() {
		return __sqlRowCount("bb_block");
	}

	function SQLGetBlockIDs() {
		return __sqlFetchIDs("bb_block");
	}

	function SQLSetBlockRow($iID,$sImgs,$sTexts,$sHeadings,$sLinks,$sType) {
		__sqlUpdate("bb_block",$iID,"imgs",$sImgs);
		__sqlUpdate("bb_block",$iID,"texts",$sTexts);
		__sqlUpdate("bb_block",$iID,"headings",$sHeadings);
		__sqlUpdate("bb_block",$iID,"links",$sLinks);
		__sqlUpdate("bb_block",$iID,"type",$sType);
	}

	function SQLAddBlockRow($sImgs,$sTexts,$sHeadings,$sLinks,$sType) {
		$sFields="imgs,texts,headings,links,type";
		$sValues="'".$sImgs."', '".$sTexts."', '".$sHeadings."', '".$sLinks."', '".$sType."'";
		__sqlInsert("bb_block",$sFields,$sValues);
	}

	function SQLDeleteBlock($iID) {
		__sqlDelete("bb_block",$iID);
	}

	/* 8. bb_post functions */
	function SQLGetPostRow($iID) {
		return __sqlFetchRow("bb_post",$iID);
	}

	function SQLGetPostRowByTitle($sTitle) {
		return __sqlFetchRowByParam("bb_post","title",$sTitle);
	}

	function SQLGetPostRowCount() {
		return __sqlRowCount("bb_post");	
	}

	function SQLGetPostIDs() {
		return __sqlFetchIDsOrderBy("bb_post","date");
	}

	function SQLGetPostIDsUnordered() {
		return __sqlFetchIDs("bb_post");
	}

	function SQLSetPostRow($iID,$sTitle,$sContent,$sImg) {
		__sqlUpdate("bb_post",$iID,"title",$sTitle);
		__sqlUpdate("bb_post",$iID,"content",$sContent);
		__sqlUpdate("bb_post",$iID,"img",$sImg);
	}
	
	function SQLAddPostRow($sTitle,$sContent,$sImg,$iAuthor) {
		$sFields="title,content,date,img,author_id";
		$sValues="'".$sTitle."', '".$sContent."', '".date("Y-m-d")."', '".$sImg."', ".$iAuthor;
		__sqlInsert("bb_post",$sFields,$sValues);
	}

	function SQLDeletePost($iID) {
		__sqlDelete("bb_post",$iID);
	}

	/* 9. bb_page functions */
	function SQLGetPageRow($iID) {
		return __sqlFetchRow("bb_page",$iID);
	}

	function SQLGetPageRowCount() {
		return __sqlRowCount("bb_page");	
	}

	function SQLGetPageIDs() {
		return __sqlFetchIDs("bb_page");
	}

	function SQLSetPageRow($iID,$sTitle,$sBlockIDs) {
		__sqlUpdate("bb_page",$iID,"title",$sTitle);
		__sqlUpdate("bb_page",$iID,"blockids",$sBlockIDs);
	}

	function SQLSetPageRowEx($iID,$sTitle,$sCustom_php,$sBlockIDs) {
		__sqlUpdate("bb_page",$iID,"title",$sTitle);
		__sqlUpdate("bb_page",$iID,"custom_php",$sCustom_php);
		__sqlUpdate("bb_page",$iID,"blockids",$sBlockIDs);
	}
	
	function SQLAddPageRow($iSiteid,$sTitle,$sBlockIDs) {
		$sFields="siteid,title,type,blockids";
		$sValues=$iSiteid.", '".$sTitle."', 0, '".$sBlockIDs."'";
		__sqlInsert("bb_page",$sFields,$sValues);
	}

	function SQLAddPageRowEx($iSiteid,$sTitle,$iType,$sCustom_php,$sBlockIDs) {
		$sFields="siteid,title,type,custom_php,blockids";
		$sValues=$iSiteid.", '".$sTitle."', ".$iType.", '".$sCustom_php."', '".$sBlockIDs."'";
		__sqlInsert("bb_page",$sFields,$sValues);
	}

	function SQLDeletePage($iID) {
		__sqlDelete("bb_page",$iID);
	}

	/* 10. install */
	function SQLInstallSite($sTitle,$sDesc,$sKeywords) {
		if(SQLGetSiteRowCount()>0) {
			$siteid=SQLGetSiteIDs()[count(SQLGetSiteIDs())-1]+1;
		} else {
			$siteid=1;
		}
		SQLAddPageRow($siteid,"Home","");
		if(SQLGetPageRowCount()>0) {
			$pageid=SQLGetPageIDs()[count(SQLGetPageIDs())-1];
		} else {
			$pageid=1;
		}
		SQLAddSiteRow($sTitle,$sDesc,$sKeywords,1,"https://fonts.googleapis.com/css?family=Roboto:300","default",$pageid);
		SQLAddBlockRow("","","","","header");
		SQLAddBlockRow("","","","","footer");
		if(SQLGetBlockRowCount()>0) {
			$blockid=SQLGetBlockIDs()[count(SQLGetBlockIDs())-1]-1;
		} else {
			$blockid=1;
		}
		SQLAddMenuRow($siteid,"Home","?site=".$siteid."&page=".$pageid);
		SQLAddSocialRow($siteid,"","");
		SQLAddElementsRow($siteid,1,$blockid);
		SQLAddElementsRow($siteid,2,$blockid+1);
	}

	function SQLUninstallSite($iID) {

	}
?>