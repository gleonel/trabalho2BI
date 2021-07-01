<?php

namespace App\Http\Controllers\Admin;;

use App\Models\Consulta;
use Illuminate\Http\Request;
use App \Http\Controllers\Controller;

class ConsultaController extends Controller
{
    /**
    * @var Consultas
    */
    private $consultas;

    public function construct(Consultas $consultas)
    {
        $this->consultas = $consultas;
    }

    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $consultas = $this->consultas->paginate(15);
        return view('consultas.index', compact('consultas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('consultas.create');
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
            $consultas = $this->consultas->create($data);


            flash('Consulta criada com sucesso!')->success();
            return redirect()->route('consultas.index');

        } catch (\Exception $e) {
            $message = 'Erro ao criar consulta!';

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
     * @param  \App\Models\Consulta  $consultas
     * @return \Illuminate\Http\Response
     */
    public function show(Consulta $consultas)
    {
        return view('consultas.edit', compact('consultas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Consulta  $consultas
     * @return \Illuminate\Http\Response
     */
    public function edit(Consulta $consultas)
    {
        return redirect()->route('consultas.show', ['consultas' => $consultas->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Consulta  $consultas
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Consulta $consultas)
    {
        $data = $request->all();

        try {
            $consultas->update($data);

            flash('Consulta atualizada com sucesso!')->success();
            return redirect()->route('consultas.show', ['consultas' => $consultas->id]);

        } catch (\Exception $e) {
            $message = 'Erro ao atualizar consulta!';

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
     * @param  \App\Models\Consulta  $consultas
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consulta $consultas)
    {
        try {
            $consultas->delete();
            flash('Consulta removida com sucesso!')->success();
            return redirect()->route('consultas.index');

        } catch (\Exception $e) {
            $message = 'Erro ao remover consultas!';

            if(env('APP_DEBUG')) {
                $message = $e->getMessage();
            }
        flash($message)->warning();
        return redirect()->back();
        }
    }
}
