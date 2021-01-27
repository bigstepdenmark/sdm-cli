<?php

namespace App\Helper;

/**
 * Class TemplateHelper
 * @package App\Helper
 */
abstract class TemplateHelper
{
    private const TEMPLATE = '../../templates/';
    private const MAGENTO = 'magento/';
    private const MAGENTO_MODULE = self::MAGENTO . 'module/';

    /**
     * @param string|null $filename
     * @param array $data
     * @return string
     */
    public static function getRootPath(?string $filename = null, array $data = []): string
    {
        $path = realpath(__DIR__ . DIRECTORY_SEPARATOR . self::TEMPLATE) . '/';

        return self::get($path, $filename, $data);
    }

    /**
     * @param string|null $filename
     * @param array $data
     * @return string
     */
    public static function getMagentoPath(?string $filename = null, array $data = []): string
    {
        return self::get(self::getRootPath() . self::MAGENTO, $filename, $data);
    }

    /**
     * @param string|null $filename
     * @param array $data
     * @return string
     */
    public static function getMagentoModulePath(?string $filename = null, array $data = []): string
    {
        return self::get(self::getRootPath() . self::MAGENTO_MODULE, $filename, $data);
    }

    /**
     * @param string $path
     * @param string|null $filename
     * @param array $data
     * @return string
     */
    private static function get(string $path, ?string $filename = null, array $data = []): string
    {
        if ($filename !== null) {
            $content = file_get_contents($path . $filename . '.tmp');
            if (count($data)) {
                foreach ($data as $key => $value) {
                    $content = str_replace('{{' . $key . '}}', $value, $content);
                }
            }

            return $content;
        }

        return $path;
    }
}
