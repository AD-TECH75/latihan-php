<?php
header('X-Frame-Options: DENY');
header('X-Content-Type-Options: nosniff');
header('Referrer-Policy: no-referrer');
header('X-XSS-Protection: 0'); // legacy, biarkan off

header("Content-Security-Policy: default-src 'self'; script-src 'self'; style-src 'self';");
