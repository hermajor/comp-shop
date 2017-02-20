<?php
namespace PHP_TASK; //liw\core;

class ErrorHandler
{
    private static function getErrorName($errno)
    {
        $errors = [
            E_ERROR => "E_ERROR",
            E_STRICT => "E_STRICT",
            //и т.д. все ошибки
        ];
    }

    public function Register()
    {
        set_error_handler(array($this, 'errorHandler'));
        register_shutdown_function([$this, 'fatalErrorHandler']);//для фатальных ошибок которые не ловит set_error типа неопределенная функция
        //set_exception_handler([$this, 'exceptionHandler']); //обработчик исключений
    }

    public function errorHandler($errno, $errorstr, $file, $line)
    {
        $this->showError($errno, $errorstr, $file, $line);

        return true; //
    }

    public function fatalErrorHandler()
    {
        if (!empty($error = error_get_last()) AND $error['type'] & (E_ERROR | E_PARSE | E_COMPILE_ERROR | E_CORE_ERROR)){ // 4 типа ошибок которые тут обрабатываются
            ob_get_clean(); // очищаем буфер вывода ошибки
            $this->showError($error['type'], $error['message'], $error['file'], $error['line']);
        }
    }

    //public function exceptionHandler(\Exception $e)
    //{
    //    $this->showError(get_class($e), $e->getMessage(), $e->getFile(), $e->getLine());
    //    return true;
    //}

    protected function showError($errno, $errorstr, $file, $line, $status = 500) //500 - ошибка сервера
    {
        header("HTTP/1.1 {$status}");

        echo 'Номер ошибки: '.$errno.'<hr>';
        echo $errorstr.'<hr>';
        echo 'File: '.$file.'<hr>';
        echo 'Line: '.$line.'<hr>';
    }

}
// ссылка на его гит
//https://github.com/altiore/mm/blob/lesson15/vendor/liw/core/ErrorHandler.php