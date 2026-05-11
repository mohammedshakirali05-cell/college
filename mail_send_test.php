<?php
require_once __DIR__ . '/app/services/MailService.php';

$mailService = new MailService();
$result = $mailService->sendCredentialsEmail(
    'mohammedshakirali05@gmail.com',
    'Test Student',
    'Student',
    'STU-TEST-00001',
    'T3stPassw0rd!'
);

echo "Result:\n";
var_export($result);
echo "\n";
