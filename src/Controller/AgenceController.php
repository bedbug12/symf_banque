<?php

namespace App\Controller;

use App\Entity\Agence;
use App\Repository\AgenceRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AgenceController extends AbstractController
{



    #[Route('/g/agence/show', name: 'app_g_show_agence',methods:['GET'])]
    public function show(AgenceRepository $repoAg): Response
    {
        $datas=$repoAg->findAll();
        return $this->render('agence/index.html.twig',[
            'datas'=>$datas
        ]);
    }



    #[Route('/g/agence/create', name: 'app_g_create_agence',methods:['POST'])]
    public function Create(Request $request,AgenceRepository $repoAg): Response
    {
        $errors=[];

        if($request->request->has("btnSave")){
            $tel=$request->request->get("tel");
            $adresse=$request->request->get("adresse");
            if (empty($tel)) {
               $errors['tel'] ="Le telephone est obligatoire";
            }
            if (empty($adresse)) {
                $errors['adresse'] ="L'adresse est obligatoire";
            }
            if (count($errors)!=0) {
                return $this->redirectToRoute('app_g_show_agence',[
                    "errors"=>$errors
                ]);
            }
            if ($request->request->get("btnSave")=="create") {
                $num="AG_".(count($repoAg->findAll())+1);
                $agence=new Agence();
                $agence->setNumero($num);
            }else {
                $id=$request->request->get("id");
                $agence=$repoAg->find($id);
            }
       
            $agence->setTel($tel);
            $agence->setAdresse($adresse);
            $repoAg->save($agence,true);
        }
        return $this->redirectToRoute('app_g_show_agence');
    
    }


    
    #[Route('/g/agence/edit/{id}', name: 'app_g_edit_agence',methods:['GET'])]
    public function edit($id,AgenceRepository $repoAg,Request $request): Response
    {
        $agence=$repoAg->findOneBy(['id'=>$id]);
        $datas=$repoAg->findAll();
      
        return $this->render('agence/index.html.twig',[
            'datas'=>$datas,
            "agence"=>$agence
        ]);

    }





    #[Route('/g/agence/del/{id}', name: 'app_g_del_agence',methods:['GET'])]
    public function del($id,AgenceRepository $repoAg): Response
    {
        $agence=$repoAg->findOneBy(['id'=>$id]);

        if (count($agence->getComptes())==0) {
            $repoAg->remove($agence,true); 
            $this->addFlash('info', 'Agence supprimer avec succes');
        }else{
            $this->addFlash('info', 'Cet agence ne peux pas etre supprimer puis ce qu\'il contient des comptes');
        }
        
       
        return $this->redirectToRoute('app_g_show_agence');
    }






}
