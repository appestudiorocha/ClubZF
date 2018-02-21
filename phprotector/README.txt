PhProtector V0.3.1.1 Public Release 23-06-2010
=======================================================

 _____  _                     _            _             
|  __ \| |                   | |          | |            
| |__) | |__  _ __  _ __ ___ | |_ ___  ___| |_ ___  _ __ 
|  ___/| '_ \| '_ \| '__/ _ \| __/ _ \/ __| __/ _ \| '__|
| |    | | | | |_) | | | (_) | ||  __/ (__| || (_) | |   
|_|    |_| |_| .__/|_|  \___/ \__\___|\___|\__\___/|_|   
             | |                                         
             |_|             	   protect your web site!

Purpose: 
========

PhProtector allows you to easily secure a PHP site.

PhProtector is library in php that check for intrusion atacks.It protects against SQL injection and Cross-site scripting. It uses regular expression pattern matching to find malicious http requests (GETS and POSTS). 
It creates a xml sql injection log that shows atacker information and the risk. 
Note that you can only secure Mysql database/no database with this release version.



Legal:
======

I take no responsibility for ANY harm caused due to use of this script.
Use it at own risk!



Licence:
========

PhProtector is released under GNU General Public License v3. 
I only request:  
  - notice me via mail if you liked to use it, if you want include the website.
  - if you find bugs or you have suggestions email me.  
  


Package contents:
=================

Phprotector library uses the following components:

PhProtector(Folder)
	PhProtector.php
	LogAtack.php
	log.xml (created in case of attack only)
        .log_style.xls  (css for xml file -> do not delete!)



Installation:
=============

1) Copy "phprotector" folder to your root path.

2) Insert the following code in all web pages you want to protect. 
 

  	//START PhProtector// 
		
		//include the class file
		require("phprotector/PhProtector.php");
			
	        /* TESTING environment (show all PHP errors!) */
	        $prot= new PhProtector("phprotector/log.xml", true); 
	   	 
		/* FINAL environment (do not show PHP errors!) */ 
		//$prot = new PhProtector("phprotector/log.xml", false); 
		
		if($prot->isMalicious()){
			header("location: index.html");  //if an atack is found, it will be redirected to this page :)
			die();
		}
		
	//END PhProtector// / 



3) Test all the configuration by submiting a GET variable to your web page. 
Example:  "http//:www.example.com/yourpage.php?xpto=1 union select * from table" 
if your request ended in index.html and the XML log was created (log.xml) the configuration is OK!

4) Please ensure that the correct value for constructor is used:

	$prot= new PhProtector("phprotector/log.xml", true); 

or in case of a final release of a web page:

	$prot = new PhProtector("phprotector/log.xml", false);



Problems?:
==========

If you use variable that start with pattern "id" like "id_news" and is a non number variable you can expect to
be marked as an attack, please change your php design! This script assume that id variable should be real ids not strings!

There are some words in variables (GETs and POSTs) that are blocked, for example variables that have "select"
"order by","update" etc, etc 



FEATURES/FIXES:
=====
The error routine were wrong coded in 0.3.1, this is a fix version, update is strongly advised.
This version brings no new features.



TODO:
=====

Anticipated for the future:

* Mssql filters (now only Mysql is supported).
* Protection against Null Byte Injection. (included in beta version 0.3.2)
* Protection against spam in forms. (beta version 0.3.2)
* Protection against email disclosure in web sites. (included in beta version 0.3.2)
* Protection in PHP sessions (included in beta version 0.3.2) 



I hope it serves you!!!

PhProtector is made by Hugo Sousa (adamastor666gmail.com)
 



