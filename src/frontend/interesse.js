function registrarInteresse(id_cliente, id_servico) {
    // Constrói o objeto FormData com os dados a serem enviados via POST
    const formData = new FormData();
    formData.append('id_cliente', id_cliente);
    formData.append('id_servico', id_servico);

    // Requisição AJAX para enviar os dados para registrar_interesse.php
    fetch('src/backend/registrar_interesse.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Interesse registrado com sucesso!');
            // Atualizar a interface, se necessário
        } else {
            alert('Erro ao registrar interesse: ' + data.message);
        }
    })
    .catch(error => {
        console.error('Erro na requisição AJAX:', error);
        alert('Erro na requisição AJAX. Verifique o console para mais detalhes.');
    });
}