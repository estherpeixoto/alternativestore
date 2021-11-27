function checkout() {
    fetch(`/sacola/payment`, {
        method: 'post',
        credentials: 'same-origin',
        headers: window.headers,
        body: JSON.stringify({
            _token: window.csrf,
        }),
    }).then(response => {
        return response.json()
    }).then(r => {
        document.querySelector('#picpay_qrcode img')
            .setAttribute('src', r.qrCode)

        document.querySelector('#picpay_qrcode a')
            .setAttribute('href', r.link)

        hideElements()
    })
    .catch(error => {
        console.log(error)
    })
}

function hideElements() {
    document.getElementById('picpay_description').classList.add('hidden')
    document.getElementById('submit').classList.add('hidden')
    document.getElementById('title').classList.add('hidden')
    document.getElementById('picpay_qrcode').classList.remove('hidden')
}