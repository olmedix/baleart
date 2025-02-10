<?php

namespace App\Http\Controllers;

use App\Models\Modality;
use App\Models\Service;
use App\Models\Zone;
use App\Models\Space;
use App\Models\Address;
use App\Models\SpaceType;
use App\Models\Municipality;
use Illuminate\Http\Request;
use App\Http\Requests\GuardarViewSpaceRequest;


class ViewSpaceController extends Controller
{

    public function index()
    {
        $spaces = Space::with('modalities', 'services')->orderByDesc('id')->paginate(5);
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

        $space = new Space();
        $space->name = $request->name;
        $space->regNumber = $request->regNumber;
        $space->observation_CA = $request->observation_CA;
        $space->observation_ES = $request->observation_ES;
        $space->observation_EN = $request->observation_EN;
        $space->email = $request->email;
        $space->phone = $request->phone;
        $space->website = $request->website;
        $space->access_types = $request->input('accessType');
        $space->totalScore = 0;
        $space->countScore = 0;
        $space->address_id = $address->id; // Se asigna la dirección recién creada
        $space->space_type_id = $request->space_type_id;
        $space->user_id = auth()->id(); // Para usar el usuario autenticado

        // Primero debe guardarse el space para darle el id a las tablas intermedias
        $space->save();

        if ($request->has('services')) {
            $space->services()->attach($request->input('services'));
        }

        if ($request->has('modalities')) {
            $space->modalities()->attach($request->input('modalities'));
        }

        return redirect()->route('spaces.index')->with('success', 'Espacio creado correctamente');
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
        // dd($space);

        $space->update();

        return back(); // Vuelve a la página origen, y vuelve a cargar el registro actualizado
    }


    public function destroy(Space $space)
    {
        // Eliminar relaciones en la tabla pivote antes de borrar el espacio
        $space->services()->detach();
        $space->modalities()->detach();

        $space->delete();
        return back()->with('status', 'Espacio eliminado correctamente');
    }
}
