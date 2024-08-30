<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="fr">
  <head>
    <meta charset="utf-8" />
    <title>Conversion d'une chaîne en nombre</title>
  </head>
  <body>
  <div>
  <?php
  echo '1 + "1" = ',(1 + "1"),'<br />';
  echo '1 + "1.5" = ',(1 + "1.5"),'<br />';
  echo '1 + "1.5E2" = ',(1 + "1.5E2"),'<br />';
  echo '1 + "1e3" = ',(1 + "1e3"),'<br />';
  echo '1 + 1abc = ',(1 + "1abc"),'<br />';
  echo '1 + "1.5abcd" = ',(1 + "1.5abcd"),'<br />';
  echo '1 + "1.5 abcd" = ',(1 + "1.5 abcd"),'<br />';
  echo '1 + ".5" = ',(1 + ".5"),'<br />';
  echo '1 + "-5" = ',(1 + "-5"),'<br />';
  echo '1 + " \t\n\r 5" = ',(1 + " \t\n\r 5"),'<br />';
  echo '1 + "abc1" = ',(1 + "abc1"),'<br />';
  ?>
  </div>
  </body>
</html>