<?php

namespace reclamationBundle\Controller;

use MyBundle\Entity\Reclamation;
use MyBundle\Entity\User;

use reclamationBundle\Form\ReclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

/* Include the Composer generated autoload.php file. */
require 'C:\wamp64\www\pi-dev\vendor\autoload.php';


class reclamationController extends Controller
{
    public function addReclamationAction(Request $request )
    {
        $user=$this->getUser();
        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $rec=new Reclamation();
        $date=new \DateTime();
        $rec->setDater($date);
        $rec->setIduser($user);
        $form=$this->createForm(ReclamationType::class,$rec);
        $form=$form->handleRequest($request);
        if($form->isValid() )
        {
            $rec->setSujetr($form['sujetr']->getData());
            $rec->setNomr($form['nomr']->getData());
            $em=$this->getDoctrine()->getManager();
            $em->persist($rec);
            $em->flush();
            return $this->redirectToRoute('reclamation_addReclamation');
        }


// Instantiation and passing `true` enables exceptions
        $mail = new PHPMailer(true);

        try {
            //Server settings
            //$mail->SMTPDebug = 1;                      // Enable verbose debug output
            $mail->isSMTP();                                            // Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
            // SMTP password
            $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` also accepted
            $mail->Port       = 587;                                    // TCP port to connect to
            /* Username (email address). */
            $mail->Username = 'syrine.kerriou@esprit.tn';

            /* Google account password. */
            $mail->Password = '07494750';
            //Recipients
            $mail->setFrom('from@example.com', 'titi');
            $mail->addAddress('syrine.kerriou@gmail.com');     // Add a recipient


            /* // Attachments
             $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
             $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name*/

            // Content
            $mail->isHTML(true);                                  // Set email format to HTML
            $mail->Subject = 'reclamation';
            $mail->Body    = ' votre reclamation est en cours de traitement <b>!</b> ';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
            //echo 'Message has been sent';
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
        $form=$this->createForm(ReclamationType::class,null);
        $list=$this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        return $this->render('@reclamation/reclamation/addReclamation.html.twig',array(
            'form'=>$form->createView(),
            'list'=>$list,
            'u'=>$u
        ));
    }

    public function deleteAction($id)
    {
        $user=$this->getUser();

        $u=$this->getDoctrine()->getRepository(User::class)->find($user);
        $rec=$this->getDoctrine()->getRepository(Reclamation::class)->find($id);
        if($rec->getIdUser() == $u)
        {

            $em = $this->getDoctrine()->getManager();
            $em->remove($rec);
            $em->flush();
        }
        return $this->redirectToRoute('reclamation_affichage');

    }
    public function affichageAction()
    {
        $em=$this->getDoctrine()->getRepository(Reclamation::class)->findAll();
        return $this->render('@reclamation/reclamation/affichageReclamation.html.twig',array(
            're'=>$em

        ));
    }


}
