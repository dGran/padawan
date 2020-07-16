<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Exports\SeasonsPostsExport;
use App\Imports\SeasonsPostsImport;
use Maatwebsite\Excel\Facades\Excel;
use RealRashid\SweetAlert\Facades\Alert;

use App\SeasonPost;
use App\Tournament;
use App\Season;

class SeasonPostController extends Controller
{
	public function selector()
	{
		$tournaments = Tournament::orderBy('name')->get();

		if ($tournaments->count() == 0) {
            flash()->error('No existen torneos, debe existir al menos uno para poder acceder a los participantes');
            return back();
		}

		return view('admin.seasons_posts.selector', ['tournaments' => $tournaments]);
	}

	public function selectorSelect()
	{
		$tournament = Tournament::find(request()->tournament_id);

		if ($tournament && request()->season_slug) {
			return redirect()->route('admin.seasons_posts', [$tournament, request()->season_slug]);
		} else {
			return back();
		}
	}

    public function loadSeasons($tournament_id)
    {
		$seasons = Season::where('tournament_id', '=', $tournament_id)->orderBy('name')->get();

		if ($seasons->count()> 0) {
    		return view('admin.seasons_posts.selector.seasons', ['seasons' => $seasons])->render();
		}
    }

    public function list(Tournament $tournament, Season $season)
    {
        $perPage = request()->perPage;
        $perPage = request()->perPage ? request()->perPage : 10;
        $order = request()->order ? request()->order : 'id';
        $filterName = request()->filterName;
        $filterType = request()->filterType;
        $page = request()->page;
        if (!$page) {
            if (request()->session()->get('season_post_page')) {
                $page = request()->session()->get('season_post_page');
            }
        }

        if (!request()->filtering) { // filtering determine when you use the form and exclude the first access
            if (request()->session()->get('season_post_perPage')) {
                $perPage = request()->session()->get('season_post_perPage');
            }
            if (request()->session()->get('season_post_order')) {
                $order = request()->session()->get('season_post_order');
            }
            if (request()->session()->get('season_post_filterName')) {
                $filterName = request()->session()->get('season_post_filterName');
            }
            if (request()->session()->get('season_post_filterType')) {
                $filterType = request()->session()->get('season_post_filterType');
            }
        }

        $order_ext = $this->getOrder($order, $tournament);

        $seasons_posts = SeasonPost::seasonId($season->id)->name($filterName, $tournament)->type($filterType)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage);
        if ($page > $seasons_posts->lastPage()) {
            $page = $seasons_posts->lastPage();
        }
		$seasons_posts = SeasonPost::seasonId($season->id)->name($filterName, $tournament)->type($filterType)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->Paginate($perPage, ['*'], 'page', $page);

        session(['season_post_perPage' => $perPage]);
        session(['season_post_page' => $page]);
        session(['season_post_order' => $order]);
        session(['season_post_filterName' => $filterName]);
        session(['season_post_filterType' => $filterType]);

