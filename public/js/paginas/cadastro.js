jQuery('document').ready(function () {
    jQuery("#larTemp").hide();
    jQuery("#redesSociais").hide();

    Cep();
    LarTemp();
    Submit();
    larTempForm();
    CadPet();
});




function larTempForm(){
    jQuery("#larTempForm").submit(function(e) {
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
            success: function(response) {
                console.log("Sucesso!");
               // console.log(response);
            },
            error: function(xhr, status, error) {
                console.error("Erro:", error);
            }
        });
})}
/***********************************************************************************/


function CadPet() {
    jQuery("#meuPetDados").submit(function(e) {
        e.preventDefault();

        var PastaFotos= jQuery("#pastaDeFotos").val();
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
            success: function(response) {
                console.log("Sucesso!");

                  for (var key in response) {
                    jQuery("#listandoOsPets").append(
                        "<li>"+ response[key]['nome']+" --- <img src="+storagePath+"/"+response[key]['foto']+" /></li>"
                    );
                      //  console.log(key + " : " + response[key]['nome']);   
                }
                
            },
            error: function(xhr, status, error) {
                console.error("Erro:", error);
            }
        });
    });
}

/***********************************************************************************/








function LarTemp() {
    jQuery('#larTemporarioLink').click(function(){ jQuery("#larTemp").show();  })
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














function Submit() {
    jQuery("#cadastro").submit(function(e) {
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
            success: function(response) {
                console.log("Sucesso!");
                console.log(response);
            },
            error: function(xhr, status, error) {
                console.error("Erro:", error);
            }
        });
        /***********************************************************/
    });
}
