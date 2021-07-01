<?php

namespace App\Http\Controllers;;

use App\Models\Paciente;
use Illuminate\Http\Request;
use App \Http\Controllers\Controller;

class PacienteController extends Controller
{
    /**
    * @var Paciente
    */
    private $paciente;

    public function construct(Paciente $paciente)
    {
        $this->paciente = $paciente;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $paciente = $this->paciente->paginate(15);
        return view('paciente.index', compact('paciente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('paciente.create');
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
            $paciente = $this->paciente->create($data);


            flash('Paciente criado com sucesso!')->success();
            return redirect()->route('paciente.index');

        } catch (\Exception $e) {
            $message = 'Erro ao criar paciente!';

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
     * @param  \App\Models\Paciente $paciente
     * @return \Illuminate\Http\Response
     */
    public function show(Paciente $paciente)
    {
        return view('paciente.edit', compact('paciente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function edit(Paciente $paciente)
    {
        return redirect()->route('paciente.show', ['paciente' => $paciente->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Paciente $paciente)
    {
        $data = $request->all();

        try {
            $paciente->update($data);

            flash('Paciente atualizado com sucesso!')->success();
            return redirect()->route('paciente.show', ['category' => $paciente->id]);

        } catch (\Exception $e) {
            $message = 'Erro ao atualizar paciente!';

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
     * @param  \App\Models\Paciente  $paciente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Paciente $paciente)
    {
        try {
            $paciente->delete();
            flash('Paciente removido com sucesso!')->success();
            return redirect()->route('medicos.index');

        } catch (\Exception $e) {
            $message = 'Erro ao remover paciente!';

            if(env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
        flash($message)->warning();
        return redirect()->back();
        }
    }
}
