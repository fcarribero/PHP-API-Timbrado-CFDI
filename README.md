# advans/php-api-timbrado-cfdi

[![Latest Stable Version](https://img.shields.io/packagist/v/advans/php-api-timbrado-cfdi?style=flat-square)](https://packagist.org/packages/advans/php-api-timbrado-cfdi)
[![Total Downloads](https://img.shields.io/packagist/dt/advans/php-api-timbrado-cfdi?style=flat-square)](https://packagist.org/packages/advans/php-api-timbrado-cfdi)

## Instalación usando Composer

```sh
$ composer require advans/php-api-timbrado-cfdi
```

## Ejemplo

````
$service_timbrado_cfdi = new \Advans\Api\TimbradoCFDI\TimbradoCFDI([
    'base_url' => '*************************',
    'key' => '**********************'
]);

$xml_timbre = $service_timbrado_cfdi->timbre($cfdi);
````

## Configuración

| Parámetro | Valor por defecto | Descripción |
| :--- | :--- | :--- |
| base_url | null | URL de la API |
| key | null | API Key |
| use_exceptions | true | Define si una respuesta con error dispara un Exception
