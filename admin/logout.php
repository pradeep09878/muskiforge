<?php

declare(strict_types=1);

require __DIR__ . '/../config.php';
require __DIR__ . '/../includes/functions.php';

unset($_SESSION['admin_id'], $_SESSION['admin_username']);
session_regenerate_id(true);

header('Location: ' . url('admin/login.php'));
exit;
