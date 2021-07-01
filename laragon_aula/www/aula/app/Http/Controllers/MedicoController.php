<?php

namespace App\Http\Controllers;;

use App\Models\Medico;
use Illuminate\Http\Request;
use App \Http\Controllers\Controller;

class MedicoController extends Controller
{
    /**
    * @var Medicos
    */
    private $medicos;

    public function construct(Medicos $medicos)
    {
        $this->medicos = $medicos;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $medicos = $this->medicos->paginate(15);
        return view('medicos.index', compact('medicos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('medicos.create');
    }

    /**
    2 * Store a newly created resource in storage.
    3 *
    4 * @param \Illuminate\Http\Request $request
    5 * @return \Illuminate\Http\Response
    6 */
    public function store(Request $request)
    {
        $data = $request->all();
        try {
            $medicos = $this->medicos->create($data);


            flash('Medico criada com sucesso!')->success();
            return redirect()->route('medicos.index');

        } catch (\Exception $e) {
            $message = 'Erro ao criar médico!';

            if(env('APP_DEBUG')) {
            $message = $e->getMessage();
        }

        flash($message)->warning();
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Medico $medicos
     * @return \Illuminate\Http\Response
     */
    public function show(Medico $medicos)
    {
        return view('medicos.edit', compact('medicos'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Medico  $medicos
     * @return \Illuminate\Http\Response
     */
    public function edit(Medico $medicos)
    {
        return redirect()->route('medicos.show', ['category' => $medicos->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Medico  $medicos
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Medico $medicos)
    {
        $data = $request->all();

        try {
            $medicos->update($data);

            flash('Medico atualizado com sucesso!')->success();
            return redirect()->route('medico.show', ['category' => $medicos->id]);

        } catch (\Exception $e) {
            $message = 'Erro ao atualizar medico!';

            if(env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
        }

        flash($message)->warning();
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Medico  $medicos
     * @return \Illuminate\Http\Response
     */
    public function destroy(Medico $medicos)
    {
        try {
            $medicos->delete();
            flash('Medico removido com sucesso!')->success();
            return redirect()->route('medicos.index');

        } catch (\Exception $e) {
            $message = 'Erro ao remover medico!';

            if(env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
        flash($message)->warning();
        return redirect()->back();
        }
    }
}
