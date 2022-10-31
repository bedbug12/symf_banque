<?php

namespace App\Controller;

use App\Entity\Client;
use App\Form\ClientType;
use App\Repository\ClientRepository;
use App\Repository\CompteRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompteController extends AbstractController
{
    #[Route('/g/compte/show', name: 'app_g_show_compte')]
    public function show(CompteRepository $repoCompte,Request $request,ClientRepository $repoClient): Response
    {
        $tel="";
        $datas=$repoCompte->findAll();
        if ($request->request->has("tel") && $request->request->get("tel")!="") {
            $tel=$request->request->get("tel");
            $client=$repoClient->findOneBy(['tel'=>$tel]);
            $datas=$client->getComptes();
        }
        return $this->render('compte/index.html.twig',[
            'datas'=>$datas,
            'tel'=>$tel
        ]);
    }





    #[Route('/g/compte/create', name: 'app_g_create_compte')]
    public function create(CompteRepository $repoCompte,Request $request,ClientRepository $repoClient): Response
    {
        $tel="";
        $client=new Client;
        // $datas=$repoCompte->findAll();
        if ($request->request->has("tel") && $request->request->get("tel")!="") {
            $tel=$request->request->get("tel");
            $client=$repoClient->findOneBy(['tel'=>$tel]);
        //     $datas=$client->getComptes();
        }
        $form=$this->createForm(ClientType::class,$client);
        return $this->render('compte/nouveau.html.twig',[
            // 'datas'=>$datas,
            'tel'=>$tel,
            'form'=>$form->createView(),
            'client'=>$client
        ]);
   }
   
}
