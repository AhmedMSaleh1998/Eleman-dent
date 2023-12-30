<?php


namespace App\Services;


use App\Jobs\SenNotificationsJob;
use App\Models\Admin;
use App\Notifications\OnTheFlyNotification;
use App\Prototype\FilterMeta;
use App\Repository\BasketRepository;
use App\Repository\NotificationRepository;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use App\Utils\FilterUtil;
use Carbon\Carbon;
use Illuminate\Http\Request;

class NotificationService extends BaseService
{

    private $userRepository;
    /**
     * OrderService constructor.
     * @param OrderRepository $repository
     * @param Request $request
     * @param BasketRepository $basketRepository
     */
    public function __construct(
        NotificationRepository $repository,
        Request $request,
        UserRepository $userRepository
    )
    {
        parent::__construct($repository, $request);
        $this->userRepository = $userRepository;
        $this->filters['notifiable_type']  = new FilterMeta('notifiable_type', FilterUtil::EQUAL_FILTER, Admin::class);

    }

    public function paginate($order = [])
    {
        $this->filters['notifiable_id']  = new FilterMeta('notifiable_id', FilterUtil::NUMBER_FILTER, \Auth::user()->id);
        return parent::paginate($order);
    }

    public function sendNotifications($title,$message)
    {
        SenNotificationsJob::dispatch($title,$message, $this->userRepository);
    }


}
