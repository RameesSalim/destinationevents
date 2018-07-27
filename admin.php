<?php
require('res/php/config.php');

?>
Hi this is a protected content! You are logged-in. Happy viewing.
<br />
<br />
===============<br />
Navigation Menu<br />
===============<br />
<a href="index.php">Homepage</a><br />
<a href="about.php">About this page</a><br />

<a href="#">logout<?php $user->logout(); ?></a>