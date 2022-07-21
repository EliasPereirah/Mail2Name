<?php

namespace App;
class NameSuggests
{
    private array $femaleNames;
    private array $maleNames;

    public function __construct()
    {
        $this->femaleNames = json_decode(file_get_contents('data/femaleNames.json'));
        $this->maleNames = json_decode(file_get_contents('data/malesNames.json'));
    }

    private function detectFemaleName(string $email)
    {
        $data = new \stdClass();
        foreach ($this->femaleNames as $item) {
            if (preg_match("/$item->nome/i", $email)) {
                $data->name = ucfirst(strtolower($item->nome));
                $data->genre = 'female';
                $data->frequency = $item->freq;
                return $data;
            }
        }
        // if come here has no match for the email
        $data->frequency = 0;
        $data->name = '';
        $data->genre = '';
        return $data;
    }

    private function detectMaleName(string $email): \stdClass
    {
        $data = new \stdClass();
        foreach ($this->maleNames as $item) {
            if (preg_match("/$item->nome/i", $email)) {
                $data->name = ucfirst(strtolower($item->nome));
                $data->genre = 'male';
                $data->frequency = $item->freq;
                return $data;
            }
        }
        // if come here has no match for the email
        $data->frequency = 0;
        $data->name = '';
        $data->genre = '';
        return $data;
    }

    /**
     * @param string $email email to be analyzed
     * @return \stdClass object with name, frequency(total persons with this name in Brazil), and possible genre
     **/
    public function getName(string $email): \stdClass
    {
        $email = $this->removeMailServer($email);

        $female = $this->detectFemaleName($email);
        $male = $this->detectMaleName($email);
        if ($female->frequency > $male->frequency) {
            return $female;
        } else {
            return $male;
        }
    }

    private function removeMailServer($email)
    {
        return substr($email, 0, strpos($email, "@"));
    }

}