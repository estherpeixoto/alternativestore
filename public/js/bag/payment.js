function checkout() {
    fetch('/sacola/checkout', {
        method: 'POST',
        credentials: 'same-origin',
        headers: window.headers,
        body: JSON.stringify({
            _token: window.csrf,
            product: window.product,
        }),
    }).then((response) => {
        PagSeguroLightbox(response.code)
    })
}