    	return view('admin.seasons_posts.list', ['seasons_posts' => $seasons_posts, 'tournament' => $tournament, 'season' => $season, 'page' => $page, 'perPage' => $perPage, 'filterName' => $filterName, 'filterType' => $filterType, 'order' => $order]);
    }

    public function view(Tournament $tournament, Season $season, $id)
    {
        $season_post = SeasonPost::findOrFail($id);
        return view('admin.seasons_posts.view', ['season_post' => $season_post, 'tournament' => $tournament, 'season' => $season]);
    }

    public function add(Tournament $tournament, Season $season)
    {
    	return view('admin.seasons_posts.add', ['tournament' => $tournament, 'season' => $season]);
    }

    public function save(Tournament $tournament, Season $season, Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ],
        [
            'title.required' => 'El título es obligatorio',
            'content.required' => 'El contenido es obligatorio',
        ]);

        $data = $request->all();

		$data['season_id'] = $season->id;
		$data['slug'] = Str::slug($request->title, '-');
        if ($request->hasFile('img')) {
            $this->validate($request,[
                'img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ],
            [
                'img.image' => 'El logo debe ser una imagen',
                'img.mimes' => 'El logo debe ser un archivo .jpeg, .png, .jpg, .gif o .svg',
                'img.max' => 'El tamaño del logo no puede ser mayor a 2048 bytes'
            ]);

            $img_name = $data['slug'] . '.' . $request->img->extension();
            \Storage::disk('seasons_posts')->put($img_name, \File::get($request->file('img')));

            $data['img'] = $img_name;
        }
        $season_post = SeasonPost::create($data);

        if ($season_post->save()) {
            flash()->success('Registro creado correctamente');
            return redirect()->route('admin.seasons_posts', [$tournament, $season]);
        }

    }

    public function edit(Tournament $tournament, Season $season, $id)
    {
    	$season_post = SeasonPost::findOrFail($id);
    	return view('admin.seasons_posts.edit', ['season_post' => $season_post, 'tournament' => $tournament, 'season' => $season]);
    }

    public function update(Tournament $tournament, Season $season, $id, Request $request)
    {
    	$season_post = SeasonPost::findOrFail($id);

        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
        ],
        [
            'title.required' => 'El título es obligatorio',
            'content.required' => 'El contenido es obligatorio',
        ]);

        $data = $request->all();

        $data['slug'] = Str::slug($request->title, '-');
        if ($request->deleteImg) {
            // remove image from Storage
            \Storage::disk('seasons_posts')->delete($season_post->img);
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
                \Storage::disk('seasons_posts')->delete($season_post->img);

	            $img_name = $data['slug'] . '.' . $request->img->extension();
                \Storage::disk('seasons_posts')->put($img_name, \File::get($request->file('img')));

                $data['img'] = $img_name;
            }
        }

        $season_post->fill($data);

        if ($season_post->isDirty()) {
            $season_post->update($data);
            if ($season_post->update()) {
                flash()->success('Registro editado correctamente');
                return redirect()->route('admin.seasons_posts', [$tournament, $season]);
            } else {
                flash()->error('No se han guardado los datos, se ha producido un error en el servidor');
                return redirect()->route('admin.seasons_posts', [$tournament, $season]);
            }
        } else {
            flash()->info('No se han detectado cambios en el registro');
            return redirect()->route('admin.seasons_posts', [$tournament, $season]);
        }
    }

    public function destroy(Tournament $tournament, Season $season, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $season_post = SeasonPost::find($ids[$i]);
            if ($season_post && $season_post->canDestroy()) {
                $counter++;
                // remove image from Storage
                \Storage::disk('seasons_posts')->delete($season_post->img);
                $season_post->delete();
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

    public function duplicate(Tournament $tournament, Season $season, $ids)
    {
        $ids=explode(",",$ids);
        $counter = 0;
        for ($i=0; $i < count($ids); $i++)
        {
            $original = SeasonPost::find($ids[$i]);
            if ($original) {
                $counter++;
                $seasons_posts = $original->replicate();
                $random_numer = rand(100,999);
                $seasons_posts->title .= " (copia_" . $random_numer . ")";
                if ($original->img) {
                    $img_name = "copy_" . $random_numer . "_" . $original->img;
                    \Storage::disk('seasons_posts')->copy($original->img, $img_name);
                    $seasons_posts->img = $img_name;
                }
                $seasons_posts->slug = Str::slug($seasons_posts->title, '-');
                $seasons_posts->save();
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

    public function export(Tournament $tournament, Season $season, $format, $ids, $filename, $order)
    {
        $ids=explode(",",$ids);
        $order_ext = $this->getOrder($order, $tournament);
        $seasons_posts = SeasonPost::whereIn('id', $ids)->orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
        $seasons_posts->makeHidden(['img', 'slug']);

        switch ($format) {
            case 'xls':
                return (new SeasonsPostsExport($seasons_posts))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new SeasonsPostsExport($seasons_posts))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new SeasonsPostsExport($seasons_posts))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function exportGlobal(Tournament $tournament, Season $season, $format, $filename, $order)
    {
        $order_ext = $this->getOrder($order, $tournament);
		$seasons_posts = SeasonPost::orderBy($order_ext['sortField'], $order_ext['sortDirection'])->get();
		$seasons_posts->makeHidden(['img', 'slug']);

        switch ($format) {
            case 'xls':
                return (new SeasonsPostsExport($seasons_posts))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLS);
                break;
            case 'xlsx':
                return (new SeasonsPostsExport($seasons_posts))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::XLSX);
                break;
            case 'csv':
                return (new SeasonsPostsExport($seasons_posts))->download($filename . '.' . $format, \Maatwebsite\Excel\Excel::CSV);
                break;
            default:
                flash()->error('Formato de archivo no válido.');
                return back();
                break;
        }
    }

    public function import(Tournament $tournament)
    {
        if (request()->hasFile('fileImport')) {
            Excel::import(new SeasonsPostsImport, request()->file('fileImport'));
            flash()->success('Registros importados correctamente. Los registros ya existentes han sido omitidos');
        }
        return back();
    }



    /*
     * HELPERS FUNCTIONS
     *
     */
    protected function getOrder($order, $tournament) {
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
                'sortField'     => 'title',
                'sortDirection' => 'asc'
            ],
            'name_desc' => [
                'sortField'     => 'title',
                'sortDirection' => 'desc'
            ]
        ];
        return $order_ext[$order];
    }
}
