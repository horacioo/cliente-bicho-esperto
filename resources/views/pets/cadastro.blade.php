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


     <div id="abas">
        <ul>
            <li><a class="linkAba" id="cadastro" href="#1">Dados Pessoais</a></li>
            <li><a class="linkAba" id="larTemp"  href="#2">Lar temporário</a></li>
            <li><a class="linkAba" id="meusPets"  href="#3">Meus Pets</a></li>
        </ul>
     </div>



 

        <form id="Idcadastro">
            <h2>Dados pessoais</h2>
            <input type="hidden" id="id" value="{{ $dados['MeuId'] }}">
            <input type="hidden" id="token" value="{{ $token }}">

            <input id='url' type="hidden" name="rotas" value="{{ route('Cadastro.salvar') }}">
            <input id='larTempUrl' type="hidden" name="rotas" value="{{ route('lar.salvar') }}">
           
            <p><label for="">Email:<input class='form-control' type="email" value={{ $dados['email'] }}
                        required="required" id="email" name="email"></label></p>

               
            <p><label for="">Celular/WhatsApp: <input class='form-control' id="celular"
                        value={{ $cadastro['celular'] }} type="text" name="celular" required="required"></label>
            </p>
            <p><label for="">Cep:<input class='form-control' type="text" id="cep" required="required"
                        name="cep" value={{ $cadastro['cep'] }}></label></p>
            <p><label for="">Endereço:<input class='form-control' type="text" id="endereco" name="endereco"
                        required="required" value={{ $cadastro['endereco'] }}></label> </p>
            <p><label for="">Numero:<input class='form-control' type="text" id="numero" required="required"
                        name="numero" value={{ $cadastro['numero'] }}></label></p>
            <p><label for="">Complemento:<input class='form-control' type="text" id="complemento"
                        required="required" name="complemento" value={{ $cadastro['complemento'] }}></label></p>
            <p><label for="">Bairro:<input class='form-control' type="text" id="bairro" required="required"
                        name="bairro" value={{ $cadastro['bairro'] }}></label></p>
            <p><label for="">Cidade:<input class='form-control' type="text" id="cidade" required="required"
                        name="cidade" value={{ $cadastro['cidade'] }}></label></p>
            <p><label for="">Estado:<input class='form-control' type="text" id="uf" required="required"
                        name="uf" value={{ $cadastro['uf'] }}></label></p>

            <section id="redesSociais">
                <h2>Redes Sociais</h2>
                <p><label>Facebook: <input class='form-control' type="text" name="facebook" id="facebook"></label></p>
                <p><label>instagram <input class='form-control' type="text" name="instagram" id="instagram"></label></p>
                <p><label>x (antigo Twitter)<input class='form-control' type="text" name="x"
                            id="x"></label></p>
                <p><label>tik-tok <input type="text" class='form-control' name='tik-tok' id="tik"></label>
                </p>
            </section>
            <button>Salvar</button>
        </form>
  


            <form id="IdlarTemp">
                <h2>Ofereço Lar temporário?</h2>

                <p><label>
                        Sim <input class='form-control' type="radio" name="larTemporarioS" id="larsim" value="1"
                            @if ($larTemp['disponivel'] == 1) checked @endif>
                        Não <input class='form-control' type="radio" name="larTemporarioS" id="larNao"
                            value="0" @if ($larTemp['disponivel'] == 0) checked @endif>
                    </label>
                </p>

                <div id="animais">
                    <p>
                        <label>Quem posso receber no lar temporário
                            <select class='form-control' id="Animal" name="animal">
                                <option value="1" @if ($larTemp['tipo'] == 1) selected @endif>Cães
                                </option>
                                <option value="2" @if ($larTemp['tipo'] == 2) selected @endif>Gatos
                                </option>
                                <option value="3" @if ($larTemp['tipo'] == 3) selected @endif>Ambos
                                </option>
                                <option value="4" @if ($larTemp['tipo'] == 4) selected @endif>Outros
                                </option>
                            </select>
                        </label>
                    </p>
                </div>

                <div>
                    <label>Vagas disponíveis: <input class='form-control' type="number" id="vagas"
                            value="{{ $larTemp['vagas'] }}"></label>
                </div>

                <button>Salvar</button>

            </form>
       





            <?php $photosPath = public_path('storage'); /*echo $photosPath;*/ ?>
            <form id="IdmeusPets" method="POST" enctype="multipart/form-data">
                <input id='MeusPetsUrl' type="hidden" name="rotas" value="{{ route('meusPets.salvar') }}">
                <h2>Cadastre seu Pet</h2>
                <input class='form-control' type="hidden" id="pastaDeFotos" value="<?php echo $photosPath; ?>">
                <p><label>Nome: <input class='form-control' type="text" name="nomePet" id="nomePet" /></label></p>
                <p><label>Meu Pet é: <select name="tipo" id="tipoPet" class='form-control'>
                            <option value="1">Cachorro</option>
                            <option value="2">Gato</option>
                            <option value="3">Peixe</option>
                            <option value="4">Pássaro</option>
                            <option value="5">Réptil</option>
                            <option value="6">Outro</option>
                        </select></label></p>       
                <p><label><input class='form-control' type="file" id="fotoPet" name="foto"></label></p>
                <input type="hidden" id="fotoPetBase64" name="foto">
                <!-- Campo oculto para armazenar a foto em base64 -->
                <p><input type="submit" value="Salvar"></p>
                <!--------------------------->
                <ul id="listandoOsPets">
                    @foreach ($PetsData as $pet)
                        
                        <?php $parametro =  $pet->id .".".$dados['MeuId'];  ?>
                        <li>
                            <a href="{{ route('petFichaEdit', ['parametro' => $parametro]) }}">
                                <img class="img-thumbnail" src="{{ asset('storage/' . $pet->foto) }}">
                            </a>
                        </li>
                    @endforeach
                </ul>

                <!--------------------------->
            </form>






     
























    <script>
        var storagePath = "{{ asset('storage/') }}";
    </script>
    <script src="{{ asset('js/jQuery.js') }}"></script>
    <script src="{{ asset('js/paginas/cadastro.js') }}"></script>

    <script></script>
@endsection
