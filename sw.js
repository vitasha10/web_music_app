/*importScripts("assets/js/workbox-sw.js");
const {registerRoute} = workbox.routing;
const {CacheFirst} = workbox.strategies;
const {CacheableResponse} = workbox.cacheableResponse;

registerRoute(
  ({request}) => request.destination === 'image',
  new CacheFirst({
    plugins: [
      new CacheableResponsePlugin({statuses: [0, 200]})
    ],
  })
);


const workboxSW = new self.WorkboxSW();
workboxSW.precache(fileManifest);

// The route for any requests from the googleapis origin
workboxSW.router.registerRoute('/(.*)',
  workboxSW.strategies.cacheFirst({
    cacheName: 'files',
    cacheableResponse: {
      statuses: [0, 200]
    },
    networkTimeoutSeconds: 4
  })
);

////////////////////
importScripts("assets/js/workbox-sw.js");
workbox.core.skipWaiting();
workbox.core.clientsClaim();
workbox.routing.registerRoute(/\/$/, new workbox.strategies.StaleWhileRevalidate(), 'GET');

const staticCacheName = 'site-static-v1';
const assets = [
  '/',
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
  'manifest.json'
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

*/
///ffffffffffffffff app.js
/*
window.addEventListener('load', e => {
  new PWAConfApp();
  registerSW(); 
});
async function registerSW() { 
  if ('serviceWorker' in navigator) { 
    try {
      await navigator.serviceWorker.register('./sw.js'); 
    } catch (e) {
      alert('ServiceWorker registration failed. Sorry about that.'); 
    }
  } else {
    document.querySelector('.alert').removeAttribute('hidden'); 
  }
}
*/
//sw.js
/*
const cacheName = 'pwa-conf-v1';
const staticAssets = [
  '/',
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
  'manifest.json',
  'offline.html',
  'offline.css',
  'offline.js'
];
self.addEventListener('install', async event => {
  const cache = await caches.open(cacheName); 
  await cache.addAll(staticAssets); 
});

self.addEventListener('fetch', event => {
  const req = event.request;
  event.respondWith(cacheFirst(req));
});
async function cacheFirst(req) {
  const cache = await caches.open(cacheName); 
  const cachedResponse = await cache.match(req); 
  return cachedResponse || fetch(req); 
}



*/

/*
function setCookie(cname, cvalue) { //fully
  var d = new Date();
  d.setTime(d.getTime() + (30*24*60*60*1000));
  var expires = "expires="+ d.toUTCString();
  document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}
function getCookie(cname) { //fully
  var name = cname + "=";
  var decodedCookie = decodeURIComponent(document.cookie);
  var ca = decodedCookie.split(';');
  for(var i = 0; i <ca.length; i++) {
      var c = ca[i];
      while (c.charAt(0) == ' ') {
          c = c.substring(1);
      }
      if (c.indexOf(name) == 0) {
          return c.substring(name.length, c.length);
      }
  }
  return "";
}

setCookie('app_version', '1.0.0')
function get_cacheName(){
  const request = new XMLHttpRequest();
  const url = "https://api.vitasha.tk/music/get_app_version/free/";
  request.open('GET', url);
  request.setRequestHeader('Content-Type', 'application/x-www-form-url');
  request.addEventListener("readystatechange", () => {
    if (request.readyState === 4 && request.status === 200) {
      var array = JSON.parse(request.responseText);
      setCookie('app_version', array['app_version'])
      return array['app_version'];
    }else{
      return getCookie('app_version');
    }
  });
  request.send();
}
const cacheName = get_cacheName();
*/
/*
const cacheName = 'v1.0.1';
const cacheAssets = [
  '/',
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
  'manifest.json',
  'offline.html',
  'offline.css',
  'offline.js'
];

// Call Install Event
self.addEventListener('install', e => {
  console.log('Service Worker: Installed');
  e.waitUntil(
    caches
      .open(cacheName)
      .then(cache => {
        console.log('Service Worker: Caching Files');
        cache.addAll(cacheAssets);
      })
      .then(() => self.skipWaiting())
  );
});

// Call Activate Event
self.addEventListener('activate', e => {
  console.log('Service Worker: Activated');
  // Remove unwanted caches
  e.waitUntil(
    caches.keys().then(cacheNames => {
      return Promise.all(
        cacheNames.map(cache => {
          if (cache !== cacheName) {
            console.log('Service Worker: Clearing Old Cache');
            return caches.delete(cache);
          }
        })
      );
    })
  );
});

// Call Fetch Event
self.addEventListener('fetch', e => {
  console.log('Service Worker: Fetching');
  e.respondWith(fetch(e.request).catch(() => caches.match(e.request)));
});


*/







