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
echo "    <link rel='stylesheet' type='text/css' href='css/default.css'>\n";
echo "    <script type='text/javascript' src='js/jquery.js'></script>\n";

/* METAREFRESH */
echo "    <meta http-equiv='refresh' content='60'>\n";

/* BOOTSTRAP */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css'>\n";

/* DATATABLES */
echo "    <link rel='stylesheet' type='text/css' href='https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css'>\n";

echo "  </head>\n";

echo "  <body style='background-color:#282828; color:#EFEFEF'>\n";

/* USER MODAL POPUP */
echo "    <div class='modal fade' id='userModal' tabindex='-1' aria-labelledby='userModalLabel' aria-hidden='true'>\n";
echo "      <div class='modal-dialog'>\n";
echo "        <div class='modal-content'>\n";
echo "          <div class='modal-header'>\n";
echo "            <h5 class='modal-title' id='userModalLabel'>Modal title</h5>\n";
echo "            <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>\n";
echo "          </div>\n";

echo "          <div class='modal-body text-center'>\n";
echo "            <img id='userModalImage' src='images/oldswedes.logo.motto.small.png' alt='My Logo' />\n";

/* USER EVENTS */

echo "            <table id='userModalEventList' class='table table-dark table-striped table-bordered'>\n";

echo "              <thead>\n";
echo "                <tr>\n";
echo "                  <th class='col-3'>Time</th>\n";
echo "                  <th class='col-4'>Attacker</th>\n";
echo "                  <th class='col-4'>Victim</th>\n";
echo "                </tr>\n";
echo "              </thead>\n";

echo "              <tbody>\n";

$ueList = getUserEventList ( );
foreach ( $ueList->getArray() as $event ) {
    echo "                <tr>\n";
    echo "                  <td class='col-3'>".$event->getStamp()."</td>\n";
    echo "                  <td class='col-4'>".$event->getAttacker()->getName()."</td>\n";
    echo "                  <td class='col-4'>".$event->getVictim()->getName()."</td>\n";
    echo "                </tr>\n";
}

echo "              </tbody>\n";
echo "            </table>\n";
echo "          </div>\n";

echo "          <div class='modal-footer'>\n";
echo "            <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>\n";
echo "          </div>\n";

echo "        </div>\n";
echo "      </div>\n";
echo "    </div>\n";

    
/* HEADER */
echo "    <div id='header' class='container-fluid'>\n";
echo "      <div id='logo'>\n";
echo "        <a href='index.php'><img src='images/oldswedes.logo.motto.small.png' alt='My Logo' /></a>\n";
echo "      </div>\n";
echo "    </div>\n";


/* CONTENT LEFT*/
echo "    <div id='content' class='container-fluid'>\n";
echo "      <div id='content-main' class='container'>\n";
echo "        <h2>Knivhelg - Kniva en Admin!</h2>\n";

echo "        <div id='content-main-inner' class='row'>\n";
echo "          <div id='content-left' class='col col-2'>\n";
echo "              <h4>Poäng:</h4>\n";
echo "              <ul>\n";
echo "                  <li>10p - admin</li>\n";
echo "                  <li>5p - spelare</li>\n";
echo "              </ul>\n";
echo "          </div>\n";

echo "          <div id='content-middle' class='col col-6'>\n";
echo "            <h4>Senaste händelserna</h4>\n";
echo "             <table id='eventlist' class='table table-dark table-striped table-bordered'>\n";

echo "              <thead>\n";
echo "                <tr>\n";
echo "                  <th class='col-3'>Time</th>\n";
echo "                  <th class='col-4'>Attacker</th>\n";
echo "                  <th class='col-4'>Victim</th>\n";
echo "                </tr>\n";
echo "              </thead>\n";

echo "              <tbody>\n";

$eList = getEventList ( );
foreach ( $eList->getArray() as $event ) {
    echo "                <tr>\n";
    echo "                  <td class='col-3'>".$event->getStamp()."</td>\n";
    echo "                  <td class='col-4'>".$event->getAttacker()." [+".$event->getPoints()."p]</td>\n";
    echo "                  <td class='col-4'>".$event->getVictim()." [-".$event->getPoints()."p]</td>\n";
    echo "                </tr>\n";
}

echo "              </tbody>\n";
echo "            </table>\n";
echo "          </div>\n";









/* CONTENT RIGHT */
echo "          <div id='content-right' class='col col-3'>\n";
echo "            <h4>Topplista</h4>\n";
echo "            <table id='userlist' class='table table-dark table-striped table-bordered'>\n";

echo "              <thead>\n";
echo "                <tr>\n";
echo "                  <th class='col-1'>Rank</th>\n";
echo "                  <th class='col-4'>Name</th>\n";
echo "                  <th class='col-2'>Points</th>\n";
echo "                </tr>\n";
echo "              </thead>\n";

echo "              <tbody>\n";

$uList = getUserListSorted ( );
$index = 0;
foreach ( $uList->getArray() as $user ) {
    echo "                <tr>\n";
    echo "                  <td class='col-1'>#".++$index."</td>\n";
    echo "                  <td class='col-4'>".$user->getName()."</td>\n";
    echo "                  <td class='col-2'>".$user->getPoints()."</td>\n";
    echo "                </tr>\n";
}

echo "              </tbody>\n";
echo "            </table>\n";

echo "          </div>\n";
echo "        </div>\n";
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
echo "            $(document).ready(function() {\n";
echo "              $('#eventlist').DataTable({\n";
echo "                'paging': false,\n";
echo "                'searching': false,\n";
echo "                'info': false,\n";
echo "                'order': [[ 0, 'desc' ]]\n";
echo "              });\n";
echo "            });\n";
echo "    </script>\n";
echo "  </body>\n";
echo "</html>\n";


?>