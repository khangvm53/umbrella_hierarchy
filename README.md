# umbrella_hierarchy

## Installation
`docker-compose up -d`
## Running environment
`http://localhost:8000/`
## Config docker-compose
### PHP Apache2
```yaml
php-apache:
  container_name: php-apache
  image: php:8.1-apache
  build:
    context: ./
    dockerfile: Dockerfile
  depends_on:
    - mysql
  volumes:
    - ./src/:/var/www/html/
  ports:
    - 8000:80
```
### Mysql
```yaml
mysql:
    container_name: mysql
    image: mysql
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: umbrella_hierarchy
      MYSQL_ROOT_PASSWORD: root
      MYSQL_USER: user
      MYSQL_PASSWORD: user121@
    ports:
      - "3306:3306"
    volumes:
      - ./src/database/umbrella_hierarchy.sql:/docker-entrypoint-initdb.d/dump.sql
```
Mock database in file `./src/database/umbrella_hierarchy.sql`

### API

|                   | Method | Endpoint               | Params           |
|-------------------|--------|------------------------|------------------|
|  Format hierarchy |  Post  | http://localhost:8000/ | json=json_string |
|  Search by name   |  Get   | http://localhost:8000/ | name=Employee 2  |

- json example 1
```json
{
  "Employee 1": "Employee 3",
  "Employee 2": "Employee 3",
  "Employee 3": "Employee 4",
  "Employee 4": "Employee 5"
}
```
- json example 2
```json
{
  "Employee 1": "Employee 3",
  "Employee 2": "Employee 3",
  "Employee 3": "Employee 4",
  "Employee 4": "Employee 5",
  "Employee 6": "Employee 2",
  "Employee 7": "Employee 4",
  "Employee 8": "Employee 7",
  "Employee 9": "Employee 5",
  "Employee 10": "Employee 6"
}
```