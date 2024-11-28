document.addEventListener('DOMContentLoaded', function () {
    let capitaoSelected = false;
    let medioCounter = 0;
    let presilhaSelected = false;

    // Função para exibir o bilhete
    function showBilhete() {
        document.getElementById('bilhete-fixo').style.display = 'flex'; // Exibe o bilhete como flexbox
        checkIfAllSelected();
    }

    function checkIfAllSelected() {
        // Verifica se todas as seleções foram feitas (capitão, 2 médios e presilha)
        if (capitaoSelected && medioCounter === 2 && presilhaSelected) {
            document.getElementById('finalizar-btn').disabled = false; // Habilita o botão de finalizar
        }
    }

    // Seleção do Capitão
    document.querySelectorAll('#capitao-carousel .competitor-item').forEach(function (element) {
        element.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const photo = this.getAttribute('data-photo');
            document.getElementById('capitao-id').value = id; // Armazena o ID do capitão selecionado
            document.getElementById('bilhete-capitao-photo').src = photo; // Atualiza a foto no bilhete
            document.getElementById('bilhete-capitao-photo').style.display = 'block'; // Exibe a foto
            capitaoSelected = true; // Marca que o capitão foi selecionado
            showBilhete(); // Exibe o bilhete fixo
        });
    });

    // Seleção dos Médios
    document.querySelectorAll('#medio-carousel .competitor-item').forEach(function (element) {
        element.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const photo = this.getAttribute('data-photo');
            if (medioCounter === 0) { // Verifica se o primeiro médio ainda não foi selecionado
                document.getElementById('medio1-id').value = id; // Armazena o ID do primeiro médio
                document.getElementById('bilhete-medio1-photo').src = photo; // Atualiza a foto no bilhete
                document.getElementById('bilhete-medio1-photo').style.display = 'block'; // Exibe a foto
            } else if (medioCounter === 1) { // Se o primeiro médio já foi selecionado, seleciona o segundo
                document.getElementById('medio2-id').value = id; // Armazena o ID do segundo médio
                document.getElementById('bilhete-medio2-photo').src = photo; // Atualiza a foto no bilhete
                document.getElementById('bilhete-medio2-photo').style.display = 'block'; // Exibe a foto
            }
            medioCounter++; // Incrementa o contador de médios
            if (medioCounter === 2) { // Verifica se os dois médios já foram selecionados
                showBilhete(); // Exibe o bilhete fixo após selecionar os dois médios
            }
        });
    });

    // Seleção da Presilha
    document.querySelectorAll('#presilha-carousel .competitor-item').forEach(function (element) {
        element.addEventListener('click', function () {
            const id = this.getAttribute('data-id');
            const photo = this.getAttribute('data-photo');
            document.getElementById('presilha-id').value = id; // Armazena o ID da presilha selecionada
            document.getElementById('bilhete-presilha-photo').src = photo; // Atualiza a foto no bilhete
            document.getElementById('bilhete-presilha-photo').style.display = 'block'; // Exibe a foto
            presilhaSelected = true; // Marca que a presilha foi selecionada
            showBilhete(); // Exibe o bilhete fixo
        });
    });
});
