<?php

session_name('curavoice');
session_start();
session_unset();
session_destroy();

header("Location: ../../../www/index.php");