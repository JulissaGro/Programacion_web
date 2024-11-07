<?php

//$username = $_POST['username'];  <-- No recomendado, no tiene filtros, poco control
$username = filter_input(INPUT_POST, 'username');
$password = filter_input(INPUT_POST, 'password');

echo "Username: $username | Password: $password";