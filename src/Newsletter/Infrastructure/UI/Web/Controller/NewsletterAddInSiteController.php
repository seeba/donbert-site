<?php

declare(strict_types=1);

namespace App\Newsletter\Infrastructure\UI\Web\Controller;

use App\Newsletter\Application\Command\AddToNewsletterFromSiteCommand;
use App\Newsletter\Infrastructure\UI\Web\Form\NewsletterType;
use App\Shared\Application\Service\IdGeneratorInterface;
use App\Shared\Domain\ValueObject\Email;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Messenger\Exception\HandlerFailedException;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/newsletter/add', name:'app_newsletter_add_in_site', methods: ['POST', "GET"])]
class NewsletterAddInSiteController extends AbstractController
{
    public function __construct(
        private MessageBusInterface $messageBus, 
        private IdGeneratorInterface $idGenerator)
    {
        
    }
    
    public function __invoke(Request $request) : JsonResponse 
    {
        
        $form = $this->createForm(NewsletterType::class, null, [
            'action' => $this->generateUrl('app_newsletter_add_in_site')
        ]);
        $form->handleRequest($request);
       
        if ($form->isValid()) {
            $data = $form->getData();
            try {
                $command = new AddToNewsletterFromSiteCommand(
                    $this->idGenerator->generate()->toString(),
                    new Email($data['email']),
                    new DateTime()
                );
                $msg = 'Zostałeś zapisany na powiadomienie';
                $status = 1;

                $this->messageBus->dispatch($command);


            } catch (HandlerFailedException $exception){
            
                if ($exception->getPrevious()) {
                    $exception = $exception->getPrevious();
                }
    
                $msg = $exception->getMessage();
               
                $status = 0;
            }

            return new JsonResponse([
                'msg' => $msg,
                'status' => $status
            ]);
        }
    }
}