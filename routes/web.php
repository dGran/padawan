<?php

use Illuminate\Support\Facades\Route;
use Spatie\Honeypot\ProtectAgainstSpam;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Auth::routes(['verify' => true]);
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/', 'HomeController@home')->name('home');
// password confirm middleware example
// Route::get('/', 'HomeController@home')->name('home')->middleware('password.confirm');
Route::get('/usuarios/perfil', 'HomeController@profile')->name('profile')->middleware('auth', 'verified');
Route::put('/usuarios/perfil', 'HomeController@profileUpdate')->name('profile.update')->middleware('auth', 'verified');

Route::get('/contacto', 'ContactController@index')->name('contact');
Route::post('/contacto', 'ContactController@send')->name('contact.send')->middleware(ProtectAgainstSpam::class);

Route::get('/politica_de_privacidad', 'HomeController@privacy_policy')->name('privacy_policy');
Route::get('/politica_de_cookies', 'HomeController@cookie_policy')->name('cookie_policy');

Route::prefix('/posts')->group(function () {
	Route::get('/', 'PostController@index')->name('posts');
	Route::get('{post:id}/destroy', 'PostController@destroy')->name('posts.destroy')->middleware('permission:destroy_posts');
});

Route::prefix('/torneos')->group(function () {
	Route::get('/', 'TournamentController@index')->name('tournaments');
	Route::get('/{tournament:slug}', 'TournamentController@view')->name('tournaments.view');
});

