# Secured API Test
Secured API Test is a test requested to build a secured API which would contain a SOA structure. A second project will contain the interface allowing to add/edit the data via this API.

## Installation

### Clone the git repository

```bash
git clone git@github.com:dtfafard/secured-api-test.git
```

### Set up your database
Create your user and database name. MySQL was used for tutorial but other databases are welcomed.

```bash
# In .env
DATABASE_URL=mysql://USERNAME:PASSWORD@SERVERIP:PORT/DATABASE
```

### Install Composer
```bash
composer install
```

### Migrate the DB
```bash
bin/console doctrine:migrations:migrate
```

### Run the sandbox builder
```bash
bin/console seedbox:setup-sandbox
```

### Generate the private & public pem
Follow the steps here : https://github.com/lexik/LexikJWTAuthenticationBundle/blob/master/Resources/doc/index.md#generate-the-ssh-keys-
NOTE that you have to use openssl otherwise. JWT from Lexik depends on this library.
NOTE make sure you use the passphrase "mytest" as this is the one noted in the : lexik_jwt_authentication.yaml file. If you wish to use your own passphrase, please make sure to also update it in the config file.

### Clear the cache 
```bash
bin/console cache:clear
```

### Run the server
Choose a PORT to run the server on.

```bash
bin/console server:run 127.0.0.1:PORT
```

### Validate the server is running
In your browser, go to : 
```
http://127.0.0.1:PORT/api
```
NOTE the port to be updated according to the port you chose in the previous step.

## Usage
### Get the Token
Call the following CURL command. NOTE : make sure to update the PORT value according to the port you chose.
```
curl -X POST -H "Content-Type: application/json" http://127.0.0.1:PORT/api/login_check -d '{"username":"example1@gmail.com","password":"test123"}'
```

You should get a response like this : 
```
{"token":"TOKENVALUE_FROM_CURL_REQUEST"}
```

### Set up the Token
In your browser, go to : 
```
http://127.0.0.1:PORT/api
```

Click on "Authorize"

Enter in the field : 
```
Bearer TOKENVALUE_FROM_CURL_REQUEST
```

Click on "Authorize" and then on "Close"

### Make calls in the web interface
Click on the calls and click on "Try it out"

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