/*const cacheName = 'v1';
const staticAssets = [
    '/',
    'app.js',
    'index.css',
    'index.html',
    'logo.png',
    'offline.html',
    //'manifest.json'
];

self.addEventListener('install', async event => {
    const cache = await caches.open(cacheName);
    await cache.addAll(staticAssets);
});

/*self.addEventListener('fetch', event => {
    const req = event.request;
    event.respondWith(cacheFirst(req));
});*/
/*
async function cacheFirst(req) {
    const cache = await caches.open(cacheName);
    const cachedResponse = await cache.match(req);
    return cachedResponse || fetch(req);
}

self.addEventListener('fetch', (event) => {
    event.respondWith((async () => {
        try {
            console.log(event.request.url);
            cacheFirst(event.request);
            console.log('2323');
        } catch (error) {
            console.log('Offline', error);
            const cache = await caches.open(cacheName);
            if((event.request.url == 'index.html') || (event.request.url == 'http://localhost/')){
                const cachedResponse = await cache.match('offline.html');
                console.log('dsd');
            }else{
                const cachedResponse = await cache.match(event.request);
                console.log('dsd2');
            }
            return cachedResponse;
        }
    })());
});*/

const CACHE_NAME = 'offline1.0.0.2';
const OFFLINE_URL = 'offline.html';
self.addEventListener('install', (event) => {
  console.log('install');
  event.waitUntil((async () => {
    const cache = await caches.open(CACHE_NAME);
    await cache.add(new Request(OFFLINE_URL, { cache: 'reload' }));
    await cache.addAll([
      'assets/images/logo.png',
      'assets/css/offline.css',
      'assets/fonts/Balsamiq_swap.css',
      'manifest.json',
      'assets/images/smiley.png',
      'offline.html',
    ]);
  })());
});
self.addEventListener('activate', (event) => {
  console.log('activate');
  event.waitUntil(
    caches.keys().then(keys => {
      return Promise.all(keys
        .filter(key => key !== CACHE_NAME)
        .map(key => caches.delete(key))
      );
    })
  );
  event.waitUntil((async () => {
    if ('navigationPreload' in self.registration) {
      await self.registration.navigationPreload.enable();
    }
  })());
  self.clients.claim();
});
self.addEventListener('fetch', (event) => {
  //if (event.request.mode === 'navigate') {
  event.respondWith((async () => {
    try {
      const preloadResponse = await event.preloadResponse;
      if (preloadResponse) {
        return preloadResponse;
      }
      const networkResponse = await fetch(event.request);
      return networkResponse;
    } catch (error) {
      console.log('Offline.', error);
      const cache = await caches.open(CACHE_NAME);
      var cachedResponse;
      var host = self.location.protocol+"//"+self.location.hostname+'/';
      console.log(host);
      if (event.request.url == host) {
        cachedResponse = await cache.match(OFFLINE_URL);
      } else if (event.request.url == host+"login/") {
        cachedResponse = await cache.match(OFFLINE_URL);
      } else {
        cachedResponse = await cache.match(event.request.url);
      }
      return cachedResponse;
    }
  })());
  //}
});