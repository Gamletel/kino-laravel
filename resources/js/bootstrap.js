import axios from 'axios';
window.axios = axios;

window.axios.defaults.headers.common['X-Requested-With'] = 'XMLHttpRequest';

import Echo from 'laravel-echo';

import Pusher from 'pusher-js';
window.Pusher = Pusher;

window.Echo = new Echo({
    broadcaster: 'pusher',
    key: import.meta.env.VITE_PUSHER_APP_KEY,
    cluster: import.meta.env.VITE_PUSHER_APP_CLUSTER,
    forceTLS: true
});

/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';

// Enable pusher logging - don't include this in production
Echo.private(`review-liked-channel`)
    .listen('review-liked-event', (e) => {
        console.log(e);
    });

/*BROADCASTING*/
const channel = pusher.subscribe(`review-liked-channel.${commentId}`);
channel.bind('review-liked-event', function(data) {
    console.log('asdfsadf');
});
