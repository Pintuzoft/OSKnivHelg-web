<?php

include 'config.php';
include 'mysql.php';
include 'user.php';

$mysql = new MySQL($mysql_host, $mysql_user, $mysql_password, $mysql_database);

echo "<html>\n";

echo "  <head>\n";
echo "    <title>My Title</title>\n";
echo "    <link rel='stylesheet' type='text/css' href='css/main.css'>\n";
echo "    <script type='text/javascript' src='js/jquery.js'></script>\n";

/* BOOTSTRAP */
echo "    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'></script>\n";
echo "  </head>\n";

echo "  <body>\n";

/* HEADER */
echo "    <div id='header'>\n";
echo "      <div id='logo'>\n";
echo "        <a href='index.php'><img src='images/logo.png' alt='My Logo' /></a>\n";
echo "      </div>\n";

echo "      <div id='menu'>\n";
echo "        <ul>\n";
echo "          <li><a href='index.php'>Home</a></li>\n";
echo "          <li><a href='about.php'>About</a></li>\n";    
echo "          <li><a href='contact.php'>Contact</a></li>\n";
echo "        </ul>\n";
echo "      </div>\n";

echo "    </div>\n";


/* CONTENT */
echo "    <div id='content'>\n";



echo "    </div>\n";




/* FOOTER */ 
echo "    <div id='footer'>\n";
echo "      <div id='footer_content'>\n";
echo "      </div>\n";
echo "    </div>\n";

/* SCRIPTS */
echo "    <script type='text/javascript' src='js/bootstrap.min.js'></script>\n";

echo "  </body>\n";
echo "</html>\n";


?>