<?php
namespace App\Http\ViewComposers;

use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderComposer
{
    public $movieList = [];
    /**
     * Create a movie composer.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Bind data to the view.
     *
     * @param  View  $view
     * @return void
     */
    public function compose(View $view)
    {
        if (Auth::user()) {
            $user = Auth::user();
            $orders = $user->orders()->get();
            $view->with('orders', $orders);
        }
    }
}
