<?php
session_start();

require_once('config.php');
require_once('functions.php');

if(!checkLog()) {
  echo "<script>document.location.href = 'signin.php';</script>";
}

$query = mysqli_query($conn, "SELECT sig_name, timestamp, ip_src, inet_ntoa(ip_src) vip_src, ip_dst, inet_ntoa(ip_dst) vip_dst, status FROM acid_event ORDER BY timestamp DESC");
$count = mysqli_num_rows($query);
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Monitoring Firewall</title>
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="assets/css/bootstrap-table.min.css">
    <link rel="stylesheet" href="assets/css/font-awesome.min.css">
    <link rel="stylesheet" href="assets/css/style.min.css">
  </head>
  <body class="fmkb-dashboard">
    <main class="fmkb-main">
      <nav class="navbar navbar-default navbar-fixed-top fmkb-navbar">
        <div class="container-fluid">
          <ul class="nav navbar-nav navbar-right hidden-xs">
            <li class="dropdown"><a href="#" data-toggle="dropdown"><span class="fa fa-user-o"></span><span>&nbsp;Hi, <?php echo $_SESSION['usrName']; ?></span></a>
              <ul class="dropdown-menu">
                <li><a href="signout.php">Logout</a></li>
              </ul>
            </li>
          </ul>
        </div>
      </nav>
      <section class="fmkb-section-dashboard">
        <div class="container-fluid">
          <div class="row">
            <div class="col-xs-12">
              <h3>Monitoring Firewall</h3>
              <table id="fmkbTable">
                <thead>
                  <tr>
                    <th data-sortable="true" data-field="id">ID</th>
                    <th data-sortable="true" data-field="sig_name">Sig Name</th>
                    <th data-sortable="true" data-field="ip_src">IP Source</th>
                    <th data-sortable="true" data-field="ip_dst">IP Destination</th>
                    <th data-sortable="true" data-field="timestamp">Timestamp</th>
                  </tr>
                </thead>
                <tbody id="contentFmkbTable">
                <?php
                $i = 1;
                
                if(!empty($count)) {
                    while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)) {
                        echo "<tr>";
                        echo "<td>$i</td>";
                        echo "<td>$row[sig_name]</td>";
                        echo "<td>$row[vip_src]</td>";
                        echo "<td>$row[vip_dst]</td>";
                        echo "<td>$row[timestamp]</td>";
                        echo "</tr>";

                        $i++;
                    }
                } else {
                    echo "<tr class='text-center'>";
                    echo "<td colspan='5'>Data kosong</td>";
                    echo "</tr>";
                }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </section>
    </main>
    <script src="assets/js/jquery-3.2.1.min.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <script src="assets/js/bootstrap-table.min.js"></script>
    <script src="assets/js/bootstrap-table-id-ID.min.js"></script>
    <script src="assets/js/main.min.js"></script>
    <script>
      $(document).ready(function() {
        window.setInterval(function(){
          $.ajax({
            type: 'POST',
            url: 'engine.php',
            dataType: 'html',
            success: function(res) {
                // Silent is gold.
            }
          })
        }, 5000); 
        
        $('.btn-default > .icon-refresh').on('click', (function(e) {
          e.preventDefault();
          
          $.ajax({
            type: 'POST',
            url: 'datatable.php',
            contentType: "application/json",
            dataType: "json",
            success: function(res) {
              $('table').bootstrapTable('removeAll');
              $('table').bootstrapTable('append', res);
            }
          })
        }))
      })
      </script>
  </body>
</html>