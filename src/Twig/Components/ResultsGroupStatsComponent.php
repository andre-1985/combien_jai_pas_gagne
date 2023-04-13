<?php

namespace App\Twig\Components;

use App\Entity\SelectionEuromillions;
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

    public function getBallsChart(): Chart
    {
        $countPerBalls = array_fill_keys($this->userSelection->ballsSelectionEuromillions, 0);
        $countPerStars = array_fill_keys($this->userSelection->starsSelection, 0);

        foreach ($this->groupResult as $result) {
            if (isset($result['userCommonBallsArray'])) {
                foreach ($countPerBalls as $key => $cpb) {
                    if (in_array($key, $result['userCommonBallsArray'])) {
                        $countPerBalls[$key]+=1;
                    }
                }
            }

            if (isset($result['userCommonStarsArray'])) {
                foreach ($countPerStars as $key => $cps) {
                    if (in_array($key, $result['userCommonStarsArray'])) {
                        $countPerStars[$key]+=1;
                    }
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
                    'label' => 'Nombre de fois gagnant',
                    'backgroundColor' => $dataColors,
                    'borderColor' => 'rgb(0, 0, 0)',
                    'data' => $dataStats,
                ],
            ],
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
        ]);

        $ballsChart->setOptions([
            'plugins' => [
                'legend' => [
                    'display' => false,
                ],
            ],
            'scales' => [
                'y' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Nb de fois gagnant'
                    ],
                    'min' => 0,
                    'suggestedMax' => 5,
                    'ticks' => [
                        'stepSize' => 1,
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => 'Boules / Etoiles'
                    ],
                ]
            ]
        ]);

        return $ballsChart;
    }
}
