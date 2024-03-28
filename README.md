# DeepLink Package for Amuz CMS-UP

- CMS-UP 버전에서 사용가능한 xiso/deep-link 패키지입니다.

## Install
- 다음 명령을 통해, `root` `composer.json`에 리포지터리를 등록하고, `composer`를 통해 패키지가 자동설치될 수 있도록 할 수 있습니다.
- 먼저 저장소를 추가 합니다.

```shell
composer config repositories.xiso/deep-link vcs https://github.com/amuzcorp/deep-link
```

### for production

- 패키지의 개발상태에 따라 `:dev-main` 태그는 제거하고 지정된 버전으로 변경할 수도 있습니다.
```shell
composer require xiso/deep-link:dev-main
```

### for development

- 패키지를 개발중인 경우, 저장소를 직접 `clone` 한 것처럼, 패키지를 소스설치하는것이 더 유용할 수 있습니다.
- 패키지를 `require` 하기전에 다음과같이 해당패키지의 `--prefer-source` 옵션이 적용되도록 `root` `composer.json` 의 `config` 를 수정해야합니다.

```json
"config": {
    "preferred-install": {
        "xiso/deep-link": "source"
    }
}
```

- 이렇게하면, 해당 패키지가 `git` 을통해 `clone` 된 것 처럼 작동합니다.
- 이제 `require` 를 통해 설치하고, `composer install` 또는 `composer update` 등을 진행해도 저장소와 계속 연결이 유지되고, 변경점을 `push`할 수 있게 됩니다.

```shell
composer require xiso/deep-link:dev-main
```


## Migration & Config

필요한경우, 설정파일 및 마이그레이션 파일을 프로젝트 루트로 게시하여 활용할 수 있습니다. 다음 태그를이용해 적절히 게시하면 됩니다.

```shell
php artisan vendor:publish --tag=deep-link-config
php artisan vendor:publish --tag=deep-link-migrations
```
