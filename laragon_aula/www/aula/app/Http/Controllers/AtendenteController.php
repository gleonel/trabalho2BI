<?php

namespace App\Http\Controllers;;

use App\Models\Atendente;
use Illuminate\Http\Request;
use App \Http\Controllers\Controller;

class PacienteController extends Controller
{
    /**
    * @var Atendente
    */
    private $atendente;

    public function construct(Atendente $atendente)
    {
        $this->atendente = $atendente;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $atendente = $this->atendente->paginate(15);
        return view('atendente.index', compact('atendente'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('atendente.create');
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
            $atendente = $this->atendente->create($data);


            flash('Atendente criado com sucesso!')->success();
            return redirect()->route('atendente.index');

        } catch (\Exception $e) {
            $message = 'Erro ao criar atendente!';

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
     * @param  \App\Models\Atendente $atendente
     * @return \Illuminate\Http\Response
     */
    public function show(Atendente $atendente)
    {
        return view('atendente.edit', compact('atendente'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Atendente $atendente
     * @return \Illuminate\Http\Response
     */
    public function edit(Atendente $atendente)
    {
        return redirect()->route('atendente.show', ['atendente' => $atendente->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Atendente $atendente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Atendente $atendente)
    {
        $data = $request->all();

        try {
            $atendente->update($data);

            flash('Atendente atualizado com sucesso!')->success();
            return redirect()->route('atendente.show', ['atendente' => $atendente->id]);

        } catch (\Exception $e) {
            $message = 'Erro ao atualizar atendente!';

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
     * @param  \App\Models\Atendente $atendente
     * @return \Illuminate\Http\Response
     */
    public function destroy(Atendente $atendente)
    {
        try {
            $atendente->delete();
            flash('Atendente removido com sucesso!')->success();
            return redirect()->route('atendente.index');

        } catch (\Exception $e) {
            $message = 'Erro ao remover atendente!';

            if(env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
        flash($message)->warning();
        return redirect()->back();
        }
    }
}
