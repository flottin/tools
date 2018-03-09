<?php
namespace Tools;

class Sendgrid{

     public static function send($contentHtml, $apiKey)
     {
         $from = new \SendGrid\Email("Florent LOTTIN", "flottin@free.com");
         $subject = "Sending from php";
         $to = new \SendGrid\Email("Florent LOTTIN", "flottin@gmail.com");

         $content = new \SendGrid\Content("text/plain", 'contentHtml');
         $mail = new \SendGrid\Mail($from, $subject, $to, $content);
         
         $sg = new \SendGrid($apiKey);
         $response = $sg->client->mail()->send()->post($mail);

         var_dump($response);
          echo $response->statusCode();
          print_r($response->headers());
         // echo $response->body();
     }

}
