# Yeti

![Yeti](https://github.com/RobertJGabriel/Yeti/blob/master/assets/img/banner/headerYeti.jpg "Yeti")

> A search engine framework — add search to your site with one line of code.

Yeti lets you stand up a search engine for your own site in seconds, pulling
results from several sources at once.

| | |
| --- | --- |
| Built with | PHP 5.5, JavaScript, Bootstrap, HTML5, Ajax, Material Bootstrap |
| Version | 0.4.1 |
| State | Alpha |

## Requirements

- [Node.js](http://nodejs.org/) for the build
- PHP 5.5 and a web server
- MySQL

## Setup

1. Clone the project into your `htdocs` folder:

   ```sh
   git clone https://github.com/RobertJGabriel/Yeti.git
   ```

2. Navigate into the `yeti` folder.
3. Run `npm install`.
4. Import `yeti.sql` into a database.
5. Open `Setting.php` and fill in your database connection details.
6. Done — visit <http://localhost/yeti>.

## Build commands

| Command | What it does |
| --- | --- |
| `gulp build` | Builds both the JavaScript and Less files |
| `gulp less` | Builds the Less files |
| `gulp compressJs` | Builds the JavaScript file |

# Api Calls
Currently the apis are called used the following url structure. With a base url of 
### Base Url
```
http://localhost/yeti/
```
## Calls
Then add the following 

```
/v1/getsearch.json
```

```
/v1/getusers.json
```

```
/v1/getStates.json
```

```
/v1/getPopluarSearches.json
```
```
/v1/signin
```
```
/v1/signup
```
```
/v1/signout
```

# Problems
## Windows
### Gulp Command not found - error after installing gulp
- Create an environmental variable called NODE_PATH
- Set it to: ``` %AppData%\npm\node_modules ```
- Close CMD, and Re-Open to get the new ENV variables
- Running ``` npm ls ``` and ``` npm ls -g ```shows that they are installed, but the CMD can not find them due to the missing link.


# Screenshot
### Home
![YETI](https://github.com/RobertJGabriel/Yeti/blob/master/assets/img/banner/readme/home.png "Yeti")
### Panel
![YETI](https://github.com/RobertJGabriel/Yeti/blob/master/assets/img/banner/readme/panel.png "Yeti")
### Settings
![YETI](https://github.com/RobertJGabriel/Yeti/blob/master/assets/img/banner/readme/update.png "Yeti")
### Search
![YETI](https://github.com/RobertJGabriel/Yeti/blob/master/assets/img/banner/readme/search.png "Yeti")


## License

No licence file. All rights reserved unless stated otherwise.
