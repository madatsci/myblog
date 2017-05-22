<?php

namespace App\Core;

/**
 * Class View
 * @package App\Core
 */
class View
{
    private $config;

    const TPL_POSTFIX = '.tpl';

    /**
     * View constructor.
     */
    public function __construct()
    {
        $this->config = new Config();
    }

    /**
     * Получает содержимое файла шаблона, подставляет адрес сайта и возвращает результат в виде строки
     * 
     * @param string $tplName
     * @return string
     */
    private function getTemplate($tplName)
    {
        $tplText = file_get_contents($this->config->tplDir . $tplName . self::TPL_POSTFIX);

        return str_replace('%base_url%', $this->config->baseUrl, $tplText);
    }

    /**
     * Подставляет данные в шаблон и возвращает результат в виде строки
     * 
     * @param array $data
     * @param string $tplName
     * @return string
     */
    public function renderPartial(array $data, $tplName)
    {
        $search = [];
        $replace = [];
        $i = 0;

        foreach ($data as $key => $value) {
            $search[$i] = "%$key%";
            $replace[$i] = $value;
                $i++;
        }
        
        return str_replace($search, $replace, $this->getTemplate($tplName));
    }

    /**
     * Выводит шаблон в браузер
     * 
     * @param array $data
     * @param string $tplName
     */
    public function render(array $data, $tplName)
    {
        echo $this->renderPartial($data, $tplName);
    }
}
