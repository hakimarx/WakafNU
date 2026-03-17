const CACHE_NAME = 'wakaf-nu-v1';
const urlsToCache = [
  '/',
  '/manifest.json',
  'https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap'
];

self.addEventListener('install', event => {
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(urlsToCache))
  );
});

self.addEventListener('fetch', event => {
  event.respondWith(
    caches.match(event.request)
      .then(response => response || fetch(event.request))
  );
});
