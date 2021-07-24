<?php
namespace App\Http\ViewComposers;

use App\Models\Notification;
use App\Models\Order;
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
            $orders = $user->orders()->where('status', Order::STATUS['ordered'])->get();
            $notifications = Notification::where('receiver_id', $user->id)->orderBy('id', 'desc')->take(5)->get();
            $view->with('orders', $orders)->with('notifications', $notifications);
        }
    }
}
