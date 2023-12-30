<?php

namespace App\Services;

use App\Mail\ReplyContactUsEmail;
use App\Mail\UserRegisterMail;
use App\Models\Admin;
use App\Models\User;
use App\Notifications\NewMessageContactUs;
use App\Repositories\ContactUsRepository;
use App\Utils\PermissionsUtil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Permission;

class ContactUsService extends BaseService
{
    public function __construct(
        ContactUsRepository $repository,
        Request $request
    ) {
        parent::__construct($repository, $request);
    }


    public function reply($id)
    {
        $record = $this->show($id);
        $record->reply = $this->request->reply;
        $record->is_replied = 1;
        $record->save();
        Mail::to($record->email)->send(new ReplyContactUsEmail($record));
    }

    public function save($request)
    {
        $user = auth('api')->user();
        $input = $request->all();
        $input['name'] = $user->name;
        $input['email'] = $user->email;
        $input['phone'] = $user->phone;
        //->request->set('phone', $user->phone);
        $contactUs = $this->repository->create($input);
        $users = Admin::permission(PermissionsUtil::CONTACT_US_MANAGE)->get();
        foreach ($users as $admin) {
            $admin->notify(new NewMessageContactUs($contactUs));
        }
    }
}
