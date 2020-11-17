# laravel.sjahn.gtz.kr  

### spec  
- php 7.3
- mysql 5.7
- laravel 5.8


### init  
```sh
# package install
composer install

# create .env
cp .env.example .env

# aes keygen
artisan key:generate

# jwt keygen
artisan jwt:secret

# migration
artisan migrate
```

