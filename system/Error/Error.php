<?php

namespace System\Error;

use System\Config\Config;

class Error
{
    public static function errorHandler($level, $message, $file, $line)
    {
        if (error_reporting() !== 0) {
            throw new \ErrorException($message, 0, $level, $file, $line);
        }
    }
    public static function exceptionHandler($exception)
    {
        $code = self::setErrorCode($exception);

        if (Config::get('app.Debug')) {
            self::showErrorDebug($exception);
        } else {
            self::setErrorLog($exception);
            self::showErrorProduction($code);
        }
    }
    private static function showErrorDebug($exception)
    {
        echo "<h1>Fatal error</h1>";
        echo "<p>Uncaught exception: '" . get_class($exception) . "'</p>";
        echo "<p>Message : '" . $exception->getMessage() . "'</p>";
        echo "<p>Stack trace: <pre>" . $exception->getTraceAsString() . "</pre></p>";
        echo "<p>Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "</p>";
    }
    private static function showErrorProduction($code)
    {
        try {
            return view("errors.$code");
        } catch (\Throwable $th) {
            $pathView = __DIR__ . "/View/$code.blade.php";
            require($pathView);
        }
    }
    private static function setErrorLog($exception)
    {
        $log = dirname(__DIR__) . '/../storage/logs/' . date('Y-m-d') . '.txt';
        ini_set('error_log', $log);
        $message = "\nFatal error\n";
        $message .= "Uncaught exception: '" . get_class($exception) . "'\n";
        $message .= "Message : '" . $exception->getMessage() . "'\n";
        $message .= "Stack trace: " . $exception->getTraceAsString() . "\n";
        $message .= "Thrown in '" . $exception->getFile() . "' on line " . $exception->getLine() . "\n\n";
        $message .= "*************************************************************************\n\n\n";
        error_log($message);
    }
    private static function setErrorCode($exception)
    {
        $code = $exception->getCode();
        $code = $code != 404 ?  500 : 404;
        http_response_code($code);
        return $code;
    }
}
