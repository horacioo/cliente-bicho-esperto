@extends('pets.templates.TemplateBase')

@section('titulo')
   {{ $dados->nome }}
@endsection


@section('menu')
    <ul>
        <li>link 1</li>
        <li>link 2</li>
    </ul>
@endsection




@section('conteudo')

        <!--------------------------->
        <div class="caixa" >
  
            <h2>{{ $dados->nome }} é um(a)
            @if ($dados->tipo == 1) Cachorro  @endif
            @if ($dados->tipo == 2) Gato @endif
            @if ($dados->tipo == 3) Peixe @endif
            @if ($dados->tipo == 4) Pássaro @endif
            @if ($dados->tipo == 5) Reptil @endif
            @if ($dados->tipo == 5) Outro @endif
            </h2>

            <p class="text">
               {{ $dados->descricao }}
            </p>
            <p><img id="imagemPreview" class="thumbMini" src="{{ asset('storage/' . $dados->foto) }}"> </p>

        </div>




@endsection
