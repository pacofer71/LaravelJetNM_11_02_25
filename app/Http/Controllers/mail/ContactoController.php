<?php

namespace App\Http\Controllers\mail;

use App\Http\Controllers\Controller;
use App\Mail\ContactoMailable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    public function index(){
        return view('formsemails.fcontacto');
    }
    public function send(Request $request){
        //Validaciones serán diferentes (el campo email) según estemos o no logeados
        $validacionEmail=(Auth::user()) ? ['nullable', 'email'] : ['required', 'email'];
        $request->validate([
            'name'=>['required', 'string', 'min:3', 'max:30'],
            'comentario'=>['required', 'string', 'min:5', 'max:150'],
            'email'=>$validacionEmail
        ]);
        $email = Auth::user() ? Auth::user()->email : $request->email;
        try{
            Mail::to('support@misitio.org')->send(
                new ContactoMailable($request->name, $email, $request->comentario)
            );
            return redirect()->route('inicio')->with('mensaje', 'Comentario enviado, agradecemos su retroalimentación');

        }catch(\Exception $ex){
            return redirect()->route('inicio')->with('mensaje', 'No se pudo enviar el mensaje, intentelo pasado unos minutos');
        }
     }
}
