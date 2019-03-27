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

### Run the server
```bash
bin/console server:run 127.0.0.1:PORT
```

### Validate the server is running
In your browser, go to : 
```
http://127.0.0.1:PORT/api
```

## Usage



## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
