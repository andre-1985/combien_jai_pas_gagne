<?php

namespace App\Controller;

use App\Entity\SelectionEuromillions;
use App\Form\GridEuromillionsType;
use App\Repository\DrawEuromillionsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class GridEuromillionsController extends AbstractController
{
    #[Route('/grilleEuromillions', name: 'grid_euromillions')]
    public function index(EntityManagerInterface $entityManager, PaginatorInterface $paginator, Request $request, DrawEuromillionsRepository $repository): Response
    {
        $selectionEuromillions = new SelectionEuromillions();

        $form = $this->createForm(GridEuromillionsType::class, $selectionEuromillions)->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userSelection = $form->getData();
            $userSelectionRequest = $repository->findDrawsByUserSelection($userSelection->ballsSelectionEuromillions, $userSelection->starsSelection);

            foreach ($userSelectionRequest as $userSelectionRq) {
                $userResultsDrawId = 'draw_' . $userSelectionRq->getId();
                $drawId = $userResultsDrawId;

                $ballsRq = $userSelectionRq->getBallsArray();
                $starsRq = $userSelectionRq->getStarsArray();

                $userCommonBallsArray = array_intersect($userSelection->ballsSelectionEuromillions, $ballsRq);
                $userCommonStarsArray = array_intersect($userSelection->starsSelection, $starsRq);
                /*$completeDraw = [
                    'id' => $userSelectionRq->getId(),
                    'drawDay' => $userSelectionRq->getDrawDay(),
                    'drawDate' => $userSelectionRq->getDrawDate(),
                    'ball1' => $userSelectionRq->getBall1(),
                    'ball2' => $userSelectionRq->getBall2(),
                    'ball3' => $userSelectionRq->getBall3(),
                    'ball4' => $userSelectionRq->getBall4(),
                    'ball5' => $userSelectionRq->getBall5(),
                    'star1' => $userSelectionRq->getStar1(),
                    'star2' => $userSelectionRq->getStar2(),
                    'ascendingWinningBalls' => $userSelectionRq->getAscendingWinningBalls(),
                    'ascendingWinningStars' => $userSelectionRq->getAscendingWinningStars(),
                    'numberOfWinnerInRank1InFrance' => $userSelectionRq->getNumberOfWinnerInRank1InFrance(),
                    'numberOfWinnerInRank1InEurope' => $userSelectionRq->getNumberOfWinnerInRank1InEurope(),
                    'rankReport1' => $userSelectionRq->getRankReport1(),
                    'numberOfWinnerInRank2InFrance' => $userSelectionRq->getNumberOfWinnerInRank2InFrance(),
                    'numberOfWinnerInRank2InEurope' => $userSelectionRq->getNumberOfWinnerInRank2InEurope(),
                    'rankReport2' => $userSelectionRq->getRankReport2(),
                    'numberOfWinnerInRank3InFrance' => $userSelectionRq->getNumberOfWinnerInRank3InFrance(),
                    'numberOfWinnerInRank3InEurope' => $userSelectionRq->getNumberOfWinnerInRank3InEurope(),
                    'rankReport3' => $userSelectionRq->getRankReport3(),
                    'numberOfWinnerInRank4InFrance' => $userSelectionRq->getNumberOfWinnerInRank4InFrance(),
                    'numberOfWinnerInRank4InEurope' => $userSelectionRq->getNumberOfWinnerInRank4InEurope(),
                    'rankReport4' => $userSelectionRq->getRankReport4(),
                    'numberOfWinnerInRank5InFrance' => $userSelectionRq->getNumberOfWinnerInRank5InFrance(),
                    'numberOfWinnerInRank5InEurope' => $userSelectionRq->getNumberOfWinnerInRank5InEurope(),
                    'rankReport5' => $userSelectionRq->getRankReport5(),
                    'numberOfWinnerInRank6InFrance' => $userSelectionRq->getNumberOfWinnerInRank6InFrance(),
                    'numberOfWinnerInRank6InEurope' => $userSelectionRq->getNumberOfWinnerInRank6InEurope(),
                    'rankReport6' => $userSelectionRq->getRankReport6(),
                    'numberOfWinnerInRank7InFrance' => $userSelectionRq->getNumberOfWinnerInRank7InFrance(),
                    'numberOfWinnerInRank7InEurope' => $userSelectionRq->getNumberOfWinnerInRank7InEurope(),
                    'rankReport7' => $userSelectionRq->getRankReport7(),
                    'numberOfWinnerInRank8InFrance' => $userSelectionRq->getNumberOfWinnerInRank8InFrance(),
                    'numberOfWinnerInRank8InEurope' => $userSelectionRq->getNumberOfWinnerInRank8InEurope(),
                    'rankReport8' => $userSelectionRq->getRankReport8(),
                    'numberOfWinnerInRank9InFrance' => $userSelectionRq->getNumberOfWinnerInRank9InFrance(),
                    'numberOfWinnerInRank9InEurope' => $userSelectionRq->getNumberOfWinnerInRank9InEurope(),
                    'rankReport9' => $userSelectionRq->getRankReport9(),
                    'numberOfWinnerInRank10InFrance' => $userSelectionRq->getNumberOfWinnerInRank10InFrance(),
                    'numberOfWinnerInRank10InEurope' => $userSelectionRq->getNumberOfWinnerInRank10InEurope(),
                    'rankReport10' => $userSelectionRq->getRankReport10(),
                    'numberOfWinnerInRank11InFrance' => $userSelectionRq->getNumberOfWinnerInRank11InFrance(),
                    'numberOfWinnerInRank11InEurope' => $userSelectionRq->getNumberOfWinnerInRank11InEurope(),
                    'rankReport11' => $userSelectionRq->getRankReport11(),
                    'numberOfWinnerInRank12InFrance' => $userSelectionRq->getNumberOfWinnerInRank12InFrance(),
                    'numberOfWinnerInRank12InEurope' => $userSelectionRq->getNumberOfWinnerInRank12InEurope(),
                    'rankReport12' => $userSelectionRq->getRankReport12(),
                    'numberOfWinnerInRank13InFrance' => $userSelectionRq->getNumberOfWinnerInRank13InFrance(),
                    'numberOfWinnerInRank13InEurope' => $userSelectionRq->getNumberOfWinnerInRank13InEurope(),
                    'rankReport13' => $userSelectionRq->getRankReport13(),
                ];*/

                if (!empty($userCommonBallsArray) && !empty($userCommonStarsArray)) {
                    $userResultsDrawId = [
                        'userCommonBallsArray' => $userCommonBallsArray,
                        'userCommonStarsArray' => $userCommonStarsArray,
                        'completeDraw' => $userSelectionRq,
                    ];
                    $countCommonBallsArray = count($userResultsDrawId['userCommonBallsArray']);
                    $countCommonStarsArray = count($userResultsDrawId['userCommonStarsArray']);
                    $categoryName = 'balls_' . $countCommonBallsArray . '_' . $countCommonStarsArray;

                } elseif (empty($userCommonBallsArray) && !empty($userCommonStarsArray)) {
                    $userResultsDrawId = [
                        'userCommonStarsArray' => $userCommonStarsArray,
                        'completeDraw' => $userSelectionRq,
                    ];
                    $countCommonStarsArray = count($userResultsDrawId['userCommonStarsArray']);
                    $categoryName = '_stars_' . $countCommonStarsArray;

                } else {
                    $userResultsDrawId = [
                        'userCommonBallsArray' => $userCommonBallsArray,
                        'completeDraw' => $userSelectionRq,
                    ];
                    $countCommonBallsArray = count($userResultsDrawId['userCommonBallsArray']);
                    $categoryName = 'balls_' . $countCommonBallsArray;
                }
                $userSelectionResults[$categoryName][$drawId] = $userResultsDrawId;
            }

            krsort($userSelectionResults);
            $userSelectionResultsPagination = [];

            foreach ($userSelectionResults as $results) {
                $resultsPagination = $paginator->paginate(
                    $results,
                    $request->query->getInt('page', 1),
                    20
                );
                $userSelectionResultsPagination[] = $resultsPagination;
            }

            return $this->render(
                'pages/grid_euromillions/user_euromillions_results.html.twig', [
                    'userSelection' => $userSelection,
                    'userSelectionResults' => $userSelectionResults,
                    'userSelectionResultsPagination' => $userSelectionResultsPagination,
                ]
            );
        }

        return $this->render('pages/grid_euromillions/index.html.twig', [
                'form' => $form,
                'selectionEuromillions' => $selectionEuromillions,
            ]
        );
    }
}
