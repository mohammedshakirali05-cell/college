<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';
require_once __DIR__ . '/../../config/MailConfig.php';

class MailService
{
    public function sendCredentialsEmail($toEmail, $name, $role, $loginId, $plainPassword)
    {
        // Validate inputs
        if (empty($toEmail) || !filter_var($toEmail, FILTER_VALIDATE_EMAIL)) {
            error_log('MailService: Invalid email address - ' . $toEmail);
            return [
                'success' => false,
                'error' => 'Invalid email address'
            ];
        }

        if (empty($loginId) || empty($plainPassword)) {
            error_log('MailService: Missing login credentials');
            return [
                'success' => false,
                'error' => 'Missing login credentials'
            ];
        }

        $mail = new PHPMailer(true);

        try {
            // SMTP Configuration
            $mail->isSMTP();
            $mail->SMTPDebug = defined('MAIL_DEBUG') && MAIL_DEBUG ? SMTP::DEBUG_SERVER : SMTP::DEBUG_OFF;
            $mail->Debugoutput = function($str, $level) {
                error_log('PHPMailer Debug [' . $level . ']: ' . $str);
            };
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USERNAME;
            $mail->Password   = trim(MAIL_PASSWORD);
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = MAIL_PORT;
            $mail->Timeout    = 15;
            $mail->SMTPKeepAlive = false;
            $mail->SMTPAutoTLS = true;

            // Message
            $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
            $mail->addAddress($toEmail, $name);

            $protocol = !empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
            $host = $_SERVER['HTTP_HOST'] ?? 'localhost';
            $loginUrl = $protocol . '://' . $host . '/college/public/index.php?url=login';

            $mail->isHTML(true);
            $mail->Subject = 'Your Admission Portal Access - Nehru BBA & BCA College';
            $mail->Body = "
                <html>
                <head>
                    <style>
                        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; margin: 0; padding: 0; background: #f4f8ff; }
                        .container { max-width: 640px; margin: 0 auto; padding: 30px; background: #ffffff; border-radius: 24px; box-shadow: 0 30px 80px rgba(16, 66, 122, 0.08); }
                        .header { text-align: center; padding-bottom: 20px; }
                        .header h1 { font-size: 28px; color: #0d3d74; margin: 0; }
                        .banner { display: inline-block; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; padding: 10px 20px; border-radius: 999px; margin: 20px 0; font-weight: 700; }
                        .card { background: #f7fbff; border: 1px solid rgba(37, 99, 235, 0.14); border-radius: 18px; padding: 22px; margin: 20px 0; font-family: monospace; }
                        .card strong { display: block; margin-bottom: 12px; color: #1d4ed8; font-size: 14px; }
                        .button { display: inline-block; background: linear-gradient(135deg, #2563eb, #1d4ed8); color: white; text-decoration: none; padding: 14px 28px; border-radius: 999px; font-weight: 700; margin-top: 20px; }
                        .footer { font-size: 13px; color: #6b7280; margin-top: 30px; text-align: center; }
                    </style>
                </head>
                <body>
                    <div class='container'>
                        <div class='header'>
                            <h1>🎓 Admission Portal Access Ready</h1>
                        </div>
                        <div class='banner'>✓ Your admission form is now activated!</div>
                        <p>Hi <strong>{$name}</strong>,</p>
                        <p>Thank you for completing the admission registration payment. Your admission form has been issued instantly and your portal access is ready.</p>

                        <div class='card'>
                            <strong>📋 Your login credentials:</strong>
                            Student ID: <code>{$loginId}</code><br>
                            Password: <code>{$plainPassword}</code><br>
                            Email: <code>{$toEmail}</code>
                        </div>

                        <p><strong>Next Steps:</strong></p>
                        <ol>
                            <li>Click the button below to login</li>
                            <li>Complete your full admission form</li>
                            <li>Upload required documents</li>
                            <li>Submit for final verification</li>
                        </ol>

                        <center>
                            <a href='{$loginUrl}' class='button'>🔓 Login to Portal Now</a>
                        </center>

                        <div class='footer'>
                            <p><strong>⚠️ Important:</strong> Keep these credentials safe. Do not share with anyone.</p>
                            <p>If you did not make this request, contact the admission office immediately.</p>
                            <p>Nehru BBA & BCA College • Admission Office<br>
                            <small>This is an automated email. Please do not reply to this message.</small></p>
                        </div>
                    </div>
                </body>
                </html>
            ";

            $mail->AltBody =
                "Admission Portal Access Ready\n" .
                "================================\n\n" .
                "Your admission form is now activated.\n\n" .
                "Login Credentials:\n" .
                "Student ID: {$loginId}\n" .
                "Password: {$plainPassword}\n" .
                "Email: {$toEmail}\n\n" .
                "Login URL: {$loginUrl}\n\n" .
                "Keep these credentials safe. Do not share with anyone.";

            // Send email
            if (!$mail->send()) {
                error_log('MailService Send Failed: ' . $mail->ErrorInfo);
                return [
                    'success' => false,
                    'error' => 'Failed to send email: ' . $mail->ErrorInfo
                ];
            }

            error_log('MailService: Email sent successfully to ' . $toEmail);
            return [
                'success' => true,
                'error' => null
            ];

        } catch (Exception $e) {
            $errorMsg = 'MailService Exception: ' . $e->getMessage();
            error_log($errorMsg);
            return [
                'success' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    public function sendCashApprovalEmail($toEmail, $fullName, $admissionNumber, $successUrl)
    {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->SMTPDebug = defined('MAIL_DEBUG') && MAIL_DEBUG ? SMTP::DEBUG_SERVER : SMTP::DEBUG_OFF;
            $mail->Debugoutput = function($str, $level) {
                error_log('PHPMailer Debug [' . $level . ']: ' . $str);
            };
            $mail->Host       = MAIL_HOST;
            $mail->SMTPAuth   = true;
            $mail->Username   = MAIL_USERNAME;
            $mail->Password   = trim(MAIL_PASSWORD);
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port       = MAIL_PORT;
            $mail->Timeout    = 15;
            $mail->SMTPKeepAlive = false;
            $mail->SMTPAutoTLS = true;

            $mail->setFrom(MAIL_FROM_EMAIL, MAIL_FROM_NAME);
            $mail->addAddress($toEmail, $fullName);

            $mail->isHTML(true);
            $mail->Subject = '🎉 Your Admission Has Been Approved! - Nehru BBA and BCA College';
            $mail->Body = "
                <html>
                <head>
                    <style>
                        body { font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif; }
                        .email-container { max-width: 600px; margin: 0 auto; }
                        .header { background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 30px; border-radius: 10px 10px 0 0; text-align: center; }
                        .content { padding: 30px; background: #f9f9f9; }
                        .success-badge { background: #28a745; color: white; padding: 10px 20px; border-radius: 5px; display: inline-block; margin: 20px 0; font-weight: bold; }
                        .info-box { background: white; padding: 20px; border-left: 4px solid #667eea; margin: 20px 0; }
                        .button { display: inline-block; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); color: white; padding: 15px 40px; border-radius: 5px; text-decoration: none; font-weight: bold; margin: 20px 0; }
                        .footer { background: #333; color: white; padding: 20px; text-align: center; font-size: 12px; border-radius: 0 0 10px 10px; }
                    </style>
                </head>
                <body>
                    <div class='email-container'>
                        <div class='header'>
                            <h1>✓ Admission Approved!</h1>
                            <p>Your cash payment has been verified</p>
                        </div>
                        <div class='content'>
                            <p>Dear <strong>{$fullName}</strong>,</p>
                            
                            <div class='success-badge'>CASH PAYMENT APPROVED</div>
                            
                            <p>Great news! Your admission application has been approved by the Nehru BBA and BCA College administration after verification of your cash payment.</p>
                            
                            <div class='info-box'>
                                <strong>Application Details:</strong><br>
                                <strong>Application ID:</strong> {$admissionNumber}<br>
                                <strong>Status:</strong> <span style='color: #28a745; font-weight: bold;'>ADMITTED</span><br>
                                <strong>Next Step:</strong> Complete your admission form
                            </div>
                            
                            <h3>What's Next?</h3>
                            <ol>
                                <li>Click the button below to access your admission form</li>
                                <li>Fill in all required details carefully</li>
                                <li>Upload all necessary documents</li>
                                <li>Submit your admission form</li>
                                <li>You'll receive your admission receipt via email</li>
                            </ol>
                            
                            <center>
                                <a href='{$successUrl}' class='button'>Complete Your Admission Form</a>
                            </center>
                            
                            <div class='info-box' style='background: #e7f3ff; border-left-color: #17a2b8;'>
                                <strong>💡 Need Help?</strong><br>
                                If you have any questions or need assistance, please contact the admission office during working hours. All the information you need is available on the college portal.
                            </div>
                            
                            <p>Best regards,<br><strong>Nehru BBA and BCA College</strong><br>Admission Department</p>
                        </div>
                        <div class='footer'>
                            <p>This is an automated email. Please do not reply to this email. For queries, contact the admission office.</p>
                            <p>&copy; " . date('Y') . " Nehru BBA and BCA College. All rights reserved.</p>
                        </div>
                    </div>
                </body>
                </html>
            ";

            $mail->AltBody =
                "Congratulations!\n" .
                "Your admission has been approved.\n\n" .
                "Application ID: {$admissionNumber}\n" .
                "Status: ADMITTED\n\n" .
                "Please visit your admission portal to complete the next steps.\n" .
                "Success URL: {$successUrl}";

            $mail->send();

            return [
                'success' => true,
                'error' => null
            ];
        } catch (Exception $e) {
            return [
                'success' => false,
                'error' => $mail->ErrorInfo
            ];
        }
    }
}