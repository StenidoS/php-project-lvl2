### Hexlet tests and linter status:
[![Actions Status]]
[![PHP Composer]]
[![Maintainability]]
[![Test Coverage]]

## Setup
```sh
$ git clone https://github.com/StenidoS/php-project-lvl2

$ make install
```

## Run tests & linter
```sh
$ make test

$ make lint

$ make lint-fix
```



### Help
```shell
$ ./bin/gendiff -h
```

### Use gendiff for two json files
```shell
$ ./bin/gendiff tests/fixtures/file11.json tests/fixtures/file22.json
```
[![asciicast]]


### Use gendiff for two yml files
```shell
$ ./bin/gendiff tests/fixtures/file1.yaml tests/fixtures/file2.yaml
```
[![asciicast]]


### Use gendiff for two recursive yaml and json files
```shell
./bin/gendiff tests/fixtures/file11.json tests/fixtures/file22.json
```
```shell
./bin/gendiff tests/fixtures/file1.yaml tests/fixtures/file2.yaml

```
[![asciicast]]


### Use gendiff with format plain for two recursive yaml and json files
```shell
./bin/gendiff --format plain tests/fixtures/file11.json tests/fixtures/file22.json
```
```shell
./bin/gendiff --format plain tests/fixtures/file.yaml tests/fixtures/file2.yaml

```
[![asciicast]]


### Use gendiff with format json for two recursive yaml and json files
```shell
./bin/gendiff --format json tests/fixtures/file11.json tests/fixtures/file22.json
```
```shell
./bin/gendiff --format json tests/fixtures/file1.yaml tests/fixtures/file2.yaml
```
[![asciicast]]
[![asciicast]]
