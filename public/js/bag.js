const csrf = document.querySelector("meta[name='csrf-token']").content

const headers = {
    'Content-Type': 'application/json',
    Accept: 'application/json, text-plain, */*',
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': csrf,
}

function handleSubmit(event, id) {
	const type = event.target.getAttribute('data-type')

    fetch(`/sacola/alterar-${type === 'size' ? 'tamanho' : 'quantidade'}`, {
        method: 'post',
        credentials: 'same-origin',
        headers,
        body: JSON.stringify({
            _token: csrf,
            id,
        	size_id: parseInt(event.target.value),
        }),
    }).then(response => {
		if (response.ok) {
			response.json().then(r => {
				changeModal({
					state: 'success',
					title: 'OK',
					description: (type === 'size' ? 'Tamanho' : 'Quantidade') + ' alterado com sucesso',
					secondaryButtonText: 'OK',
				})
			})
		} else {
			changeModal({
				state: 'error',
				title: 'Erro',
				description: 'Houve um erro. Por favor tente novamente mais tarde.',
				secondaryButtonText: 'Voltar',
			})
		}

		show()
	})
}
