<?php

namespace App\View\Components;

use App\Enums\Rank;
use App\Enums\Tier;
use Illuminate\View\Component;

class RankedEmblem extends Component
{
    public $tier;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($tier = "")
    {
        $this->tier = $tier;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.ranked-emblem', [
            'emblem' => match ($this->tier) {
                'IRON' => 'Emblem_Iron.png',
                'BRONZE' => 'Emblem_Bronze.png',
                'SILVER' => 'Emblem_Silver.png',
                'GOLD' => 'Emblem_Gold.png',
                'PLATINUM' => 'Emblem_Platinum.png',
                'DIAMOND' => 'Emblem_Diamond.png',
                'MASTER ' => 'Emblem_Master.png',
                'GRANDMASTER' => 'Emblem_Grandmaster.png',
                'CHALLENGER' => 'Emblem_Challenger.png',
            }
        ]);
    }
}
