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
        $perPage = isset(request()->perPage) ? request()->perPage : 10;
        $page = request()->page;
        $sortField = request()->sortField ? request()->sortField : 'created_at';
        $sortDirection = request()->sortDirection ? request()->sortDirection : 'asc';
        $filterName = request()->filterName;

        $users = User::name($filterName)->whereNotNull('email_verified_at')->orderBy($sortField, $sortDirection)->Paginate($perPage);
        if ($page > $users->lastPage()) {
            $page = $users->lastPage();
        }
        $users = User::name($filterName)->whereNotNull('email_verified_at')->orderBy($sortField, $sortDirection)->Paginate($perPage, ['*'], 'page', $page);

    	return view('admin.users.list', ['users' => $users, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'sortField' => $sortField, 'sortDirection' => $sortDirection]);
    }

    public function view($id)
    {
        session(['current_list' => url()->previous()]);

        $user = User::findOrFail($id);
        return view('admin.users.view', ['user' => $user]);
    }

    public function add()
    {
        session(['current_list' => url()->previous()]);

        return view('admin.users.add');
    }

    public function save()
    {
        $url = request()->session()->get('current_list');
        request()->session()->forget('current_list');

        $data = request()->validate([
            'name' => 'required|unique:users,name',
            'email' => 'required|unique:users,email',
            'password' => 'required',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya existe',
            'email.required' => 'El email es obligatorio',
            'email.unique' => 'El email ya existe',
            'password.required' => 'El password es obligatorio',
        ]);

        $data['email_verified_at'] = now();
        $data['password'] = Hash::make($data['password']);

        $user = User::create($data);

        if ($user->save()) {
            $user->profile()->save(new Profile);

            $user->profile->twitter = request()->twitter;
            $user->profile->save();

            flash()->success('Registro creado correctamente');
            return redirect($url);
        }

        // $user = User::create([
        //    'name'     => request()->name,
        //    'email'    => request()->name,
        //    'email_verified_at' => now(),
        //    'password' => Hash::make('secret'),
        // ]);
        // $user->profile()->save(new Profile);

        // flash()->success('Registro creado correctamente');
        // return redirect($url);
    }

    public function edit($id)
    {
        session(['current_list' => url()->previous()]);

        $user = User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function update($id) {
        $url = request()->session()->get('current_list');
        request()->session()->forget('current_list');

        // content logic..

        flash()->success('Registro editado correctamente');
        return redirect($url);
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
                $this->remove_img_from_storage('avatars', 'avatar_' . $user->id);
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
                $user->name .= " (copia_" . rand(100,999) . ")";
                $user->email .= " (copia_" . rand(100,999) . ")";
                $user->save();
                $user->profile()->save(new \App\Profile);
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

    public function export($format, $ids, $filename, $sortField, $sortDirection)
    {
        $ids=explode(",",$ids);
        $users = User::whereIn('id', $ids)->orderBy($sortField, $sortDirection)->get();

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

    public function exportGlobal($format, $filename, $sortField, $sortDirection, $filterName = null) {
        $users = User::name($filterName)->whereNotNull('email_verified_at')->orderBy($sortField, $sortDirection)->get();

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
}