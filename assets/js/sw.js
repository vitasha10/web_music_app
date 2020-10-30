const staticCacheName = 'site-static-v1';
const assets = [
  '/',
  '/?source=pwa',
  'assets/images/logo.png',
  'assets/images/play.png',
  'assets/images/pause.png',
  'assets/images/home.png',
  'assets/images/explicit.png',
  'assets/images/search.png',
  'assets/css/index.css',
  'assets/css/preloader.css',
  'assets/fonts/cyrillic.woff2',
  'assets/fonts/cyrillic-ext.woff2',
  'assets/fonts/greek.woff2',
  'assets/fonts/greek-ext.woff2',
  'assets/fonts/latin.woff2',
  'assets/fonts/latin-ext.woff2',
  'assets/fonts/vietnamese.woff2',
  'assets/fonts/Roboto_swap.css',
  'assets/js/jquery.min.js',
];
// событие install
self.addEventListener('install', evt => {
  evt.waitUntil(
    caches.open(staticCacheName).then((cache) => {
      console.log('caching shell assets');
      cache.addAll(assets);
    })
  );
});
// событие activate
self.addEventListener('activate', evt => {
  evt.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(keys
        .filter(key => key !== staticCacheName)
        .map(key => caches.delete(key))
      );
    })
  );
});
// событие fetch
self.addEventListener('fetch', evt => {
  evt.respondWith(
    caches.match(evt.request).then(cacheRes => {
      return cacheRes || fetch(evt.request);
    })
  );
});

const dynamicCacheName = 'site-dynamic-v1';
// событие activate
self.addEventListener('activate', evt => {
  evt.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(keys
        .filter(key =>  key !== dynamicCacheName)
        .map(key => caches.delete(key))
      );
    })
  );
});
// событие fetch
self.addEventListener('fetch', evt => {
  evt.respondWith(
    caches.match(evt.request).then(cacheRes => {
      return cacheRes || fetch(evt.request).then(fetchRes => {
        return caches.open(dynamicCacheName).then(cache => {
          cache.put(evt.request.url, fetchRes.clone());
          return fetchRes;
        })
      });
    })
  );
});