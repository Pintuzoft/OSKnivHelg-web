<?php
date_default_timezone_set('Europe/Stockholm');
error_reporting(E_ALL);
ini_set('display_errors', 'On');

include_once 'class/config.php';
include_once 'class/mysql.php';
include_once 'class/arraylist.php';
include_once 'class/functions.php';
include_once 'class/event.php';
include_once 'class/user.php';



echo "<html>\n";

echo "  <head>\n";
echo "    <title>My Title</title>\n";
echo "    <link rel='stylesheet' type='text/css' href='css/main.css'>\n";
echo "    <script type='text/javascript' src='js/jquery.js'></script>\n";

/* BOOTSTRAP */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>\n";

/* DATATABLES */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css'>\n";

echo "  </head>\n";

echo "  <body>\n";

/* HEADER */
echo "    <div id='header' class='container-fluid'>\n";
echo "      <div id='logo'>\n";
echo "        <a href='index.php'><img src='images/logo.png' alt='My Logo' /></a>\n";
echo "      </div>\n";

echo "    </div>\n";


/* CONTENT LEFT*/
echo "    <div id='content' class='container-fluid'>\n";

echo "      <div id='content-main' class='row'>\n";

echo "          <div id='content-left' class='col-md-3'>\n";
echo "            <p>left!</p>\n";
echo "          </div>\n";

/* CONTENT RIGHT */
echo "          <div id='content-right' class='col-md-9'>\n";

echo "            <p>right!</p>\n";


echo "          </div>\n";

echo "      </div>\n";

echo "    </div>\n";

/* FOOTER */ 
echo "    <div id='footer'>\n";
echo "      <div id='footer_content'>\n";
echo "      </div>\n";
echo "    </div>\n";

/* SCRIPTS */
echo "    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js'></script>\n";
echo "    <script type='text/javascript' src='https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js'></script>\n";
echo "    <script type='text/javascript' src='https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js'></script>\n";
echo "    <script type='text/javascript'>\n";
echo "      $(document).ready(function() {\n";
echo "        $('#eventlist').DataTable();\n";
echo "      });\n";
echo "    </script>\n";
echo "  </body>\n";
echo "</html>\n";


?>