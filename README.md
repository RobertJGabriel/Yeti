
![YETI](https://github.com/RobertJGabriel/Yeti/blob/master/assests/img/banner/headerYeti.jpg "Yeti")


#About
Yeti is an search engine framwork. It is designed to allow users to create a search engine for the there site in a amatter of seconds. Allowing results from different source. All by adding a line of code.


# Information
#####Built in : PHP5.5, Javascript, Bootstrap, Html5, Ajax, Material Bootstrap
#####Version Number : 0.4.1
#####State : Alpha
#####Declarative Comments Format : Read more
#####Technical Notes : Read More



#Set Up
**Prerequisites:** [Node](http://nodejs.org/).
- Clone this project to your htdocs folder ``` git clone https://github.com/RobertJGabriel/Yeti.git ```
- Navigate to the yeti folder.
- Run ``` npm install ```
- Import yeti.sql into a database.
- Open up Setting.php and add in your information for the database connection.
- Added 128.0.0.2 www.yetisearch.io to the htaccess file.
- All done, Just finsihed [here](http://www.yeti.io)

## Build Commands
- ``` gulp build  ``` : Builds both the javascript and less files
- ``` gulp less  ``` : Build the less files.
- ``` gulp compressJs  ``` : Builds the javascript file.

#Api Calls
Currently the apis are called used the following url structure. With a base url of 
###Base Url 
```
http://localhost/yeti/
```
##Calls 
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

#Problems 
##Windows
### Gulp Command not found - error after installing gulp
- Create an environmental variable called NODE_PATH
- Set it to: ``` %AppData%\npm\node_modules ```
- Close CMD, and Re-Open to get the new ENV variables
- Running ``` npm ls ``` and ``` npm ls -g ```shows that they are installed, but the CMD can not find them due to the missing link.
