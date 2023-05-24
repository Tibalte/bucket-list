<?php

namespace App\Controller;

use App\Entity\Bucket;
use App\Form\WishType;
use App\Repository\BucketRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;



#[Route('/wish', name: 'wish_')]
class WishController extends AbstractController
{
    #[Route('', name: 'list')]
    public function list(BucketRepository $bucketRepository): Response
    {
        $buckets = $bucketRepository->findBy(["isPublished" => true], ["dateCreated" => "DESC"]);

        dump($buckets);
        return $this->render('wish/list.html.twig',[
            'buckets' => $buckets
        ]);

    }

    #[Route('/{id}', name: 'detail', requirements: ["id" => "\d+"])]
    public function detail(int $id, BucketRepository $bucketRepository): Response
    {
        dump($id);
        $bucket = $bucketRepository->find($id);

        if(!$bucket){
            //permet de lancer une erreur 404
            throw $this->createNotFoundException("not found");
        }

        return $this->render('wish/detail.html.twig', [
            'bucket' => $bucket
        ]);
    }

    #[Route('/add', name:'add')]
    public function add(): Response
    {
        $wish = new Bucket();
        $wishForm = $this -> createForm(WishType::class, $wish);

        return $this->render('wish/add.html.twig', [
            'wishForm' => $wishForm->createView()

        ]);

    }




}
