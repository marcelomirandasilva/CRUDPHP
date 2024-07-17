<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../database/connect.php';

$faker = Faker\Factory::create();

for ($i = 0; $i < 50; $i++) {
    $no_pessoa = $faker->name;
    $nu_telefone = "(" . $faker->randomNumber(2, true) . ") " . $faker->randomNumber(4, true) . "-" . $faker->randomNumber(4, true);

    $co_cep =$faker->randomNumber(5, true) . '-' . $faker->randomNumber(3, true);


    $no_logradouro = $faker->streetName();
    $no_municipio = $faker->city();
    $no_bairro = $faker->word();
    $nu_logradouro = $faker->buildingNumber();
    $de_complemento = $faker->word();
    $sg_uf = substr($faker->stateAbbr(), 0, 2);


    $stmt = $conn->prepare("INSERT INTO pessoas (no_pessoa, nu_telefone, co_cep, no_logradouro, no_municipio, no_bairro, nu_logradouro, de_complemento, sg_uf) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ? )");
    $stmt->execute([$no_pessoa, $nu_telefone, $co_cep, $no_logradouro, $no_municipio, $no_bairro, $nu_logradouro, $de_complemento, $sg_uf]);
}



?>
