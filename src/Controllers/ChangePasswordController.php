<?php

namespace Exceedone\Exment\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Exceedone\Exment\Model\LoginUser;
use Exceedone\Exment\Model\Define;
use Exceedone\Exment\Validator\CurrentPasswordRule;

class ChangePasswordController extends Controller
{
    use \Exceedone\Exment\Controllers\AuthTrait;

    /**
     * Get the password reset validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'current_password' => ['required', new CurrentPasswordRule],
            'password' => get_password_rule(true, \Exment::user()),
        ];
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string|null  $token
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showChangeForm(Request $request)
    {
        return view('exment::auth.change')->with(
            $this->getLoginPageData()
        );
    }

    /**
     * Change the given user's password.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function change(Request $request)
    {
        $this->validate($request, $this->rules());

        $user = \Exment::user();
        $password = $request->get('password');

        $this->changePassword($user, $password);

        $request->session()->forget(Define::SYSTEM_KEY_SESSION_PASSWORD_LIMIT);

        admin_toastr(exmtrans('user.message.change_succeeded'));
        return redirect(admin_url('auth/login'));
    }

    /**
     * Update the given user's password.
     *
     * @param  LoginUser  $user
     * @param  string  $password
     * @return void
     */
    protected function changePassword(LoginUser $user, $password)
    {
        // password sets at LoginUser Model
        $user->password = $password;
        $user->saveOrFail();
    }
}
