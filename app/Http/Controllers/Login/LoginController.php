<?php

namespace App\Http\Controllers\Login;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginRegister()
    {
        return view('auth.login_register'); // Trỏ đến file view chúng ta sắp tạo
    }
    public function login(Request $request)
    {
        // 1. Validate dữ liệu (Sửa 'username' -> 'mail')
        $request->validate([
            'mail' => 'required|email', // Thêm |email để chắc chắn họ nhập đúng định dạng
            'password' => 'required',
        // 'phone' => 'required|string|max:15',
        // 'register_username' => 'required|string|max:255',
        ]);

        // 2. Kiểm tra thông tin đăng nhập
        // Cột trong Database là 'email', nhưng dữ liệu từ Form gửi lên tên là 'mail'
        $credentials = [
            'email' => $request->mail, // <--- QUAN TRỌNG: Sửa dòng này
            'password' => $request->password,
        ];

        // 3. Thử đăng nhập (Đoạn dưới giữ nguyên)
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();

            if (Auth::user()->role == 1) {
                return redirect()->intended('admin/dashboard');
            }

            return redirect()->intended('/');
        }

        // 4. Báo lỗi nếu sai (Sửa 'username' -> 'mail')
        return back()->withErrors([
            'mail' => 'Email hoặc mật khẩu không đúng.', // <--- Sửa key này để lỗi hiện đúng chỗ
        ]);
    }
    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        
        return redirect('/'); // Dòng này đảm bảo quay về trang chủ
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
