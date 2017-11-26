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
    include_once "bb-sql.php";

    /*
        Contents:
            0. basics
            1. user
    */

    /* 0. basics */
    function SessionStart() {
        session_start();
    }

    function SessionSetUser($sEmail,$sPw) {
        $_SESSION["u_data_1"]=$sEmail;
        $_SESSION["u_data_6"]=$sPw;
    }

    function SessionDestroyUser() {
        unset($_SESSION["u_data_1"]);
        unset($_SESSION["u_data_6"]);
        session_destroy();
    }

    /* 1. user */
    function UserIsSessionValid($iMode) {
        if(isset($_SESSION["u_data_1"])&&isset($_SESSION["u_data_6"])) {
            $row=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
            if(sizeof($row)>0) {
                if($iMode==0) {
                    if(password_verify($_SESSION["u_data_6"],$row["password"])) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    if($row["type"]==1||$row["type"]==2) {
                        if(password_verify($_SESSION["u_data_6"],$row["password"])) {
                            return true;
                        } else {
                            return false;
                        }
                    } else {
                        return false;
                    }
                }
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    function UserGetIDFromSession() {
        if(UserIsSessionValid(0)) {
            $row=SQLGetUserRowByEmail($_SESSION["u_data_1"]);
            return $row["id"];
        } else {
            return false;
        }
    }

    function UserLogIn($sEmail,$sPw,$iMode) {
        $row=SQLGetUserRowByEmail($sEmail);
        if(sizeof($row)>0) {
            if($iMode==0) {
                if(password_verify($sPw,$row["password"])) {
                    return true;
                } else {
                    return false;
                }
            } else {
                if($row["type"]==1||$row["type"]==2) {
                    if(password_verify($sPw,$row["password"])) {
                        return true;
                    } else {
                        return false;
                    }
                } else {
                    return false;
                }
            }
        } else {
            return false;
        }
    }
?>