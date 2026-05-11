<?php
session_start();

require_once __DIR__ . '/config/MailConfig.php';
require_once __DIR__ . '/vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

echo "<h2>Mail Configuration Test</h2>";
echo "<pre>";
echo "MAIL_HOST: " . MAIL_HOST . "\n";
echo "MAIL_PORT: " . MAIL_PORT . "\n";
echo "MAIL_USERNAME: " . MAIL_USERNAME . "\n";
echo "MAIL_FROM_EMAIL: " . MAIL_FROM_EMAIL . "\n";
echo "MAIL_FROM_NAME: " . MAIL_FROM_NAME . "\n";
echo "</pre>";

// Test form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $testEmail = trim($_POST['test_email'] ?? '');
    
    if (empty($testEmail)) {
        echo "<p style='color: red;'><strong>Error:</strong> Please enter a test email address</p>";
    } else {
        echo "<h3>Sending test email to: $testEmail</h3>";
        
        $mail = new PHPMailer(true);
        try {
            $mail->isSMTP();
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USERNAME;
            $mail->Password   = trim(MAIL_PASSWORD);
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = MAIL_PORT;
            $mail->Timeout    = 15;
            
            echo "<p>✓ SMTP configuration set</p>";
            
            $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
            $mail->addAddress($testEmail, 'Test User');
            
            echo "<p>✓ From and To addresses set</p>";
            
            $mail->isHTML(true);
            $mail->Subject = 'Test Email from Nehru College';
            $mail->Body = '<h1>Test Email</h1><p>If you see this, email is working!</p>';
            
            echo "<p>✓ Message content set</p>";
            
            echo "<p><strong>Attempting to send...</strong></p>";
            
            if ($mail->send()) {
                echo "<p style='color: green;'><strong>✓ SUCCESS!</strong> Email sent successfully to $testEmail</p>";
            } else {
                echo "<p style='color: red;'><strong>✗ Send failed:</strong> " . $mail->ErrorInfo . "</p>";
            }
            
        } catch (Exception $e) {
            echo "<p style='color: red;'><strong>✗ Exception:</strong> " . $e->getMessage() . "</p>";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Mail Configuration Test</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        input { padding: 8px; width: 300px; font-size: 14px; }
        button { padding: 10px 20px; font-size: 14px; background: #2563eb; color: white; border: none; border-radius: 4px; cursor: pointer; }
        button:hover { background: #1d4ed8; }
        pre { background: #f3f4f6; padding: 10px; border-radius: 4px; overflow-x: auto; }
    </style>
</head>
<body>

<h1>Mail Configuration Test</h1>

<form method="POST">
    <label for="test_email">Enter your email to receive a test message:</label><br><br>
    <input type="email" id="test_email" name="test_email" placeholder="your-email@example.com" required>
    <button type="submit">Send Test Email</button>
</form>

<hr>

<h3>Debug Information:</h3>
<pre>
<?php
echo "PHP Version: " . phpversion() . "\n";
echo "OpenSSL Support: " . (extension_loaded('openssl') ? 'Yes' : 'No') . "\n";
echo "cURL Support: " . (extension_loaded('curl') ? 'Yes' : 'No') . "\n";
echo "Error Reporting: " . (ini_get('display_errors') ? 'Enabled' : 'Disabled') . "\n";
echo "SMTP Host: " . (defined('MAIL_HOST') ? MAIL_HOST : 'Not defined') . "\n";
?>
</pre>

</body>
</html>
