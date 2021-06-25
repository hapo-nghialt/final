<?php
namespace App\Http\ViewComposers;

use App\Models\Notification;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class OrderComposer
{
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
            $notifications = Notification::where('receiver_id', $user->id)->get();
            $view->with('orders', $orders)->with('notifications', $notifications);
        }
    }
}
