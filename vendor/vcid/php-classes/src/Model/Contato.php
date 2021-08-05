<?php

namespace vcinsidedigital\Model;


use vcinsidedigital\Model;
use vcinsidedigital\Mail;

class Contato extends Model
{
    
    public function sendMailMsg()
    {
        $mail = new Mail($this->getvalues(), "mail", [
            "assunto"=> $this->getAssunto(),
            "nome"=> $this->getnome(),
            "email"=> $this->getemail(),
            "telefone"=> $this->gettelefone(),
            "msg"=> $this->getmsg()
        ]);
    }


    public function sendWhatsappMsg()
    {
        $nome = "*Nome:*" ." ". $this->getnome()."%0A";
        $email = "*E-mail:*" ." ". $this->getemail()."%0A%0A";
        $assunto = "*Assunto:*" ." ". $this->getAssunto()."%0A%0A";
        $msg = $this->getmsg();


        $msg_whatsapp = $nome.$email.$assunto.$msg;

        $url = "https://api.whatsapp.com/send?phone=5535988191124&text=$msg_whatsapp";

        $_SESSION['url'] = $url;
        
        header("Location: $url");
        exit;
    }
    
}