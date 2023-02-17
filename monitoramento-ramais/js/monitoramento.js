function atualizarRamais() {
    $.ajax({
        url: "lib/ramais.php",
        type: "GET",
        success: function(info_ramais) {
            // Limpar o conteúdo anterior
            $('#cartoes').empty();

            // Adicionar os novos cartões
            for(let i in info_ramais) {
                let status = info_ramais[i].status;
                let cardClass = '';
                if (status === 'indisponivel') {
                    cardClass = 'cartao-indisponivel';
                }
                $('#cartoes').append(`
                    <div class="cartao ${cardClass}">
                        <div>${info_ramais[i].nome}, Ramal: ${info_ramais[i].ramal} ${status}</div>
                        <span class="${status} icone-posicao"></span>
                    </div>
                `);
            }
        },
        error: function() {
            console.log("Erro!");
        }
    });

        $.ajax({
            url: "lib/update_db.php",
            type: "GET",
            dataType: "json",
            success: function(response) {
                // Processar a resposta JSON
                for (let nome in response) {
                    for (let numero in response[nome]) {
                        console.log(response[nome][numero]);
                    }
                }
            },
            error: function() {
                console.log("May the force be with you..");
            }
        });
}



atualizarRamais();
// Executar a função a cada 10 segundos
setInterval(atualizarRamais, 10000);
