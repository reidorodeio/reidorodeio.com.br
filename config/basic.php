<?php return array (
  'web_name' => 'Bettpro',
  'embed' => 'fff',
  'contact_address' => 'Berlin,Germany',
  'contact_email' => 'support@example.com',
  'contact_phone' => '0123654789',
  'currency' => 'USD',
  'currency_symbol' => '$',
  'paginate' => 15,
  'copyright_text' => 'All Rights Reserved',
  'sender_email' => 'noreply@betrodeio.com',
  'sender_email_name' => 'BetRodeio',
  'email_description' => '<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BetRodeio</title>
    <link href="https://fonts.googleapis.com/css2?family=Exo:wght@400;700&display=swap" rel="stylesheet">
</head>

<body style="margin: 0; padding: 0; background-color: #rgb(211, 240, 200); font-family: \'Exo\', Arial, sans-serif; color: #fff;">
    <table width="100%" border="0" cellspacing="0" cellpadding="0">
        <tr>
            <td align="center">
                <!-- Container principal -->
                <table width="100%" border="0" cellspacing="0" cellpadding="0" style="max-width: 600px;">
                    <tr>
                        <td align="center" bgcolor="#rgb(211, 240, 200)" style="padding: 20px;">
                            <img src="https://betrodeio.com/public/images/logo/logo.png" alt="BetRodeio"
                                style="max-width: 100%; height: auto; display: block;">
                        </td>
                    </tr>
                    <tr>
                        <td align="center" bgcolor="#222" style="padding: 20px; border-radius: 10px; margin: 20px;">
                            <h2 style="margin: 0;">Olá, {{name}}.</h2>
                            {{message}}
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>

</html>',
  'email_configuration' => 
  array (
    'name' => 'sendmail',
    'smtp_host' => 'sandbox.smtp.mailtrap.io',
    'smtp_port' => '2525',
    'smtp_encryption' => 'tls',
    'smtp_username' => '875352c3d7acdc',
    'smtp_password' => '462db6ea615cae',
  ),
  'global_email' => 'support@mail.com',
  'global_description' => 'Hi {{name}}, {{message}} , Thank you',
);