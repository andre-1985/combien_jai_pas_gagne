<?php

namespace App\Twig\Components;

use App\Entity\SelectionEuromillions;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent('results_group_stats')]
final class ResultsGroupStatsComponent
{
    public SelectionEuromillions $userSelection;
    public array $groupResult;

    public function __construct(
        private readonly ChartBuilderInterface $chartBuilder,
    ) {
    }

    public function getBallsChart(): array
    {
        foreach ($this->groupResult as $result) {
            if (isset($result['userCommonBallsArray'])) {
                $countPerBalls = array_fill_keys($this->userSelection->ballsSelectionEuromillions, 0);
                $userCommonBallsArray = $result['userCommonBallsArray'];
                foreach ($userCommonBallsArray as $cB) {
                    $countPerBalls[$cB]++;
                }
            }

            if (isset($result['userCommonStarsArray'])) {
                $countPerStars = array_fill_keys($this->userSelection->starsSelection, 0);
                foreach ($result['userCommonStarsArray'] as $cS) {
                    $countPerStars[$cS] = ++$countPerStars[$cS];
                }
            }
        }

        $ballsChart = $this->chartBuilder->createChart(Chart::TYPE_BAR);

        if (isset($countPerBalls)) {
            foreach ($countPerBalls as $countPerBall) {
                $ballsStats[] = $countPerBall;
            }
        }

        if (isset($countPerStars)) {
            foreach ($countPerStars as $countPerStar) {
                $starsStats[] = $countPerStar;
            }
        }

        if (isset($ballsStats) && isset($starsStats)) {
            $labelsSelection = array_merge($this->userSelection->ballsSelectionEuromillions, $this->userSelection->starsSelection);
            $dataStats = array_merge($ballsStats, $starsStats);
            $dataColors = array_fill(0, count($this->userSelection->ballsSelectionEuromillions), 'rgb(0, 51, 153)');
            $starsColors = array_fill(0, count($this->userSelection->starsSelection), 'rgb(238, 187, 5)');
            foreach ($starsColors as $starsColor) {
                $dataColors[] = $starsColor;
            }
        }
        elseif (isset($ballsStats) && !isset($starsStats)) {
            $labelsSelection = $this->userSelection->ballsSelectionEuromillions;
            $dataStats = $ballsStats;
            $dataColors = array_fill(0, count($dataStats), 'rgb(0, 51, 153)');
        }
        elseif (!isset($ballsStats) && isset($starsStats)) {
            $labelsSelection = $this->userSelection->starsSelection;
            $dataStats = $starsStats;
            $dataColors = array_fill(0, count($dataStats), 'rgb(238, 187, 5)');
        }

        $ballsChart->setData([
            'labels' => $labelsSelection,
            'datasets' => [
                [
                    'label' => 'Numéro',
                    'backgroundColor' => $dataColors,
                    'borderColor' => 'rgb(0, 0, 0)',
                    'data' => $dataStats,
                ],
            ],
        ]);

        return $countPerBalls;
    }
}
