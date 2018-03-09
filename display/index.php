<?php
require '../vendor/autoload.php';
//use

error_reporting(E_ALL);
ini_set("display_errors", 1);

$from = new SendGrid\Email(null, "dx@sendgrid.com");
$subject = "Hello World from the SendGrid PHP Library!";
$to = new SendGrid\Email(null, "flottin@gmail.com");
$content = new SendGrid\Content("text/plain", "Hello, Email!");
$mail = new SendGrid\Mail($from, $subject, $to, $content);

$apiKey = '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';
$sg = new \SendGrid($apiKey);

$response = $sg->client->mail()->send()->post($mail);
var_dump($response);


final class ReportTest
{

    private static $header = ['header 1', 'header 2', 'header 3'];

    private static $body = [
            ['row 1', 'ok2', 'ok3'],
            ['row 2', 'un texte avec " " et éèà ok2', 'ok3'],
            ['row 3', 'ok2', 'ok3']
          ];

          public static function getErrors()
          {
                  $error = new Tools\Error();
                  $error->rowid = 1;
                  $error->col = 'A';
                  $error->msg = 'an error message!';

                  $error->value = 'the value';
                  Tools\Errors::add($error);

                  $error = new Tools\Error();
                  $error->rowid = 2;
                  $error->col = 'B';
                  $error->msg = 'an error message!';

                  $error->value = 'the value';
                  Tools\Errors::add($error);
                  return Tools\Errors::getErrors();
          }

    public function testGetHtml()
    {
        $res = \Tools\Report::getHtml(self::$header, self::$body);
        echo $res;
    }

    public function testGetCsv()
    {
        return  \Tools\Report::getCsv(self::$header, self::$body, 'ok', '../var/report/');
        echo $res;
    }


    public static function run()
    {




        $loader = new Twig_Loader_Filesystem('../templates');
        $twig = new Twig_Environment($loader, array(
            'debug' => true,
        ));
        $twig->addExtension(new Twig_Extension_Debug());

        $errors = self::getErrors();
        $header = \Tools\Report::getHeader($errors);
        $body = \Tools\Report::getBody($errors);
        $datas = array('header' => $header, 'body' => $body);
        $content = $twig->render('index.html', $datas);
        echo $content;


        //self::send($content);

        Tools\Sendgrid::send($content);

    }

    public static function send($content)
    {
        $to = 'flottin@gamil.com';

        $subject = 'Website Change Request';

        $headers = "From: " . strip_tags($to) . "\r\n";
        $headers .= "Reply-To: ". strip_tags($to) . "\r\n";
        //$headers .= "CC: susan@example.com\r\n";
        $headers .= "MIME-Version: 1.0\r\n";
        $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";

        mail('flottin@gmail.com', 'Mon Sujet', $content, $headers);

    }

}
ReportTest::run();
