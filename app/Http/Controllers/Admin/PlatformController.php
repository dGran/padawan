<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\PlatformsExport;
use App\Imports\PlatformsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\Platform;

class PlatformController extends Controller
{
    public function list()
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('platform_page')) {
                $page = request()->session()->get('platform_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('platform_perPage')) {
                $perPage = request()->session()->get('platform_perPage');
            }
            if (request()->session()->get('platform_order')) {
                $order = request()->session()->get('platform_order');
            }
            if (request()->session()->get('platform_filterName')) {
                $filterName = request()->session()->get('platform_filterName');
            }
        }

        $order_ext = $this->getOrder($order);

        $platforms = Platform::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $platforms->lastPage()) {
            $page = $platforms->lastPage();
        }
        $platforms = Platform::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['platform_perPage' => $perPage]);
        session(['platform_page' => $page]);
        session(['platform_order' => $order]);
        session(['platform_filterName' => $filterName]);

    	return view('admin.platforms.list', ['platforms' => $platforms, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'order' => $order]);
    }

    public function view($id)
    {
        $platform = Platform::findOrFail($id);
        return view('admin.platforms.view', ['platform' => $platform]);
    }

    public function add()
    {
        return view('admin.platforms.add');
    }

    public function save(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|unique:platforms,name',
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya existe',
        ]);

        $data = $request->all();
        $data['slug'] = Str::slug($request->name, '-');

        if ($request->hasFile('img')) {
            $this->validate($request,[
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'img.image' => 'El logo debe ser una imagen',
                'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
            ]);

            $img_name = $data['slug'] . '&' . time() . '.' . $request->img->extension();
            \Storage::disk('platforms')->put($img_name, \File::get($request->file('img')));

            $data['img'] = $img_name;
        }

        $platform = Platform::create($data);

        if ($platform->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.platforms');
        }
    }

    public function edit($id)
    {
        $platform = Platform::findOrFail($id);
        return view('admin.platforms.edit', ['platform' => $platform]);
    }

    public function update($id, Request $request)
    {
        $platform = Platform::findOrFail($id);

        $data['slug'] = Str::slug($request->name, '-');

        $data = $request->validate([
            'name' => 'required|unique:platforms,name,' . $platform->id,
        ],
        [
            'name.required' => 'El nombre es obligatorio',
            'name.unique' => 'El nombre ya existe',
        ]);

        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('platforms')->delete($platform->img);
            $data['img'] = null;
        } else {
            if ($request->hasFile('img')) {
                $this->validate($request,[
                    'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                ],
                [
                    'img.image' => 'El logo debe ser una imagen',
                    'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                    'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
                ]);

                // remove image from Storage
                \Storage::disk('platforms')->delete($platform->img);

	            $img_name = $data['slug'] . '&' . time() . '.' . $request->img->extension();
                \Storage::disk('platforms')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }
        $platform->fill($data);

        if ($platform->isDirty()) {
            $platform->update($data);
            if ($platform->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.platforms');
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.platforms');
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.platforms');
        }
    }

    public function destroy($ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $platform = Platform::find($ids[$i]);
            if ($platform && $platform->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('platforms')->delete($platform->img);
                $platform->delete();
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
            $original = Platform::find($ids[$i]);
            if ($original) {
                $counter++;
                $platform = $original->replicate();
                $platform->name .= " (copia_" . rand(100,999) . ")";
                if ($original->img) {
                    $img_name = "copy_" . $original->img;
                    \Storage::disk('platforms')->copy($original->img, $img_name);
                    $platform->img = $img_name;
                }
                $platform->slug = Str::slug($platform->name, '-');
                $platform->save();
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
        $platforms = Platform::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new PlatformsExport($platforms))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PlatformsExport($platforms))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PlatformsExport($platforms))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal($format, $filename, $order, $filterName = null) {
        $order_ext = $this->getOrder($order);
        $platforms = Platform::name($filterName)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();

        switch ($format) {
            case 'xls':
                return (new PlatformsExport($platforms))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new PlatformsExport($platforms))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new PlatformsExport($platforms))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
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
            Excel::import(new PlatformsImport, request()->file('fileImport'));
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
            'id' => [
                'sortField'     => 'id',
                'sortDirection' => 'asc'
            ],
            'id_desc' => [
                'sortField'     => 'id',
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