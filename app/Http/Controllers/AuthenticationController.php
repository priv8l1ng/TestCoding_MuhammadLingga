<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Validator;
use GuzzleHttp\Exception\RequestException;

class AuthenticationController extends Controller
{
    public function loginView()
    {
        return view('components.authentication.login');
    }

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email:dns,filter,filter_unicode,rfc,strict|max:255',
            'password' => 'required|min:8',
        ], [
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'password.min' => 'Password minimal 8 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => '01',
                'message' => $validator->errors()->first(),
            ]);
        }

        if (Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'success' => true,
                'status' => '00',
                'message' => 'Login berhasil!',
            ]);
        }
    }

    public function registerView()
    {
        return view('components.authentication.register');
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nama' => 'required|min:3',
            'no_hp' => 'required|numeric',
            'alamat' => 'required|min:3',
            'kota' => 'required',
            'provinsi' => 'required',
            'role' => 'required',
            'email' => 'required|email:dns,filter,filter_unicode,rfc,strict|max:255|unique:users',
            'password' => 'required|min:8',
            'confirm-password' => 'required|same:password',
        ],[
            'nama.required' => 'Nama harus diisi',
            'no_hp.required' => 'Nomor HP harus diisi',
            'alamat.required' => 'Alamat harus diisi',
            'kota.required' => 'Kota harus diisi',
            'provinsi.required' => 'Provinsi harus diisi',
            'role.required' => 'Role harus diisi',
            'email.required' => 'Email harus diisi',
            'password.required' => 'Password harus diisi',
            'confirm-password.required' => 'Konfirmasi Password harus diisi',
            'confirm-password.same' => 'Konfirmasi Password harus sama dengan Password',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'status' => '01',
                'message' => $validator->errors()->first(),
            ]);
        }

        User::create([
            'nama' => $request->nama,
            'no_hp' => $request->no_hp,
            'alamat' => $request->alamat,
            'kota' => $request->kota,
            'provinsi' => $request->provinsi,
            'role' => $request->role,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json([
            'success' => true,
            'status' => '00',
            'message' => 'Pendaftaran berhasil, Silahkan Login',
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login');
    }

    public function accountSettingsView()
    {
        return view('components.dashboard.account-settings');
    }

    public function updateProfilePicture(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_profile' => 'image|mimes:jpeg,png,jpg,jfif,gif,bmp',
        ],
        [
            'update_profile.image' => 'Profile picture must be image',
            'update_profile.mimes' => 'Profile picture must be jpeg,png,jpg,gif,bmp',
        ]);

        if($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' =>  $validator->errors()->first(),
                'data' => [
                    'update_profile' => $request->update_profile,
                ],
            ]);
        }

        if(Auth::user()->foto) {
            $folderDB = explode('/', Auth::user()->foto)[0];
            $image_path = public_path('assets/media/avatars/' . $folderDB);
            File::deleteDirectory($image_path);
        }
        
        if($request->update_profile == null) {
            // update with no profile picture
           User::where('id', Auth::user()->id)->update([
               'foto' => null,
           ]);
           
           return response()->json([
               'status' => '00',
               'message' => 'Foto profil berhasil diperbarui tanpa gambar profil',
           ]);
        }

        if($request->hasFile('update_profile')    
            && $request->file('update_profile')->isValid() //
            && in_array($request->file('update_profile')->getClientOriginalExtension(), ['jpeg', 'png', 'jpg', 'jfif', 'gif', 'bmp'])) {
            $file = $request->file('update_profile');
            $filename = $file->getClientOriginalName(); // Get the original name of the file
            $folder = uniqid() . '-' . now()->timestamp;
            $encryptFolder = Crypt::encryptString($folder);
            // if(!File::exists(public_path('dashboard/media/avatars/' . $folderDB))) { // Check if the folder exists in the directory or not 
            //     $file->move(public_path('dashboard/media/avatars/' . $folder), $filename);
            // }
            $file->move(public_path('assets/media/avatars/' . $folder), $filename);

            User::where('id', Auth::user()->id)->update([
                'foto' => $folder . '/' . $filename,
            ]);

            return response()->json([
                'status' => '00',
                'message' => 'Foto profile berhasil di perbarui',
                'update_profile' => $encryptFolder,
            ]);
        }
        else
        {
            return response()->json([
                'status' => '01',
                'message' => 'Tidak ada file yang dipilih.'
            ]);
        }
    }

    public function updateName(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_name' => 'required|min:3|max:255',
        ],
        [
            'update_name.required' => 'Nama harus diisi',
            'update_name.min' => 'Nama minimal 3 karakter',
            'update_name.max' => 'Nama maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' =>  $validator->errors()->first(),
                'data' => [
                    'name' => $request->update_name,
                ],
            ]);
        }

        User::where('id', Auth::user()->id)->update([
            'nama' => $request->update_name,
        ]);

        return response()->json([
            'status' => '00',
            'message' => 'Nama berhasil di perbarui',
            'data' => [
                'name' => $request->update_name,
            ],
        ]);
    }

    public function updateKota(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_kota' => 'required|min:3|max:255',
        ],
        [
            'update_kota.required' => 'Kota harus diisi',
            'update_kota.min' => 'Kota minimal 3 karakter',
            'update_kota.max' => 'Kota maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' =>  $validator->errors()->first(),
                'data' => [
                    'kota' => $request->update_kota,
                ],
            ]);
        }

        User::where('id', Auth::user()->id)->update([
            'kota' => $request->update_kota,
        ]);

        return response()->json([
            'status' => '00',
            'message' => 'Kota berhasil di perbarui',
            'data' => [
                'kota' => $request->update_kota,
            ],
        ]);
    }

    public function updateProvinsi(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_provinsi' => 'required|min:3|max:255',
        ],
        [
            'update_provinsi.required' => 'Provinsi harus diisi',
            'update_provinsi.min' => 'Provinsi minimal 3 karakter',
            'update_provinsi.max' => 'Provinsi maksimal 255 karakter',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' =>  $validator->errors()->first(),
                'data' => [
                    'provinsi' => $request->update_provinsi,
                ],
            ]);
        }

        User::where('id', Auth::user()->id)->update([
            'provinsi' => $request->update_provinsi,
        ]);

        return response()->json([
            'status' => '00',
            'message' => 'Provinsi berhasil di perbarui',
            'data' => [
                'provinsi' => $request->update_provinsi,
            ],
        ]);
    }

    public function updateEmail(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_email' => 'required|email:rfc,dns',
        ],
        [
            'update_email.required' => 'Email harus diisi',
            'update_email.email' => 'Email harus valid',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' =>  $validator->errors()->first(),
                'data' => [
                    'email' => $request->update_email,
                ],
            ]);
        }

        User::where('id', Auth::user()->id)->update([
            'email' => $request->update_email,
        ]);

        return response()->json([
            'status' => '00',
            'message' => 'Email berhasil di perbarui',
            'data' => [
                'email' => $request->update_email,
            ],
        ]);
    }

    public function updatePhone(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'update_phone' => 'required|numeric|digits_between:10,15',
        ],
        [
            'update_phone.required' => 'Nomor HP harus diisi',
            'update_phone.numeric' => 'Nomor HP harus berupa angka',
            'update_phone.digits_between' => 'Nomor HP harus berisi antara 10 sampai 15 digit',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'message' =>  $validator->errors()->first(),
                'data' => [
                    'phone' => $request->update_phone,
                ],
            ]);
        }

        User::where('id', Auth::user()->id)->update([
            'no_hp' => $request->update_phone,
        ]);

        return response()->json([
            'status' => '00',
            'message' => 'Nomor HP berhasil di perbarui',
            'data' => [
                'phone' => $request->update_phone,
            ],
        ]);
    }

    public function updatePassword(Request $request)
    {
        $validator = Validator::make(request()->only('current_password', 'new_password', 'confirm_password'), [
            'current_password' => 'required',
            'new_password' => 'required|min:8',
            'confirm_password' => 'required|same:new_password|min:8'
        ], [
            'current_password.required' => 'Password saat ini harus diisi',
            'new_password.required' => 'Password baru harus diisi',
            'new_password.confirmed' => 'Password baru konfirmasi tidak sesuai',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'confirm_password.required' => 'Password baru konfirmasi harus diisi',
            'confirm_password.same' => 'Password baru konfirmasi tidak sesuai',
            'confirm_password.min' => 'Password baru konfirmasi minimal 8 karakter'
        ]);
        
        if ($validator->fails()) {
            return response()->json([
                'status' => '01',
                'errors' => $validator->errors(),
                'message' => $validator->errors()->first()
            ]);
        }else if (!Hash::check(request('current_password'), Auth::user()->password)) {
            return response()->json([
                'status' => '01',
                'message' => 'Password saat ini salah',
                'asdiasohdas' => $request->current_password
            ]);
        }else if (Hash::check(request('new_password'), Auth::user()->password)) {
            return response()->json([
                'status' => '01',
                'message' => 'Password baru tidak boleh sama dengan password saat ini'
            ]);
        } else {
            User::where('id', Auth::user()->id)->update([
                'password' => Hash::make(request('new_password')),
            ]);

            return response()->json([
                'status' => '00',
                'message' => 'Password berhasil di perbarui'
            ]);
        }
    }
}
