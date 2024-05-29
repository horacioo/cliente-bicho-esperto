@extends('pets.templates.TemplateBase')

@section('titulo')
    Dados pessoais
@endsection



@section('menu')
    <ul>
        <li>link 1</li>
        <li>link 2</li>
    </ul>
@endsection





@section('conteudo')
    @if ($user_id == $dados->user_id)
        <!--------------------------->
        <?php $photosPath = public_path('storage'); /*echo $photosPath;*/ ?>
        <input type="hidden" id="token" value="{{ $token }}">
        <form id="IdmeusPetsUpdate" method="POST" enctype="multipart/form-data">
            <input id='MeusPetsUrl' type="hidden" name="rotas" value="{{ route('Pet.update') }}">
            <input id='MeusPetID' type="hidden" name="rotas" value=" {{ $dados->id }}">
            <input id='user_id' type="hidden" name="rotas" value=" {{ $dados->user_id }}">
            <h2>Dados do seu Pet</h2>
            <input class='form-control' type="hidden" id="pastaDeFotos" value="<?php echo $photosPath; ?>">
            <p><label>Nome: <input class='form-control' type="text" name="nomePet" id="nomePet"
                        value=" {{ $dados->nome }}" /></label></p>
            <p>
                <label>Meu Pet é: <select name="tipo" id="tipoPet" class='form-control'>
                        <option value="1" @if ($dados->tipo == 1) selected @endif>Cachorro</option>
                        <option value="2" @if ($dados->tipo == 2) selected @endif>Gato</option>
                        <option value="3" @if ($dados->tipo == 3) selected @endif>Peixe</option>
                        <option value="4" @if ($dados->tipo == 4) selected @endif>Pássaro</option>
                        <option value="5" @if ($dados->tipo == 5) selected @endif>Réptil</option>
                        <option value="6" @if ($dados->tipo == 6) selected @endif>Outro</option>
                    </select></label>
            </p>

            <p><label> Descrição:
                    <textarea name="descricao" id="descricao">{{ $dados->descricao }}</textarea>
                </label></p>

            <p>
                <label>

                    <input class='form-control' type="file" id="fotoPet" name="foto" onchange="atualizarImagem()">
                    <img id="imagemPreview" class="thumbMini" src="{{ asset('storage/' . $dados->foto) }}">

                </label>
            </p>






            <input type="hidden" id="fotoPetBase64" name="foto">
            <!-- Campo oculto para armazenar a foto em base64 -->
            <p><input type="submit" value="Salvar"></p>
            <!--------------------------->

            <!--------------------------->
        </form>



       








        <form id="vacinasForm">
            <input id='MeusPetID' type="hidden" name="rotas" value=" {{ $dados->id }}">
            <input id="urlVacina" type="hidden" value="{{ route('Pet.vacina') }}">
            <h2>Vacinas</h2>
            <p>
                <!------------------------------------------------------------------------->
                <label>
                       Vacina:<input class='form-control' type="text" name="Vacina" id="Vacina" required value="" /> 
                       Data:<input type="date" id="data" required >
                       proxima dose:<input type="date" id="proxima" required >
                </label>
                <!------------------------------------------------------------------------->
                <input type="submit" value="Salvar">
            </p>

            <table class='listaDeVacinas'>
            <thead>
               <td>Vacina</td>
               <td>Data da Aplicação</td>
               <td>Data da próxima aplicação</td>
               <td>-</td>
               <td>-</td>
            </thead>
            <tbody>
                @foreach($vacinas as $vac)
                <tr>
                <td class='VacNome'>{{$vac->vacina}}</td>
                <td class='DataVac'>{{ date('d/m/Y' ,strtotime($vac->data)) }} </td>
                <td class='ProximaVac'>{{date('d/m/Y' ,strtotime($vac->proxima)) }}</td>
                <td class="idDaVacina">{{$vac->id}}</td>
                <td id="{{$vac->id}}" class="editarVac">editar</td>
                </tr>
                @endforeach
            </tbody> 
            </table>


            
        </form>


        <!------editar as vacinas-------->
        <form id="editarVacina">
            <input type="hidden" id="IdRegistroVacina">
            <input type="hidden" id="urlDeletVacina" value="{{ route('Pet.DeleteVacina') }}">
            <input type="hidden" id="urlEditarVacina" value="{{ route('Pet.EditaVacina')}}">
            <label>Vacina : <input type="text" id="vacinaNomeEdit"></label>
            <label>Data de Aplicação : <input type="date" id="DataAplicVacinaEdit"></label>
            <label>Data Da Próxima dose : <input type="date" id="DataProximaEdit"></label>
            <input type="submit" value="Salvar">
            <span class="btn deleteRegistroVacina">Excluir</span> 
            <span class="close btnClose">fechar</span> 
        </form>
        <!------------------------------->
        









        <!--<img class="img-thumbnail" src="{{ asset('storage/' . $dados->foto) }}">-->
    @else
        <img class="img-thumbnail" src="{{ asset('storage/' . $dados->foto) }}">
    @endif


    <script>
        var storagePath = "{{ asset('storage/') }}";
    </script>
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="{{ asset('js/paginas/cadastro.js') }}"></script>

    <script></script>
@endsection
