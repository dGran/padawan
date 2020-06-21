<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use Illuminate\Support\Facades\Hash;
use App\User;
use App\Profile;

class UserController extends Controller
{
    public function list()
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'register_date';
        $filterName = request()->filterName;
        $filterOnlyAdmin = request()->filterOnlyAdmin == "on" ? 1 : '';
        $filterOnlyVerified = request()->filterOnlyVerified == "on" ? 1 : '';
        $filterOnlyNotVerified = request()->filterOnlyNotVerified == "on" ? 1 : '';
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('user_page')) {
                $page = request()->session()->get('user_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('user_perPage')) {
                $perPage = request()->session()->get('user_perPage');
            }
            if (request()->session()->get('user_order')) {
                $order = request()->session()->get('user_order');
            }
            if (request()->session()->get('user_filterName')) {
                $filterName = request()->session()->get('user_filterName');
            }
            if (request()->session()->get('user_filterOnlyAdmin')) {
                $filterOnlyAdmin = request()->session()->get('user_filterOnlyAdmin');
            }
            if (request()->session()->get('user_filterOnlyVerified')) {
                $filterOnlyVerified = request()->session()->get('user_filterOnlyVerified');
            }
            if (request()->session()->get('user_filterOnlyNotVerified')) {
                $filterOnlyNotVerified = request()->session()->get('user_filterOnlyNotVerified');
            }
        }

        $order_ext = $this->getOrder($order);

        $users = User::name($filterName)->onlyNotVerified($filterOnlyNotVerified)->onlyVerified($filterOnlyVerified)->onlyAdmin($filterOnlyAdmin)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $users->lastPage()) {
            $page = $users->lastPage();
        }
        $users = User::name($filterName)->onlyNotVerified($filterOnlyNotVerified)->onlyVerified($filterOnlyVerified)->onlyAdmin($filterOnlyAdmin)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['user_perPage' => $perPage]);
        session(['user_page' => $page]);
        session(['user_order' => $order]);
        session(['user_filterName' => $filterName]);
        session(['user_filterOnlyAdmin' => $filterOnlyAdmin]);
        session(['user_filterOnlyVerified' => $filterOnlyVerified]);
        session(['user_filterOnlyNotVerified' => $filterOnlyNotVerified]);

    	return view('admin.users.list', ['users' => $users, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterOnlyAdmin' => $filterOnlyAdmin, 'filterOnlyVerified' => $filterOnlyVerified, 'filterOnlyNotVerified' => $filterOnlyNotVerified, 'order' => $order]);
    }

    public function view($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.view', ['user' => $user]);
    }

    public function add()
    {
        return view('admin.users.add');
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required|min:8',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya existe',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El password es obligatorio',
            'password.min' => 'El password tiene que tener mínimo 8 caracteres'
        ]);

        $data = $request->all();
        $data['email_verified_at'] = now();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if ($user->save()) {
            $user->profile()->save(new Profile);

            $user->profile->birthdate = $request->birthdate;
            $user->profile->location = $request->location;
            $user->profile->ps_id = $request->ps_id;
            $user->profile->xbox_id = $request->xbox_id;
            $user->profile->steam_id = $request->steam_id;
            $user->profile->origin_id = $request->origin_id;
            $user->profile->whatsapp = $request->whatsapp;
            $user->profile->twitter = $request->twitter;
            $user->profile->facebook = $request->facebook;
            $user->profile->instagram = $request->instagram;
            if ($request->hasFile('avatar')) {
                $this->validate($request,[
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'avatar.image' => 'El avatar debe ser una imagen',
                    'avatar.mimes' => 'El avatar debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                    'avatar.max' => 'El tamaño del avatar no puede ser mayor a 2048 bytes'
                ]);

                $avatar_name = 'avatar_' . $user->id .'&' . time() . '.' . $request->avatar->extension();
                \Storage::disk('avatars')->put($avatar_name, \File::get($request->file('avatar')));

                $user->profile->avatar = $avatar_name;
            }

            $user->profile->save();

            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.users');
        }
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update($id, Request $request)
    {
        $user = User::findOrFail($id);

        $data = $request->validate([
            'name' => 'required|unique:users,name,' .$user->id,
            'email' => 'required|unique:users,email,' .$user->id,
            'password' => 'required|min:8',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya existe',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El password es obligatorio',
            'password.min' => 'El password tiene que tener mínimo 8 caracteres'
        ]);

        if ($request->password != $user->password) {
            $data['password'] = Hash::make($data['password']);
        }

        if ($request->deleteAvatar) {
            // remove image from Storage
            \Storage::disk('avatars')->delete($user->profile->avatar);
            $data['avatar'] = null;
        } else {
            if ($request->hasFile('avatar')) {
                $this->validate($request,[
                    'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'avatar.image' => 'El avatar debe ser una imagen',
                    'avatar.mimes' => 'El avatar debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                    'avatar.max' => 'El tamaño del avatar no puede ser mayor a 2048 bytes'
                ]);

                // remove image from Storage
                \Storage::disk('avatars')->delete($user->profile->avatar);

                $avatar_name = 'avatar_' . $user->id .'&' . time() . '.' . $request->avatar->extension();
                \Storage::disk('avatars')->put($avatar_name, \File::get($request->file('avatar')));

                $data['avatar'] = $avatar_name;
            }
        }
        $data['birthdate'] = $request->birthdate;
        $data['location'] = $request->location;
        $data['ps_id'] = $request->ps_id;
        $data['xbox_id'] = $request->xbox_id;
        $data['steam_id'] = $request->steam_id;
        $data['origin_id'] = $request->origin_id;
        $data['whatsapp'] = $request->whatsapp;
        $data['twitter'] = $request->twitter;
        $data['facebook'] = $request->facebook;
        $data['instagram'] = $request->instagram;

        $user->fill($data);
        $user->profile->fill($data);

        if ($user->isDirty() || $user->profile->isDirty()) {
            $user->update($data);
            $user->profile->update($data);
            if ($user->update() && $user->profile->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.users');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.users');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.users');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $user = User::find($ids[$i]);
            if ($user && $user->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('avatars')->delete($user->profile->avatar);
                $user->delete();
            }
        }
        if ($counter > 0) {
            if ($counter == 1) {
                flash()->success('Registro eliminado correctamente');
            } else {
                flash()->success('Registros eliminados correctamente');
            }
            return back()->with('page', 1);
        } else {
            flash()->error('Acción cancelada. Los registros no han podido ser eliminados.');
            return back();
        }
    }

    public function duplicate($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = User::find($ids[$i]);
            if ($original) {
                $counter++;
                $user = $original->replicate();
                $random_numer = rand(100,999);
                $user->name .= " (copia_" . $random_numer . ")";
                $user->email .= " (copia_" . $random_numer . ")";
                $user->save();

                $user->profile = $original->profile->replicate();
                $user->profile->user_id = $user->id;
                if ($original->profile->avatar) {
                    $avatar_name = "copy_" . $random_numer . "_" . $original->profile->avatar;
                    \Storage::disk('avatars')->copy($original->profile->avatar, $avatar_name);
                    $user->profile->avatar = $avatar_name;
                }
                $user->profile->save();
            }
        }
        if ($counter > 0) {
            if ($counter == 1) {
                flash()->success('Registro duplicado correctamente');
            } else {
                flash()->success('Registros duplicados correctamente');
            }
            return back();
        } else {
            flash()->error('Acción cancelada. Los registros que querías duplicar ya no existen. Se ha actualizado la lista.');
            return back();
        }
    }

    public function export($format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order);
        $users = User::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order) {
        $order_ext = $this->getOrder($order);
        $users = User::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new UsersExport($users))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function import()
    {
        if (request()->hasFile('fileImport')) {
            Excel::import(new UsersImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }



    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order) {
        $order_ext = [
            'register_date' => [
                'sortField'     => 'created_at',
                'sortDirection' => 'asc'
            ],
            'register_date_desc' => [
                'sortField'     => 'created_at',
                'sortDirection' => 'desc'
            ],
            'name' => [
                'sortField'     => 'name',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'name',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}