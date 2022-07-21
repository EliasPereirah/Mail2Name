# Mail2Name
Obtenha sugestão de nome e genero para um dado e-mail
# Exemplo de uso
```
<?php
//use example
require("vendor/autoload.php");
$NameSuggests = new \App\NameSuggests();
$email = 'anna_silva23@server.tld';
// caso não encontre sugestão retornará name, genre vazios e frequency = 0
$mail_info = $NameSuggests->getName($email);
print_r($mail_info);
```
