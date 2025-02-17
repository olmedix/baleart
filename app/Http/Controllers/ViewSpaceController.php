<?php

namespace App\Http\Controllers;

use App\Models\Zone;
use App\Models\Image;
use App\Models\Space;
use App\Models\Address;
use App\Models\Comment;
use App\Models\Service;
use App\Models\Modality;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Requests\GuardarViewSpaceRequest;


class ViewSpaceController extends Controller
{

    public function index()
    {
        $spaces = Space::with('modalities', 'services')
            ->selectRaw('*, CASE WHEN countScore = 0 THEN totalScore ELSE totalScore / countScore END as score_avg')
            ->orderByDesc('score_avg')
            ->paginate(5);

        return view('space.index', ['spaces' => $spaces]);
    }



    public function create()
    {
        $spaceTypes = SpaceType::all();
        $municipalities = Municipality::all();
        $zones = Zone::all();
        $services = Service::all();
        $modalities = Modality::all();
        return view('space.create', compact('spaceTypes', 'municipalities', 'zones', 'services', 'modalities'));
    }

    public function store(GuardarViewSpaceRequest $request)
    {
        $address = Address::create([
            'name' => $request->address_name, // Asegúrate de que el campo del formulario coincida
            'municipality_id' => $request->municipality_id,
            'zone_id' => (int) $request->zone_id,
        ]);

        $space = Space::create([
            'name' => $request->name,
            'regNumber' => $request->regNumber,
            'observation_CA' => $request->observation_CA,
            'observation_ES' => $request->observation_ES,
            'observation_EN' => $request->observation_EN,
            'email' => $request->email,
            'phone' => $request->phone,
            'website' => $request->website,
            'access_types' => $request->input('accessType'),
            'totalScore' => 0,
            'countScore' => 0,
            'address_id' => $address->id, // Se asigna la dirección recién creada
            'space_type_id' => $request->space_type_id,
            'user_id' => auth()->id(), // Para usar el usuario autenticado
        ]);

        if ($request->has('services')) {
            $space->services()->attach($request->input('services'));
        }

        if ($request->has('modalities')) {
            $space->modalities()->attach($request->input('modalities'));
        }

        return redirect()->route('spaces.index')->with('status', 'Espacio creado correctamente');
    }

    public function show(Space $space)
    {
        $space->load(['address', 'spaceType', 'user']);
        return view('space.show', ['space' => $space]);
    }

    public function edit(Space $space)
    {
        $spaceTypes = SpaceType::all();
        $municipalities = Municipality::all();
        $services = Service::all();
        $modalities = Modality::all();
        $address = $space->address->name;

        return view('space.edit', compact('space', 'spaceTypes', 'municipalities', 'services', 'modalities', 'address'));
    }


    public function update(GuardarViewSpaceRequest $request, Space $space)
    {
        $space->update($request->except(['services', 'modalities', 'address_name']));


        // Actualizar servicios y modalidades (relaciones Many-to-Many)
        $space->services()->sync($request->input('services', []));
        $space->modalities()->sync($request->input('modalities', []));

        // Actualizar dirección (relación One-to-One)
        if ($space->address) {
            $space->address->update(['name' => $request->input('address_name')]);
        }

        $space->update();

        return back()->with('status', 'Espacio actualizado correctamente');
    }


    public function destroy(Space $space)
    {

        $comments = Comment::where('space_id', $space->id)->get();
        foreach ($comments as $comment) {
            // Eliminar imágenes asociadas al comentario
            $images = Image::where('comment_id', $comment->id)->get();
            foreach ($images as $image) {
                $image->delete();
            }
            $comment->delete();
        }

        // Eliminar relaciones en la tabla pivote antes de borrar el espacio
        $space->services()->detach();
        $space->modalities()->detach();

        $space->delete();
        return back()->with('status', 'Espacio eliminado correctamente');
    }
}
