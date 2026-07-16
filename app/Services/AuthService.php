<?php


namespace App\Services;

use App\Http\Resources\UserResource;
use App\Repositories\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use App\Mail\Register;
use App\Mail\trackRegister;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Exception;

class AuthService extends BaseService
{

    public function __construct(UserRepository $repository, Request $request)
    {
        parent::__construct($repository, $request);
    }

    /**
     * @param $request
     * @return bool
     */
    public function userLogin(Request $request)
    {
        
        $credentials = $request->only('email', 'password');
        if (Auth::guard('api')->attempt($credentials)) {
            // Authentication passed
            $user = Auth::guard('api')->user();
            if($user->status == 0)
            {
                throw new Exception('Account is not verified , please verify it then login');
            }
            $token = $user->createToken('authToken')->plainTextToken;
            $user->api_token = $token;
            $user->save();
            return response()->json(['token' => $token , 'user' => new UserResource($user)], 200);
        }
        throw new Exception('invalid email or password');

    }

    public function getAuthUser($guard)
    {
        return \auth()->guard($guard)->user();
    }

    public function userRegister($request)
    {
        $data = $request->validated();
        $code = substr(time(), 6);
        $data['code'] = $code;

        // إنشاء المستخدم أولاً — مستقل تماماً عن خدمة الميل
        $user = $this->repository->create($data);

        $mailData = [
            'email' => $request->email,
            'code' => $data['code'],
        ];

        // إرسال إيميل التفعيل خدمة مستقلة — لو الميل مش شغّال التسجيل بيكمّل عادي
        safeSendMail(function () use ($request, $mailData) {
            Mail::to($request->email)->send(new Register($mailData));
            Mail::to('info@elemandental.com')->send(new trackRegister($mailData));
        }, 'user register verification code');

        if($user){
            return new UserResource($user);
        }
    }

    public function activate($email, $code)
    {
        $user = $this->repository->where('email', $email)->where('code', $code)->first();

        if ($user) {
            if($user->status == 1){
                
                throw new Exception('Email Already Verified , go to login page');
            }else{
                $user->status = 1;
                $user->code = null;
                $user->api_token =  $user->createToken('MyApp')->plainTextToken;
                $user->save();
            }
            $token = $user->createToken('authToken')->plainTextToken;
            return response()->json(['token' => $token , 'user' => new UserResource($user)], 200);
        }
        throw new Exception('email or code is incorrect');
    }

    public function forgetPassword($request)
    {
        $user = $this->repository->where('email',$request['email'])->first();
        if($user){
            $code = substr(time(), 6);
            $user->code = $code;
            $user->save();
            $mailData = [
                'email' => $request->email,
                'code' => $code,
            ];
            // إرسال كود الاستعادة خدمة مستقلة — لو الميل مش شغّال العملية بتكمّل
            safeSendMail(function () use ($request, $mailData) {
                Mail::to($request->email)->send(new Register($mailData));
            }, 'forget password code');

            return $code;
        }else{
            throw new Exception('Wrong Email');
        }
        
    }

    public function changePassword($request)
    {
        $user = $this->repository->where('email', $request['email'])->where('code', $request['code'])->first();
        if($user){
            $user->password = bcrypt($request['password']);
            $user->save();
        }else{
            throw new Exception('Wrong Email or code');
        }
        
    }

    public function logout()
    {
        $user = Auth::guard('api')->user();
        $user->api_token = null ;
        $user->save();
        Auth::logout();
    }
}
