# X Micro Framework

**X Micro Framework** is a ***lightweight microservice framework*** powered by **PHP**.

## [Detailed Docs For Available Functions](https://bb7hn.github.io/XMicro/)

### GETTING STARTED

- clone or download repository

```shell
  mkdir my-project
  cd my-project
  git clone https://github.com/bb7hn/XMicroFramework.git .
```
- serve with php
````shell
  php -S 127.0.0.1:8000
````
Note: serving with php locally is requires mysql pdo

### DOCKER
- just run
````shell
  docker compose up --build 
````

- create an empty database (mysql/mariadb)
- edit config.php for credentials
- Go to http://127.0.0.1:8000/setup.php

That's it now you have a running microservice on [http://127.0.0.1:8000]()

You can find [here](https://bb7hn.github.io/XMicro/) the detailed docs for XMicro