<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comandes;

class ComandesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $comandes = Comandes::all();
        return response()->json(['comandes' => $comandes], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'mail' => 'required|email',
            'data_comanda' => 'required|date',
            'parking' => 'nullable|boolean',
            'catering' => 'nullable|boolean',
        ]);

        $comanda = new Comandes;
        $comanda->mail = $request->input('mail');
        $comanda->data_execucio = $request->input('data_comanda');
        $comanda->parking = $request->input('parking');
        $comanda->catering = $request->input('catering');
        $comanda->estat = 'pendent';
        $comanda->save();

        return response()->json(['message' => 'Comanda creada amb èxit', 'comanda' => $comanda], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(Comandes $comanda)
    {
        return response()->json($comanda, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Comandes $comanda)
    {
        $this->validate($request, [
            'estat' => 'required|in:pendent,acceptada,cancel·lada,tancada',
        ]);

        $comanda = Comanda::find($idcomanda);

        if (!$comanda) {
            return response()->json(['message' => 'Comanda no trobada'], 404);
        }

        $comanda->estat = $request->input('estat');
        $comanda->save();

        return response()->json(['message' => 'Comanda actualitzada amb èxit', 'comanda' => $comanda], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Comandes $comanda)
    {
        if ($comanda->estat === 'pendent' || $comanda->estat === 'cancel·lada') {
            $comanda->delete();
            return response()->json([
                'message' => 'Comanda eliminada correctament.'
            ], 200);
        } else {
            return response()->json([
                'error' => 'La comanda ja està confirmada o no tens permissos per eliminar-la'
            ], 400);
        }
    }
    // Client llista les seves comandes
    public function getClientComandes($mail)
    {
        $comandes = Comanda::where('mail', $mail)->get();

        return response()->json(['comandes' => $comandes], 200);
    }
    // Administrador llista totes les comandes pendents
    public function getPendentComandes()
    {
        $comandes = Comanda::where('estat', 'pendent')->get();

        return response()->json(['comandes' => $comandes], 200);
    }

    // Administrador mostra una comanda per id
    public function getComandaById($idcomanda)
    {
        $comanda = Comanda::find($idcomanda);

        return response()->json(['comanda' => $comanda], 200);
    }
}
