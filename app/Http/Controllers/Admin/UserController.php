<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\UsersExport;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function list()
    {
        $perPage = isset(request()->perPage) ? request()->perPage : 10;
        $page = request()->page;
        $sortField = request()->sortField ? request()->sortField : 'created_at';
        $sortDirection = request()->sortDirection ? request()->sortDirection : 'asc';
        $filterName = request()->filterName;

    	$users = \App\User::name($filterName)->whereNotNull('email_verified_at')->orderBy($sortField, $sortDirection)->Paginate($perPage);
        // if ($page > $users->lastPage()) {
        //     $page = $users->lastPage();
        // }

    	return view('admin.users.list', ['users' => $users, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'sortField' => $sortField, 'sortDirection' => $sortDirection]);
    }

    public function edit($id) {
        $user = \App\User::findOrFail($id);
        return view('admin.users.edit', ['user' => $user]);
    }

    public function destroy($ids) {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $user = \App\User::find($ids[$i]);
            if ($user) {
                $counter++;
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
            flash()->error('Acción cancelada. Los registros que querías eliminar ya no existen. Se ha actualizado la lista.');
            return back();
        }
    }

    public function duplicate($ids) {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = \App\User::find($ids[$i]);
            if ($original) {
                $counter++;
                $user = $original->replicate();
                $user->name .= " (copia_" . rand ( 100 , 999 ) . ")";
                $user->email .= " (copia_" . rand ( 100 , 999 ) . ")";
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

    public function export($format, $ids, $filename) {
        $ids=explode(",",$ids);
        $users = \App\User::whereIn('id', $ids)->get();

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
}