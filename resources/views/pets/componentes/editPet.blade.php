
<?php $photosPath = public_path('storage'); ?>

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


       
                @if ($PetsData != null && $PetsData != "" && $PetsData != "undefined")
                    <ul id="listandoOsPets">
                        @foreach ($PetsData as $pet)
                            <li>
                                <img class="img-thumbnail" src="{{ asset('storage/' . $pet->foto) }}">
                                <!--<div>Nome do Pet: {{ $pet->nome }} | editar | excluir</div>-->
                            </li>
                        @endforeach
                    </ul>
                @endif


                <!--------------------------->
            </form>