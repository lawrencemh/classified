<?php

namespace app\Http\ViewComposers;

use Illuminate\View\View;
use App\Area;
class AreaComposer
{
    /**
     * Holds the area instance.
     *
     * @var App\Area $area;
     */
    private $area;

    /**
     * Get the area from session and share with view.
     *
     * @param View $view
     * @return Illuminate\View\View
     */
    public function compose(View $view)
    {
        // Find area it not set.
        if (empty($this->area)) {
            $this->area = Area::where('slug', session()->get('area', config()->get('classified.defaults.area')))->first();
        }

        // return view with area
        return $view->with('area', $this->area);
    }
}