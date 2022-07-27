<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use App\Form\SearchForm;
use App\Entity\Report;
use App\Data\SearchData;
use Doctrine\Persistence\ManagerRegistry;

use App\Form\ReportType;

class ReportController extends AbstractController
{
    public function __construct(private ManagerRegistry $doctrine) {}
    /**
     * @Route("/", name="report_list")
     */
    public function index(Request $request)
    {
    
        $data = new SearchData();

        $form = $this->createForm(SearchForm::class, $data);
        $form->handleRequest($request);
        
        $reports = $this->doctrine->getRepository(Report::class)->findSearch($data);

        return $this->render('report/index.html.twig',[
            'reports'=>$reports,
            'form' => $form->createView()
        ]);
    }

}
