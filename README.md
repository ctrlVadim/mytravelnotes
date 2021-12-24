<h3>Docker</h3>
Start containers
```
docker-compose up -d
```

Stop containers
```
docker-compose down
```

Update containers with cache
```
docker-compose build --no-cache
```
<hr>
<h3>Laravel</h3>
<p> .env file, dont forget to change db host </p>

Database
```
php artisan migrate
```

Table users
```
php artisan db:seed --class=UserSeeder
```

Table notes
```
php artisan db:seed --class=NoteSeeder
```

Table comments
```
php artisan db:seed --class=CommentSeeder
```
<hr>

<h3>NPM</h3>

Init
```
npm run dev
```
CSS/JS editing
```
npm run watch
``` 
