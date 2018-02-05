<?php

class SendMail {

    function mail($to, $subject, $message, $from) {

        $to = $to;
        $subject = $subject;
        $message = $message;
        $message = wordwrap($message, 70);
        $headers = 'MIME-Version: 1.0' . "\r\n";
        $headers = "From: $from\r\n";
        $headers.="Content-type: text/html; charset=\"UTF-8\"\n";
        $headers.="Content-Transfer-Encoding: 8bit\n\n";
        $maild_mes = mail($to, $subject, $message, $headers);
        if ($maild_mes) {
            return true;
        } else {
            return false;
        }
    }

}
