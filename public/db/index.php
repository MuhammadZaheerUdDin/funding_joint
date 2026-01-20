<?php

function adminer_object() {
  
  class AdminerSoftware extends Adminer {    
    //Used to allow Adminer login without password
//    function login($login, $password) {
//      return ($login == 'root' && $password == '');
//    }
    function name() {
		return "<a href='https://www.adminer.org/'" . target_blank() . " id='h1'>DB Manager</a>";
	}
  }
  
  return new AdminerSoftware;
}
include './panel.php';
