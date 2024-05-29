jQuery('document').ready(function () {
    //jQuery("#larTemp").hide();
    jQuery("#redesSociais").hide();

    Cep();
    LarTemp();
    Submit();
    larTempForm();
    CadPet();
    linkAbas();
    CadPetUpdate();
    Vacina();
    EditarVacinas();
    jQuery("#editarVacina").hide();
    close();
    deleteRegistroVacina();
    editarVacina();
});




function larTempForm() {
    jQuery("#IdlarTemp").submit(function (e) {
        e.preventDefault();

        var valorEscolhido = $('input[name="larTemporarioS"]:checked').val();

        var token = jQuery("#token").val();
        var url = jQuery("#larTempUrl").val();

        var formData = new FormData();

        formData.append("animal", jQuery("#Animal").val());
        formData.append("vaga", valorEscolhido);
        formData.append("quantidade", jQuery("#vagas").val());
        formData.append("user_id", jQuery("#id").val());

        jQuery.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                'Authorization': 'Bearer ' + token
            },
            processData: false,
            contentType: false,
            success: function (response) {
                console.log("Sucesso!");
                // console.log(response);
            },
            error: function (xhr, status, error) {
                console.error("Erro:", error);
            }
        });
    })
}
/***********************************************************************************/


function CadPet() {
    jQuery("#IdmeusPets").submit(function (e) {
        e.preventDefault();
        ///alert("234");

        var PastaFotos = jQuery("#pastaDeFotos").val();
        var token = jQuery("#token").val();
        var url = jQuery("#MeusPetsUrl").val();
        var formData = new FormData();

        formData.append("nome", jQuery("#nomePet").val());
        formData.append("tipo", jQuery("#tipoPet").val());
        formData.append("user_id", jQuery("#id").val());

        var fotoPet = document.getElementById('fotoPet').files[0];
        if (fotoPet) {
            formData.append("foto", fotoPet);
        }


        jQuery.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                'Authorization': 'Bearer ' + token
            },
            processData: false,
            contentType: false,
            success: function (response) {
                console.log("Sucesso!");
                jQuery("#listandoOsPets").children().remove();
                for (var key in response) {
                    jQuery("#listandoOsPets").append(
                        "<li>" + response[key]['nome'] + " --- <img src=" + storagePath + "/" + response[key]['foto'] + " /></li>"
                    );
                    //  console.log(key + " : " + response[key]['nome']);   
                }

            },
            error: function (xhr, status, error) {
                console.error("Erro:", error);
            }
        });
    });
}

/***********************************************************************************/








function LarTemp() {
    jQuery('#IdlarTempx').click(function () { jQuery("#larTemp").show(); })
}




function Cep() {
    jQuery("#cep").change(function () {
        var cep = jQuery(this).val(); // Correção aqui
        jQuery.ajax({
            url: 'http://cep.republicavirtual.com.br/web_cep.php?cep=' + cep + '&formato=jsonp',
            method: 'GET',
            success: function (response) {
                console.log(response);
                jQuery("#bairro").val(response.bairro);
                jQuery("#cidade").val(response.cidade);
                jQuery("#endereco").val(response.logradouro);
                jQuery("#uf").val(response.uf);

            },
        });
    });
}





