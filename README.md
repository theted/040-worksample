# 040 worksample
Sample application


## Public url
Is available at https://040.herp.se/

---

## Local setup & build instructions
Should be pretty straight-forward: 

#### Clone this repo:
```
git clone git@github.com:theted/040-worksample.git
```

### Define database user config:
Database config is stored in `config.php`. Set values for your local database.

#### Import database structure
Add database tables structure, stored in `./data/db.sql`.

---

## Development instructions

#### Install dependencies
```
npm install
```

#### Build static assets (css,js,php views)
```
npm run build
```

### Watch assets
Watch assets, re-build & automatically reload as needed:
```
npm run watch
```

---

## Technologies used / under the hood
This application is using [gulp] as the task runner, [stylus] as the CSS-processor and [pug] as the HTML templateing enginge. Additionally, [browser-sync] is used to dynamically&autimagicly update re-compiled static assets in open browser(s). Default port is `3001`.

Dynamic output is regular `.php`, `.css` & `.js` files and is thus easily hosted on any webserver supporting php (~7.0).


<!-- links -->
[gulp]: https://gulpjs.com
[stylus]: http://stylus-lang.com/
[pug]: https://pugjs.org/
[browser-sync]: https://browsersync.io
