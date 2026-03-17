const CACHE_NAME = 'wakaf-nu-v2';
const assetsToCache = [
  '/manifest.json',
  'https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap'
];

self.addEventListener('install', event => {
  self.skipWaiting();
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then(cache => cache.addAll(assetsToCache))
  );
});

self.addEventListener('activate', event => {
  event.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.filter(name => name !== CACHE_NAME).map(name => caches.delete(name))
      );
    })
  );
});

self.addEventListener('fetch', event => {
  // Stale-while-revalidate for assets, Network-first for routes
  event.respondWith(
    fetch(event.request).catch(() => caches.match(event.request))
  );
});