/******************************************************************/
/************Atualizando o cadastro dos pets***********************/
function CadPetUpdate() {
    jQuery("#IdmeusPetsUpdate").submit(function (e) {
        e.preventDefault();



        var PastaFotos = jQuery("#pastaDeFotos").val();
        var token = jQuery("#token").val();
        var url = jQuery("#MeusPetsUrl").val();
        var id = jQuery("#MeusPetID").val();
        var descricao = jQuery("#descricao").val();
        var user_id = jQuery("#user_id").val();
        var formData = new FormData();


        formData.append("user_id", jQuery("#user_id").val());
        formData.append("nome", jQuery("#nomePet").val());
        formData.append("tipo", jQuery("#tipoPet").val());
        formData.append("descricao", jQuery("#descricao").val());
        formData.append("id", id);

        var fotoPet = document.getElementById('fotoPet').files[0];
        if (fotoPet) {
            formData.append("foto", fotoPet);
        }


        jQuery.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                'Authorization': 'Bearer ' + token
            },
            processData: false,
            contentType: false,
            success: function (response) {
                console.log("Sucesso!");
                jQuery("#listandoOsPets").children().remove();
                /*for (var key in response) {
                    jQuery("#listandoOsPets").append(
                        "<li>"+ response[key]['nome']+" --- <img src="+storagePath+"/"+response[key]['foto']+" /></li>"
                    );   
                }*/

            },
            error: function (xhr, status, error) {
                console.error("Erro:", error);
            }
        });

    });
}

/***********************************************************************************/
/********************Salvando as vacinas********************************************/
function Vacina() {
    jQuery("#vacinasForm").submit(function (e) {
        e.preventDefault();
        /*************************/
        var token = jQuery("#token").val();
        var url = jQuery("#urlVacina").val();
        /*********/
        var formData = new FormData();
        formData.append("pet_id", jQuery("#MeusPetID").val());
        formData.append("vacina", jQuery("#Vacina").val());
        formData.append("data", jQuery("#data").val());
        formData.append("proxima", jQuery("#proxima").val());
        /**************************/
        jQuery.ajax({
            url: url,
            type: "POST",
            data: formData,
            processData: false,
            contentType: false,
            headers: {
                'Authorization': 'Bearer ' + token
            },
            success: function (response) {

                jQuery(".listaDeVacinas").children('tbody').empty();

                jQuery("#data").val('');
                jQuery("#Vacina").val('');
                jQuery("#proxima").val('');


                var linha = 0;
                for (var key in response.dados) {
                    console.log(response.dados[linha]);
                    jQuery(".listaDeVacinas").children('tbody').append("<tr>"
                        + "<td class='VacNome'> " + response.dados[linha]['vacina'] + "</td>"
                        + "<td class='DataVac'>" + converterDataPadrao(response.dados[linha]['data']) + "</td>"
                        + "<td class='ProximaVac'>" + converterDataPadrao(response.dados[linha]['proxima']) + "  </td>"
                        + "<td class='idDaVacina'>" + response.dados[linha]['id'] + " </td>"
                        + "<td id='" + response.dados[linha]['id'] + "' class='editarVac'>editar</td>"
                        + "</tr>");
                    linha++;
                }
            }
        });
        /**************************/
    })
}
/************************************************************************************/









function Submit() {
    jQuery("#Idcadastro").submit(function (e) {
        var token = jQuery("#token").val();
        var formData = new FormData();

        e.preventDefault();


        var url = jQuery("#url").val();

        formData.append("uf", jQuery("#uf").val());
        formData.append("cidade", jQuery("#cidade").val());
        formData.append("bairro", jQuery("#bairro").val());
        formData.append("complemento", jQuery("#complemento").val());
        formData.append("numero", jQuery("#numero").val());
        formData.append("endereco", jQuery("#endereco").val());
        formData.append("cep", jQuery("#cep").val());
        formData.append("celular", jQuery("#celular").val());
        formData.append("email", jQuery("#email").val());
        formData.append("user_id", jQuery("#id").val());

        /***********************************************************/
        ///console.log(formData);
        /***********************************************************/
        jQuery.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                'Authorization': 'Bearer ' + token
            },
            processData: false,
            contentType: false,
            success: function (response) {
                console.log("Sucesso!");
                console.log(response);
            },
            error: function (xhr, status, error) {
                console.error("Erro:", error);
            }
        });
        /***********************************************************/
    });
}



function linkAbas() {
    jQuery(".linkAba").click(function () {
        jQuery("form").hide();
        jQuery(".linkAba").removeClass("efeitoAba");
        jQuery(this).addClass("efeitoAba");
        var idClicado = jQuery(this).attr("id");
        jQuery("#Id" + idClicado).show();
        console.log("Id" + idClicado);
    })
}
/************************************************************/





