<?php
namespace App\Http\Controllers\Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Users;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use PHPMailer\PHPMailer\PHPMailer as PHPMailer ;
use PHPMailer\PHPMailer\Exception;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('username', 'email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            if ($user->role == 1) {
                return redirect()->route('home_admin');
            }
            return redirect()->route('home')->withErrors(['email' => 'Invalid credentials.']);
        }

        return redirect()->route('login')->withErrors(['email' => 'Invalid credentials.']);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    
    public function reset_password()
    {
        return view('auth.resetpassword');
    }

    public function checkmail(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        $email = $request->input('email');
        $user = Users::where('email', $email)->first();

        if ($user) {
            // Tạo token
            $token = Str::random(60);
            DB::table('password_resets')->insert([
                'email' => $email,
                'token' => $token,
                'created_at' => now(),
            ]);

            // Gửi email
            $resetLink = route('update_password', ['token' => $token]);

            $mail = new PHPMailer(true);

            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'thetoan.011204@gmail.com';
                $mail->Password = 'gwzc jkgt ljtw ympy';
                $mail->SMTPSecure = 'ssl';
                $mail->Port = 465;

                $mail->setFrom('thetoan.011204@gmail.com', 'toan phamne');
                $mail->addAddress($email, $user->username);

                $mail->isHTML(true);
                $mail->Subject = 'Update Password';
                $mail->Body = "Nhấn vào đây để khôi phục mật khẩu của bạn: <a href=\"$resetLink\">Khôi phục mật khẩu</a>";

                $mail->send();
                return back()->with('message', 'Email đã được gửi. Vui lòng kiểm tra hộp thư của bạn.');
            } catch (Exception $e) {
                return back()->withErrors(['error' => 'Không thể gửi email. Vui lòng thử lại sau.']);
            }
        } else {
            return back()->withErrors(['error' => 'Email chưa được đăng ký'])->withInput();
        }
    }

    public function update_password(Request $request, $token)
    {
        $tokenData = DB::table('password_resets')->where('token', $token)->first();

        if (!$tokenData) {
            return redirect()->route('reset_password')->withErrors(['token' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        return view('auth.updatepassword', ['token' => $token]);
    }

    public function handleUpdatePassword(Request $request)
    {
        $request->validate([
            'token' => 'required',
            'password' => 'required|confirmed',
        ]);

        $tokenData = DB::table('password_resets')->where('token', $request->input('token'))->first();

        if (!$tokenData) {
            return back()->withErrors(['token' => 'Token không hợp lệ hoặc đã hết hạn.']);
        }

        $user = Users::where('email', $tokenData->email)->first();

        if (!$user) {
            return back()->withErrors(['email' => 'Email không tồn tại.']);
        }

        $user->password = bcrypt($request->input('password'));
        $user->save();

        DB::table('password_resets')->where('email', $tokenData->email)->delete();

        return redirect()->route('login')->with('message', 'Mật khẩu của bạn đã được cập nhật.');
    }

}
