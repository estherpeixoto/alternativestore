window.csrf = document.querySelector("meta[name='csrf-token']").content

window.headers = {
    'Content-Type': 'application/json',
    Accept: 'application/json, text-plain, */*',
    'X-Requested-With': 'XMLHttpRequest',
    'X-CSRF-TOKEN': csrf,
}