/************************************************************/
// JavaScript
function atualizarImagem() {
    var input = document.getElementById('fotoPet');
    var imagemPreview = document.getElementById('imagemPreview');

    // Verifica se um arquivo foi selecionado
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            // Atualiza o src da imagem de pré-visualização
            imagemPreview.src = e.target.result;
        }

        // Lê o arquivo como uma URL de dados
        reader.readAsDataURL(input.files[0]);
    }
}

/************************************************************/














/************************************************************/
/************************************************************/
function EditarVacinas() {

    jQuery(document).on('click', '.editarVac', function () {

        ////jQuery(".editarVac").click(function () {
        console.clear();
        const vacina = jQuery(this).siblings('.VacNome').html();
        const data = jQuery(this).siblings('.DataVac').html();
        const proxima = jQuery(this).siblings('.ProximaVac').html();
        const id = jQuery(this).attr('id');

        console.log(data);
        jQuery("#editarVacina").children('label').children("#vacinaNomeEdit").val(vacina);
        jQuery("#editarVacina").children('label').children("#DataAplicVacinaEdit").val(converterData(data));
        jQuery("#editarVacina").children('label').children("#DataProximaEdit").val(converterData(proxima));
        jQuery("#editarVacina").children("#IdRegistroVacina").val(id);
        jQuery("#editarVacina").show();

        jQuery('body').prepend("<div id='fundaoEdiçoes'></div>");
        window.localStorage.setItem("aba", "editarVacina");
        window.localStorage.setItem("idVacina", id);
    });
}
/************************************************************/
/************************************************************/















/************************************************************/
/************************************************************/
function editarVacina(){
    jQuery('#editarVacina').submit(function(e){
        e.preventDefault();

        var token = jQuery("#token").val();
        const id = jQuery("#IdRegistroVacina").val();
        const vacina = jQuery("#vacinaNomeEdit").val();
        const dataApl = jQuery("#DataAplicVacinaEdit").val();
        const dataProx = jQuery("#DataProximaEdit").val();
        const url = jQuery("#urlEditarVacina").val();
        const pet = jQuery("#MeusPetID").val();
        


        var formData = new FormData();
        formData.append("id", id);
        formData.append("vacina", vacina);
        formData.append("data", dataApl);
        formData.append("proxima", dataProx);
        formData.append("pet", pet);

        /********************************************************/
        /********************************************************/
        jQuery.ajax({
            url: url,
            type: "POST",
            data: formData,
            headers: {
                'Authorization': 'Bearer ' + token
            },
            processData: false,
            contentType: false,
            success: function (response) {
                CloseDetalhes();
               jQuery(".listaDeVacinas").children('tbody').empty();
              /******************************************************/
              /******************************************************/
              var linha = 0;
              for (var key in response.dados) {
                  console.log(response.dados[linha]);
                  jQuery(".listaDeVacinas").children('tbody').append("<tr>"
                      + "<td class='VacNome'> " + response.dados[linha]['vacina'] + "</td>"
                      + "<td class='DataVac'>" + converterDataPadrao(response.dados[linha]['data']) + "</td>"
                      + "<td class='ProximaVac'>" + converterDataPadrao(response.dados[linha]['proxima']) + "  </td>"
                      + "<td class='idDaVacina'>" + response.dados[linha]['id'] + " </td>"
                      + "<td id='" + response.dados[linha]['id'] + "' class='editarVac'>editar</td>"
                      + "</tr>");
                  linha++;
              }
              /******************************************************/
              /******************************************************/
            },
            error: function (xhr, status, error) {
                console.error("Erro:", error);
            }
        });
        /********************************************************/
        /********************************************************/

    });
}

/************************************************************/
/************************************************************/














