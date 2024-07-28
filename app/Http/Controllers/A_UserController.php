<?php

namespace App\Http\Controllers;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;
use Illuminate\Http\Request;
use App\Models\Users as Users;
use Illuminate\Support\Facades\Auth;

class A_UserController extends Controller
{   
    public function export() 
    {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
    public function index()
    {   
        $user = Auth::user();
        $A_user = Users::Users()->paginate(10);
        return view('admin.A_User', compact('A_user'));
    }

    public function view_adduser()
    {
        return view('admin.A_AddUser');
    }
    public function destroy($id)
    {
        $user = Users::findOrFail($id);

        // Xóa file hình ảnh nếu tồn tại
        if ($user->image) {
            $oldImagePath = public_path('img/user/' . $user->image);
            if (file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }
        }
        $user->delete();

        return redirect()->route('A_User')->with('success', 'User deleted successfully!');
    }

    public function add_user(Request $request)
    {   
        $request->validate([
            'fullname' => 'nullable|string',
            'address' => 'nullable|string',
            'username' => 'required|string',
            'phone' => 'nullable|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
            'role' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        if ($request->phone && Users::where('phone',$request->phone)->exists()) {
            return redirect()->back()->withErrors([
                'phone'=>'Phone exists in database'
            ])->withInput();
        }
        if ( Users::where('email',$request->mail)->exists()) {
            return redirect()->back()->withErrors([
                'email'=>'Mail exists in database'
            ])->withInput();
        }
        if (Users::where('username',$request->username)->exists()) {
            return redirect()->back()->withErrors([
                'username'=>'Username exists in database'
            ])->withInput();
        }

        $imageName = null;
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/user'), $imageName);
        }

        Users::create([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'image' => $imageName,
        ]);

        return redirect()->route('view_adduser')->with('success', 'User added successfully.');
    }

    public function edit($id){
        $user = Users::findOrFail($id);
        return view('admin.A_EditUser',compact('user'));
    }

    public function update(Request $request, $id){
        $user = Users::findOrFail($id);
    
        $request->validate([
            'fullname' => 'nullable|string',
            'username' => 'nullable|string',
            'phone' => 'nullable|string',
            'address' => 'nullable|string',
            'email' => 'required|email',
            'password' => 'required|string|confirmed',
            'role' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);
    
        // Check for duplicate email
        if ($request->email != $user->email && Users::where('email', $request->email)->exists()) {
            return redirect()->back()->withErrors([
                'email' => 'Email already exists in the database.',
            ])->withInput();
        }
    
        // Check for duplicate username
        if ($request->username != $user->username && Users::where('username', $request->username)->exists()) {
            return redirect()->back()->withErrors([
                'username' => 'Username already exists in the database.',
            ])->withInput();
        }
    
        // Check for duplicate phone
        if ($request->phone && $request->phone != $user->phone && Users::where('phone', $request->phone)->exists()) {
            return redirect()->back()->withErrors([
                'phone' => 'Phone already exists in the database.',
            ])->withInput();
        }
    
        $imageName = $user->image;
    
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('img/user'), $imageName);
    
            // Delete old image if exists
            if ($user->image) {
                $oldImagePath = public_path('img/user/' . $user->image);
                if (file_exists($oldImagePath)) {
                    unlink($oldImagePath);
                }
            }
        }
    
        $user->update([
            'username' => $request->username,
            'fullname' => $request->fullname,
            'address' => $request->address,
            'phone' => $request->phone,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'role' => $request->role,
            'image' => $imageName,
        ]);
    
        return redirect()->route('A_User')->with('success', 'User updated successfully.');
    }
    
}