Route::prefix('/admin')->middleware(['auth', 'isAdmin', 'password.confirm'])->group(function () {
	//Dashboard
	Route::get('/', 'Admin\AdminController@dashboard')->name('admin');

	//Users
	Route::get('/usuarios', 'Admin\UserController@list')->name('admin.users');
	Route::get('/usuarios/nuevo', 'Admin\UserController@add')->name('admin.users.add');
	Route::post('/usuarios/nuevo', 'Admin\UserController@save')->name('admin.users.save');
	Route::get('/usuarios/editar/{id}', 'Admin\UserController@edit')->name('admin.users.edit');
	Route::put('/usuarios/editar/{id}', 'Admin\UserController@update')->name('admin.users.update');
	Route::get('/usuarios/ver/{id}', 'Admin\UserController@view')->name('admin.users.view');
	Route::get('/usuarios/eliminar/{ids}', 'Admin\UserController@destroy')->name('admin.users.destroy');
	Route::get('/usuarios/duplicar/{ids}', 'Admin\UserController@duplicate')->name('admin.users.duplicate');
	Route::get('/usuarios/exportar/{format}/{ids}/{filename}/{order}', 'Admin\UserController@export')->name('admin.users.export');
	Route::get('/usuarios/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\UserController@exportGlobal')->name('admin.users.export.global');
	Route::post('/usuarios/importar', 'Admin\UserController@import')->name('admin.users.import');

	//Platforms
	Route::get('/plataformas', 'Admin\PlatformController@list')->name('admin.platforms');
	Route::get('/plataformas/nueva', 'Admin\PlatformController@add')->name('admin.platforms.add');
	Route::post('/plataformas/nueva', 'Admin\PlatformController@save')->name('admin.platforms.save');
	Route::get('/plataformas/editar/{id}', 'Admin\PlatformController@edit')->name('admin.platforms.edit');
	Route::put('/plataformas/editar/{id}', 'Admin\PlatformController@update')->name('admin.platforms.update');
	Route::get('/plataformas/ver/{id}', 'Admin\PlatformController@view')->name('admin.platforms.view');
	Route::get('/plataformas/eliminar/{ids}', 'Admin\PlatformController@destroy')->name('admin.platforms.destroy');
	Route::get('/plataformas/duplicar/{ids}', 'Admin\PlatformController@duplicate')->name('admin.platforms.duplicate');
	Route::get('/plataformas/exportar/{format}/{ids}/{filename}/{order}', 'Admin\PlatformController@export')->name('admin.platforms.export');
	Route::get('/plataformas/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\PlatformController@exportGlobal')->name('admin.platforms.export.global');
	Route::post('/plataformas/importar', 'Admin\PlatformController@import')->name('admin.platforms.import');

	//Games
	Route::get('/juegos', 'Admin\GameController@list')->name('admin.games');
	Route::get('/juegos/nuevo', 'Admin\GameController@add')->name('admin.games.add');
	Route::post('/juegos/nuevo', 'Admin\GameController@save')->name('admin.games.save');
	Route::get('/juegos/editar/{id}', 'Admin\GameController@edit')->name('admin.games.edit');
	Route::put('/juegos/editar/{id}', 'Admin\GameController@update')->name('admin.games.update');
	Route::get('/juegos/ver/{id}', 'Admin\GameController@view')->name('admin.games.view');
	Route::get('/juegos/eliminar/{ids}', 'Admin\GameController@destroy')->name('admin.games.destroy');
	Route::get('/juegos/duplicar/{ids}', 'Admin\GameController@duplicate')->name('admin.games.duplicate');
	Route::get('/juegos/exportar/{format}/{ids}/{filename}/{order}', 'Admin\GameController@export')->name('admin.games.export');
	Route::get('/juegos/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\GameController@exportGlobal')->name('admin.games.export.global');
	Route::post('/juegos/importar', 'Admin\GameController@import')->name('admin.games.import');

	//Games Positions
	Route::get('/posiciones', 'Admin\GamePositionController@list')->name('admin.positions');
	Route::get('/posiciones/nueva', 'Admin\GamePositionController@add')->name('admin.positions.add');
	Route::post('/posiciones/nueva', 'Admin\GamePositionController@save')->name('admin.positions.save');
	Route::get('/posiciones/editar/{id}', 'Admin\GamePositionController@edit')->name('admin.positions.edit');
	Route::put('/posiciones/editar/{id}', 'Admin\GamePositionController@update')->name('admin.positions.update');
	Route::get('/posiciones/ver/{id}', 'Admin\GamePositionController@view')->name('admin.positions.view');
	Route::get('/posiciones/eliminar/{ids}', 'Admin\GamePositionController@destroy')->name('admin.positions.destroy');
	Route::get('/posiciones/duplicar/{ids}', 'Admin\GamePositionController@duplicate')->name('admin.positions.duplicate');
	Route::get('/posiciones/exportar/{format}/{ids}/{filename}/{order}', 'Admin\GamePositionController@export')->name('admin.positions.export');
	Route::get('/posiciones/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\GamePositionController@exportGlobal')->name('admin.positions.export.global');
	Route::post('/posiciones/importar', 'Admin\GamePositionController@import')->name('admin.positions.import');

	//Games Circuits
	Route::get('/circuitos', 'Admin\GameCircuitController@list')->name('admin.circuits');
	Route::get('/circuitos/nuevo', 'Admin\GameCircuitController@add')->name('admin.circuits.add');
	Route::post('/circuitos/nuevo', 'Admin\GameCircuitController@save')->name('admin.circuits.save');
	Route::get('/circuitos/editar/{id}', 'Admin\GameCircuitController@edit')->name('admin.circuits.edit');
	Route::put('/circuitos/editar/{id}', 'Admin\GameCircuitController@update')->name('admin.circuits.update');
	Route::get('/circuitos/ver/{id}', 'Admin\GameCircuitController@view')->name('admin.circuits.view');
	Route::get('/circuitos/eliminar/{ids}', 'Admin\GameCircuitController@destroy')->name('admin.circuits.destroy');
	Route::get('/circuitos/duplicar/{ids}', 'Admin\GameCircuitController@duplicate')->name('admin.circuits.duplicate');
	Route::get('/circuitos/exportar/{format}/{ids}/{filename}/{order}', 'Admin\GameCircuitController@export')->name('admin.circuits.export');
	Route::get('/circuitos/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\GameCircuitController@exportGlobal')->name('admin.circuits.export.global');
	Route::post('/circuitos/importar', 'Admin\GameCircuitController@import')->name('admin.circuits.import');

	//Teams
	Route::get('/equipos', 'Admin\TeamController@list')->name('admin.teams');
	Route::get('/equipos/nuevo', 'Admin\TeamController@add')->name('admin.teams.add');
	Route::post('/equipos/nuevo', 'Admin\TeamController@save')->name('admin.teams.save');
	Route::get('/equipos/editar/{id}', 'Admin\TeamController@edit')->name('admin.teams.edit');
	Route::put('/equipos/editar/{id}', 'Admin\TeamController@update')->name('admin.teams.update');
	Route::get('/equipos/ver/{id}', 'Admin\TeamController@view')->name('admin.teams.view');
	Route::get('/equipos/eliminar/{ids}', 'Admin\TeamController@destroy')->name('admin.teams.destroy');
	Route::get('/equipos/duplicar/{ids}', 'Admin\TeamController@duplicate')->name('admin.teams.duplicate');
	Route::get('/equipos/exportar/{format}/{ids}/{filename}/{order}', 'Admin\TeamController@export')->name('admin.teams.export');
	Route::get('/equipos/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\TeamController@exportGlobal')->name('admin.teams.export.global');
	Route::post('/equipos/importar', 'Admin\TeamController@import')->name('admin.teams.import');

	//Players Databases
	Route::get('/base-datos-jugadores', 'Admin\PlayerDatabaseController@list')->name('admin.players_databases');
	Route::get('/base-datos-jugadores/nueva', 'Admin\PlayerDatabaseController@add')->name('admin.players_databases.add');
	Route::post('/base-datos-jugadores/nueva', 'Admin\PlayerDatabaseController@save')->name('admin.players_databases.save');
	Route::get('/base-datos-jugadores/editar/{id}', 'Admin\PlayerDatabaseController@edit')->name('admin.players_databases.edit');
	Route::put('/base-datos-jugadores/editar/{id}', 'Admin\PlayerDatabaseController@update')->name('admin.players_databases.update');
	Route::get('/base-datos-jugadores/ver/{id}', 'Admin\PlayerDatabaseController@view')->name('admin.players_databases.view');
	Route::get('/base-datos-jugadores/eliminar/{ids}', 'Admin\PlayerDatabaseController@destroy')->name('admin.players_databases.destroy');
	Route::get('/base-datos-jugadores/duplicar/{ids}', 'Admin\PlayerDatabaseController@duplicate')->name('admin.players_databases.duplicate');
	Route::get('/base-datos-jugadores/exportar/{format}/{ids}/{filename}/{order}', 'Admin\PlayerDatabaseController@export')->name('admin.players_databases.export');
	Route::get('/base-datos-jugadores/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\PlayerDatabaseController@exportGlobal')->name('admin.players_databases.export.global');
	Route::post('/base-datos-jugadores/importar', 'Admin\PlayerDatabaseController@import')->name('admin.players_databases.import');

	//Players
	Route::get('/jugadores', 'Admin\PlayerController@list')->name('admin.players');
	Route::get('/jugadores/nuevo', 'Admin\PlayerController@add')->name('admin.players.add');
	Route::post('/jugadores/nuevo', 'Admin\PlayerController@save')->name('admin.players.save');
	Route::get('/jugadores/cargar_posiciones/{player_database_id}/{mode}/{player_position_id?}', 'Admin\PlayerController@loadPositions')->name('admin.players.load_positions');
	Route::get('/jugadores/editar/{id}', 'Admin\PlayerController@edit')->name('admin.players.edit');
	Route::put('/jugadores/editar/{id}', 'Admin\PlayerController@update')->name('admin.players.update');
	Route::get('/jugadores/ver/{id}', 'Admin\PlayerController@view')->name('admin.players.view');
	Route::get('/jugadores/eliminar/{ids}', 'Admin\PlayerController@destroy')->name('admin.players.destroy');
	Route::get('/jugadores/duplicar/{ids}', 'Admin\PlayerController@duplicate')->name('admin.players.duplicate');
	Route::get('/jugadores/exportar/{format}/{ids}/{filename}/{order}', 'Admin\PlayerController@export')->name('admin.players.export');
	Route::get('/jugadores/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\PlayerController@exportGlobal')->name('admin.players.export.global');
	Route::post('/jugadores/importar', 'Admin\PlayerController@import')->name('admin.players.import');

	//Tournaments
	Route::get('/torneos', 'Admin\TournamentController@list')->name('admin.tournaments');
	Route::get('/torneos/nuevo', 'Admin\TournamentController@add')->name('admin.tournaments.add');
	Route::post('/torneos/nuevo', 'Admin\TournamentController@save')->name('admin.tournaments.save');
	Route::get('/torneos/editar/{id}', 'Admin\TournamentController@edit')->name('admin.tournaments.edit');
	Route::put('/torneos/editar/{id}', 'Admin\TournamentController@update')->name('admin.tournaments.update');
	Route::get('/torneos/ver/{id}', 'Admin\TournamentController@view')->name('admin.tournaments.view');
	Route::get('/torneos/eliminar/{ids}', 'Admin\TournamentController@destroy')->name('admin.tournaments.destroy');
	Route::get('/torneos/duplicar/{ids}', 'Admin\TournamentController@duplicate')->name('admin.tournaments.duplicate');
	Route::get('/torneos/exportar/{format}/{ids}/{filename}/{order}', 'Admin\TournamentController@export')->name('admin.tournaments.export');
	Route::get('/torneos/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\TournamentController@exportGlobal')->name('admin.tournaments.export.global');
	Route::post('/torneos/importar', 'Admin\TournamentController@import')->name('admin.tournaments.import');

	//Seasons
	Route::get('/torneos/temporadas/selector-de-torneo', 'Admin\SeasonController@selector')->name('admin.seasons.selector');
	Route::post('/torneos/temporadas/selector-de-torneo', 'Admin\SeasonController@selectorSelect')->name('admin.seasons.selector.select');
	Route::get('/torneos/{tournament:slug}/temporadas/', 'Admin\SeasonController@list')->name('admin.seasons');
	Route::get('/torneos/{tournament:slug}/temporadas/nueva', 'Admin\SeasonController@add')->name('admin.seasons.add');
	Route::post('/torneos/{tournament:slug}/temporadas/nueva', 'Admin\SeasonController@save')->name('admin.seasons.save');
	Route::get('/torneos/{tournament:slug}/temporadas/editar/{id}', 'Admin\SeasonController@edit')->name('admin.seasons.edit');
	Route::put('/torneos/{tournament:slug}/temporadas/editar/{id}', 'Admin\SeasonController@update')->name('admin.seasons.update');
	Route::get('/torneos/{tournament:slug}/temporadas/ver/{id}', 'Admin\SeasonController@view')->name('admin.seasons.view');
	Route::get('/torneos/{tournament:slug}/temporadas/eliminar/{ids}', 'Admin\SeasonController@destroy')->name('admin.seasons.destroy');
	Route::get('/torneos/{tournament:slug}/temporadas/duplicar/{ids}', 'Admin\SeasonController@duplicate')->name('admin.seasons.duplicate');
	Route::get('/torneos/{tournament:slug}/temporadas/exportar/{format}/{ids}/{filename}/{order}', 'Admin\SeasonController@export')->name('admin.seasons.export');
	Route::get('/torneos/{tournament:slug}/temporadas/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\SeasonController@exportGlobal')->name('admin.seasons.export.global');
	Route::post('/torneos/{tournament:slug}/temporadas/importar', 'Admin\SeasonController@import')->name('admin.seasons.import');

	//Participants
	Route::get('/participantes/selector-de-temporada', 'Admin\ParticipantController@selector')->name('admin.participants.selector');
	Route::post('/participantes/selector-de-temporada', 'Admin\ParticipantController@selectorSelect')->name('admin.participants.selector.select');
	Route::get('/participantes/cargar_temporadas/{tournament_id}', 'Admin\ParticipantController@loadSeasons')->name('admin.participants.load_seasons');
	Route::get('/torneos/{tournament:slug}/{season:slug}/participantes', 'Admin\ParticipantController@list')->name('admin.participants');
	Route::get('/torneos/{tournament:slug}/{season:slug}/participantes/nuevo', 'Admin\ParticipantController@add')->name('admin.participants.add');
	Route::post('/torneos/{tournament:slug}/{season:slug}/participantes/nuevo', 'Admin\ParticipantController@save')->name('admin.participants.save');
	Route::get('/torneos/{tournament:slug}/{season:slug}/participantes/editar/{id}', 'Admin\ParticipantController@edit')->name('admin.participants.edit');
	Route::put('/torneos/{tournament:slug}/{season:slug}/participantes/editar/{id}', 'Admin\ParticipantController@update')->name('admin.participants.update');
	Route::get('/torneos/{tournament:slug}/{season:slug}/participantes/ver/{id}', 'Admin\ParticipantController@view')->name('admin.participants.view');
	Route::get('/torneos/{tournament:slug}/{season:slug}/participantes/eliminar/{ids}', 'Admin\ParticipantController@destroy')->name('admin.participants.destroy');
	Route::get('/torneos/{tournament:slug}/{season:slug}/participantes/exportar/{format}/{ids}/{filename}/{order}', 'Admin\ParticipantController@export')->name('admin.participants.export');
	Route::get('/torneos/{tournament:slug}/{season:slug}/participantes/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\ParticipantController@exportGlobal')->name('admin.participants.export.global');
	Route::post('/torneos/{tournament:slug}/{season:slug}/participantes/importar', 'Admin\ParticipantController@import')->name('admin.participants.import');

	//Reserves
	Route::get('/reservas/selector-de-temporada', 'Admin\ReserveController@selector')->name('admin.reserves.selector');
	Route::post('/reservas/selector-de-temporada', 'Admin\ReserveController@selectorSelect')->name('admin.reserves.selector.select');
	Route::get('/reservas/cargar_temporadas/{tournament_id}', 'Admin\ReserveController@loadSeasons')->name('admin.reserves.load_seasons');
	Route::get('/torneos/{tournament:slug}/{season:slug}/reservas', 'Admin\ReserveController@list')->name('admin.reserves');
	Route::get('/torneos/{tournament:slug}/{season:slug}/reservas/nuevo', 'Admin\ReserveController@add')->name('admin.reserves.add');
	Route::post('/torneos/{tournament:slug}/{season:slug}/reservas/nuevo', 'Admin\ReserveController@save')->name('admin.reserves.save');
	Route::get('/torneos/{tournament:slug}/{season:slug}/reservas/editar/{id}', 'Admin\ReserveController@edit')->name('admin.reserves.edit');
	Route::put('/torneos/{tournament:slug}/{season:slug}/reservas/editar/{id}', 'Admin\ReserveController@update')->name('admin.reserves.update');
	Route::get('/torneos/{tournament:slug}/{season:slug}/reservas/ver/{id}', 'Admin\ReserveController@view')->name('admin.reserves.view');
	Route::get('/torneos/{tournament:slug}/{season:slug}/reservas/eliminar/{ids}', 'Admin\ReserveController@destroy')->name('admin.reserves.destroy');
	Route::get('/torneos/{tournament:slug}/{season:slug}/reservas/exportar/{format}/{ids}/{filename}/{order}', 'Admin\ReserveController@export')->name('admin.reserves.export');
	Route::get('/torneos/{tournament:slug}/{season:slug}/reservas/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\ReserveController@exportGlobal')->name('admin.reserves.export.global');
	Route::post('/torneos/{tournament:slug}/{season:slug}/reservas/importar', 'Admin\ReserveController@import')->name('admin.reserves.import');

	//Competitions
	Route::get('/competiciones/selector-de-temporada', 'Admin\CompetitionController@selector')->name('admin.competitions.selector');
	Route::post('/competiciones/selector-de-temporada', 'Admin\CompetitionController@selectorSelect')->name('admin.competitions.selector.select');
	Route::get('/competiciones/cargar_temporadas/{tournament_id}', 'Admin\CompetitionController@loadSeasons')->name('admin.competitions.load_seasons');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones', 'Admin\CompetitionController@list')->name('admin.competitions');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones/nueva', 'Admin\CompetitionController@add')->name('admin.competitions.add');
	Route::post('/torneos/{tournament:slug}/{season:slug}/competiciones/nueva', 'Admin\CompetitionController@save')->name('admin.competitions.save');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones/editar/{id}', 'Admin\CompetitionController@edit')->name('admin.competitions.edit');
	Route::put('/torneos/{tournament:slug}/{season:slug}/competiciones/editar/{id}', 'Admin\CompetitionController@update')->name('admin.competitions.update');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones/ver/{id}', 'Admin\CompetitionController@view')->name('admin.competitions.view');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones/eliminar/{ids}', 'Admin\CompetitionController@destroy')->name('admin.competitions.destroy');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones/duplicar/{ids}', 'Admin\CompetitionController@duplicate')->name('admin.competitions.duplicate');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones/exportar/{format}/{ids}/{filename}/{order}', 'Admin\CompetitionController@export')->name('admin.competitions.export');
	Route::get('/torneos/{tournament:slug}/{season:slug}/competiciones/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\CompetitionController@exportGlobal')->name('admin.competitions.export.global');
	Route::post('/torneos/{tournament:slug}/{season:slug}/competiciones/importar', 'Admin\CompetitionController@import')->name('admin.competitions.import');

	//Fases
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases', 'Admin\PhaseController@list')->name('admin.phases');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/nueva', 'Admin\PhaseController@add')->name('admin.phases.add');
	Route::post('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/nueva', 'Admin\PhaseController@save')->name('admin.phases.save');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/editar/{id}', 'Admin\PhaseController@edit')->name('admin.phases.edit');
	Route::put('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/editar/{id}', 'Admin\PhaseController@update')->name('admin.phases.update');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/ver/{id}', 'Admin\PhaseController@view')->name('admin.phases.view');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/eliminar/{ids}', 'Admin\PhaseController@destroy')->name('admin.phases.destroy');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/duplicar/{ids}', 'Admin\PhaseController@duplicate')->name('admin.phases.duplicate');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/exportar/{format}/{ids}/{filename}/{order}', 'Admin\PhaseController@export')->name('admin.phases.export');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\PhaseController@exportGlobal')->name('admin.phases.export.global');
	Route::post('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/importar', 'Admin\PhaseController@import')->name('admin.phases.import');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/activar/{ids}', 'Admin\PhaseController@activate')->name('admin.phases.activate');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/fases/desactivar/{ids}', 'Admin\PhaseController@desactivate')->name('admin.phases.desactivate');

	//Grupos
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos', 'Admin\GroupController@list')->name('admin.groups');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/nuevo', 'Admin\GroupController@add')->name('admin.groups.add');
	Route::post('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/nuevo', 'Admin\GroupController@save')->name('admin.groups.save');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/editar/{id}', 'Admin\GroupController@edit')->name('admin.groups.edit');
	Route::put('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/editar/{id}', 'Admin\GroupController@update')->name('admin.groups.update');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/ver/{id}', 'Admin\GroupController@view')->name('admin.groups.view');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/eliminar/{ids}', 'Admin\GroupController@destroy')->name('admin.groups.destroy');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/duplicar/{ids}', 'Admin\GroupController@duplicate')->name('admin.groups.duplicate');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/exportar/{format}/{ids}/{filename}/{order}', 'Admin\GroupController@export')->name('admin.groups.export');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\GroupController@exportGlobal')->name('admin.groups.export.global');
	Route::post('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/importar', 'Admin\GroupController@import')->name('admin.groups.import');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/activar/{ids}', 'Admin\GroupController@activate')->name('admin.groups.activate');
	Route::get('/torneos/{tournament:slug}/{season:slug}/{competition:slug}/{phase:slug}/grupos/desactivar/{ids}', 'Admin\GroupController@desactivate')->name('admin.groups.desactivate');

	//News
	Route::get('/noticias/selector-de-temporada', 'Admin\SeasonPostController@selector')->name('admin.seasons_posts.selector');
	Route::post('/noticias/selector-de-temporada', 'Admin\SeasonPostController@selectorSelect')->name('admin.seasons_posts.selector.select');
	Route::get('/noticias/cargar_temporadas/{tournament_id}', 'Admin\SeasonPostController@loadSeasons')->name('admin.seasons_posts.load_seasons');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias', 'Admin\SeasonPostController@list')->name('admin.seasons_posts');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias/nueva', 'Admin\SeasonPostController@add')->name('admin.seasons_posts.add');
	Route::post('/torneos/{tournament:slug}/{season:slug}/noticias/nueva', 'Admin\SeasonPostController@save')->name('admin.seasons_posts.save');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias/editar/{id}', 'Admin\SeasonPostController@edit')->name('admin.seasons_posts.edit');
	Route::put('/torneos/{tournament:slug}/{season:slug}/noticias/editar/{id}', 'Admin\SeasonPostController@update')->name('admin.seasons_posts.update');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias/ver/{id}', 'Admin\SeasonPostController@view')->name('admin.seasons_posts.view');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias/eliminar/{ids}', 'Admin\SeasonPostController@destroy')->name('admin.seasons_posts.destroy');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias/duplicar/{ids}', 'Admin\SeasonPostController@duplicate')->name('admin.seasons_posts.duplicate');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias/exportar/{format}/{ids}/{filename}/{order}', 'Admin\SeasonPostController@export')->name('admin.seasons_posts.export');
	Route::get('/torneos/{tournament:slug}/{season:slug}/noticias/exportar-tabla-completa/{format}/{filename}/{order}', 'Admin\SeasonPostController@exportGlobal')->name('admin.seasons_posts.export.global');
	Route::post('/torneos/{tournament:slug}/{season:slug}/noticias/importar', 'Admin\SeasonPostController@import')->name('admin.seasons_posts.import');

	//Economy
	Route::get('/torneos/economia/selector-de-temporada', 'Admin\CashController@selector')->name('admin.cash.selector');
	Route::post('/torneos/economia/selector-de-temporada', 'Admin\CashController@selectorSelect')->name('admin.cash.selector.select');
	Route::get('/torneos/{tournament:slug}/{season:slug}/economia', 'Admin\CashController@list')->name('admin.cash');

	//Season Players
	Route::get('/torneos/jugadores/selector-de-temporada', 'Admin\SeasonPlayerController@selector')->name('admin.season_players.selector');
	Route::post('/torneos/jugadores/selector-de-temporada', 'Admin\SeasonPlayerController@selectorSelect')->name('admin.season_players.selector.select');
	Route::get('/torneos/{tournament:slug}/{season:slug}/jugadores', 'Admin\SeasonPlayerController@list')->name('admin.season_players');

	//Transfers
	Route::get('/torneos/transfers/selector-de-temporada', 'Admin\TransferController@selector')->name('admin.transfers.selector');
	Route::post('/torneos/transfers/selector-de-temporada', 'Admin\TransferController@selectorSelect')->name('admin.transfers.selector.select');
	Route::get('/torneos/{tournament:slug}/{season:slug}/transfers', 'Admin\TransferController@list')->name('admin.transfers');
});