/************************************************************/
/************************************************************/
function deleteRegistroVacina() {

    jQuery('.deleteRegistroVacina').click(function () {


        resultado = window.confirm("Quer realmente deletar esse registro de vacina?");

        if (resultado == true) {


            const url = jQuery("#urlDeletVacina").val();
            var token = jQuery("#token").val();
            const id = window.localStorage.getItem("idVacina");
            const pet = jQuery("#MeusPetID").val();
            console.log("deletando o id: " + id);


            /*****************************************/
            /*****************************************/
            var formData = new FormData();
            formData.append("id", id);
            formData.append("pet", pet);

            jQuery.ajax({
                url: url,
                type: "POST",
                data: formData,
                headers: {
                    'Authorization': 'Bearer ' + token
                },
                processData: false,
                contentType: false,
                success: function (response) {
                    console.log("Sucesso!");
                    console.log(response.status);
                    if (response.status == "success") {
                        alert("registro excluido com sucesso");
                        CloseDetalhes();
                        /************************/
                        jQuery(".listaDeVacinas").children('tbody').children().remove();
                        var linha = 0;
                        for (var key in response.dados) {
                            console.log(response.dados[linha]);
                            jQuery(".listaDeVacinas").children('tbody').append("<tr>"
                                + "<td class='VacNome'> " + response.dados[linha]['vacina'] + "</td>"
                                + "<td class='DataVac'>" + converterDataPadrao(response.dados[linha]['data']) + "</td>"
                                + "<td class='ProximaVac'>" + converterDataPadrao(response.dados[linha]['proxima']) + "  </td>"
                                + "<td class='idDaVacina'>" + response.dados[linha]['id'] + " </td>"
                                + "<td id='" + response.dados[linha]['id'] + "' class='editarVac'>editar</td>"
                                + "</tr>");
                            linha++;
                        }
                        /************************/
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Erro:", error);
                }
            });
            /*****************************************/
            /*****************************************/
        }
        else{
            CloseDetalhes();
        }
    });


}
/***********************************************************/


















/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
function close() {
    jQuery(document).on('click', '.close', function () {
        console.log("foi, deu certo");
        CloseDetalhes();
    });

}

function CloseDetalhes() {
    jQuery('#fundaoEdiçoes').remove();
    var aba = window.localStorage.getItem('aba');
    jQuery("#" + aba + "").hide();
}
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/

















/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
function converterData(data) {
    // Separando os componentes da data
    const partesData = data.split('/');

    // Criando um objeto Date com os componentes da data
    const dataObjeto = new Date(partesData[2], partesData[1] - 1, partesData[0]);

    // Obtendo os componentes da data (ano, mês e dia)
    const ano = dataObjeto.getFullYear();
    const mes = String(dataObjeto.getMonth() + 1).padStart(2, '0'); // Adicionando zero à esquerda se for necessário
    const dia = String(dataObjeto.getDate()).padStart(2, '0'); // Adicionando zero à esquerda se for necessário

    // Criando a string formatada no formato desejado "yyyy-MM-dd"
    const dataFormatada = `${ano}-${mes}-${dia}`;

    return dataFormatada;
}
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/








/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
function converterDataPadrao(data) {
    // Separando os componentes da data
    const partesData = data.split('-');

    // Criando um objeto Date com os componentes da data
    const dataObjeto = new Date(partesData[0], partesData[1] - 1, partesData[2]);

    // Obtendo os componentes da data (ano, mês e dia)
    const ano = dataObjeto.getFullYear();
    const mes = String(dataObjeto.getMonth() + 1).padStart(2, '0'); // Adicionando zero à esquerda se for necessário
    const dia = String(dataObjeto.getDate()).padStart(2, '0'); // Adicionando zero à esquerda se for necessário

    // Criando a string formatada no formato desejado "dd-MM-yyyy"
    const dataFormatada = `${dia}/${mes}/${ano}`;

    return dataFormatada;
}
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/
/*************************************************************/