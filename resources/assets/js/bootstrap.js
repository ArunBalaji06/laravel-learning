import Echo from "laravel-echo"

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: '5db02c831e5a123babb1',
    cluster: 'ap2',
    encrypted: true
});