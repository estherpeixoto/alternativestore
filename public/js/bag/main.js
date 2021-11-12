function handleSubmit(event, id, quantity = 1) {
    const type = event.target.getAttribute('data-type')

    fetch(`/sacola/alterar-${type === 'size' ? 'tamanho' : 'quantidade'}`, {
        method: 'post',
        credentials: 'same-origin',
        headers: window.headers,
        body: JSON.stringify({
            _token: window.csrf,
            id,
            quantity,
            size_id: parseInt(event.target.value),
        }),
    })
        .then((response) => {
            return response.json()
        })
        .then((json) => {
            updateFields(json.totals)

            changeModal({
                state: 'success',
                title: 'OK',
                description: json.message,
                secondaryButtonText: 'OK',
            })

            show()
        })
        .catch((error) => {
            changeModal({
                state: 'error',
                title: 'Erro',
                description: error.message,
                secondaryButtonText: 'Voltar',
            })

            show()
        })
}

function updateFields({ price_products, price_delivery, total }) {
    document.getElementById('price_products').innerHTML = `R$ ${price_products}`
    document.getElementById('price_delivery').innerHTML = `R$ ${price_delivery}`
    document.getElementById('total').innerHTML = `R$ ${total}`
}

function decrease(event, product_id) {
    let quantity = document.getElementById(`quantity${product_id}`)
    const newValue = parseInt(quantity.value) - 1

    if (newValue > 0) {
        quantity.value = newValue
        setTimeout(handleSubmit(event, product_id, quantity.value), 6000)
    }
}

function increase(event, product_id) {
    let quantity = document.getElementById(`quantity${product_id}`)
    quantity.value = parseInt(quantity.value) + 1

    setTimeout(handleSubmit(event, product_id, quantity.value), 6000)
}
