<?php
namespace Tools;

class Sendgrid  extends Mailer
{
    /**
     * Summary of send
     * @return boolean
     */
    public function send()
    {
        $mailList       = self::getTo();

        $from           = new \SendGrid\Email($this->nameFrom, $this->from);
        if (count($mailList) == 1)
        {
            $to             = new \SendGrid\Email($this->nameTo, $this->to);
        }
        else{
            $to             = new \SendGrid\Email($mailList[0], $mailList[0]);
        }
        $content        = new \SendGrid\Content("text/" . $this->contentType, $this->content);
        $mail           = new \SendGrid\Mail($from, $this->subject, $to, $content);
        $mail->addCategory($this->category);

        if (!empty($this->filename))
        {
            $attachment = new \SendGrid\Attachment();

            $content = file_get_contents($this->filename);
            $name = \MRM\Peugeot\Core\Tools\Text::getFilename($this->filename);
            $attachment->setContent(base64_encode($content));
            $attachment->setType("txt/csv");
            $attachment->setFilename($name);
            $attachment->setDisposition("attachment");
            $attachment->setContentId("report");
            $mail->addAttachment($attachment);
        }

        if(count($mailList) > 1) {
            //$to = new \SendGrid\Email($mailList[0], $mailList[0]);
            $personalization = new \SendGrid\Personalization();

            foreach($mailList as $emailtxt)
            {
                $email = new \SendGrid\Email($emailtxt, $emailtxt);
                $personalization->addTo($email);
            }
            $mail->addPersonalization($personalization);
        }

        $sg         = new \SendGrid($this->apikey);
        $response   = $sg->client->mail()->send()->post($mail);
        switch ($response->statusCode()) {
            case '200':
            case '202':
                return true;
            case '400':
            case '401':
            case '403':
            case '404':
            case '405':
            case '413':
            case '415':
            case '429':
            case '500':
            case '503':
                return $response;
        }
        return false;
    }
    /**
     * Summary of getTo
     * @return string[]
     */
    public function getTo()
    {
        $to = explode(',', $this->to);
        $mails = [];
        foreach($to as $mail)
        {
            if (!empty(trim($mail)))
            {
                $mails [] = trim($mail);
            }
        }
        return $mails;
    }

}