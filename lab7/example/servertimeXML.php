<?php
          header('Content-Type: text/xml');
          echo "<?xml version=\"1.0\" ?>\n";
          echo "<clock><timenow>" . date('H:i:s') .  "</timenow></clock>";
          ?>