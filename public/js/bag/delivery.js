let postalCode = document.getElementById('postal_code')

Inputmask({
    mask: '#####-###',
}).mask(postalCode)

postalCode.addEventListener('keyup', function (event) {
    const street = document.getElementById('street')
    const complement = document.getElementById('complement')
    const neighbour = document.getElementById('neighbour')
    const city = document.getElementById('city')
    const state = document.getElementById('state')

    if (event.target.value.replaceAll('_', '').length === 9) {
        fetch(`https://viacep.com.br/ws/${event.target.value}/json/`, {
            mode: 'cors',
        }).then((response) => {
            response.json().then((r) => {
                if (r.erro === true) {
                    changeModal({
                        state: 'error',
                        title: 'Erro',
                        description: 'Houve um erro. CEP não encontrado.',
                        secondaryButtonText: 'Voltar',
                    })

                    show()

                    postalCode.value = ''
                } else {
                    complement.value = r.complemento

                    street.value = r.logradouro
                    street.setAttribute('readonly', true)

                    neighbour.value = r.bairro
                    neighbour.setAttribute('readonly', true)

                    city.value = r.localidade
                    city.setAttribute('readonly', true)
                    document.querySelector("input[name^='city[ibge]']").value =
                        r.ibge

                    state.value = r.uf
                    state.setAttribute('readonly', true)

                    document.getElementById('number').focus()
                }
            })
        })
    } else {
        complement.value = ''

        street.value = ''
        street.setAttribute('readonly', false)

        neighbour.value = ''
        neighbour.setAttribute('readonly', false)

        city.value = ''
        city.setAttribute('readonly', false)

        state.value = ''
        state.setAttribute('readonly', false)
    }
})
